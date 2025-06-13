<?php

namespace App\Models;

use App\Models\TblPrestation;
use App\Models\TblMotifrejetprestation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblMotifrejetbyprestat extends Model
{
    use HasFactory;
    protected $connection = 'mysql3';
    // protected $table = 'tbl_motifrejetbypresta';

    protected $fillable = [
        'codeprestation',
        'codemotif',
    ];
    public function prestation()
    {
        return $this->belongsTo(TblPrestation::class, 'codeprestation', 'code');
    }
    public function motif()
    {
        return $this->belongsTo(TblMotifrejetprestation::class, 'codemotif', 'code');
    }
}
