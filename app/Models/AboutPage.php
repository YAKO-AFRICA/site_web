<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use HasFactory;
     // Spécifiez la connexion à utiliser
     protected $connection = 'mysql';
     
    protected $fillable = [
        'uuid',
        'title',
        'nomPCA',
        'content',
        'image',
        'section',
        'update_user_uuid'
    ];

    public function updateUser()
    {
        return $this->belongsTo(User::class, 'update_user_uuid', 'uuid');
    }


}