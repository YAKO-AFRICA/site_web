<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblTypePrestation extends Model
{
    use HasFactory;
    protected $connection = 'mysql3';
    protected $fillable = [
        'libelle',
        'description',
        'impact',
        'etat',
        
    ];
}