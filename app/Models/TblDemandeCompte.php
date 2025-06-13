<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblDemandeCompte extends Model
{
    use HasFactory;
    protected $connection = 'mysql3';
    protected $table = 'tbldemandecompte';
    protected $primaryKey = 'idTblDemandeCompte';
    public $timestamps = false;
    protected $fillable = [
        'idTblDemandeCompte',
        'nomDemandeur',
        'prenomDemandeur',
        'tel1Demandeur',
        'tel2Demandeur',
        'dateNaissanceDemandeur',
        'mailDemandeur',
        'resumeDemandeur',
        'dateDemande',
        'statutDemandeur',
        'produitDemandeur',
        'statutDemande',
        'dateTraitementDemande',
        'observations',
        'conditions',
        'idmembre',
        'idcontrat',
        'refDemande',
        'refcontratDemandeur',
        'typeDemande'
    ];
}