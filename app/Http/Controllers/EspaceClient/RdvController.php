<?php

namespace App\Http\Controllers\EspaceClient;

use App\Http\Controllers\Controller;
use App\Models\TblBordereauRdv;
use App\Models\TblProductPrestation;
use App\Models\Tblrdv;
use App\Models\TblTypePrestation;
use App\Models\TblVille;
use App\Models\TblVilleReseau;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RdvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.espace_client.services.rdv.index');
    }

    public function selectPrestation()
{
    // $typePrestations = TblTypePrestation::where(function ($query) {
    //     $query->where('etat', 'Actif')
    //           ->where('impact', 1);
    // })->orWhere('impact', 'Autre')->get();
    $NbrencConfirmer = session('NbrencConfirmer', 0);
    $contratDetails = session('contractDetails', null);
    $cumulCotisationTerme = session('cumulCotisationTerme', 0);
    $contisationPourcentage = session('contisationPourcentage', 0);
    $TotalEncaissement = session('TotalEncaissement', 0);
    // $ProductPrestations = TblProductPrestation::where('product_id', $contratDetails['codeProduit'])->get();
    $ProductPrestations = TblProductPrestation::where('product_id', $contratDetails['codeProduit'])
    ->whereHas('prestation', function ($query) {
        $query->where('etat', 'Actif')
              ->where('impact', 1);
    })
    ->with('prestation') // Optionnel, pour charger la relation
    ->get();
    // Utilisation de pluck() si la relation est une simple clé étrangère
    $typePrestations = $ProductPrestations->pluck('prestation');

    $typePrestationAutre = TblTypePrestation::where('impact', 'Autre')->where('etat', 'Actif')->first();

    return view('users.espace_client.services.rdv.selectPrestation', compact('typePrestations', 'typePrestationAutre', 'NbrencConfirmer', 'cumulCotisationTerme', 'contisationPourcentage', 'TotalEncaissement', 'contratDetails'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $idcontrat = session('idcontrat');
        if (!session()->has('contractDetails')) {
            return redirect()->route('customer.rdv');
        }else{
            $contratDetails = session('contractDetails', null);
            $typePrestation = TblTypePrestation::where('id', $id)->first();
            $villes = TblVille::all();
            $villeReseaux = TblVilleReseau::select('idVilleBureau', 'libelleVilleBureau')
            ->whereHas('optionRdv') // Vérifie que la relation 'optionRdv' existe
            ->with('optionRdv') // Charge les options de rendez-vous pour chaque ville réseau
            ->get();
            $rdv = Tblrdv::where(['police'=> $idcontrat, 'motifrdv' => $typePrestation->libelle, 'etat' => 1])->first();
        }
        if ($rdv) {
            return redirect()->back()->with('fail','Une prestation de type "' . $typePrestation->libelle . '" pour le contrat ' . $idcontrat . ' est déja en cours. N° de prestation : ' . $rdv->codedmd.' cette prestation est a débouchée sur une prise de rendez-vous.'); 
        }else{
            session()->forget('contractDetails');
            return view('users.espace_client.services.rdv.create', compact('typePrestation', 'villes', 'villeReseaux', 'contratDetails'));
        }
        
    }
    public function getOptionRdv(string $id)
    {
        // $villeReseaux = TblVilleReseau::where('idVilleBureau', $id)
        // ->whereHas('optionRdv') // Vérifie que la relation 'optionRdv' existe
        // ->with('optionRdv') // Charge les options de rendez-vous pour chaque ville réseau
        // ->orderby('codejour')->get();
        $villeReseaux = TblVilleReseau::where('idVilleBureau', $id)
        ->whereHas('optionRdv')
        ->with(['optionRdv' => function ($query) {
            $query->orderBy('codejour');
        }])
        ->get();
        return response()->json([
            'status' => 'success',
            'data' => $villeReseaux
        ]);
    }
    // public function getRdvByDate(Request $request)
    // {
    //     try {
    //         // Valider les paramètres d'entrée
    //         $validated = $request->validate([
    //             'idTblBureau' => 'required|integer',
    //             'daterdv' => 'required',
    //         ]);

    //         // Reformater la date pour correspondre au format de la base (d-m-Y)
    //         // $daterdv = DateTime::createFromFormat('Y-m-d', $validated['daterdv']);

    //         // Requête pour récupérer le rendez-vous
    //         $rdv = Tblrdv::where('idTblBureau', $validated['idTblBureau'])
    //             ->whereDate('daterdveff', $validated['daterdv'])
    //             ->first();

    //         if ($rdv) {
    //             return response()->json([
    //                 'status' => 'success',
    //                 'data' => $rdv
    //             ]);
    //         }

    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Aucun rendez-vous trouvé pour cette date et ce lieu.'
    //         ]);
    //     } catch (\Throwable $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Erreur : ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function getRdvByDate(Request $request)
    {
        try {
            $validated = $request->validate([
                'idTblBureau' => 'required|integer',
                'daterdv' => 'required',
            ]);

            $idTblBureau = $validated['idTblBureau'];
            $dateInput = $validated['daterdv'];
            
            // Essayer différents formats de date
            $formats = ['Y-m-d', 'd/m/Y', 'd-m-Y', 'Y/m/d'];
            $dateRecherche = null;
            
            foreach ($formats as $format) {
                try {
                    $dateRecherche = Carbon::createFromFormat($format, $dateInput)->format('Y-m-d');
                    break;
                } catch (\Exception $e) {
                    continue;
                }
            }
            
            if (!$dateRecherche) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Format de date invalide',
                    'date_recue' => $dateInput
                ]);
            }
            
            // Requête avec différents champs possibles
            $rdv = Tblrdv::where('idTblBureau', $idTblBureau)
                ->where(function($query) use ($dateRecherche) {
                    $query->whereDate('daterdveff', $dateRecherche)
                        ->orWhereDate('daterdv', $dateRecherche)
                        ->orWhere('daterdveff', 'LIKE', $dateRecherche . '%')
                        ->orWhere('daterdv', 'LIKE', $dateRecherche . '%');
                })
                ->get();
            
            if ($rdv) {
                return response()->json([
                    'status' => 'success',
                    'data' => $rdv,
                    'debug' => [
                        'date_utilisee' => $dateRecherche,
                        'format_original' => $dateInput
                    ]
                ]);
            }
            
            // // Vérifier s'il existe des RDV pour ce bureau
            // $rdvsExistants = Tblrdv::where('idTblBureau', $idTblBureau)
            //     ->select('daterdveff', 'daterdv')
            //     ->get();
            
            // return response()->json([
            //     'status' => 'error',
            //     'message' => 'Aucun rendez-vous trouvé pour cette date et ce lieu.',
            //     'debug' => [
            //         'date_recherchee' => $dateRecherche,
            //         'id_bureau' => $idTblBureau,
            //         'rdvs_existants' => $rdvsExistants
            //     ]
            // ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur : ' . $e->getMessage()
            ], 500);
        }
    }

    public function getPlagesDesactivees()
    {
       $plagesDesactivees = TblBordereauRdv::select('periode_1', 'periode_2')
        ->get()
        ->filter(function ($rdv) {
            $debutPlage = Carbon::parse($rdv->periode_1);
            $finPlage = Carbon::parse($rdv->periode_2);
            $aujourdhui = Carbon::today();
            $premierJourMoisEnCours = Carbon::today()->startOfMonth();
            
            // Garder les plages qui :
            // 1. Commencent à partir du mois en cours (date de début >= premier jour du mois)
            // 2. OU se terminent après le premier jour du mois en cours (chevauchement)
            return $debutPlage >= $premierJourMoisEnCours || $finPlage >= $premierJourMoisEnCours;
        })
        ->map(function ($rdv) {
            return [
                'from' => Carbon::parse($rdv->periode_1)->format('Y-m-d'),
                'to'   => Carbon::parse($rdv->periode_2)->format('Y-m-d'),
            ];
        })->values(); // Réindexer le tableau
        
        return response()->json($plagesDesactivees);
    }

    // Ajoutez cette méthode dans votre RdvController.php

    public function getJoursFeries()
    {
        $annee = date('Y');
        $joursFeries = [];
        
        // 1er janvier - Nouvel an
        $joursFeries[] = date('Y-m-d', strtotime($annee . '-01-01'));
        
        // Lundi de Pâques (calcul dynamique)
        $paques = $this->calculPaques($annee);
        $lundiPaques = date('Y-m-d', strtotime($paques . ' +1 day'));
        $joursFeries[] = $lundiPaques;
        
        // 1er mai - Fête du Travail
        $joursFeries[] = date('Y-m-d', strtotime($annee . '-05-01'));
        
        // Ascension (jeudi, 40 jours après Pâques)
        $ascension = date('Y-m-d', strtotime($paques . ' +39 days'));
        $joursFeries[] = $ascension;
        
        // Lundi de Pentecôte (50 jours après Pâques)
        $lundiPentecote = date('Y-m-d', strtotime($paques . ' +50 days'));
        $joursFeries[] = $lundiPentecote;
        
        // 7 août - Fête de l'Indépendance
        $joursFeries[] = date('Y-m-d', strtotime($annee . '-08-07'));
        
        // 15 août - Assomption
        $joursFeries[] = date('Y-m-d', strtotime($annee . '-08-15'));
        
        // 1er novembre - Toussaint
        $joursFeries[] = date('Y-m-d', strtotime($annee . '-11-01'));
        
        // 15 novembre - Fête Nationale de la Paix
        $joursFeries[] = date('Y-m-d', strtotime($annee . '-11-15'));
        
        // 25 décembre - Noël
        $joursFeries[] = date('Y-m-d', strtotime($annee . '-12-25'));
        
        // Aïd el-Fitr et Aïd el-Kebir (à adapter selon l'année)
        // Ces dates doivent être mises à jour annuellement
        if ($annee == 2025) {
            $joursFeries[] = '2025-03-31'; // Aïd el-Fitr (approximatif)
            $joursFeries[] = '2025-07-07'; // Aïd el-Kebir (approximatif)
        } elseif ($annee == 2024) {
            $joursFeries[] = '2024-04-10'; // Aïd el-Fitr
            $joursFeries[] = '2024-06-17'; // Aïd el-Kebir
        }
        
        return response()->json($joursFeries);
    }

    private function calculPaques($annee)
    {
        $a = $annee % 19;
        $b = floor($annee / 100);
        $c = $annee % 100;
        $d = floor($b / 4);
        $e = $b % 4;
        $f = floor(($b + 8) / 25);
        $g = floor(($b - $f + 1) / 3);
        $h = (19 * $a + $b - $d - $g + 15) % 30;
        $i = floor($c / 4);
        $k = $c % 4;
        $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
        $m = floor(($a + 11 * $h + 22 * $l) / 451);
        $mois = floor(($h + $l - 7 * $m + 114) / 31);
        $jour = (($h + $l - 7 * $m + 114) % 31) + 1;
        
        return date('Y-m-d', strtotime($annee . '-' . $mois . '-' . $jour));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'daterdv' => 'required',
            'lieuresidence' => 'required',
        ]);
        try {
            $coderdv = RefgenerateCode(Tblrdv::class, 'RDV-', 'codedmd');
            
            $rdvEncours = Tblrdv::where([
                'motifrdv'=>$request->motifrdv,
                'police'=>$request->police,
                'etat'=>1,
            ])->first();
            if ($rdvEncours) {
                return response()->json([
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Vous avez déja un rendez-vous de type $rdvEncours->motifrdv en cours pour le contrat $rdvEncours->police. N° de RDV $rdvEncours->codedmd",
                    'code'=>500,
                ]);
            }else{
                // Création de la prestation
                $rdv = Tblrdv::create([
                    'nomclient'=>$request->nomclient,
                    'tel'=>$request->tel,
                    'email'=>$request->email,
                    'daterdv'=>$request->daterdv,
                    'codedmd' => $coderdv,
                    'dateajou' => Carbon::now()->format('d/m/Y à H:i:s'),
                    'etat' =>1,
                    'motifrdv'=>$request->motifrdv,
                    'police'=>$request->police,
                    'titre'=>$request->titre,
                    'datenaissance'=> Carbon::parse($request->datenaissance)->format('d/m/Y'),
                    'lieuresidence'=>$request->lieuresidence,
                    'idTblBureau'=>$request->idTblBureau,
                    'createdAt' => Carbon::now()->format('d/m/Y H:i:s'),
                    'creeLe' => Carbon::now(),
                    'orderInsert' =>1,
                ])->save();
                
                if ($rdv) {
                    $dataResponse =[
                        'type'=>'success',
                        'urlback'=> route('customer.rdv.mesRdv'),
                        'message'=>"RDV N° $coderdv enregistré avec succes ! Vous allez recevoir un message de confirmation de la date effective de reception",
                        'code'=>200,
                    ];
                    DB::commit();
                } else {
                        DB::rollback();
                        $dataResponse =[
                            'type'=>'error',
                            'urlback'=>'',
                            'message'=>"Erreur lors de l'enregistrement!",
                            'code'=>500,
                        ];
                }
            }
            
    
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! $th",
                'code'=>500,
            ];
        }
            return response()->json($dataResponse);
    }

    public function mesRdv()
    {
        return view('users.espace_client.services.rdv.mesRdv');
    }

    public function getRdv(Request $request)
    {
        $idcontrat = $request->input('idcontratPrest');

        try {
            $rdv = Tblrdv::where('police', $idcontrat)->with('ville')->get();
            if ($rdv->isEmpty()) {
                return response()->json(['status' => 'success', 'data' => []]);
            }
            return response()->json([
                'status' => 'success',
                'data' => $rdv,
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
