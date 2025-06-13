<?php

namespace App\Models;

use App\Models\TblProduit;
use App\Models\TblTypePrestation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblProductPrestation extends Model
{
    use HasFactory;
    protected $table = 'tbl_product_prestations';
    protected $connection = 'mysql3';
    protected $fillable = [
        'product_id',
        'product_type',
        'prestation_id',
    ];

    public function product()
    {
        return $this->belongsTo(TblProduit::class, 'product_id', 'CodeProduit');
    }

    public function prestation()
    {
        return $this->belongsTo(TblTypePrestation::class, 'prestation_id', 'id');
    }
}
