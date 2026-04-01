<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblBordereauRdv extends Model
{
    use HasFactory;
    protected $connection = 'mysql3';
    protected $table = 'tbl_bordereau_rdv';

    protected $fillable = [
        'id',
        'reference',
        'id_villes',
        'villes',
        'id_gestionnaire',
        'gestionnaire',
        'periode_1',
        'periode_2',
        'observation',
        'etat',
        'id_users',
        'auteur',
        'created_at',
    ];


    // Désactiver les timestamps
    public $timestamps = false;
    protected $primaryKey = 'id';
}