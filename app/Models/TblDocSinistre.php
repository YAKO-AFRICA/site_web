<?php

namespace App\Models;

use App\Models\TblSinistre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblDocSinistre extends Model
{
    use HasFactory;
    protected $connection = 'mysql3';
    protected $table = 'tbl_doc_sinistres';
    protected $fillable = [
        'idSinistre',
        'libelle',
        'filename',
        'path',
    ];
    public function sinistre()
    {
        return $this->belongsTo(TblSinistre::class, 'idSinistre', 'id');
    }
}
