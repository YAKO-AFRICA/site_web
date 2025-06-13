<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductByReseau;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// class ReseauDistribution extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'uuid', 
//         'code', 
//         'label',
//         'image',
//         'description',
//         'etat'
//     ];

//     public function products()
//     {
//         return $this->hasMany(ProductByReseau::class, 'reseau_uuid', 'uuid');
//     }
// }

class ReseauDistribution extends Model
{
    use HasFactory;
    // Spécifiez la connexion à utiliser
    protected $connection = 'mysql';

    protected $fillable = [
        'uuid', 
        'code', 
        'label',
        'image',
        'description',
        'etat'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_by_reseaus', 'reseau_uuid', 'product_uuid', 'uuid', 'uuid')->wherePivot('etat', 'Actif');;
    }

    public function formule()
    {
        return $this->hasMany(FormuleProduit::class, 'reseau_uuid', 'uuid');
    }

    public function visiteurs()
    {
        return $this->hasMany(Visitor::class, 'reseau_uuid', 'uuid');
    }
}
