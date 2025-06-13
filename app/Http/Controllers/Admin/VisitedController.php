<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Request;

class VisitedController extends Controller
{
    // public function visitedByCustomer(Request $request)
    //  {

    //     $ip = request()->ip();
    //     $uuid_activity = $request->uuid_activity;
    //     $product_uuid = $request->product_uuid;
    //     $reseau_uuid = $request->reseau_uuid;
    //     $prodformule_uuid = $request->prodformule_uuid;
    //     $dateToday = Carbon::now()->format('Y-m-d');
    //      DB::beginTransaction();
    // try {
    //     $visitor = Visitor::where('ip_address', $ip)->first();

    //     if ( $visitor->exists()) {
    //         if(($uuid_activity != null || $uuid_activity !='') && ($visitor->uuid_activity != $uuid_activity)&& $visitor->created_at->format('Y-m-d') != Carbon::now()->format('Y-m-d')){
    //             Visitor::create([
    //                 'ip_address' => $ip,
    //                 'uuid_activity' => $request->uuid_activity,
    //                 'product_uuid' => null,
    //                 'reseau_uuid' => null,
    //                 'prodformule_uuid' => null,
    //             ])->save();
    //         }elseif(($product_uuid != null || $product_uuid !='') && $visitor->product_uuid != $product_uuid && $visitor->created_at->format('Y-m-d') != Carbon::now()->format('Y-m-d')){
    //             Visitor::create([
    //                 'ip_address' => $ip,
    //                 'uuid_activity' => null,
    //                 'product_uuid' => $request->product_uuid,
    //                 'reseau_uuid' => null,
    //                 'prodformule_uuid' => null,
    //             ])->save();
    //         }elseif(($reseau_uuid != null || $reseau_uuid !='') && $visitor->reseau_uuid != $reseau_uuid && $visitor->created_at->format('Y-m-d') != Carbon::now()->format('Y-m-d')){
    //             Visitor::create([
    //                 'ip_address' => $ip,
    //                 'uuid_activity' => null,
    //                 'product_uuid' => null,
    //                 'reseau_uuid' => $request->reseau_uuid,
    //                 'prodformule_uuid' => null,
    //             ])->save();
    //         }elseif(($prodformule_uuid != null || $prodformule_uuid !='') && $visitor->prodformule_uuid != $prodformule_uuid && $visitor->created_at->format('Y-m-d') != Carbon::now()->format('Y-m-d')){
    //             Visitor::create([
    //                 'ip_address' => $ip,
    //                 'uuid_activity' => null,
    //                 'product_uuid' => null,
    //                 'reseau_uuid' => null,
    //                 'prodformule_uuid' => $request->prodformule_uuid,
    //             ])->save();
    //     }
    // }

