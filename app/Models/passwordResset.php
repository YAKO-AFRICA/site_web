<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class passwordResset extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'password_resets';
    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];

    public $timestamps = false;
    public function customer(){
        return $this->belongsTo(TblCustomer::class, 'login', 'email');
    }
}
