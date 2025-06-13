<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class group extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $fillable = [
        'name',
    ];
    public function permission()
    {
        return $this->hasMany(Permission::class, 'group');
    }
}
