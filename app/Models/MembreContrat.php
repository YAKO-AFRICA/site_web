<?php

namespace App\Models;

use App\Models\Membre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembreContrat extends Model
{
    use HasFactory;
    // Spécifiez la connexion à utiliser
    protected $connection = 'mysql2';
    protected $table = 'membrecontrat';

    // Désactiver les timestamps
    public $timestamps = false;
    protected $fillable = [
        'codemembre',
        'idcontrat',
    ];

    public function membre()
    {
        return $this->belongsTo(Membre::class,'codemembre', 'idmembre');
    }
}
