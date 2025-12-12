<?php

namespace App\Http\Controllers\Sinistre;

use Carbon\Carbon;
use App\Models\TblVille;
use App\Models\TblMaladie;
use App\Models\TblSinistre;
use Illuminate\Support\Str;
use App\Models\TblSignature;
use Illuminate\Http\Request;
use App\Models\TblDocSinistre;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use App\Models\TblMotifrejetbyprestat;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SinistreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.sinistre.index');
    }

    public function newSinistre()
    {
        return view('users.sinistre.newSinistre');
    }

    public function getSinistreDoc(string $idSinistre)
    {
        try {
            $DocSinistres = TblDocSinistre::where('idSinistre', $idSinistre)->get();
            if ($DocSinistres->isEmpty()) {
                return response()->json(['status' => 'success', 'data' => []]);
            }
            return response()->json([
                'status' => 'success',
                'data' => $DocSinistres,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue : ' . $th->getMessage(),
            ], 500);
        }
    }

    public function historySinistre()
    {
        return view('users.sinistre.historySinistre');
    }

    public function getInfoSinistre(string $id)
    {
        $sinistre = TblSinistre::where('id', $id)->first();
        return view('users.espace_client.services.fiches.infoSinistreByQrcode', compact('sinistre'));
    }

    public function checkContrat(Request $request)
    {
        try {
            $idcontrat = $request->input('contratId');

            $response = Http::withOptions(['timeout' => 60])
                ->post(config('services.api.encaissement_bis'), [
                    'idContrat' => $idcontrat,
                ]);

            if (!$response->successful()) {
                return response()->json([
                    'type' => 'error',
                    'message' => 'Erreur lors de la communication avec le service externe.',
                ], 400);
            }

            $data = $response->json();

            if (empty($data['details'])) {
                return response()->json([
                    'type' => 'error',
                    'message' => 'Aucun contrat trouvé pour cet ID.',
                ], 404);
            }

            $DateNaissanceContrat = $data['details'][0]['DateNaissance'] ?? null;

            if (!$DateNaissanceContrat) {
                return response()->json([
                    'type' => 'error',
                    'message' => 'La date de naissance est introuvable dans le contrat.',
                ], 400);
            }

            // Normalisation du format de date
            try {
                $DateNaissanceContrat = Carbon::createFromFormat('d/m/Y', $DateNaissanceContrat)->format('d/m/Y');
            } catch (\Exception $e) {
                return response()->json([
                    'type' => 'error',
                    'message' => 'Format de date de naissance invalide dans le contrat.',
                ], 400);
            }


            $datenaissance = ($request->input('user_id') != null) ? $DateNaissanceContrat : Carbon::parse($request->input('datenaissanceSous'))->format('d/m/Y');

            if ($DateNaissanceContrat !== $datenaissance) {
                return response()->json([
                    'type' => 'error',
                    'message' => "La date de naissance saisie ne correspond pas à celle enregistrée dans le contrat. Veuillez contacter YAKO AFRICA +(225)27 20 33 15 00.",
                ], 400);
            }
            $codeProduitYAKOFondPerdu = ['YKS_2008', 'YKS_2018', 'YKF_2008', 'YKF_2018'];
            // Ajouter 10 ans
            $DateFinAdhesion = Carbon::parse($data['details'][0]['DateEffetReel']);
            $DateFinAdhesion->addYears(10);
            if (in_array($data['details'][0]['codeProduit'], $codeProduitYAKOFondPerdu) && $DateFinAdhesion < Carbon::now()) {
                return response()->json([
                    'type' => 'error',
                    'message' => "Le contrat est arrêté et vous ne pouvez plus déclarer de sinistre.",
                ], 400);
            }

            // Sauvegarde en session
            session([
                'contratDetails' => $data['details'][0],
                'contratActeur' => $data['allActeur'] ?? [],
                'contratActeurAssure' => collect($data['allActeur'])->where('CodeRole', 'ASS') ?? [],
                'contratActeurBeneficiaire' => collect($data['allActeur'])->where('CodeRole', 'BEN') ?? [],
            ]);

            $assures = collect($data['allActeur'])->where('CodeRole', 'ASS')->values()->all();

            return response()->json([
                'type' => 'success',
                'assures' => $assures,
                'contratDetails' => $data['details'][0],
                'message' => 'Contrat trouvé avec succès.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => 'Une erreur interne s\'est produite : ' . $e->getMessage(),
            ], 500);
        }
    }

    // api pour edit
    public function getContratAssures(Request $request)
    {
        $idcontrat = $request->input('IdProposition');
        $CodeAssure = $request->input('CodeAssure');

        $response = Http::withOptions(['timeout' => 60])
            ->post(config('services.api.encaissement_bis'), [
                'idContrat' => $idcontrat,
            ]);
        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data['details'])) {
                session(['contratDetails' => $data['details'][0]]);
                session(['contratActeur' => $data['allActeur']]);
                session(['contratActeurAssure' => collect($data['allActeur'])->where('CodeRole', 'ASS')->where('IdPropositionPartenaires', $CodeAssure)->first()]);
                session(['contratActeurBeneficiaire' => collect($data['allActeur'])->where('CodeRole', 'BEN')]);

                $CodeAssure = session('contratActeurAssure')['IdPropositionPartenaires'];

                $sinistreEnCours = TblSinistre::where([
                    ['idcontrat', '=', $idcontrat],
                    ['codeAssuree', '=', $CodeAssure],
                    ['etape', '=', 1],
                ])->first();
                $sinistreInacheve = TblSinistre::where([
                    ['idcontrat', '=', $idcontrat],
                    ['codeAssuree', '=', $CodeAssure],
                    ['etape', '=', 0],
                ])->first();

                if ($sinistreEnCours) {
                    return response()->json([
                        'type' => 'error',
                        'urlback' => '',
                        'message' => "Une pré-déclaration de sinistre N° $sinistreEnCours->code pour le contrat $sinistreEnCours->idcontrat sur l'assuré(e) $sinistreEnCours->prenomAssuree $sinistreEnCours->nomAssuree est en cours de traitement. Veuillez patienter.",
                        'code' => 500,
                    ]);
                } else if ($sinistreInacheve) {
                    return response()->json([
                        'type' => 'error',
                        'urlback' => '',
                        'message' => "Vous avez une pré-déclaration de sinistre N° $sinistreInacheve->code pour le contrat $sinistreInacheve->idcontrat sur l'assuré(e) $sinistreInacheve->prenomAssuree $sinistreInacheve->nomAssuree inachevée. Veuillez finaliser la pré-déclaration.",
                        'code' => 500,
                    ]);
                } else {
                    return response()->json([
                        'type' => 'success',
                        'urlback' => route('sinistre.create'),
                        'message' => 'Un instant ...',
                        'code' => 200,
                    ]);
                }
            } else {
                return response()->json([
                    'type' => 'error',
                    'urlback' => '',
                    'message' => 'Aucun contrat trouvé pour cet ID.',
                    'code' => 400,
                ]);
            }
        } else {
            // session(['message' => "Une erreur s'est produite."]);
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => 'Une erreur s\'est produite.',
                'code' => 400,
            ]);
        }
    }

    public function create()
    {
        // Vérification des sessions REQUISES
        if (!session()->has('contratDetails') || !session()->has('contratActeur')) {
            return redirect()->route('sinistre.newSinistre')->with('error', 'Votre Session a expirée');
        }

        // Récupération des données de session
        $details = session('contratDetails');
        $acteurs = session('contratActeur');
        $assuree = session('contratActeurAssure');
        $beneficiaires = session('contratActeurBeneficiaire');
        $produit = $details['produit'];
        session(['NomProduit' => $produit]);
        // dd($details,$produit);

        // dd($beneficiaires);

        // $maladies = TblMaladie::all();

        $villes = TblVille::all();
        $response = Http::withOptions(['timeout' => 60])
            ->get(config('services.api.filiations'));
        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data)) {
                $filiations = $data;
            }
        } else {
            $filiations = [];
        }
        $response = Http::withOptions(['timeout' => 60])
            ->get(config('services.api.maladies'));
        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data)) {
                $maladies = $data;
            }
        } else {
            $maladies = [];
        }
        $response = Http::withOptions(['timeout' => 60])
            ->get(config('services.api.pompes_funebres_list'));
        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data)) {
                $lieuConservation = $data;
            }
        } else {
            $lieuConservation = [];
        }

        // Génération du token sécurisé
        $tok = Str::random(80);

        $token = [
            'token' => $tok,
            'operation_type' => "E-SINISTRE",
            'key_uuid' => $tok
        ];
        $keyUuid = $token['key_uuid'];
        $operationType = $token['operation_type'];
        try {
            $response = Http::withOptions(['timeout' => 60])->get(config('services.get_countries_api'));

            if ($response->successful()) {
                $data = $response->json();

                // Vérifie si la clé "countries" existe
                if (isset($data['countries'])) {
                    $detailCountries = $data['countries'];
                } else {
                    Log::info('La clé "countries" est absente de la réponse API.');
                }
            } else {
                Log::error('Échec de la récupération des pays depuis l\'API.');
            }
        } catch (\Exception $e) {
            Log::error('Exception lors de l\'appel à l\'API des pays : ' . $e->getMessage());
        }
        $this->clearSinistreSessions();
        return view('users.sinistre.create', compact('token', 'tok', 'details', 'acteurs', 'assuree', 'beneficiaires', 'maladies', 'villes', 'filiations', 'lieuConservation', 'keyUuid', 'operationType', 'detailCountries'));
    }

    // Méthode privée pour nettoyer les sessions
    private function clearSinistreSessions()
    {
        session()->forget([
            'contratDetails',
            'contratActeur',
            'contratActeurAssure',
            'contratActeurBeneficiaire',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // $saisiepar = auth()->user()->idmembre;
            // $otp = $request->otp_1 . $request->otp_2 . $request->otp_3 . $request->otp_4 . $request->otp_5 . $request->otp_6;
            // $otpVerif = Tblotp::where('codeOTP', $otp)->first();
            // $idOtp = $otpVerif->id ?? null;
            // Vérifier si une prestation similaire existe déjà

            // $prestationUpdated = session('prestation', null);

            $moyenPaiement = $request->moyenPaiement;
            // $etape = ($request->Singletype == 'AttestationPerteContrat') ? 0 : 1;

            $TelPaiement = ($moyenPaiement == 'Virement_Bancaire') ? null : $request->TelPaiement;
            $Operateur = ($moyenPaiement == 'Virement_Bancaire') ? null : $request->Operateur;

            // 5 caracteres
            $codeBanque = ($moyenPaiement == 'Virement_Bancaire') ? $request->rib_1 . $request->rib_2 . $request->rib_3 . $request->rib_4 . $request->rib_5 : null;

            // 5 caracteres
            $codeGuichet = ($moyenPaiement == 'Virement_Bancaire') ? $request->rib_6 . $request->rib_7 . $request->rib_8 . $request->rib_9 . $request->rib_10 : null;

            // 12 caracteres
            $numCompte = ($moyenPaiement == 'Virement_Bancaire') ? $request->rib_11 . $request->rib_12 . $request->rib_13 . $request->rib_14 . $request->rib_15 . $request->rib_16 . $request->rib_17 . $request->rib_18 . $request->rib_19 . $request->rib_20 . $request->rib_21 . $request->rib_22 : null;

            // 2 caracteres
            $cleRIB = ($moyenPaiement == 'Virement_Bancaire') ? $request->rib_23 . $request->rib_24 : null;

            $IBAN = ($moyenPaiement == 'Virement_Bancaire') ? $request->IBAN : null;

            $sinistreEnCours = TblSinistre::where([
                ['idcontrat', '=', $request->idcontrat],
                ['codeAssuree', '=', $request->codeAssuree],
                ['etape', '=', 1],
            ])->first();
            $sinistreInacheve = TblSinistre::where([
                ['idcontrat', '=', $request->idcontrat],
                ['codeAssuree', '=', $request->codeAssuree],
                ['etape', '=', 0],
            ])->first();

            if ($sinistreEnCours) {
                return response()->json([
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Une pré-déclaration de sinistre N° $sinistreEnCours->code pour le contrat $sinistreEnCours->idcontrat sur l'assuré(e) $sinistreEnCours->prenomAssuree $sinistreEnCours->nomAssuree est en cours de traitement. Veuillez patienter.",
                    'code' => 500,
                ]);
            } else if ($sinistreInacheve) {
                return response()->json([
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Vous avez une pré-déclaration de sinistre N° $sinistreInacheve->code pour le contrat $sinistreInacheve->idcontrat sur l'assuré(e) $sinistreInacheve->prenomAssuree $sinistreInacheve->nomAssuree inachevée. Veuillez finaliser la pré-déclaration.",
                    'code' => 500,
                ]);
            } else {
                $sinistre = TblSinistre::create([
                    'code' => RefgenerateCodePrest(TblSinistre::class, 'SIN-', 'code'),
                    'nomDecalarant' => $request->nomDecalarant,
                    'idcontrat' => $request->idcontrat,
                    'prenomDecalarant' => $request->prenomDecalarant,
                    'datenaissanceDecalarant' => $request->datenaissanceDecalarant,
                    'lieunaissanceDecalarant' => $request->lieunaissanceDecalarant,
                    'filiation' => $request->filiation,
                    'lieuresidenceDecalarant' => $request->lieuresidenceDecalarant,
                    'celDecalarant' => $request->celDecalarant,
                    'emailDecalarant' => $request->emailDecalarant,
                    'genreAssuree' => $request->genreAssuree,
                    'nomAssuree' => $request->nomAssuree,
                    'prenomAssuree' => $request->prenomAssuree,
                    'datenaissanceAssuree' => $request->datenaissanceAssuree,
                    'lieunaissanceAssuree' => $request->lieunaissanceAssuree,
                    'professionAssuree' => $request->professionAssuree,
                    'lieuresidenceAssuree' => $request->lieuresidenceAssuree,
                    'natureSinistre' => $request->natureSinistre,
                    'decesAccidentel' => $request->decesAccidentel,
                    'declarationTardive' => $request->declarationTardive,
                    'dateSinistre' => $request->dateSinistre,
                    'causeSinistre' => $request->causeSinistre,
                    'lieuConservation' => $request->lieuConservation,
                    'montantBON' => $request->montantBON,
                    'dateLevee' => $request->dateLevee,
                    'lieuLevee' => $request->lieuLevee,
                    'dateInhumation' => $request->dateInhumation,
                    'lieuInhumation' => $request->lieuInhumation,
                    'codeAssuree' => $request->codeAssuree,
                    'moyenPaiement' => $moyenPaiement,
                    'Operateur' => $Operateur,
                    'telPaiement' => $TelPaiement,
                    'codebanque' => $codeBanque,
                    'codeagence' => $codeGuichet,
                    'numcompte' => $numCompte,
                    'clerib' => $cleRIB,
                    'IBAN' => $IBAN,
                    'saisiepar' => $request->saisiepar,
                ]);

                // Vérification si le sinistre a été créée
                if (!$sinistre) {
                    return response()->json([
                        'type' => 'error',
                        'urlback' => '',
                        'message' => "Erreur lors de l'enregistrement de la pré-déclaration de sinistre",
                        'code' => 500,
                    ]);
                } else {
                    // Chemin externe pour stocker les fichiers
                    $externalUploadDir = base_path(env('UPLOAD_SINISTRE_FILE'));

                    if (!is_dir($externalUploadDir)) {
                        mkdir($externalUploadDir, 0777, true);
                    }

                    // Gestion des fichiers uploadés
                    if ($request->hasFile('docFile')) {
                        $contrat = $request->idcontrat;
                        // $rectoFile = null;
                        // $versoFile = null;
                        $sinistreFiles = [];

                        foreach ($request->file('docFile') as $index => $file) {
                            $fileLibelle = $request->libelle[$index];
                            // suppremer les espace, les caractères spéciaux et les mettre en majuscule la première lettre de chaque mot
                            $fileType = ucwords(str_replace(' ', '', $fileLibelle));
                            $fileType = preg_replace('/[^a-zA-Z0-9]/', '', $fileType);

                            $fileName = Carbon::now()->format('Ymd_His') . '_' . $contrat . '_' . $fileType . '.' . $file->extension();
                            $file->move($externalUploadDir . "$sinistre->code/docsSinistre/", $fileName);
                            $sinistreFiles[] = [
                                'idSinistre' => $sinistre->id,
                                'libelle' => $fileLibelle,
                                'path' => "storage/sinistre/$sinistre->code/docsSinistre/$fileName",
                                'filename' => $fileName,
                            ];
                        }

                        // Enregistrer tous les fichiers
                        foreach ($sinistreFiles as $fileData) {
                            TblDocSinistre::create($fileData);
                        }
                    }
                    $sign = TblSignature::where('key_uuid', $request->tokGenerate)->first();
                    $sign->update([
                        'reference_key' => $sinistre->code
                    ]);
                    // DB::commit();
                    $sinistrePdfUrl = $this->generateSinistrePdf($sinistre);

                    if ($sinistrePdfUrl['success'] == false) {
                        return response()->json([
                            'type' => 'error',
                            'urlback' => '',
                            'message' => "Une erreur est survenue lors de la génération de la fiche de sinistre! " . $sinistrePdfUrl['message'],
                            'code' => 500,
                        ]);
                    } else {
                        return response()->json([
                            'type' => 'success',
                            'urlback' => $sinistrePdfUrl['redirect_url'],
                            'url' => $sinistrePdfUrl['file_url'],
                            'message' => "Enregistré avec succès !",
                            'code' => 200,
                        ]);
                    }
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
    }

    private function generateSinistrePdf($sinistre)
    {
        try {
            // Chemin externe pour stocker les fichiers
            // $externalUploadDir = base_path('../uploads/prestations/');
            $externalUploadDir = base_path(env('UPLOAD_SINISTRE_FILE'));
            if (!is_dir($externalUploadDir)) {
                mkdir($externalUploadDir, 0777, true);
            }
            $imageUrl = env('SIGN_API') . "api/get-signature/" . $sinistre->code . "/E-SINISTRE";
            if ($imageUrl != null || $imageUrl != '') {
                $imageData = file_get_contents($imageUrl);
                $base64Image = base64_encode($imageData);
                $imageSrc = 'data:image/png;base64,' . $base64Image;
            } else {
                $imageSrc = '';
            }
            $NomProduit = session('NomProduit');

            $qrcode = base64_encode(QrCode::format('svg')->size(80)->generate(url('sinistre/getInfoSinistre/' . $sinistre->id)));
            $pdf = Pdf::loadView('users.espace_client.services.fiches.sinistre', compact('qrcode', 'sinistre', 'imageSrc','NomProduit'))
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'margin-left' => 0,
                    'margin-right' => 0,
                    'margin-top' => 0,
                    'margin-bottom' => 0,
                ]);
            // Dossier pour enregistrer l'état de la prestation
            $etatPrestationDir = $externalUploadDir . "$sinistre->code/ficheSinistre/";
            if (!is_dir($etatPrestationDir)) {
                mkdir($etatPrestationDir, 0777, true);
            }

            $fileName = 'ficheSinistre_' . $sinistre->code . '.pdf';
            $filePath = $etatPrestationDir . $fileName;
            $pdf->save($filePath);

            // Enregistrer le fichier dans la base de données
            TblDocSinistre::create([
                'idSinistre' => $sinistre->id,
                'libelle' => 'Fiche de déclaration de sinistre',
                'path' => "storage/sinistre/$sinistre->code/ficheSinistre/$fileName",
                'filename' => $fileName,
            ]);

            DB::commit();

            // Retourner l'URL complète du fichier PDF
            $pdfUrl = url("storage/sinistre/$sinistre->code/ficheSinistre/$fileName");
            return [
                'success' => true,
                'file_url' => $pdfUrl,
                'redirect_url' => route('sinistre.show', $sinistre->code),
                // 'redirect_url' => "#",
            ];
        } catch (\Exception $e) {
            Log::error("Erreur lors de la génération de la fiche de sinistre : ", ['error' => $e]);
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function getSinistre(Request $request)
    {
        $idcontrat = $request->input('contratId');
        $code = $request->input('code');

        try {
            $sinistres = TblSinistre::where('idcontrat', $idcontrat)->orWhere('code', $code)->get();
            if ($sinistres->isEmpty()) {
                return response()->json(['status' => 'success', 'data' => []]);
            }
            return response()->json([
                'status' => 'success',
                'data' => $sinistres,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue : ' . $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $code)
    {
        $sinistre = TblSinistre::where('code', $code)->first();
        return view('users.sinistre.show', compact('sinistre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $code)
    {
        $sinistre = TblSinistre::where('code', $code)->first();
        // Vérifier si la session contient déjà les docs de ce sinistre
        $sessionKey = 'sinistre_docs_' . $sinistre->id;

        if (!Session::has($sessionKey)) {
            // Charger les documents depuis la base seulement la première fois
            $documents = TblDocSinistre::select('id', 'libelle', 'filename', 'path')
                ->where('idSinistre', $sinistre->id)
                ->get()
                ->toArray();

            // Stocker dans la session (non modifiable ensuite)
            Session::put($sessionKey, $documents);
        }

        // Récupérer la liste depuis la session
        // $documentsSession = Session::get($sessionKey);
        // $documentsRequired = $sinistre->docSinistre->toArray();

        // Vérifier si tous les documents requis sont disponibles
        // $conditionsInvalides = count($documentsRequired) !== count($documentsSession);
        // dd($documentsRequired);

        $documentsSession = collect(Session::get($sessionKey));

        // Documents requis (ex. docSinistre = documents à fournir)
        $documentsRequired = $documentsSession->pluck('libelle')->toArray();

        // Documents déjà fournis
        $documentsExistants = collect($sinistre->docSinistre)->pluck('libelle')->toArray();

        // 🔍 Trouver les documents manquants
        $documentsManquants = array_diff($documentsRequired, $documentsExistants);
        // dd($documentsManquants,$documentsRequired,$documentsExistants);

        $conditionsInvalides = count($documentsManquants) > 0;

        $idcontrat = $sinistre->idcontrat;
        $CodeAssure = $sinistre->codeAssuree;

        $response = Http::withOptions(['timeout' => 60])
            ->post(config('services.api.encaissement_bis'), [
                'idContrat' => $idcontrat,
            ]);
        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data['details'])) {
                $details = $data['details'][0];
                $contratActeur = $data['allActeur'];
                $contratActeurAssure = collect($data['allActeur'])->where('CodeRole', 'ASS')->where('IdPropositionPartenaires', $CodeAssure)->first();
                // dd($contratActeurAssure);
                $contratActeurBeneficiaire = collect($data['allActeur'])->where('CodeRole', 'BEN');
            }
        }

        $villes = TblVille::all();
        $response = Http::withOptions(['timeout' => 60])
            ->get(config('services.api.filiations'));
        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data)) {
                $filiations = $data;
            }
        } else {
            $filiations = [];
        }
        $response = Http::withOptions(['timeout' => 60])
            ->get(config('services.api.maladies'));
        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data)) {
                $maladies = $data;
            }
        } else {
            $maladies = [];
        }
        $response = Http::withOptions(['timeout' => 60])
            ->get(config('services.api.pompes_funebres_list'));
        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data)) {
                $lieuConservation = $data;
            }
        } else {
            $lieuConservation = [];
        }
        return view('users.sinistre.edit', compact('sinistre', 'villes', 'filiations', 'maladies', 'lieuConservation', 'details', 'contratActeur', 'contratActeurAssure', 'contratActeurBeneficiaire', 'conditionsInvalides', 'documentsManquants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code)
    {
        DB::beginTransaction();
        try {
            $updatedSinistre = TblSinistre::where('code', $code)->first();
            $updatedSinistre->update([
                'nomDecalarant' => $request->nomDecalarant ?? $updatedSinistre->nomDecalarant,
                'prenomDecalarant' => $request->prenomDecalarant ?? $updatedSinistre->prenomDecalarant,
                'datenaissanceDecalarant' => $request->datenaissanceDecalarant ?? $updatedSinistre->datenaissanceDecalarant,
                'lieunaissanceDecalarant' => $request->lieunaissanceDecalarant ?? $updatedSinistre->lieunaissanceDecalarant,
                'filiation' => $request->filiation ?? $updatedSinistre->filiation,
                'lieuresidenceDecalarant' => $request->lieuresidenceDecalarant ?? $updatedSinistre->lieuresidenceDecalarant,
                'celDecalarant' => $request->celDecalarant ?? $updatedSinistre->celDecalarant,
                'emailDecalarant' => $request->emailDecalarant ?? $updatedSinistre->emailDecalarant,
                'genreAssuree' => $request->genreAssuree ?? $updatedSinistre->genreAssuree,
                'nomAssuree' => $request->nomAssuree ?? $updatedSinistre->nomAssuree,
                'prenomAssuree' => $request->prenomAssuree ?? $updatedSinistre->prenomAssuree,
                'datenaissanceAssuree' => $request->datenaissanceAssuree ?? $updatedSinistre->datenaissanceAssuree,
                'lieunaissanceAssuree' => $request->lieunaissanceAssuree ?? $updatedSinistre->lieunaissanceAssuree,
                'professionAssuree' => $request->professionAssuree ?? $updatedSinistre->professionAssuree,
                'lieuresidenceAssuree' => $request->lieuresidenceAssuree ?? $updatedSinistre->lieuresidenceAssuree,
                'natureSinistre' => $request->natureSinistre ?? $updatedSinistre->natureSinistre,
                'decesAccidentel' => $request->decesAccidentel ?? $updatedSinistre->decesAccidentel,
                'declarationTardive' => $request->declarationTardive ?? $updatedSinistre->declarationTardive,
                'dateSinistre' => $request->dateSinistre ?? $updatedSinistre->dateSinistre,
                'causeSinistre' => $request->causeSinistre ?? $updatedSinistre->causeSinistre,
                'lieuConservation' => $request->lieuConservation ?? $updatedSinistre->lieuConservation,
                'montantBON' => $request->montantBON ?? $updatedSinistre->montantBON,
                'dateLevee' => $request->dateLevee ?? $updatedSinistre->dateLevee,
                'lieuLevee' => $request->lieuLevee ?? $updatedSinistre->lieuLevee,
                'dateInhumation' => $request->dateInhumation ?? $updatedSinistre->dateInhumation,
                'lieuInhumation' => $request->lieuInhumation ?? $updatedSinistre->lieuInhumation,
                'codeAssuree' => $request->codeAssuree ?? $updatedSinistre->codeAssuree,
                'etape' => 0,
            ]);

            if ($updatedSinistre) {
                $sinistrePdfUrl = $this->updateSinistrePdf($updatedSinistre);
                // $motifsRejet = TblMotifrejetbyprestat::where('codeprestation', $code)->get();
                // foreach ($motifsRejet as $motif) {
                //     $motif->delete();
                // }
                if (!$sinistrePdfUrl) {
                    Log::info("Erreur lors de la mise à jour du PDF du sinistre");
                }
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => 'back',
                    'message' => "Modifiée avec succès!",
                    'code' => 200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de la mise à jour!",
                    'code' => 500,
                ];
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur systeme! $th",
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }

    public function addDocSinistre(Request $request)
    {
        DB::beginTransaction();
        try {
            $sinistre = TblSinistre::where('code', $request->code)->first();
            // Chemin externe pour stocker les fichiers
            $externalUploadDir = base_path(env('UPLOAD_SINISTRE_FILE'));

            if (!is_dir($externalUploadDir)) {
                mkdir($externalUploadDir, 0777, true);
            }

            // Gestion des fichiers uploadés
            if ($request->hasFile('docFile')) {
                $contrat = $request->idcontrat;
                // $rectoFile = null;
                // $versoFile = null;
                $sinistreFiles = [];

                foreach ($request->file('docFile') as $index => $file) {
                    $fileLibelle = $request->libelle[$index];
                    // suppremer les espace, les caractères spéciaux et les mettre en majuscule la première lettre de chaque mot
                    $fileType = ucwords(str_replace(' ', '', $fileLibelle));
                    $fileType = preg_replace('/[^a-zA-Z0-9]/', '', $fileType);

                    $fileName = Carbon::now()->format('Ymd_His') . '_' . $contrat . '_' . $fileType . '.' . $file->extension();
                    $file->move($externalUploadDir . "$sinistre->code/docsSinistre/", $fileName);
                    $sinistreFiles[] = [
                        'idSinistre' => $sinistre->id,
                        'libelle' => $fileLibelle,
                        'path' => "storage/sinistre/$sinistre->code/docsSinistre/$fileName",
                        'filename' => $fileName,
                    ];
                }

                // Enregistrer tous les fichiers
                foreach ($sinistreFiles as $fileData) {
                    TblDocSinistre::create($fileData);
                }
            }
            DB::commit();
            $dataResponse = [
                'type' => 'success',
                'urlback' => 'back',
                'message' => "Document ajouté avec succès!",
                'code' => 200,
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur systeme! $th",
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }

    public function transmettreSinistre(string $code)
    {
        DB::beginTransaction();
        try {
            $sinistreTransmitted = TblSinistre::where('code', $code)->first();
            $sessionKey = 'sinistre_docs_' . $sinistreTransmitted->id;
            // Récupérer la liste depuis la session
            $documentsSession = Session::get($sessionKey);
            $documents = $documentsSession;


            $documentsRequired = $sinistreTransmitted->docSinistre->toArray();

            foreach ($documents as $doc) {
                if (array_key_exists($doc['libelle'], $documentsRequired)) {
                    $documentsRequired[$doc['libelle']] = $doc['libelle']; // Stocke la valeur si elle existe
                }
            }
            // Vérifier si tous les documents requis sont disponibles
            $conditionsInvalides = count($documentsRequired) !== count($documents);
            if ($conditionsInvalides) {
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Veuillez fournir tous les documents!",
                    'code' => 500,
                ];
                return response()->json($dataResponse);
            } else {
                $sinistreTransmitted->update([
                    'etape' => 1
                ]);
            }
            if ($sinistreTransmitted) {

                $dataResponse = [
                    'type' => 'success',
                    'urlback' => route('sinistre.index'),
                    'message' => "Transmis avec succès!",
                    'code' => 200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de la transmission!",
                    'code' => 500,
                ];
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur systeme! $th",
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $code)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $isDeleted = TblSinistre::where('code', $code)->first();
    //         $isDeletedDocs = TblDocSinistre::where('idSinistre', $isDeleted->id)->get();
    //         if ($isDeleted) {
    //             foreach ($isDeletedDocs as $doc) {
    //                 // Supprime l'entrée de la base de données
    //                 $doc->delete();
    //             }
    //             // Dossier stocké
    //             $filePath = base_path(env('UPLOAD_SINISTRE_FILE')) . "$isDeleted->code";
    //             if (file_exists($filePath)) {
    //                 unlink($filePath);
    //             }
    //             $isDeleted->delete();
    //             $dataResponse = [
    //                 'type' => 'success',
    //                 'urlback' => "back",
    //                 'message' => "Prédéclaration de sinistre supprimé avec succès!",
    //                 'code' => 200,
    //             ];
    //             DB::commit();
    //         } else {
    //             DB::rollback();
    //             $dataResponse = [
    //                 'type' => 'error',
    //                 'urlback' => '',
    //                 'message' => "Erreur lors de la suppression!",
    //                 'code' => 500,
    //             ];
    //         }
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         $dataResponse = [
    //             'type' => 'error',
    //             'urlback' => '',
    //             'message' => "Erreur systeme! $th",
    //             'code' => 500,
    //         ];
    //     }
    //     return response()->json($dataResponse);
    // }

    public function destroy(string $code)
    {
        DB::beginTransaction();
        try {
            $isDeleted = TblSinistre::where('code', $code)->first();
            $isDeletedDocs = TblDocSinistre::where('idSinistre', $isDeleted->id)->get();

            if ($isDeleted) {
                foreach ($isDeletedDocs as $doc) {
                    // Supprimer l'entrée de la base de données
                    $doc->delete();
                }

                // Dossier stocké
                $filePath = base_path(env('UPLOAD_SINISTRE_FILE')) . $isDeleted->code;

                if (file_exists($filePath)) {
                    // Vérifier si c'est un fichier ou un dossier
                    if (is_file($filePath)) {
                        unlink($filePath);
                    } elseif (is_dir($filePath)) {
                        // Supprimer tout le contenu du dossier avant
                        $files = glob($filePath . '/*');
                        foreach ($files as $file) {
                            if (is_file($file)) {
                                unlink($file);
                            } elseif (is_dir($file)) {
                                // si jamais il y a des sous-dossiers
                                File::deleteDirectory($file);
                            }
                        }
                        // Enfin supprimer le dossier
                        rmdir($filePath);
                    }
                }

                $isDeleted->delete();

                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Prédéclaration de sinistre supprimée avec succès!",
                    'code' => 200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de la suppression!",
                    'code' => 500,
                ];
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! " . $th->getMessage(),
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }


    public function destroyDoc(string $id)
    {
        DB::beginTransaction();
        try {
            $doc = TblDocSinistre::where('id', $id)->first();
            if ($doc) {
                $sinistre = TblSinistre::where('id', $doc->idSinistre)->first();
                // Chemin du fichier stocké
                $filePath = base_path(env('UPLOAD_SINISTRE_FILE')) . "$sinistre->code/docsSinistre/$doc->filename";
                // $filePathe = base_path(env('UPLOAD_SINISTRE_FILE')) . "$sinistre->code/ficheSinistre/$doc->filename";

                // Vérifie si le fichier existe avant de le supprimer
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                // Vérifie si le fichier existe avant de le supprimer
                // if (file_exists($filePathe)) {
                //     unlink($filePathe);
                // }

                // Supprime l'entrée de la base de données
                $doc->delete();

                // $ok = $this->updateSinistrePdf($sinistre);
                // if (!$ok) {
                //     DB::rollBack();
                //     Log::info("Erreur lors de la mise à jour du PDF de la sinistre");
                //     $dataResponse = [
                //         'type' => 'error',
                //         'urlback' => '',
                //         'message' => "Erreur lors de la mise à jour du PDF de la sinistre",
                //         'code' => 500,
                //     ];
                // }
            }
            DB::commit();
            $dataResponse = [
                'type' => 'success',
                'urlback' => 'back',
                'message' => "Document supprimé avec succès!",
                'code' => 200,
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! $th",
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }

    private function updateSinistrePdf($sinistre)
    {
        try {
            $externalUploadDir = base_path(env('UPLOAD_SINISTRE_FILE'));
            if (!is_dir($externalUploadDir)) {
                mkdir($externalUploadDir, 0777, true);
            }
            $imageUrl = env('SIGN_API') . "api/get-signature/" . $sinistre->code . "/E-SINISTRE";

            $imageSrc = '';
            try {
                $response = Http::timeout(5)->get($imageUrl);

                if ($response->successful()) {
                    $data = $response->json();

                    // Vérifie si 'error' existe et est à true
                    if (isset($data['error']) && $data['error'] === true) {
                        Log::info('Signature non trouvée pour la sinistre N°: ' . $sinistre->code);
                    } else {

                        $imageData = $response->body();
                        $base64Image = base64_encode($imageData);
                        $imageSrc = 'data:image/png;base64,' . $base64Image;
                    }
                } else {
                    Log::error('Erreur HTTP lors de l\'appel de l\'API signature. Code de retour : ', $response->json());
                }
            } catch (\Exception $e) {
                Log::error('Exception lors de la récupération de la signature : ' . $e->getMessage());
            }

            // Dossier pour enregistrer l'état de la prédeclaration
            $qrcode = base64_encode(QrCode::format('svg')->size(80)->generate(url('sinistre/getInfoSinistre/' . $sinistre->id)));
            $pdf = Pdf::loadView('users.espace_client.services.fiches.sinistre', compact('qrcode', 'sinistre', 'imageSrc'))
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'margin-left' => 0,
                    'margin-right' => 0,
                    'margin-top' => 0,
                    'margin-bottom' => 0,
                ]);
            // Dossier pour enregistrer l'état de la prédeclaration
            $etatPrestationDir = $externalUploadDir . "$sinistre->code/ficheSinistre/";
            if (!is_dir($etatPrestationDir)) {
                mkdir($etatPrestationDir, 0777, true);
            }

            $fileName = 'ficheSinistre_' . $sinistre->code . '.pdf';
            $filePath = $etatPrestationDir . $fileName;
            $pdf->save($filePath);

            $docName = TblDocSinistre::where(['idSinistre' => $sinistre->id, 'filename' => $fileName])->first();
            if ($docName) {
                $docName->delete();
            }

            // Enregistrer le fichier dans la base de données
            TblDocSinistre::create([
                'idSinistre' => $sinistre->id,
                'libelle' => 'Fiche de déclaration de sinistre',
                'path' => "storage/sinistre/$sinistre->code/ficheSinistre/$fileName",
                'filename' => $fileName,
            ]);

            DB::commit();
            Log::info("Fiche de déclaration de sinistre generée avec succès");
            return [
                'success' => true,
            ];
        } catch (\Exception $e) {
            Log::error("Erreur lors de la génération du bulletin : ", ['error' => $e]);
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
