<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\PostImage;
use App\Models\CommentActuality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Actuality extends Model
{
    use HasFactory;

    // Spécifiez la connexion à utiliser
    protected $connection = 'mysql';

    protected $fillable = [
        'uuid',
        'user_uuid',
        'product_uuid',
        'title',
        'comment',
        'video_url',
        'citation',
        'etat',
        'update_user_uuid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_uuid', 'uuid');
    }

    public function comments()
    {
        return $this->hasMany(CommentActuality::class, 'actuality_uuid', 'uuid');
    }  
    public function postImage()
    {
        return $this->hasMany(PostImage::class, 'actuality_uuid', 'uuid');
    }

    public function visiteurs()
    {
        return $this->hasMany(Visitor::class, 'uuid_activity', 'uuid');
    }
}