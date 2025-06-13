<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductByReseau;
use App\Models\ReseauDistribution;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReseauDistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('etat', 'Actif')->get();
        $reseaux = ReseauDistribution::where('etat', 'Actif')->get();
        // dd($reseaux);

        return view('admins.pages.reseauDist.reseau_distribution', compact('reseaux', 'products'));
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
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        DB::beginTransaction();
        try {
            // Traitement de l'image
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $imageName = Str::uuid() . '.' . $file->extension();
                $file->move(public_path('images/ReseauDist/'), $imageName);
            }
            $uuid = Str::uuid();
            $saving = ReseauDistribution::create([
                'uuid' => $uuid,
                'code' => Refgenerate(ReseauDistribution::class, 'R', 'code'),
                'label' => $request->label,
                'description' => $request->description,
                'image' => $imageName ?? null,
            ])->save();

            $productUuidArray = $request->input('product_uuid');

            foreach ($productUuidArray as $key => $productUuid) {
                ProductByReseau::create([
                    'uuid' => Str::uuid(),
                    'reseau_uuid' => $uuid,
                    'product_uuid' => $productUuid,
                ]);
            }

            if ($saving) {
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => 'back',
                    'message' => 'Enregistré avec succes!',
                    'code' => 200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de l'enregistrement!",
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
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        return view('admins.pages.products.reseau_distribution_show', compact('reseaux'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, string $uuid)
    {
        $request->validate([
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'label' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // Recherche du réseau à modifier
            $reseau = ReseauDistribution::where('uuid', $uuid)->firstOrFail();

            // Traitement de l'image
            if ($request->hasFile('file')) {
                // Supprimer l'ancienne image si elle existe
                if ($reseau->image) {
                    $oldImagePath = public_path('images/ReseauDist/' . $reseau->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Enregistrer la nouvelle image
                $file = $request->file('file');
                $imageName = Str::uuid() . '.' . $file->extension();
                $file->move(public_path('images/ReseauDist/'), $imageName);
                $reseau->image = $imageName;
            }

            // Mise à jour des autres champs
            $reseau->label = $request->label;
            $reseau->description = $request->description;
            $saving = $reseau->save();

            $productUuidArray = $request->input('product_uuid');

            foreach ($productUuidArray as $key => $productUuid) {
                // Supprimer l'entrée déjà existante
                ProductByReseau::where('reseau_uuid', $reseau->uuid)
                    ->where('product_uuid', $productUuid)
                    ->delete();

                // Ajouter la nouvelle entrée
                ProductByReseau::create([
                    'uuid' => Str::uuid(),
                    'reseau_uuid' => $reseau->uuid,
                    'product_uuid' => $productUuid,
                ]);
            }
            if ($saving) {
                DB::commit();
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => 'back',
                    'message' => 'Modifié avec succès !',
                    'code' => 200,
                ];
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => 'Erreur lors de la modification !',
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
            $reseau = ReseauDistribution::where('uuid', $uuid)->firstOrFail();
            // Mettre à jour l'état à "Archivé"
            $reseau->etat = 'Archivé';
            $reseau->save();

            return response()->json([
                'type' => 'success',
                'message' => 'Le réseau de distribution a été supprimer avec succès!',
                'urlback' => route('admin.reseau_distribution'), // Redirection après succès
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur lors de la supprimer: ' . $e->getMessage(),
            ]);
        }
    }
    public function removeProdInReseau(string $uuid)
    {
        try {
            // Trouver le réseau à supprimer
            $productByReseau = ProductByReseau::where(['uuid'=> $uuid])->firstOrFail();
            // Mettre à jour l'état à "Inactif"
            $productByReseau->etat = 'Inactif';
            $productByReseau->save();

            return response()->json([
                'type' => 'success',
                'message' => 'Le produit a été retiré du reseau avec succès!',
                'urlback' => route('admin.reseau_distribution'), // Redirection après succès
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur lors de la supprimer: ' . $e->getMessage(),
            ]);
        }
    }
}
