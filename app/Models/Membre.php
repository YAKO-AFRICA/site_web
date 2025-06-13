<?php

namespace App\Models;

use App\Models\TblZone;
use App\Models\TblCustomer;
use App\Models\MembreContrat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membre extends Model
{
    use HasFactory;
    // Spécifiez la connexion à utiliser
    protected $connection = 'mysql2';
    protected $table = 'membre';

    protected $fillable = [
        'idmembre', 
        'nom',
        'prenom',
        'email',
        'cel',
        'codeagent',
        'codezone',
        'ville', 
        'typ_membre', 
        'login',
        'pass',
        'activer',
        'estajour',
        'memberok',
        'date',
        'datenaissance',
        'lieunaissance',
        'lieuresidence',
        'sexe',

    ];

    // Désactiver les timestamps
    public $timestamps = false;
    protected $primaryKey = 'idmembre';
    // Relation entre Membre et TblCustomer
    public function customers()
    {
        return $this->hasMany(TblCustomer::class, 'idmembre', 'idmembre');
        // 'idmembre' distant dans TblCustomer et 'idmembre' local dans Membre
    }

    public function membreContrat()
    {
        return $this->hasMany(MembreContrat::class, 'codemembre', 'idmembre');
    }
    public function zone()
    {
        return $this->belongsTo(TblZone::class, 'codezone', 'id');
    }
}

