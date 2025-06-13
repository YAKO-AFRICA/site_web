<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\TeamYako;
use App\Models\AboutPage;
use App\Models\ReseauInterne;
use App\Models\Actuality;
use App\Models\ModelCourrier;
use Illuminate\Http\Request;
use App\Models\FormuleProduit;
use App\Models\CommentActuality;
use App\Models\ReseauDistribution;
use App\Models\Temoignage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {


        // $table = ReseauDistribution::on('mysql2')->take(2)->get();
        // dd($table); 
        $reseaux = ReseauDistribution::where('etat', 'Actif')->take(2)->get();
        $products = Product::where('etat', 'Actif')->orderBy('code', 'ASC')->get();
        $temoignages = Temoignage::where('etat','Actif')->orderBy('created_at', 'desc')->get();
        $actualities = Actuality::where('etat', 'Actif')->with('product', 'user', 'postImage')->orderBy('created_at', 'desc')->take(1)->get();// Charger le produit associé à chaque actualité
        // foreach ($actualities as $actuality) {
        //     $actuality->postImage;
        //     dd($actuality->postImage);
        // }
        return view('users.index', compact('reseaux', 'products', 'temoignages', 'actualities'));
    }

    public function invitation()
    {
        return view('users.invitations.invitation');
    }

    public function about()
    {
        $aboutHist = AboutPage::where('section', 'sectionHistorique')->first();
        $aboutMotPCA = AboutPage::where('section', 'sectionMotPCA')->first();
        $PCA = TeamYako::where("team_fonction", "Président du conseil d'administration")->first();
        $DGs = TeamYako::where('team_fonction', 'Directeur générale')
               ->orWhere('team_fonction', 'Directeur Général Adjoint')
               ->get();
        $DGA = TeamYako::where("team_fonction", "Directeur Général Adjoin")->first();
        
        // Récupérer tous les membres sauf ceux ayant la fonction 'Directrice générale'

        $teams = TeamYako::whereIn('team_fonction', [
            'Directeur Financier et Comptable', 
            'Directeur Technique et Actuariat'
        ])->get();

        $teams1 = TeamYako::whereIn('team_fonction', [
            'Directeur Général Adjoint', 
            'Directeur Financier et Comptable', 
            'Directeur Technique et Actuariat'
        ])->get(); 

        $teams2 = TeamYako::whereIn('team_fonction', [
            "Directeur du Système d'Information", 
            'Directeur du Développement Commercial', 
            'Directeur Adjoint du Développement Commercial'
        ])->get();

        return view('users.about.apropos', compact('aboutHist', 'aboutMotPCA', 'DGs', 'teams', 'PCA', 'DGA', 'teams1', 'teams2'));
    }

    public function reseau()
    {
        $Siege = ReseauInterne::where(['etat'=>'Actif', 'type'=>'Siege'])->first();
        $EspaceClient = ReseauInterne::where(['etat'=>'Actif', 'type'=>'EspaceClient'])->first();
        $Autres = ReseauInterne::where(['etat'=>'Actif', 'type'=>'Autre'])->get();
        return view('users.about.reseau', compact('Siege', 'EspaceClient', 'Autres'));
    }

    public function getReseaux()
    {
        // Récupérer tous les réseaux avec latitude et longitude
        $reseaux = ReseauInterne::select('label', 'longitude', 'latitude', 'description')->where(['etat'=>'Actif'])->get();
        return response()->json($reseaux);
    }

    
    public function products(string $uuid)
    {
        $reseaux = ReseauDistribution::where('uuid', $uuid)->first();

        $products = $reseaux->products()->where('products.etat', 'Actif')->get();

        // Préparer un tableau pour les formules associées
        $formulesByProduct = [];

        // Récupérer les formules associées à chaque produit
        foreach ($products as $product) {
            $productUuids = $product->uuid; // UUID du produit actuel
            $formulesByProduct[$productUuids] = FormuleProduit::where(['product_uuid'=> $productUuids, 'reseau_uuid'=> $uuid, 'etat'=> 'Actif'])->get();
        }
        // dd($formulesByProduct);

        return view('users.products.products', compact('reseaux', 'products', 'formulesByProduct'));
    }


    public function all_products()
{
    $products = Product::where('etat', 'Actif')->get();

    // Préparer des tableaux pour les formules et réseaux associés
    $formulesByProduct = [];
    $reseauByProduct = [];

    // Récupérer les réseaux et formules associés à chaque produit
    foreach ($products as $product) {
        $productUuids = $product->uuid; // UUID du produit actuel
        
        // Récupérer les réseaux de distribution actifs pour chaque produit
        $reseauByProduct[$productUuids] = $product->reseaux()
            ->wherePivot('etat', 'Actif') // Condition sur la table pivot
            ->get();

        foreach ($reseauByProduct[$productUuids] as $reseau) {
            // Récupérer les formules actives pour chaque combinaison produit/réseau
            $formulesByProduct[$productUuids][$reseau->uuid] = FormuleProduit::where([
                'product_uuid' => $productUuids,
                'reseau_uuid' => $reseau->uuid,
                'etat' => 'Actif'
            ])->get();
        }
    }
    // dd($formulesByProduct);

    return view('users.products.all_products', compact('products', 'formulesByProduct', 'reseauByProduct'));
}
    public function product_details(string $uuid)
    {

        $formulproduct = FormuleProduit::where('uuid', $uuid)->first(); 
        return view('users.products.product_details', compact('formulproduct'));
    }

    public function actuality()
    {
        $actualities = Actuality::where('etat', 'Actif')->with('product', 'user', 'postImage')->orderBy('created_at', 'desc')->get();// Charger le produit associé à chaque actualité
        return view('users.actualites.actuality', compact('actualities'));
    }
    
    public function actualityByProduct(string $product_uuid)
    {
        $actualities = Actuality::where('etat', 'Actif')->with('product', 'user', 'postImage')->orderBy('created_at', 'desc')->get();// Charger le produit associé à chaque actualité
        $actualityByProducts = Actuality::where(['etat'=> 'Actif', 'product_uuid'=> $product_uuid])->with('product', 'user', 'postImage')->orderBy('created_at', 'desc')->get();// Charger le produit associé à chaque actualité
        // $actualitiyInstitu = Actuality::where('etat', 'Actif')->where( 'product_uuid','Institutionnelle')->with('user', 'postImage')->orderBy('created_at', 'desc')->get();// Charger le produit associé à chaque actualité
        return view('users.actualites.actualityByProduct', compact('actualityByProducts', 'actualities'));
    }

    public function actuality_details(string $uuid)
    {   
        $actuality = Actuality::where('uuid', $uuid)->first();
        $actualities = Actuality::where(['etat'=> 'Actif'])
        ->where('product_uuid', $actuality->product_uuid)
        ->where('uuid', '!=', $uuid) // Exclure l'actualité courante
        ->with('product')
        ->orderBy('created_at', 'desc')
        ->get(); // Charger le produit associé à chaque actualité

        $comments = CommentActuality::where(['etat'=> 'Actif', 'status'=> 'Approved'])->where('actuality_uuid', $uuid)->orderBy('created_at', 'desc')->get();
        return view('users.actualites.actuality_details', compact('actuality', 'actualities', 'comments'));
    }

    public function assistance()
    {
        $courriers = ModelCourrier::get();
        return view('users.about.assistance', compact('courriers'));
    }
}
