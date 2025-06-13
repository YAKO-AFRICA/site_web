<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamYako extends Model
{
    use HasFactory;
     // Spécifiez la connexion à utiliser
     protected $connection = 'mysql';
     
    protected $fillable = [
        'uuid',
        'user_uuid', 
        'team_name', 
        'team_fonction', 
        'team_image',
        'team_description',
        'update_user_uuid'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_uuid', 'uuid');
    }

}