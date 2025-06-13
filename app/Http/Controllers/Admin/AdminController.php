<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Visitor;
use App\Models\TeamYako;
use App\Models\AboutPage;
use App\Models\Actuality;
use App\Models\Temoignage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ModelCourrier;
use App\Models\ReseauInterne;
use App\Models\FormuleProduit;
use App\Models\Presouscription;
use App\Models\ReseauDistribution;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\View\Components\Task;

class AdminController extends Controller
{
    public function index()
    {
        // Nombre total de visiteurs
        $totalVisitors = Visitor::where('ip_address', '!=', '')
            ->whereNull('uuid_activity')
            ->whereNull('product_uuid')
            ->whereNull('reseau_uuid')
            ->whereNull('prodformule_uuid')
            ->whereNull('page_visited')
            ->count();

        // Nombre de visiteurs aujourd'hui
        $today = Visitor::where('ip_address', '!=', '')
            ->whereDate('created_at', Carbon::today())
            ->whereNull('uuid_activity')
            ->whereNull('product_uuid')
            ->whereNull('reseau_uuid')
            ->whereNull('prodformule_uuid')
            ->whereNull('page_visited')
            ->count();

        // Nombre de visiteurs par semaine
        $visiteursParSemaine = Visitor::where('ip_address', '!=', '')
            ->whereYear('created_at', Carbon::now()->year) // Filtrer par année en cours
            ->whereNull('uuid_activity')
            ->whereNull('product_uuid')
            ->whereNull('reseau_uuid')
            ->whereNull('prodformule_uuid')
            ->whereNull('page_visited')
            ->select(DB::raw('WEEK(created_at, 1) as week_number'), DB::raw('COUNT(*) as total'))
            ->groupBy('week_number')
            ->orderBy('total', 'desc')
            ->get();
            // dd($visiteursParSemaine->take(3)->toArray());

        // Nombre de visites par jour
        $visitesParJour = Visitor::where('ip_address', '!=', '')
            ->whereDate('created_at', '>=', Carbon::now()->subWeeks(3)) // Prendre les 21 derniers jours
            ->whereNull('uuid_activity')
            ->whereNull('product_uuid')
            ->whereNull('reseau_uuid')
            ->whereNull('prodformule_uuid')
            ->whereNull('page_visited')
            ->select(DB::raw('DATE(created_at) as jour'), DB::raw('COUNT(*) as total'))
            ->groupBy('jour')
            ->orderBy('jour', 'asc')
            ->get();

            $labels = $visitesParJour->pluck('jour')->toArray(); // Jours (axe X)
            $data = $visitesParJour->pluck('total')->toArray();  // Nombre de visites (axe Y)


        // Nombre de visiteurs ce mois-ci
        $thisMonth = Visitor::where('ip_address', '!=', '')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year) // Ajout pour s'assurer que c'est le bon mois et la bonne année
            ->whereNull('uuid_activity')
            ->whereNull('product_uuid')
            ->whereNull('reseau_uuid')
            ->whereNull('prodformule_uuid')
            ->whereNull('page_visited')
            ->count();
        // $thisYear = Visitor::whereYear('created_at', Carbon::now()->year)->where('ip_address', '!=', '')->where(['uuid_activity'=>'','product_uuid'=>'','reseau_uuid'=>'','prodformule_uuid'=>''])->count();

        $newPreSouscription = Presouscription::where(['etat' => 'Actif', 'status' => 'En attente', 'type' => 'Pré-souscription'])->count();
        $approuvePreSouscription = Presouscription::where(['etat' => 'Actif', 'status' => 'Approuver', 'type' => 'Pré-souscription'])->count();
        $rejetePreSouscription = Presouscription::where(['etat' => 'Actif', 'status' => 'Rejeter', 'type' => 'Pré-souscription'])->count();
        $newContact = Presouscription::where(['etat' => 'Actif', 'status' => 'En attente', 'type' => 'contact'])->count();
        $approuveContact = Presouscription::where(['etat' => 'Actif', 'status' => 'Approuver', 'type' => 'contact'])->count();
        $rejeteContact = Presouscription::where(['etat' => 'Actif', 'status' => 'Rejeter', 'type' => 'contact'])->count();

