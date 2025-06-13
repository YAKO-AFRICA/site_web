<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ReseauDistribution;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// class ProductByReseau extends Model
// {
//     use HasFactory;
//     protected $fillable = [
//         'uuid',
//         'reseau_uuid', 
//         'product_uuid', 
//         'etat'
//     ];

//     public function reseau(){
//         return $this->belongsTo(ReseauDistribution::class, 'reseau_uuid','uuid');
//     }

//     public function product(){
//         return $this->hasMany(Product::class, 'product_uuid', 'uuid');
//     }
// }

class ProductByReseau extends Model
{
    use HasFactory;
     // Spécifiez la connexion à utiliser
     protected $connection = 'mysql';
     
    protected $fillable = [
        'uuid',
        'reseau_uuid', 
        'product_uuid', 
        'etat'
    ];

    public function reseau(){
        return $this->belongsTo(ReseauDistribution::class, 'reseau_uuid', 'uuid');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_uuid', 'uuid');
    }
}
