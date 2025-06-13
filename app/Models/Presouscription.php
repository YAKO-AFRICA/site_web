<?php

namespace App\Models;

use App\Models\User;
use App\Models\FormuleProduit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presouscription extends Model
{
    use HasFactory;
     // Spécifiez la connexion à utiliser
     protected $connection = 'mysql';
     
    protected $fillable = [
        'uuid', 
        'code', 
        'product_uuid', 
        'customer_firstname',
        'customer_lastname', 
        'customer_civility', 
        'customer_assure', 
        'customer_birthday', 
        'assure_birthday', 
        'customer_placebirth', 
        'customer_job',
        'customer_residence', 
        'customer_email', 
        'customer_phone', 
        'customer_whatsapp', 
        'object',
        'content', 
        'etat', 
        'status', 
        'type', 
        'update_status_user_uuid',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'update_status_user_uuid', 'uuid');
    }

    public function formul_product()
    {
        return $this->belongsTo(FormuleProduit::class, 'product_uuid', 'uuid');
    }
}
