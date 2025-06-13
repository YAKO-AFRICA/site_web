<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tblotp extends Model
{
    use HasFactory;
    protected $connection = 'mysql3';
    protected $fillable = [
        'codeOTP',
        'used',
        'operation_type',
        'contact_method',
        'contact',
        'positionGPS',
        'otp_attempts',
    ];
}
