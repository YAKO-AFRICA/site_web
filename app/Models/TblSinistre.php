<?php

namespace App\Models;

use App\Models\TblDocSinistre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblSinistre extends Model
{
    use HasFactory;
    protected $connection = 'mysql3';
    protected $table = 'tbl_sinistres';
    protected $fillable = [
        'code',
        'nomDecalarant',
        'idcontrat',
        'prenomDecalarant',
        'datenaissanceDecalarant',
        'lieunaissanceDecalarant',
        'filiation',
        'lieuresidenceDecalarant',
        'celDecalarant',
        'emailDecalarant',
        'genreAssuree',
        'nomAssuree',
        'prenomAssuree',
        'datenaissanceAssuree',
        'lieunaissanceAssuree',
        'professionAssuree',
        'lieuresidenceAssuree',
        'natureSinistre',
        'decesAccidentel',
        'declarationTardive',
        'dateSinistre',
        'causeSinistre',
        'lieuConservation',
        'montantBON',
        'dateLevee',
        'lieuLevee',
        'dateInhumation',
        'lieuInhumation',
        'codeAssuree',
        'moyenPaiement',
        'Operateur',
        'telPaiement',
        'codebanque',
        'codeagence',
        'numcompte',
        'clerib',
        'IBAN',
        'saisiepar',
        'traiterpar',
        'villedeclaration',
        'observationtraitement',
        'estMigree',
        'etape',
        'envoimail',
        'mailtraitement',
        'etat',
    ];
    public function docSinistre()
    {
        return $this->hasMany(TblDocSinistre::class, 'idSinistre', 'id');
    }

}
