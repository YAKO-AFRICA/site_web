<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblMaladie extends Model
{
    use HasFactory;
    protected $connection = 'mysql3';
    protected $table = 'tbl_maladie';
    protected $fillable = [
        'idMaladie',
        'libelleMaladie',
    ];
    // Désactiver les timestamps
    public $timestamps = false;
    protected $primaryKey = 'idMaladie';
}
