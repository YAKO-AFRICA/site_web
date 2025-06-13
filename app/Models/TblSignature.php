<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblSignature extends Model
{
    use HasFactory;
    protected $connection = 'mysql3';
    protected $table = 'tbl_signatures';

    protected $fillable = [
        'operation_type',
        'reference_key',
        'key_uuid',
        'email',
        'recto_path',
        'verso_path',
        'signature_path',
        'status',
    ];
}
