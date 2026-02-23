<?php

namespace App\Http\Controllers\EspaceClient;

use DateTime;
use Carbon\Carbon;
use App\Models\Tblrdv;
use App\Models\TblVille;
use Illuminate\Http\Request;
use App\Models\TblVilleReseau;
use App\Models\TblTypePrestation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\TblProductPrestation;

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
        $villeReseaux = TblVilleReseau::where('idVilleBureau', $id)
        ->whereHas('optionRdv') // Vérifie que la relation 'optionRdv' existe
        ->with('optionRdv') // Charge les options de rendez-vous pour chaque ville réseau
        ->get();
        return response()->json([
            'status' => 'success',
            'data' => $villeReseaux
        ]);
    }
    public function getRdvByDate(Request $request)
{
    try {
        // Valider les paramètres d'entrée
        $validated = $request->validate([
            'idTblBureau' => 'required|integer',
            // 'idTblBureau' => 'required|integer|exists:tblvillebureau,idVilleBureau',
            'daterdv' => 'required',
        ]);

        // Reformater la date pour correspondre au format de la base (d-m-Y)
        // $daterdv = DateTime::createFromFormat('d/m/Y', $validated['daterdv'])->format('d-m-Y');

        // Requête pour récupérer le rendez-vous
        $rdv = Tblrdv::where('idTblBureau', $validated['idTblBureau'])
            ->where('daterdv', $validated['daterdv']) // Comparaison avec le champ VARCHAR
            ->first();

        if ($rdv) {
            return response()->json([
                'status' => 'success',
                'data' => $rdv
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Aucun rendez-vous trouvé pour cette date et ce lieu.'
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Erreur : ' . $e->getMessage()
        ], 500);
    }
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
