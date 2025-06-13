<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FormuleProduit;
use App\Models\ReseauDistribution;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FormuleProdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $products = Product::where('etat','Actif')->get();
        $formules = FormuleProduit::where('etat', 'Actif')->with('product')->get();// Charger le produit associé à chaque formule
        $reseaux = ReseauDistribution::where('etat', 'Actif')->get();
        return view('admins.pages.productFormule.index', compact('formules', 'products', 'reseaux'));
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
            $imageName = Str::uuid().'.'.$file->extension();
            $file->move(public_path('images/FormuleProducts/'), $imageName);
        }
        // Traitement de la brochure
        if ($request->hasFile('brochure')) {
            $filebrochure = $request->file('brochure');
            $brochureName = Str::uuid().'.'.$filebrochure->extension();
            $filebrochure->move(public_path('images/FormuleProducts/Brochure/'), $brochureName);
        }
        $uuid = Str::uuid();
        $saving = FormuleProduit::create([
            'uuid' => $uuid,
            'code' => Refgenerate(FormuleProduit::class, 'FP', 'code'),
            'label' => $request->label,
            'reseau_uuid' => $request->reseau_uuid,
            'product_uuid' => $request->product_uuid,
            'description' => $request->description,
            'video_url' => $request->video_url,
            'formul_image' => $imageName ?? null,
            'brochure' => $brochureName ?? null,
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
        $request->validate([
            
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    DB::beginTransaction();
    try {
        // Recherche du produit à modifier
        $formulProduit = FormuleProduit::where('uuid', $uuid)->firstOrFail();
        // Traitement de l'image
        if ($request->hasFile('file')) {
            // Supprimer l'ancienne image si elle existe
            if ($formulProduit->formul_image) {
                $oldImagePath = public_path('images/FormuleProducts/' . $formulProduit->formul_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Enregistrer la nouvelle image
            $file = $request->file('file');
            $imageName = Str::uuid() . '.' . $file->extension();
            $file->move(public_path('images/FormuleProducts/'), $imageName);
            $formulProduit->formul_image = $imageName;
        }
        
        // Enregistrer la nouvelle brochure
        if ($request->hasFile('brochure')) {
            // Supprimer l'ancienne brochure si elle existe
            if ($formulProduit->brochure) {
                $oldbrochurePath = public_path('images/FormuleProducts/Brochure/' . $formulProduit->brochure);
                if (file_exists($oldbrochurePath)) {
                    unlink($oldbrochurePath);
                }
            }

            // Enregistrer la nouvelle image
            $filebrochure = $request->file('brochure');
            $brochureName = Str::uuid() . '.' . $filebrochure->extension();
            $filebrochure->move(public_path('images/FormuleProducts/Brochure/'), $brochureName);
            $formulProduit->brochure = $brochureName;
        }

        // Mise à jour des autres champs
        $formulProduit->label = $request->label;
        $formulProduit->video_url = $request->video_url;
        $formulProduit->description = $request->description;
        $saving = $formulProduit->save();
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        try {
            // Trouver le réseau à supprimer
            $product = FormuleProduit::where('uuid', $uuid)->firstOrFail();
            // Mettre à jour l'état à "Archivé"
            $product->etat = 'Inactif';
            $product->save();
    
            return response()->json([
                'type' => 'success',
                'message' => "La formule a été désactivée avec succès!",
                'urlback' => route('admin.product_formul') // Redirection après succès
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => "Erreur lors de l'archivage: " . $e->getMessage(),
            ]);
        }
    }
}
