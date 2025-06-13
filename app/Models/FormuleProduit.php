<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Presouscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormuleProduit extends Model
{
    use HasFactory;
     // Spécifiez la connexion à utiliser
     protected $connection = 'mysql';
     
    protected $fillable = [
        'uuid', 
        'code', 
        'label',
        'formul_image',
        'video_url',
        'reseau_uuid',
        'product_uuid',
        'description',
        'etat',
        'brochure'

    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_uuid', 'uuid');
    }
    
    public function reseau()
    {
        return $this->belongsTo(ReseauDistribution::class, 'reseau_uuid', 'uuid');
    }

    public function presouscription()
    {
        return $this->hasMany(Presouscription::class, 'product_uuid', 'uuid');
    }

    public function visiteurs()
    {
        return $this->hasMany(Visitor::class, 'prodformule_uuid', 'uuid');
    }
}
