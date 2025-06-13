<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admins.users.index', compact('users', 'roles'));
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
            $password = $request->password;
            $confirm_password = $request->confirm_password;

            if ($password != $confirm_password) {
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Les mots de passe ne correspondent pas! Veuillez verifier!",
                    'code' => 500,
                ];
            } else {
                $uuid = Str::uuid();
                $user = User::create([
                    'uuid' => $uuid,
                    'name' => $request->name,
                    'email' => $request->email,
                    'role_id' => $request->role_id,
                    'password' => bcrypt($password),
                ]);

                $role = Role::find($request->role_id);
                $user->assignRole($role);
                $user->syncRoles([$role->id]);
                

                if ($user) {
                    
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
        DB::beginTransaction();
        try {
            $user = User::find($uuid);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->save();

            $role = Role::find($request->role_id);
            $user->assignRole($role);

            $user->syncRoles([$role->id]);

            if ($user) {

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {

        $user = User::whereId($uuid)->delete();
        if ($user) {
            $dataResponse = [
                'type' => 'success',
                'urlback' => "back",
                'message' => "Supprimé avec succes!",
                'code' => 200,
            ];
        } else {
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur lors de la suppression!",
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }
}
