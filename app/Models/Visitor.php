<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Actuality;
use App\Models\FormuleProduit;
use App\Models\ReseauDistribution;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visitor extends Model
{
    use HasFactory;
    // protected $connection = 'mysql';
    protected $fillable = ['ip_address','uuid_activity','product_uuid','reseau_uuid','prodformule_uuid','page_visited'];

    public function actuality(){
        return $this->belongsTo(Actuality::class, 'uuid_activity', 'uuid');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_uuid', 'uuid');
    }
    public function reseau()
    {
        return $this->belongsTo(ReseauDistribution::class, 'reseau_uuid', 'uuid');
    }
    public function formule(){
        return $this->belongsTo(FormuleProduit::class, 'prodformule_uuid', 'uuid');
    }
}

