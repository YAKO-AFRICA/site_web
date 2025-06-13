<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\TeamYako;
use App\Models\AboutPage;
use App\Models\Actuality;
use App\Models\Temoignage;
use App\Models\ModelCourrier;
use App\Models\ReseauInterne;
use App\Models\Presouscription;
use Laravel\Sanctum\HasApiTokens;

use App\Models\ReseauDistribution;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
     // Spécifiez la connexion à utiliser
    protected $connection = 'mysql';
    protected $guard = 'web';
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'type',
        'fonction',
        'role_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    // public function roles()

    public function actualites()
    {
        return $this->hasMany(Actuality::class, 'user_uuid', 'uuid');
    }
    
    public function presouscription()
    {
        return $this->hasMany(Presouscription::class, 'update_status_user_uuid', 'uuid');
    }

    public function aboutPage()
    {
        return $this->hasMany(AboutPage::class, 'update_user_uuid', 'uuid');
    }
    
    public function teamYako()
    {
        return $this->hasMany(TeamYako::class, 'user_uuid', 'uuid');
    }

    public function reseauInterne()
    {
        return $this->hasMany(ReseauInterne::class, 'user_uuid', 'uuid');
    }
    public function Courrier()
    {
        return $this->hasMany(ModelCourrier::class, 'user_uuid', 'uuid');
    }

    public function temoignage()
    {
        return $this->hasMany(Temoignage::class, 'user_uuid', 'uuid');
    }
}