        $visiteReseauxParJour = Visitor::where('reseau_uuid', '!=', '')
            ->get()
            ->groupBy([
                function ($visitor) {
                    return $visitor->created_at->format('d-m-Y');
                },
                'reseau_uuid'
            ])
            ->map(function ($dateGroup) {
                return $dateGroup->map->count();
            });

        $reseaux = ReseauDistribution::where('etat', 'Actif')->pluck('label', 'uuid');
        // dd($visiteReseauxParJour,$reseaux);

        $visiteProduitsParJour = Visitor::where('product_uuid', '!=', '')
            ->with('product')
            ->get()
            ->groupBy(function ($visitor) {
                return $visitor->created_at->format('d-m-Y'); // Groupement par jour
            })
            ->map(function ($dateGroup) {
                return $dateGroup
                    ->groupBy('product_uuid') // Groupement par produit
                    ->map->count() // Compter les visites par produit
                    ->sortDesc() // Trier par nombre de visites décroissant
                    ->take(5); // Prendre les 5 produits les plus consultés
            });

            
            // Récupérer les produits correspondants, mais uniquement les 5 premiers produits par jour
            $productUuids = $visiteProduitsParJour->collapse()->keys()->take(5); // Liste des 5 UUID uniques des produits
            $products = Product::whereIn('uuid', $productUuids)->where('etat', 'Actif')->pluck('label', 'uuid');

        $visiteFormulesProduitsParJour = Visitor::where('prodformule_uuid', '!=', '')
            ->with('formule')
            ->get()
            ->groupBy(function ($visitor) {
                return $visitor->created_at->format('d-m-Y'); // Groupement par jour
            })
            ->map(function ($dateGroup) {
                return $dateGroup
                    ->groupBy('prodformule_uuid') // Groupement par produit
                    ->map->count() // Compter les visites par produit
                    ->sortDesc() // Trier par nombre de visites décroissant
                    ->take(5); // Prendre les 5 produits les plus consultés
            });

            
            // Récupérer les produits correspondants, mais uniquement les 5 premiers produits par jour
            $prodFormuleUuids = $visiteFormulesProduitsParJour->collapse()->keys()->take(5); // Liste des 5 UUID uniques des produits
            $prodFormules = FormuleProduit::whereIn('uuid', $prodFormuleUuids)->where('etat', 'Actif')->pluck('label', 'uuid');
            // dd($visiteFormulesProduitsParJour, $prodFormules);

        $visiteActualitesParJour = Visitor::where('uuid_activity', '!=', '')
            ->with('actuality')
            ->get()
            ->groupBy(function ($visitor) {
                return $visitor->created_at->format('d-m-Y'); // Groupement par jour
            })
            ->map(function ($dateGroup) {
                return $dateGroup
                    ->groupBy('uuid_activity') // Groupement par produit
                    ->map->count() // Compter les visites par produit
                    ->sortDesc() // Trier par nombre de visites décroissant
                    ->take(5); // Prendre les 5 produits les plus consultés
            });

            
            // Récupérer les produits correspondants, mais uniquement les 5 premiers produits par jour
            $actualityUuids = $visiteActualitesParJour->collapse()->keys()->take(5); // Liste des 5 UUID uniques des produits
            $actualities = Actuality::whereIn('uuid', $actualityUuids)
                ->where('etat', 'Actif')
                ->pluck('title', 'uuid')
                ->map(function ($title) {
                    return Str::limit($title, 50, '...'); // Limite à 10 caractères
                });
            // dd($visiteActualitesParJour, $actualities);

