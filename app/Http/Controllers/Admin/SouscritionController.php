<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Souscription;
use Illuminate\Http\Request;
use App\Models\EmailNewsletter;
use App\Models\Presouscription;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SouscritionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//     public function index(Request $request)
// {
//     // Initialiser les variables de statut pour la vue
//     $statusPre = $request->input('filterByPre', ''); // Valeur par défaut vide
//     $statusCon = $request->input('filterByContact', ''); // Valeur par défaut vide

//     if ($request->ajax()) {
//         // Filtrer les pré-souscriptions et contacts selon le statut sélectionné
//         $preSouscriptions = Presouscription::where('etat', 'Actif')
//             ->where('type', 'Pré-souscription')
//             ->when($statusPre, function ($query, $statusPre) {
//                 return $query->where('status', $statusPre);
//             })
//             ->orderBy('created_at', 'desc')
//             ->get();

//         $contacts = Presouscription::where('etat', 'Actif')
//             ->where('type', 'contact')
//             ->when($statusCon, function ($query, $statusCon) {
//                 return $query->where('status', $statusCon);
//             })
//             ->orderBy('created_at', 'desc')
//             ->get();

//         // Retourner les résultats filtrés au format JSON
//         return response()->json([
//             'preSouscriptions' => $preSouscriptions,
//             'contacts' => $contacts,
//         ]);
//     }

//     // Charger tous les enregistrements par défaut
//     $preSouscriptions = Presouscription::where('etat', 'Actif')
//         ->where('type', 'Pré-souscription')
//         ->orderBy('created_at', 'desc')
//         ->get();

//     $contacts = Presouscription::where('etat', 'Actif')
//         ->where('type', 'contact')
//         ->orderBy('created_at', 'desc')
//         ->get();

//     // Passer les statuts et les listes à la vue
//     return view('admins.pages.mail.index', compact('preSouscriptions', 'contacts', 'statusPre', 'statusCon'));
// }

public function index(Request $request)
{
    // Récupérer le statut sélectionné dans la requête 
    $statusPre = $request->input('filterByPre', '');
    $statusCon = $request->input('filterByContact', '');

    // Filtrer les pré-souscriptions et les contacts en fonction du statut, si fourni
    $preSouscriptions = Presouscription::where('etat', 'Actif')
        ->where('type', 'Pré-souscription')
        ->when($statusPre, function ($query, $statusPre) {
            return $query->where('status', $statusPre);
        })
        ->with('formul_product', 'user')
        ->orderBy('created_at', 'desc')
        ->get();

    $contacts = Presouscription::where('etat', 'Actif')
        ->where('type', 'contact')
        ->when($statusCon, function ($query, $statusCon) {
            return $query->where('status', $statusCon);
        })
        ->with('formul_product', 'user')
        ->orderBy('created_at', 'desc')
        ->get();

    if ($request->ajax()) {
        return response()->json([
            'preSouscriptions' => view('admins.pages.mail.partials.pre-souscriptions', compact('preSouscriptions'))->render(),
            'contacts' => view('admins.pages.mail.partials.contacts', compact('contacts'))->render(),
        ]);
    }

    return view('admins.pages.mail.index', compact('preSouscriptions', 'contacts', 'statusCon', 'statusPre'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function newsletter()
    {
        $newsletters = EmailNewsletter::orderBy('created_at', 'desc')->get();
        return view('admins.pages.mail.newsletter', compact('newsletters'));
    }

    public function newsletterStore(Request $request)
    {

        DB::beginTransaction();
        try {
            
            $uuid = Str::uuid();
            $saving = EmailNewsletter::create([
                'uuid' => $uuid,
                'email' => $request->email,
            ])->save();
    
            if ($saving) {
    
                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Enregistré avec succes!",
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

    /**
     * Store a newly created resource in storage.
     */
    public function store (Request $request)
    {
    DB::beginTransaction();
    try {

        $uuid = Str::uuid();
        $saving = Presouscription::create([
            'uuid' => $uuid,
            'code' => Refgenerate(Presouscription::class, 'PrS', 'code'),
            'product_uuid' => $request->product_uuid,
            'customer_firstname' => $request->customer_firstname,
            'customer_lastname' => $request->customer_lastname,
            'customer_civility' => $request->customer_civility,
            'customer_assure' => $request->customer_assure,
            'customer_birthday' => $request->customer_birthday,
            'assure_birthday' => $request->assure_birthday,
            'customer_placebirth' => $request->customer_placebirth,
            'customer_job' => $request->customer_job,
            'customer_residence' => $request->customer_residence,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_whatsapp' => $request->customer_whatsapp,
            'object' => $request->object,
            'content' => $request->content,
            'type' => $request->type,
        ])->save();

        if ($saving) {

            $dataResponse =[
                'type'=>'success',
                'urlback'=>"back",
                'message'=>"Enregistré avec succes!",
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

    /**
     * Display the specified resource.
     */
    public function showpreSouscription(string $uuid)
    {
        // Recherche du souscription à modifier
        $preSouscription = Presouscription::where('uuid', $uuid)->with('formul_product', 'user')->firstOrFail();

        // return view('admins.pages.mail.index', compact('preSouscription'));
        return response()->json($preSouscription);
    }

    public function showContact(string $uuid)
    {
        // Recherche du souscription à modifier
        $contact = Presouscription::where('uuid', $uuid)->with('user')->firstOrFail(); 
        return response()->json($contact);
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
    public function approuvedMessage(string $uuid)
{
    $preSouscription = Presouscription::where('uuid', $uuid)->firstOrFail();
    if ($preSouscription) {
        $preSouscription->status = 'Approuver';
        $preSouscription->save();  // Sauvegarder la modification

        return response()->json(['success' => true]);
    }
    
    return response()->json(['success' => false, 'message' => 'Message non trouvé.']);
}

    public function dismissMessage(string $uuid)
    {
        // Récupérer la souscription via l'UUID
        $preSouscription = Presouscription::where('uuid', $uuid)->firstOrFail();
        if ($preSouscription) {
            $preSouscription->status = 'Rejeter';
            $preSouscription->save();  // Sauvegarder la modification

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Message non trouvé.']);
    }
        
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
{
    // Récupérer la souscription via l'UUID
    $preSouscription = Presouscription::where('uuid', $uuid)->firstOrFail();
    if ($preSouscription) {
        $preSouscription->etat = 'Inactif';
        $preSouscription->save();  // Sauvegarder la modification

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'Message non trouvé.']);
}

}
