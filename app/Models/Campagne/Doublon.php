<?php

namespace App\Models\Campagne;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doublon extends Model
{
    use HasFactory;
    protected $connection = 'mysql4';
    protected $table = 'doublons';
    protected $fillable = [
        'personne_unique_id', 
        'import_client_id', 
        'nom', 
        'prenoms', 
        'naissance_souscripteur', 
        'contact1', 
        'contact2', 
        'mail', 
        'numero_contrat', 
        'code_personne', 
        'code_produit', 
        'produit', 
        'canal', 
        'prime', 
        'date_premier_encaissement', 
        
        ];
    protected $casts = [
        'import_client_id' => 'integer', 
        'naissance_souscripteur' => 'date',
    ];
}
