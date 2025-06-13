<?php


namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TblCustomer extends Authenticatable

{
    use  HasFactory, Notifiable;
    // Spécifiez la connexion à utiliser
    protected $connection = 'mysql2';
    protected $fillable = [
        'login',
        'password',
        'activer',
        'estajour',
        'memberok',
        'idmembre',
        'isFirstLog',
        'remember_token',
        'token_expires_at'
    ];

    // Relation entre TblCustomer et Membre
    public function membre()
    {
        return $this->belongsTo(Membre::class, 'idmembre', 'idmembre'); 
        // 'idmembre' local de TblCustomer et 'idmembre' distant dans Membre
    }

}
