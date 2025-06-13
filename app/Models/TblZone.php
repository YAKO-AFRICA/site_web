<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblZone extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'tblzone';

    protected $primaryKey = 'id';
    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'codezone',
        'codereseau',
        'libellezone',
        'coderesponsable',
        'nomresponsable',
    ];
}
