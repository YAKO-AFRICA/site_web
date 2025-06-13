<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Actuality;
use App\Models\PostImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CommentActuality;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Request;

class ActualityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actualities = Actuality::where('etat', 'Actif')->with('product', 'user')->get();// Charger le produit associé à chaque actualité
        $products = Product::where('etat', 'Actif')->get();
        return view('admins.pages.actualities.index', compact('actualities', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $user = Auth::user();
    $user_uuid = $user->uuid;

    DB::beginTransaction();
    try {
        $uuid = Str::uuid();

        // Enregistrer les informations de l'actualité
        $saving = Actuality::create([
            'uuid' => $uuid,
            'title' => $request->title,
            'user_uuid' => $user_uuid,
            'product_uuid' => $request->product_uuid,
            'comment' => $request->comment,
            'citation' => $request->citation,
            'video_url' => $request->video_url,
        ]);

        // Récupérer les fichiers d'images
        $PostImagesArray = $request->file('file');

        if ($PostImagesArray && is_array($PostImagesArray)) {
            foreach ($PostImagesArray as $PostImage) {
                if ($PostImage) {
                    // Générer un nom unique pour chaque image
                    $imageName = Str::uuid() . '.' . $PostImage->extension();
                    $PostImage->move(public_path('images/Actualities/'), $imageName);

                    // Enregistrer chaque image dans la table PostImage
                    PostImage::create([
                        'uuid' => Str::uuid(),
                        'actuality_uuid' => $saving->uuid,
                        'image_url' => $imageName,
                    ]);
                }
            }
        }

        DB::commit();

        $dataResponse = [
            'type' => 'success',
            'urlback' => "back",
            'message' => "Enregistré avec succès!",
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
     * Affichage des commentaires approuvés sur le site.
     */
    public function comment_view()
    {
        $comments = CommentActuality::where(['etat'=> 'Actif'])->with('actuality', 'user')->orderBy('created_at', 'desc')->get();
        return view('admins.pages.actualities.ActuComment', compact('comments'));
    }

     public function comment_store(Request $request)
     {
        //  $user = Auth::user();
        //  $user_uuid = $user->uuid;
         DB::beginTransaction();
    try {

        $uuid = Str::uuid();
        $saving = CommentActuality::create([
            'uuid' => $uuid,
            // 'code' => Refgenerate(CommentActuality::class, 'S', 'code'),
            // 'user_uuid' => $user_uuid,
            'actuality_uuid' => $request->actuality_uuid,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_website' => $request->customer_website,
            'comment' => $request->comment,
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
     

     public function comment_approved(Request $request, string $uuid)
    {
        try {
            $user = Auth::user();
            $user_uuid = $user->uuid;
            // Trouver l'Actuality à supprimer
            $Comment = CommentActuality::where('uuid', $uuid)->firstOrFail();
            // Mettre à jour l'état à "Inactif"
            $Comment->status = $request->status;
            $Comment->user_uuid = $user_uuid;

            $Comment->save();
    
            if ($Comment) {

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


     public function comment_destroy(string $uuid)
    {
        try {
            // Trouver l'Actuality à supprimer
            $Comment = CommentActuality::where('uuid', $uuid)->firstOrFail();
            // Mettre à jour l'état à "Inactif"
            $Comment->etat = 'Inactif';
            $Comment->save();
    
            return response()->json([
                'type' => 'success',
                'message' => "Le comment a été supprimer avec succès!",
                'urlback' => route('admin.actuality.comment_show') // Redirection après succès
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => "Erreur lors de l'archivage: " . $e->getMessage(),
            ]);
        }
    }
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

    public function DeleteImgByActuality(string $uuid)
    {
        $ImgByActuality = PostImage::where('uuid', $uuid)->firstOrFail();

        // Supprimer les images
        if ($ImgByActuality) {
                // Supprimer le fichier physique
                $imagePath = public_path('images/Actualities/' . $ImgByActuality->image_url);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                // Supprimer l'enregistrement de la base de données
                $ImgByActuality->delete();
        }
}

    
    public function update(Request $request, string $uuid)
{
    $user = Auth::user();
    $user_uuid = $user->uuid;
    DB::beginTransaction();

    try {
        // Recherche de l'actualité à modifier
        $actuality = Actuality::where('uuid', $uuid)->firstOrFail();

        // Mise à jour des autres champs
        $actuality->title = $request->title;
        $actuality->comment = $request->comment;
        $actuality->product_uuid = $request->product_uuid;
        $actuality->citation = $request->citation;
        $actuality->video_url = $request->video_url;
        $actuality->update_user_uuid = $user_uuid;
        $saving = $actuality->save();

        // Traitement des nouvelles images
        $PostImagesArray = $request->file('file');
        if ($PostImagesArray && is_array($PostImagesArray)) {
            foreach ($PostImagesArray as $PostImage) {
                if ($PostImage) {
                    // Générer un nom unique pour chaque image
                    $imageName = Str::uuid() . '.' . $PostImage->extension();
                    $PostImage->move(public_path('images/Actualities/'), $imageName);

                    // Enregistrer chaque image dans la table PostImage
                    PostImage::create([
                        'uuid' => Str::uuid(),
                        'actuality_uuid' => $uuid,
                        'image_url' => $imageName,
                    ]);
                }
            }
        }

        if ($saving) {
            $dataResponse = [
                'type' => 'success',
                'urlback' => "back",
                'message' => "Enregistré avec succès!",
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
            'message' => "Erreur système! $th",
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
            // Trouver l'Actuality à supprimer
            $actuality = Actuality::where('uuid', $uuid)->firstOrFail();
            // Mettre à jour l'état à "Inactif"
            $actuality->etat = 'Inactif';
            $actuality->save();
    
            return response()->json([
                'type' => 'success',
                'message' => "L'actualité a été supprimer avec succès!",
                'urlback' => route('admin.actuality') // Redirection après succès
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => "Erreur lors de l'archivage: " . $e->getMessage(),
            ]);
        }
    }
}



// // Traitement de l'image
        // if ($request->hasFile('file')) {
        //     // Supprimer l'ancienne image si elle existe
        //     if ($actuality->image_url) {
        //         $oldImagePath = public_path('images/Actualities/' . $actuality->image_url);
        //         if (file_exists($oldImagePath)) {
        //             unlink($oldImagePath);
        //         }
        //     }

        //     // Enregistrer la nouvelle image
        //     $file = $request->file('file');
        //     $imageName = Str::uuid() . '.' . $file->extension();
        //     $file->move(public_path('images/Actualities/'), $imageName);
        //     $actuality->image_url = $imageName;
        // }


        // $PostImages = PostImage::where('actuality_uuid', $uuid)->get();
        // foreach ($PostImages as $PostImage) {
        //     $PostImage->delete();
        // }
