<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblVille extends Model
{
    use HasFactory;
    protected $connection = 'mysql3';
    protected $table = 'tbl_ville';
    protected $fillable = [
        'idville',
        'libelleVillle'
    ];
    // Désactiver les timestamps
    public $timestamps = false;
    protected $primaryKey = 'idville';
}
