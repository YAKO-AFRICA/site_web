<?php

namespace App\Http\Controllers\Admin;

use App\Models\Membre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = Membre::where(['typ_membre'=> 2, 'branche' => 'COM'])->get();
        return view('admins.pages.agents.index', compact('agents'));
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
    DB::beginTransaction();
    try {
        $saving = Membre::create([
            'uuid' => $uuid,
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
