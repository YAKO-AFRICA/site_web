<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TblCreationCompte extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'tbl_creation_comptes';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [
        'id',
        'nom',
        'prenom',
        'email',
        'cel',
        'login',
        'password',
        'estClient',
        'estnotifie',
        'estnotifieLe',
        'idCustomer',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'idCustomer', 'id');
    }
}