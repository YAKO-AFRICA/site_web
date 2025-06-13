<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ReseauInterne;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReseauInterneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reseauInternes = ReseauInterne::where('etat', 'Actif')->with('user')->get();
        return view('admins.pages.reseauInterne.index', compact('reseauInternes'));
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
    // public function store (Request $request)
    // {
    //     $user = Auth::user();
    //     $user_uuid = $user->uuid;
    //     $request->validate([
            
    //         'file' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    //     ]);
    // DB::beginTransaction();
    // try {

    //     // Traitement de l'image
    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    //         $imageName = Str::uuid().'.'.$file->extension();
    //         $file->move(public_path('images/'), $imageName);
    //     }
    //     $uuid = Str::uuid();
    //     $saving = ReseauInterne::create([
    //         'uuid' => $uuid,
    //         'user_uuid' => $user_uuid,
    //         'code' => Refgenerate(ReseauInterne::class, 'RI', 'code'),
    //         'label' => $request->label,
    //         'ville' => $request->ville,
    //         'email' => $request->email,
    //         'telephone1' => $request->telephone1,
    //         'telephone2' => $request->telephone2,
    //         'longitude' => $request->longitude,
    //         'latitude' => $request->latitude,
    //         'type' => $request->type,
    //         'etat' => $request->etat,
    //         'description' => $request->description,
    //         'image' => $imageName ?? null,
    //     ])->save();

    //     if ($saving) {

    //         $dataResponse =[
    //             'type'=>'success',
    //             'urlback'=>"back",
    //             'message'=>"Enregistré avec succes!",
    //             'code'=>200,
    //         ];
    //         DB::commit();
    //    } else {
    //         DB::rollback();
    //         $dataResponse =[
    //             'type'=>'error',
    //             'urlback'=>'',
    //             'message'=>"Erreur lors de l'enregistrement!",
    //             'code'=>500,
    //         ];
    //    }

    // } catch (\Throwable $th) {
    //     DB::rollBack();
    //     $dataResponse =[
    //         'type'=>'error',
    //         'urlback'=>'',
    //         'message'=>"Erreur systeme! $th",
    //         'code'=>500,
    //     ];
    // }
    //     return response()->json($dataResponse);
    //  }

    public function store(Request $request)
    {
        // Récupération de l'utilisateur connecté
        $user = Auth::user();
        $user_uuid = $user->uuid;
    
        // Validation conditionnelle des données du formulaire
        $request->validate([
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->type === 'Siege') {
            $tel1 = $request->telephone1Siege;
            $tel2 = $request->telephone2Siege;
            $email = $request->emailSiege;
        } elseif ($request->type === 'EspaceClient') {
            $tel1 = $request->telephone1EspaceClient;
            $tel2 = $request->telephone2EspaceClient;
            $email = $request-> emailEspaceClient ?? '';
        } elseif ($request->type === 'Autre') {
            $tel1 = $request->telephone1Autre;
            $tel2 = $request->telephone2Autre;
            $email = $request->emailAutre;
        }

        // Début de la transaction dans la base de données
        DB::beginTransaction();
        try {
            // Traitement de l'image
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $imageName = Str::uuid().'.'.$file->extension();
                $file->move(public_path('images/ReseauInterne/'), $imageName);
            }
    
            // Création de l'objet ReseauInterne et sauvegarde
            $uuid = Str::uuid();
            $reseau = new ReseauInterne([
                'uuid' => $uuid,
                'user_uuid' => $user_uuid,
                'code' => Refgenerate(ReseauInterne::class, 'RI', 'code'),
                'label' => $request->label,
                'ville' => $request->ville,
                'email' => $email,
                'telephone1' => $tel1,
                'telephone2' => $tel2,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'type' => $request->type,
                'description' => $request->description,
                'image' => $imageName ?? null,
            ]);
            $reseau->save();
    
            DB::commit();
            $dataResponse = [
                'type' => 'success',
                'urlback' => 'back',
                'message' => 'Enregistré avec succès!',
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
        // Récupération de l'utilisateur connecté
        $user = Auth::user();
        $user_uuid = $user->uuid;
        $request->validate([
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        DB::beginTransaction();
        try {
            // Recherche du réseau à modifier
            $reseauInterne = ReseauInterne::where('uuid', $uuid)->firstOrFail();
    
            // Traitement de l'image
            if ($request->hasFile('file')) {
                // Supprimer l'ancienne image si elle existe
                if ($reseauInterne->image) {
                    $oldImagePath = public_path('images/ReseauInterne/' . $reseauInterne->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
    
                // Enregistrer la nouvelle image
                $file = $request->file('file');
                $imageName = Str::uuid() . '.' . $file->extension();
                $file->move(public_path('images/ReseauInterne/'), $imageName);
                $reseauInterne->image = $imageName;
            }
    
            // Mise à jour des autres champs
            $reseauInterne->label = $request->label;
            $reseauInterne->ville = $request->ville;
            $reseauInterne->email = $request->email;
            $reseauInterne->telephone1 = $request->telephone1;
            $reseauInterne->telephone2 = $request->telephone2;
            $reseauInterne->longitude = $request->longitude;
            $reseauInterne->latitude = $request->latitude;
            $reseauInterne->description = $request->description;
            $reseauInterne->update_user_uuid = $user_uuid;
            $saving = $reseauInterne->save();
    
            if ($saving) {
                DB::commit();
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Modifié avec succès !",
                    'code' => 200,
                ];
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de la modification !",
                    'code' => 500,
                ];
            }
    
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système ! $th",
                'code' => 500,
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
            $reseauInterne = ReseauInterne::where('uuid', $uuid)->firstOrFail();
            if ($reseauInterne->type === 'Siege' || $reseauInterne->type === 'EspaceClient') {

                return response()->json([
                    'type' => 'error',
                    'message' => "Vous ne pouvez pas supprimer cet enregistrement mais plutôt le modifié!",
                    'urlback' => route('admin.reseau_interne') // Redirection après succès
                ]);
            } else{
                // Mettre à jour l'état à "Archivé"
            $reseauInterne->etat = 'Inactif';
            $reseauInterne->save();
    
            return response()->json([
                'type' => 'success',
                'message' => "Le réseau a été supprimer avec succès!",
                'urlback' => route('admin.reseau_interne') // Redirection après succès
            ]);
    
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => "Erreur lors de la suppression: " . $e->getMessage(),
            ]);
        }
    }
}
