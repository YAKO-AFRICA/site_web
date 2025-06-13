<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Temoignage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TemoignageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $temoignages = Temoignage::where('etat','Actif')->orderBy('created_at', 'desc')->get();
        return view('admins.pages.temoignages.index', compact('temoignages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (Request $request)
    {
        $user = Auth::user();
        $user_uuid = $user->uuid;
    DB::beginTransaction();
    try {
        $uuid = Str::uuid();
        $saving = Temoignage::create([
            'uuid' => $uuid,
            'user_uuid' => $user_uuid,
            'nom' => $request->nom,
            'fonction' => $request->fonction,
            'contenu' => $request->contenu,
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
    public function update(Request $request, string $uuid)
    {
        $user = Auth::user();
        $user_uuid = $user->uuid;
    DB::beginTransaction();
    try {
        // Recherche du produit à modifier
        $temoignage = Temoignage::where('uuid', $uuid)->firstOrFail();

        // Mise à jour des autres champs
        $temoignage->nom = $request->nom;
        $temoignage->fonction = $request->fonction;
        $temoignage->contenu = $request->contenu;
        $temoignage->update_user_uuid = $user_uuid;
        $saving = $temoignage->save();
        if ($saving) {

            $dataResponse =[
                'type'=>'success',
                'urlback'=>"back",
                'message'=>"Temoignage modifié avec succes!",
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        try {
            // Trouver le réseau à supprimer
            $temoignage = Temoignage::where('uuid', $uuid)->firstOrFail();
            // Mettre à jour l'état à "Archivé"
            $temoignage->etat = 'Inactif';
            $temoignage->save();
    
            return response()->json([
                'type' => 'success',
                'message' => "Le temoignage a été supprimé avec succès!",
                'urlback' => route('admin.temoignage') // Redirection après succès
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => "Erreur lors de la suppression: " . $e->getMessage(),
            ]);
        }
    }
}
