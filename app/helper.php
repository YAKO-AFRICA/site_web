<?php
function Refgenerate($table,$init,$key)
{
    $latest = $table::latest()->first();
    if (! $latest) {
        return $init.'-00001';
    }

    $string = preg_replace("/[^0-9\.]/", '', $latest->$key);

    return $init.'-' . sprintf('%05d',$string+1);
}

function RefgenerateCode($table, $init, $key)
{
    $latest = $table::orderBy('idrdv', 'desc')->first();
    if (!$latest) {
        $code = $init . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3)) . rand(10, 99);
        return $code;
    }

    $string = preg_replace("/[^0-9\.]/", '', $latest->$key);
    $code = $init . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3)) . rand(10, 99);
    return $code;
} 
function RefgenerateCodePrest($table, $init, $key)
{
    $latest = $table::orderBy('id', 'desc')->first();
    if (!$latest) {
        $code = $init . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3)) . rand(10, 99);
        return $code;
    }

    $string = preg_replace("/[^0-9\.]/", '', $latest->$key);
    $code = $init . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3)) . rand(10, 99);
    return $code;
} 
function RefgenerateCodeDemandeCompte($table, $init, $key)
{
    $latest = $table::orderBy('idTblDemandeCompte', 'desc')->first();
    if (!$latest) {
        $code = $init . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3)) . rand(10, 99);
        return $code;
    }

    $string = preg_replace("/[^0-9\.]/", '', $latest->$key);
    $code = $init . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3)) . rand(10, 99);
    return $code;
} 

function RefgenerateOTP($table, $key)
{
    $latest = $table::orderBy('id', 'desc')->first();
    if (!$latest) {
        $code = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
        return $code;
    }

    $string = preg_replace("/[^0-9\.]/", '', $latest->$key);
    $code = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

    
    return $code;
}
// // Vérifier si le code généré est déjà stocké dans la base de données avec un used=0
// $existingCode = $table::where('code', $code)->where('used', 0)->first();
// if ($existingCode) {
//     // Si le code existe déjà, on le remet dans les possibilités pour être regénéré
//     $code = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
// }