<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



class ProductController extends Controller
{

//     public function uploadImage(Request $request)
// {
//     if ($request->hasFile('file')) {
//         $file = $request->file('file');
//         $path = $file->store('images', 'public'); // Stocke dans le dossier 'images' de l'espace public

//         return response()->json([
//             'location' => asset('storage/' . $path) // Retourne l'URL publique de l'image
//         ]);
//     }

//     return response()->json(['error' => 'Erreur lors du téléchargement'], 400);
// }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('etat','Actif')->get();
        return view('admins.pages.products.index', compact('products'));
    }



    public function test()
    {
        return view('admins.pages.test');
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
        $request->validate([
            
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    DB::beginTransaction();
    try {

        // Traitement de l'image
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $imageName = Str::uuid().'.'.$file->extension();
            $file->move(public_path('images/Products/'), $imageName);
        }
        $uuid = Str::uuid();
        $saving = Product::create([
            'uuid' => $uuid,
            'code' => Refgenerate(Product::class, 'P', 'code'),
            'label' => $request->label,
            'description' => $request->description,
            'product_image' => $imageName ?? null,
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
    public function show(string $uuid)
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
        $product = Product::where('uuid', $uuid)->firstOrFail();
        // Traitement de l'image
        if ($request->hasFile('file')) {
            // Supprimer l'ancienne image si elle existe
            if ($product->product_image) {
                $oldImagePath = public_path('images/Products/' . $product->product_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Enregistrer la nouvelle image
            $file = $request->file('file');
            $imageName = Str::uuid() . '.' . $file->extension();
            $file->move(public_path('images/Products/'), $imageName);
            $product->product_image = $imageName;
        }

        // Mise à jour des autres champs
        $product->label = $request->label;
        $product->description = $request->description;
        $saving = $product->save();
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
            $product = Product::where('uuid', $uuid)->firstOrFail();
            // Mettre à jour l'état à "Archivé"
            $product->etat = 'Inactif';
            $product->save();
    
            return response()->json([
                'type' => 'success',
                'message' => "Le réseau de distribution a été archivé avec succès!",
                'urlback' => route('admin.product_list') // Redirection après succès
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => "Erreur lors de l'archivage: " . $e->getMessage(),
            ]);
        }
    }

    
}