    // DB::commit();
    // } catch (\Throwable $th) {
    //     DB::rollback();
    //     return response()->json(['error' => $th->getMessage()], 500);
    // }
    // return response()->json(['message' => 'modification effectuer avec succès.']);
    // }
    public function visitedByCustomer(Request $request)
    {
        $ip = $request->ip();
        $dateToday = Carbon::now()->format('Y-m-d');
        // dd($request->all());
        DB::beginTransaction();
        try {
            $visitor = Visitor::where(['ip_address'=> $ip, 'uuid_activity' => $request->uuid_activity, 'product_uuid' => $request->product_uuid, 'reseau_uuid' => $request->reseau_uuid, 'prodformule_uuid' => $request->prodformule_uuid, 'page_visited' => $request->page_visited])->whereDate('created_at', $dateToday)->first();

            // Si le visiteur n'existe pas, on le crée directement
            if (!$visitor) {
                Visitor::create([
                    'ip_address' => $ip,
                    'uuid_activity' => $request->uuid_activity,
                    'product_uuid' => $request->product_uuid,
                    'reseau_uuid' => $request->reseau_uuid,
                    'prodformule_uuid' => $request->prodformule_uuid,
                    'page_visited' => $request->page_visited
                ]);
            }
            // Si le visiteur existe, on vérifie les changements et la date
            // elseif ($visitor->created_at->format('Y-m-d') != $dateToday) {
            //     $fields = ['uuid_activity', 'product_uuid', 'reseau_uuid', 'prodformule_uuid', 'page_visited'];

            //     foreach ($fields as $field) {
            //         if ($request->filled($field) && $visitor->$field != $request->$field) {
            //             $reseau_uuid = $field === 'reseau_uuid' ? $request->$field : null;
            //             Visitor::create([
            //                 'ip_address' => $ip,
            //                 'uuid_activity' => $field === 'uuid_activity' ? $request->$field : null,
            //                 'product_uuid' => $field === 'product_uuid' ? $request->$field : null,
            //                 'reseau_uuid' => ($field === 'page_visited' && $request->$field == 'Nos produits') ? null : $reseau_uuid,
            //                 'prodformule_uuid' => $field === 'prodformule_uuid' ? $request->$field : null,
            //                 'page_visited' => $field === 'page_visited' ? $request->$field : null,
            //             ]);
            //             break; // On s'arrête après la première insertion
            //         }
            //     }
            // }
            // elseif ($visitor->created_at->format('Y-m-d') != $dateToday) {
            //     $fields = ['uuid_activity', 'product_uuid', 'reseau_uuid', 'prodformule_uuid', 'page_visited'];
                
            //     foreach ($fields as $field) {
            //         if ($request->filled($field) && $visitor->$field != $request->$field) {
            //             // $reseau_uuid = ($field === 'reseau_uuid' || ($field === 'page_visited' && $request->$field == 'Nos produits' && $request->filled('reseau_uuid'))) 
            //             //     ? $request->reseau_uuid 
            //             //     : null; 
            //             if ($field === 'page_visited' && ($request->filled('page_visited') != "" || $request->$request->filled('page_visited')  != null) && $request->filled('page_visited') == 'Nos produits') {
            //                 Visitor::create([
            //                     'ip_address' => $ip,
            //                     'uuid_activity' => $field === 'uuid_activity' ? $request->$field : null,
            //                     'product_uuid' => $field === 'product_uuid' ? $request->$field : null,
            //                     'reseau_uuid' => null,
            //                     'prodformule_uuid' => $field === 'prodformule_uuid' ? $request->$field : null,
            //                     'page_visited' => $field === 'page_visited' ? $request->$field : null,
            //                 ]);
            //                 break; // On s'arrête après la première insertion
            //             }elseif($field === 'reseau_uuid') {
            //                 Visitor::create([
            //                     'ip_address' => $ip,
            //                     'uuid_activity' => $field === 'uuid_activity' ? $request->$field : null,
            //                     'product_uuid' => $field === 'product_uuid' ? $request->$field : null,
            //                     'reseau_uuid' => $field === 'reseau_uuid' ? $request->$field : null,
            //                     'prodformule_uuid' => $field === 'prodformule_uuid' ? $request->$field : null,
            //                     'page_visited' => null,
            //                 ]);
            //             }
            //             else{
            //                 Visitor::create([
            //                     'ip_address' => $ip,
            //                     'uuid_activity' => $field === 'uuid_activity' ? $request->$field : null,
            //                     'product_uuid' => $field === 'product_uuid' ? $request->$field : null,
            //                     'reseau_uuid' => $field === 'reseau_uuid' ? $request->$field : null,
            //                     'prodformule_uuid' => $field === 'prodformule_uuid' ? $request->$field : null,
            //                     'page_visited' => $field === 'page_visited' ? $request->$field : null,
            //                 ]);
            //             }
                        
            //         }
            //     }
            // }
            
            
            // // Deuxième insertion            
            elseif ($visitor->created_at->format('Y-m-d') != $dateToday) {
                $fields = ['uuid_activity', 'product_uuid', 'reseau_uuid', 'prodformule_uuid', 'page_visited'];
                $newVisitorData = ['ip_address' => $ip];
            
                $hasChanges = false;
            
                foreach ($fields as $field) {
                    if ($request->filled($field) && (!isset($visitor->$field) || $visitor->$field != $request->$field)) {
                        $newVisitorData[$field] = $request->$field;
                        $hasChanges = true;
                    }
                }
            
                if ($hasChanges) {
                    Visitor::create($newVisitorData);
                }
            }
            

            DB::commit();
            return response()->json(['message' => 'Modification effectuée avec succès.']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

//     public function visitedByCustomer(Request $request)
// {
//     $ip = $request->ip();
//     $dateToday = Carbon::now()->format('Y-m-d');

//     DB::beginTransaction();
//     try {
//         // Vérifier si l'utilisateur a déjà visité cette actualité ou ce produit aujourd'hui
//         $visitor = Visitor::where('ip_address', $ip)
//             ->whereDate('created_at', $dateToday)
//             ->where(function ($query) use ($request) {
//                 $query->where('uuid_activity', $request->uuid_activity)
//                       ->orWhere('product_uuid', $request->product_uuid)
//                       ->orWhere('reseau_uuid', $request->reseau_uuid)
//                       ->orWhere('prodformule_uuid', $request->prodformule_uuid);
//             })->exists();

//         // Si aucune visite trouvée, on enregistre une nouvelle visite
//         if (!$visitor) {
//             Visitor::create([
//                 'ip_address' => $ip,
//                 'uuid_activity' => $request->uuid_activity,
//                 'product_uuid' => $request->product_uuid,
//                 'reseau_uuid' => $request->reseau_uuid,
//                 'prodformule_uuid' => $request->prodformule_uuid,
//             ]);
//         }

//         DB::commit();
//         return response()->json(['message' => 'Modification effectuée avec succès.']);
//     } catch (\Throwable $th) {
//         DB::rollback();
//         return response()->json(['error' => $th->getMessage()], 500);
//     }
// }
}