        $pageVisited = Visitor::where('page_visited', '!=', null)
            ->where('page_visited', '!=', '')
            ->get()
            ->groupBy('page_visited')  // Regroupe par page_visited uniquement
            ->map(function ($pageGroup) {
                return $pageGroup->count();  // Compte le nombre de visites pour chaque page
            });

        // Transforme les données PHP en format JavaScript pour l'affichage dans le graphique
        $chartData = $pageVisited->map(function ($count, $page) {
            return [
                'name' => $page,
                'value' => $count,
            ];
        })->values(); // Utilise values pour réindexer les éléments


        // dd($pageVisited, $chartData);
        return view('admins.dashboard', compact('totalVisitors', 'today', 'thisMonth', 'newPreSouscription', 'approuvePreSouscription', 'rejetePreSouscription', 'newContact', 'approuveContact', 'rejeteContact', 'visiteReseauxParJour', 'reseaux', 'visiteProduitsParJour', 'products', 'labels', 'data', 'chartData', 'visiteFormulesProduitsParJour', 'prodFormules', 'visiteActualitesParJour', 'actualities'));
    }

    public function accueil()
    {
        $reseaux = ReseauDistribution::where('etat', 'Actif')->take(2)->get();
        $products = Product::where('etat', 'Actif')->get();
        $temoignages = Temoignage::where('etat', 'Actif')->orderBy('created_at', 'desc')->get();
        return view('admins.userPages.accueil', compact('reseaux', 'products', 'temoignages'));
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

        return view('admins.userPages.about.apropos', compact('aboutHist', 'aboutMotPCA', 'DGs', 'teams', 'PCA', 'DGA', 'teams1', 'teams2'));
    }
    public function aboutUpdate(Request $request, string $uuid)
    {
        $user = Auth::user();
        $user_uuid = $user->uuid;
        $request->validate([

            'file' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);
        DB::beginTransaction();
        try {
            // Recherche du produit à modifier
            $AboutPage = AboutPage::where('uuid', $uuid)->first();
            // Traitement de l'image
            if ($request->hasFile('file')) {
                // Supprimer l'ancienne image si elle existe
                if ($AboutPage->image) {
                    $oldImagePath = public_path('images/AboutPage/' . $AboutPage->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Enregistrer la nouvelle image
                $file = $request->file('file');
                $imageName = Str::uuid() . '.' . $file->extension();
                $file->move(public_path('images/AboutPage/'), $imageName);
                $AboutPage->image = $imageName;
            }

            // Mise à jour des autres champs
            $AboutPage->title = $request->title;
            $AboutPage->nomPCA = $request->nomPCA;
            $AboutPage->content = $request->content;
            $AboutPage->update_user_uuid = $user_uuid;

            $saving = $AboutPage->save();
            if ($saving) {

                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Enregistré avec succes!",
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


    public function AddTeam(Request $request)
    {
        $user = Auth::user();
        $user_uuid = $user->uuid;
        // Validation
        $request->validate([
            'team_name' => 'required|array',
            'team_name.*' => 'required|string|max:255',
            'team_fonction' => 'required|array',
            'team_fonction.*' => 'required|string|max:255',
            'team_description' => 'required|array',
            'team_description.*' => 'required|string',
            'file' => 'nullable|array',
            'file.*' => 'nullable|image|mimes:jpeg,png,jpg', // Validation pour les images multiples
        ]);

        DB::beginTransaction();
        try {
            $saveSuccess = true; // Variable pour suivre l'état des sauvegardes

            // Boucle sur chaque membre de l'équipe soumis
            foreach ($request->team_name as $index => $teamName) {
                // Traitement de l'image
                if ($request->hasFile('file') && isset($request->file('file')[$index])) {
                    $file = $request->file('file')[$index];
                    $imageName = Str::uuid() . '.' . $file->extension();
                    $file->move(public_path('images/Teams/'), $imageName);
                } else {
                    $imageName = null; // Pas d'image fournie
                }

                // Enregistrement de chaque membre de l'équipe
                $saving = TeamYako::create([
                    'uuid' => Str::uuid(),
                    'user_uuid' => $user_uuid,
                    'team_name' => $teamName,
                    'team_fonction' => $request->team_fonction[$index],
                    'team_image' => $imageName, // Assigner l'image ou null
                    'team_description' => $request->team_description[$index],
                    // 'update_user_uuid' => auth()->user()->uuid, // Optionnel : mettez à jour avec l'utilisateur connecté
                ]);

                if (!$saving) {
                    $saveSuccess = false;
                    break; // Si une sauvegarde échoue, on arrête la boucle
                }
            }

            if ($saveSuccess) {
                DB::commit();
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Enregistré avec succès!",
                    'code' => 200,
                ];
            } else {
                DB::rollBack();
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
                'message' => "Erreur système: {$th->getMessage()}",
                'code' => 500,
            ];
        }

        return response()->json($dataResponse);
    }

    public function updateTeam(Request $request, string $uuid)
    {
        $user = Auth::user();
        $user_uuid = $user->uuid;
        $request->validate([

            'file' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);
        DB::beginTransaction();
        try {
            // Recherche du produit à modifier
            $Team = TeamYako::where('uuid', $uuid)->first();
            // Traitement de l'image
            if ($request->hasFile('file')) {
                // Supprimer l'ancienne image si elle existe
                if ($Team->team_image) {
                    $oldImagePath = public_path('images/Teams/' . $Team->team_image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Enregistrer la nouvelle image
                $file = $request->file('file');
                $imageName = Str::uuid() . '.' . $file->extension();
                $file->move(public_path('images/Teams/'), $imageName);
                $Team->team_image = $imageName;
            }

            // Mise à jour des autres champs
            $Team->team_name = $request->team_name;
            $Team->team_fonction = $request->team_fonction;
            $Team->team_description = $request->team_description;
            $Team->update_user_uuid = $user_uuid;

            $saving = $Team->save();
            if ($saving) {

                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Modifié avec succes!",
                    'code' => 200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de la modification!",
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

    public function reseau()
    {
        $Siege = ReseauInterne::where(['etat' => 'Actif', 'type' => 'Siege'])->first();
        $EspaceClient = ReseauInterne::where(['etat' => 'Actif', 'type' => 'EspaceClient'])->first();
        $Autres = ReseauInterne::where(['etat' => 'Actif', 'type' => 'Autre'])->get();
        return view('admins.userPages.reseau', compact('Siege', 'EspaceClient', 'Autres'));
    }

    public function assistance()
    {
        $courriers = ModelCourrier::get();
        return view('admins.userPages.assistance', compact('courriers'));
    }

    public function assistanceStore(Request $request)
    {
        $user = Auth::user();
        $user_uuid = $user->uuid;
        // Valider les données du formulaire
        $request->validate([
            'label' => 'required|string|max:255',
            'file' => 'required|mimes:pdf', // Limite de 2 Mo
        ]);
        DB::beginTransaction();
        try {
            // Générer un UUID pour l'enregistrement
            $uuid = Str::uuid();

            // Récupérer le fichier PDF du formulaire
            if ($request->hasFile('file')) {
                // Obtenir le fichier
                $file = $request->file('file');
                // Générer un nom unique pour le fichier
                $fileName = Str::uuid() . '.' . $file->extension();
                $file->move(public_path('ModelCourriers/'), $fileName);
            }
            // Créer l'enregistrement dans la base de données
            $saving = ModelCourrier::create([
                'uuid' => $uuid,
                'user_uuid' => $user_uuid, // Récupérer l'UUID de l'utilisateur connecté
                'label' => $request->input('label'),
                'file' => $fileName, // Chemin du fichier stocké
            ]);

            if ($saving) {
                DB::commit();
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Enregistré avec succès!",
                    'code' => 200,
                ];
            } else {
                DB::rollBack();
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
                'message' => "Erreur système: {$th->getMessage()}",
                'code' => 500,
            ];
        }

        return response()->json($dataResponse);
    }
}
