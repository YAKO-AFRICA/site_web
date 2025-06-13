<?php

namespace App\Models;

use App\Models\TblProductPrestation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblProduit extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'tblproduit';

    protected $fillable = [
        'CodeProduit',
        'MonLibelle',
        'DateProduit',
        'CodeBranche',
        'CodeProduitNature',
        'CodeDocument',
        'CodeTxTech',
        'Statut',
        'CodeGroupeAssure',
        'CodeGroupeProfil',
        'AgeMiniAdh',
        'AgeMaxiAdh',
        'TableTarification',
        'TableReglementaire',
        'TableFiscale',
        'TableComptable',
        'CodeContractant',
        'NumSeq',
        'DelaiCarrence',
        'CapitalAssurePMOK',
        'CapitalassureVersExcpOK',
        'CodeBrancheDeux',
        'TypeContrat',
        'Capital',
        'CodeProduitCourt',
        'ID_Old',
        'DureeSouscriptionAnnee',
        'DureeSouscriptionMois',
        'VieEntiere',
        'DureeCotisationAns',
        'DureeCotisationMois',
        'CodeMarque',
    ];

    public function typePrestations()
    {
        return $this->hasMany(TblProductPrestation::class, 'product_id', 'CodeProduit');
        // return $this->belongsToMany(TblTypePrestation::class, 'tbl_product_prestations', 'product_id', 'prestation_id');
    }
}
