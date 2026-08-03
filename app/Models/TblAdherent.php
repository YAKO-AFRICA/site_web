<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblAdherent extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'tbladherent';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'situationMatrimoniale',
        'civilite',
        'nom',
        'prenom',
        'datenaissance',
        'lieunaissance',
        'estmigre',
        'sexe',
        'numeropiece',
        'naturepiece',
        'lieuresidence',
        'profession',
        'employeur',
        'email',
        'mobile',
        'mobile1',
        'telephone',
        'typeNumMSpecial',
        'numSpecial',
        'pays',
        'bp',
        'telephone1',
        'codemembre',
        'saisieLe',
        'saisiepar',
        'refcontratsource',
        'cleintegration',
        'id_maj',
        'connexe',
        'contratconnexe',
        'capitalconnexe',
    ];
}
