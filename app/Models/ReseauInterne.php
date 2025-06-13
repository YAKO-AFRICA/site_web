<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReseauInterne extends Model
{
    use HasFactory;
     // Spécifiez la connexion à utiliser
     protected $connection = 'mysql';
     
    protected $fillable = [
        'uuid',
        'code',
        'user_uuid',
        'label',
        'ville',
        'email',
        'telephone1',
        'telephone2',
        'image',
        'longitude',
        'latitude',
        'description',
        'type',
        'etat',
        'update_user_uuid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}