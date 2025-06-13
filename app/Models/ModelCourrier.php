<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ModelCourrier extends Model
{
    use HasFactory;
     // Spécifiez la connexion à utiliser
     protected $connection = 'mysql';
     
    protected $fillable = [
        'uuid',
        'user_uuid',
        'label',
        'file',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
