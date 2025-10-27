<?php

namespace App\Http\Controllers\EspaceClient;

use Carbon\Carbon;
use App\Models\Membre;
use setasign\Fpdi\Fpdi;
use App\Models\TblCustomer;
use Illuminate\Http\Request;
use App\Models\MembreContrat;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\UserRegisteredMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $errorCount = session('error_count', "");
        return view('users.espace_client.dashboard', compact('errorCount'));
    }

    public function fetchContractDetails(Request $request)
    {
        $idcontrat = $request->input('idcontrat');
        // dd($idcontrat);
        if (!$idcontrat) {
            return response()->json([
                'status' => 'error',
                'message' => 'Aucun contrat sélectionné.',
            ], 400);
        }

        try {
            // Utiliser Guzzle directement pour un meilleur contrôle
            $response = Http::withOptions([
                'timeout' => 60,  // Augmenter le délai d'attente
            ])->post(config('services.api.encaissement_bis'), [
                'idContrat' => $idcontrat,
            ]);
            // $response = Http::withOptions([
            //     'timeout' => 60,  // Augmenter le délai d'attente
            // ])->post(env('API_ENCAISSEMENT_BIS'), [
            //     'idContrat' => $idcontrat,
            // ]);

            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $response->json(),
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Impossible de récupérer les informations du contrat.',
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur s\'est produite : ' . $e->getMessage(),
            ], 500);
        }
    }

    public function AddContratByAuthCustomer(Request $request)
    {
        try {
            DB::beginTransaction();
            $idcontrat = $request->input('contrat');
            $datenaissance = Carbon::parse($request->input('datenaissance'))->format('d/m/Y');

            // dd($datenaissance);
            $customerId = Auth::user();

            // $contrat = MembreContrat::where('idcontrat', $idcontrat)->first();
            $response = Http::withOptions(['timeout' => 60])
                ->post(config('services.api.encaissement_bis'), [
                    'idContrat' => $idcontrat,
                ]);
            if ($response->successful()) {
                $data = $response->json();
                // dd($data['details']);
                if (!empty($data['details'])) {
                    $existingMembre = Membre::where('idmembre', $customerId->idmembre)->first();
                    $existingCustomer = TblCustomer::where('idmembre', $customerId->idmembre)->first();
                    $existingMembreContrat = ($existingMembre != null) ? MembreContrat::where(['codemembre' => $existingMembre->idmembre, 'idcontrat' => $idcontrat])->first() : null;
                    // dd($existingMembre, $existingCustomer, $existingMembreContrat);

                    // session(['message' => "La date de naissance saisie ne correspond pas à celle enregistrée dans le contrat."]);
                    if ($data['details'][0]['DateNaissance'] != $datenaissance) {

                        // Récupérer et mettre à jour le compteur d'erreurs
                        $errorCount = session('error_count', 0);
                        $errorCount++;
                        session(['error_count' => $errorCount]);
                        // $errorCount = session('error_count', "");

                        if ($errorCount >= 3) {
                            session(['error_count' => 0]); // Réinitialiser le compteur après 3 erreurs
                            // session('error_count', 0);
                            return response()->json([
                                'type' => 'error',
                                'message' => "La date de naissance saisie ne correspond pas à celle enregistrée dans le contrat. Vous avez atteint le nombre maximum d'essais ($errorCount / 3). Veuillez contacter YAKO AFRICA pour l'ajout de ce contrat.",
                                'code' => 400,
                                'count_error' => true,
                                'error_count' => $errorCount,
                            ]);
                        } else {
                            return response()->json([
                                'type' => 'error',
                                // 'urlback' => 'back',
                                'message' => "La date de naissance saisie ne correspond pas à celle enregistrée dans le contrat.($errorCount / 3)",
                                'code' => 400,
                                'count_error' => true,
                                'error_count' => $errorCount,
                            ]);
                        }
                    } else {
                        if ($data['details'][0]['OnStdbyOff'] != "1") {
                            return response()->json([
                                'type' => 'error',
                                'urlback' => '',
                                'message' => 'Ce contrat est arreté ou en veille.',
                                'code' => 400,
                            ]);
                        } else {
                            if (($existingMembre || $existingCustomer) && $existingMembreContrat) {
                                return response()->json([
                                    'type' => 'error',
                                    'urlback' => '',
                                    'message' => "Le contrat " . $idcontrat . " est deja ajouté à votre compte.",
                                    'code' => 400,
                                ]);
                            } else if (($existingMembre || $existingCustomer) && !$existingMembreContrat) {
                                MembreContrat::create([
                                    'codemembre' => $existingMembre->idmembre,
                                    'idcontrat' => $idcontrat,
                                ]);
                                // $recipientEmail = 'bruce.yapo@yakoafricassur.com' ?? null;
                                $recipientEmail = $existingCustomer->email ?? $existingMembre->email ?? null;
                                $emailSubject = "ID contrat " . $idcontrat . "ajouté ";
                                $message = '<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="justify" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                            Le contrat ' . $idcontrat . ' a bien été ajouté à votre compte, vous pouvez désormais consulter les détails du contrat.
        
                                        </td>';

                                $destinatorName = 'Cher(e) client(e) ' . $existingMembre->nom . ' ' . $existingMembre->prenom;

                                $mailData = [
                                    'title' => $emailSubject,
                                    'body' => $message,
                                    'destinatorName' => $destinatorName,
                                    'destinatorEmail' => $existingCustomer->email,
                                    'btnText' => 'Cliquez ici',
                                    'btnLink' => route('customer.loginForm'),
                                ];

                                $mail = new UserRegisteredMail($mailData, $emailSubject);
                                if ($recipientEmail != null) {
                                    Mail::to($recipientEmail)->send($mail);
                                }
                                // $mailSending = Mail::to($recipientEmail)->send($mail);
                                DB::commit();
                                // session(['message' => "ID Contrat Enregistré avec succès !."]);
                                return response()->json([
                                    'type' => 'success',
                                    'urlback' => 'back',
                                    'message' => "ID Contrat Enregistré avec succès !.",
                                    'code' => 200,
                                ]);
                            }
                        }
                    }
                } else {
                    // session(['message' => "Aucun contrat trouvé pour cet ID."]);
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
        } catch (\Exception $e) {
            DB::rollBack();
            // session(['message' => "Une erreur s'est produite : " . $e->getMessage()]);
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => 'Une erreur s\'est produite : ' . $e->getMessage(),
                'code' => 400,
            ]);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function etatCotisation()
    {
        return view('users.espace_client.services.cotisation.etat');
    }

    public function police()
    {
        return view('users.espace_client.services.police.index');
    }
    public function getPolice(Request $request)
    {
        try {
            $idcontrat = $request->input('contrat');
            $externalUploadDir = base_path(env('GET_CUSTOMER_CP'));
            $externalCGPRODDir = base_path(env('GET_DOC_CGPROD'));

            $response = Http::withOptions([
                'timeout' => 60,  // Augmenter le délai d'attente
            ])->post(config('services.api.encaissement_bis'), [
                'idContrat' => $idcontrat,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $dateEffetReelle = $data['details'][0]['DateEffetReel'];
                $codeProduit = $data['details'][0]['codeProduit'];
                $dateEffetReelle = Carbon::createFromFormat('d/m/Y', $dateEffetReelle)->format('d-m-Y');

                // recuperer l'annee de la date d'effet reelle
                $annee = Carbon::createFromFormat('d-m-Y', $dateEffetReelle)->format('Y');

                // recuperer le mois de la date d'effet reelle en format de deux chiffres et retirer le zéro si le mois est inferieur a 10
                $mois =  Carbon::createFromFormat('d-m-Y', $dateEffetReelle)->format('m');
                $mois = ltrim($mois, '0');

                if (!is_dir($externalUploadDir)) {
                    mkdir($externalUploadDir, 0777, true);
                }
                if (!is_dir($externalCGPRODDir)) {
                    mkdir($externalCGPRODDir, 0777, true);
                }
                
                $CPfileName = "A{$annee}/M{$mois}/CP_{$idcontrat}.pdf";
                $CPfilePath = $externalUploadDir  . DIRECTORY_SEPARATOR . $CPfileName;

                if (!file_exists($CPfilePath)) {
                    return response()->json([
                        'type' => 'error',
                        'signification' => 'Le fichier demandé est introuvable.',
                        'message' => 'Désolé ! La police du contrat N° ' . $idcontrat . ' n\'est pas encore disponible !',
                        'code' => 404,
                    ], 404);
                }

                
                $CGProdFile = "CG_{$codeProduit}.pdf";
                $CGProdFilePath = $externalCGPRODDir  . DIRECTORY_SEPARATOR . $CGProdFile;

                // Initialiser FPDI pour fusionner les fichiers CPfilePath et CGProdFile 
                $finalPdf = new Fpdi();

                // Ajouter toutes les pages du bulletin
                $CPPageCount = $finalPdf->setSourceFile($CPfilePath);
                for ($pageNo = 1; $pageNo <= $CPPageCount; $pageNo++) {
                    $finalPdf->AddPage();
                    $tplIdx = $finalPdf->importPage($pageNo);
                    $finalPdf->useTemplate($tplIdx);
                }
            
                // Ajouter toutes les pages du fichier CGU
                $CGProdPageCount = $finalPdf->setSourceFile($CGProdFilePath);
                for ($pageNo = 1; $pageNo <= $CGProdPageCount; $pageNo++) {
                    $finalPdf->AddPage();
                    $tplIdx = $finalPdf->importPage($pageNo);
                    $finalPdf->useTemplate($tplIdx);
                }
                
                // Nom du fichier final
                $FilePath = "A{$annee}/M{$mois}/DocumentsContractuels_{$idcontrat}";
                if (!is_dir($externalUploadDir . DIRECTORY_SEPARATOR . $FilePath)) {
                    mkdir($externalUploadDir . DIRECTORY_SEPARATOR . $FilePath, 0777, true);
                }
                $fileName = "CP-CG_{$idcontrat}.pdf";
                $finalFilePath = $externalUploadDir  . DIRECTORY_SEPARATOR . $FilePath . DIRECTORY_SEPARATOR . $fileName;
                $finalPdf->Output($finalFilePath, 'F');

                // Construire l'URL absolue du fichier PDF
                $fileUrl = url('get-police/' . $FilePath . DIRECTORY_SEPARATOR . $fileName);

                return response()->json([
                    'type' => 'success',
                    'signification' => 'Fichier trouvé.',
                    'message' => 'Fichier trouvé.',
                    'url' => $fileUrl,
                    'code' => 200,
                ], 200);
                
            } else {
                return response()->json([
                    'type' => 'error',
                    'signification' => 'Impossible de récupérer les informations du contrat.',
                    'message' => 'Impossible de récupérer les informations du contrat.',
                    'code' => 400,
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => 'Une erreur s\'est produite : ' . $e->getMessage(),
                'code' => 500,
            ], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function generateEtatCotisation(Request $request)
    {
        try {
            DB::beginTransaction();
            $idcontrat = $request->input('contrat');
            $response = Http::withOptions(['timeout' => 60])
                ->post(config('services.api.encaissement_bis'), [
                    'idContrat' => $idcontrat,
                ]);
            if ($response->successful()) {
                $etatCotisation = $response->json();
                // dd($etatCotisation);
                if ($etatCotisation) {
                    $assures = $etatCotisation['assures'];
                    $payeurs = $etatCotisation['payeur'];
                    $details = $etatCotisation['details'];
                    // dd($details);
                    $nonRegle = $etatCotisation['enc']['nonRegle'];
                    $confirmer = $etatCotisation['enc']['confirmer'];
                    $partielle = $etatCotisation['enc']['partielle'];
                    $totalNonRegle = array_sum(array_map(function ($item) {
                        return isset($item['MontantNet']) ? (float) $item['MontantNet'] : 0;
                    }, $nonRegle));
                    $totalConfirmer = array_sum(array_map(function ($item) {
                        return isset($item['RegltMontant']) ? (float) $item['RegltMontant'] : 0;
                    }, $confirmer));
                    $totalPartielle = array_sum(array_map(function ($item) {
                        return isset($item['RegltMontant']) ? (float) $item['RegltMontant'] : 0;
                    }, $partielle));

                    // utilise les separateurs de milliers pour les nombres totalNonRegle, totalConfirmer, totalPartielle
                    $totalNonRegle   = number_format($totalNonRegle, 0, ',', ' ');
                    $totalConfirmer  = number_format($totalConfirmer, 0, ',', ' ');
                    $totalPartielle  = number_format($totalPartielle, 0, ',', ' ');


                    $nbrTotalNonRegle = count($nonRegle);
                    $nbrTotalConfirmer = count($confirmer);
                    $nbrTotalPartielle = count($partielle);
                    $dateConsultation = now()->format('d-m-Y H:i:s');
                    $pdf = pdf::loadView('users.espace_client.services.cotisation.ficheEtat', compact('assures', 'payeurs', 'details', 'nonRegle', 'confirmer', 'partielle', 'dateConsultation', 'nbrTotalNonRegle', 'nbrTotalConfirmer', 'nbrTotalPartielle', 'totalNonRegle', 'totalConfirmer', 'totalPartielle'));
                    $pdf->setOption('enable-javascript', false);
                    $pdf->setOption('isPhpEnabled', true); // Active PHP inline 
                    $filename = 'etat_cotisation_' . $idcontrat . now()->format('d-m-Y') . '.pdf';
                    return $pdf->stream($filename);
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
        } catch (\Exception $e) {
            DB::rollBack();
            // session(['message' => "Une erreur s'est produite : " . $e->getMessage()]);
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => 'Une erreur s\'est produite : ' . $e->getMessage(),
                'code' => 400,
            ]);
        }
    }
    public function generateEtatCotisationApi(Request $request)
    {
        try {
            DB::beginTransaction();
            $idcontrat = $request->input('contrat');
            $response = Http::withOptions(['timeout' => 60])
                ->post(config('services.api.encaissement_bis'), [
                    'idContrat' => $idcontrat,
                ]);
            if ($response->successful()) {
                $etatCotisation = $response->json();
                if ($etatCotisation) {
                    $assures = $etatCotisation['assures'];
                    $payeurs = $etatCotisation['payeur'];
                    $details = $etatCotisation['details'];
                    $nonRegle = $etatCotisation['enc']['nonRegle'];
                    $confirmer = $etatCotisation['enc']['confirmer'];
                    $partielle = $etatCotisation['enc']['partielle'];
                    $totalNonRegle = array_sum(array_map(function ($item) {
                        return isset($item['MontantNet']) ? (float) $item['MontantNet'] : 0;
                    }, $nonRegle));
                    $totalConfirmer = array_sum(array_map(function ($item) {
                        return isset($item['RegltMontant']) ? (float) $item['RegltMontant'] : 0;
                    }, $confirmer));
                    $totalPartielle = array_sum(array_map(function ($item) {
                        return isset($item['RegltMontant']) ? (float) $item['RegltMontant'] : 0;
                    }, $partielle));

                    // utilise les separateurs de milliers pour les nombres totalNonRegle, totalConfirmer, totalPartielle
                    $totalNonRegle   = number_format($totalNonRegle, 0, ',', ' ');
                    $totalConfirmer  = number_format($totalConfirmer, 0, ',', ' ');
                    $totalPartielle  = number_format($totalPartielle, 0, ',', ' ');


                    $nbrTotalNonRegle = count($nonRegle);
                    $nbrTotalConfirmer = count($confirmer);
                    $nbrTotalPartielle = count($partielle);
                    $dateConsultation = now()->format('d-m-Y H:i:s');
                    $pdf = pdf::loadView('users.espace_client.services.cotisation.ficheEtatApi', compact('assures', 'payeurs', 'details', 'nonRegle', 'confirmer', 'partielle', 'dateConsultation', 'nbrTotalNonRegle', 'nbrTotalConfirmer', 'nbrTotalPartielle', 'totalNonRegle', 'totalConfirmer', 'totalPartielle'));
                    $pdf->setOption('enable-javascript', false);
                    $pdf->setOption('isPhpEnabled', true); // Active PHP inline
                    $filename = 'etat_cotisation_' . $idcontrat . '.pdf';
                    // $filename = 'etat_cotisation_' . $idcontrat . now()->format('d-m-Y') . '.pdf';

                    // Créer le dossier s’il n’existe pas
                    $directory = public_path('etatCotisationGenerer');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0755, true);
                    }

                    // Sauvegarde du fichier PDF
                    $pdf->save($directory . '/' . $filename);
                    // Retourner l'URL du PDF
                    $pdfUrl = url('etatCotisationGenerer/' . $filename); // URL publique pour accéder au PDF

                    return response()->json([
                        'pdfUrl' => $pdfUrl
                    ]);
                }
            } else {
                return response()->json([
                    'type' => 'error',
                    'message' => 'Une erreur s\'est produite.',
                    'code' => 400,
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'message' => 'Une erreur s\'est produite : ' . $e->getMessage(),
                'code' => 400,
            ]);
        }
    }

    public function clearEtatCotisationFolder()
    {
        $directory = public_path('etatCotisationGenerer');

        try {
            if (File::exists($directory)) {
                $files = File::files($directory);
                $jour = 24 / 2;
                foreach ($files as $file) {
                    $lastModified = Carbon::createFromTimestamp(File::lastModified($file));
                    if ($lastModified->lt(Carbon::now()->subHours($jour))) {
                        File::delete($file);
                    }
                }
            }

            return response()->json([
                'type' => 'success',
                'message' => 'Les fichiers de plus de 12 heures ont été supprimés avec succès.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur : ' . $e->getMessage()
            ], 500);
        }
    }
}
