<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;
     // Spécifiez la connexion à utiliser
     protected $connection = 'mysql';
     
    protected $fillable = [
        'uuid',
        'actuality_uuid',
        'image_url',
        'etat',
    ];
    public function actuality()
    {
        return $this->belongsTo(Actuality::class, 'actuality_uuid', 'uuid');
    }
}