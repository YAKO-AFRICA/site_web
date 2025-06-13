<?php

namespace App\Models;

use App\Models\Actuality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentActuality extends Model
{
    use HasFactory;
     // Spécifiez la connexion à utiliser
     protected $connection = 'mysql';
     
    protected $fillable = [
        'uuid',
        'actuality_uuid',
        'user_uuid',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_website',
        'comment',
        'status',
        'etat',
    ];

    public function actuality()
    {
        return $this->belongsTo(Actuality::class, 'actuality_uuid', 'uuid');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}