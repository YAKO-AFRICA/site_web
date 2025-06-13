<?php

namespace App\Models;

use App\Models\Actuality;
use App\Models\Souscription;
use App\Models\FormuleProduit;
use App\Models\ReseauDistribution;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
     // Spécifiez la connexion à utiliser
     protected $connection = 'mysql';
     
    protected $fillable = [
        'uuid', 
        'code', 
        'label',
        'product_image',
        'video_url',
        'description',
        'etat',
        'numEnregist'
    ];

    public function reseaux()
    {
        return $this->belongsToMany(ReseauDistribution::class, 'product_by_reseaus', 'product_uuid', 'reseau_uuid', 'uuid', 'uuid');
    }
    
    public function formules()
    {
        return $this->hasMany(FormuleProduit::class, 'product_uuid', 'uuid');
    }

    public function actualites()
    {
        return $this->hasMany(Actuality::class, 'product_uuid', 'uuid');
    }
    public function visiteurs()
    {
        return $this->hasMany(Visitor::class, 'product_uuid', 'uuid');
    }
}