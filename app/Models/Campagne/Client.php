<?php

namespace App\Models\Campagne;

use App\Models\Campagne\Doublon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $connection = 'mysql4';
    protected $table = 'clients';
    protected $fillable = [
        'uuid',
        'nom',
        'prenom',
        'tel1',
        'tel2',
        'whattsapp',
        'email',
        'date_naissance',
        'type_document',
        'ref_document',
        'genre',
        'situation_matrimoniale',
        'total_contrat',
        'liste_contrats',
        'idCustomer',
        'lieunaissance',
        'lieuresidence',
        'profession',
    ];
    protected $casts = [
        'date_naissance' => 'date',
        'total_contrat' => 'integer',
        'meta' => 'array',
    ];

    public function doublons()
    {
        return $this->hasMany(Doublon::class, 'personne_unique_id', 'uuid');
    }

    /** * Conversion de liste_contrats * * Base : * ["3610915","3593104","3588765"] * * PHP : * ['3610915', '3593104', '3588765'] */ 
    public function getListeContratsAttribute($value)
    {
        if (empty($value)) {
            return [];
        }
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }
    public function setListeContratsAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['liste_contrats'] = json_encode(array_values($value), JSON_UNESCAPED_UNICODE);
        } elseif (is_string($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                $this->attributes['liste_contrats'] = json_encode(array_values($decoded), JSON_UNESCAPED_UNICODE);
            } else {
                $this->attributes['liste_contrats'] = $value;
            }
        } else {
            $this->attributes['liste_contrats'] = null;
        }
    }
    /** * Conversion de whattsapp * * Base : * ["0758817235","0150452368"] * * PHP : * ['0758817235', '0150452368'] */ 
    public function getWhattsappAttribute($value)
    {
        if (empty($value)) {
            return [];
        }
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }

    // Conversion de whattsapp
    public function setWhattsappAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['whattsapp'] = json_encode(array_values($value), JSON_UNESCAPED_UNICODE);
        } elseif (is_string($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                $this->attributes['whattsapp'] = json_encode(array_values($decoded), JSON_UNESCAPED_UNICODE);
            } else {
                $this->attributes['whattsapp'] = json_encode([$value], JSON_UNESCAPED_UNICODE);
            }
        } else {
            $this->attributes['whattsapp'] = null;
        }
    }

    /** * Mutator pour normaliser le genre. */
    public function setGenreAttribute($value)
    {
        $value = strtoupper(trim($value));
        $this->attributes['genre'] = match ($value) {
            'M', 'MALE', 'MASCULIN' => 'M',
            'F', 'FEMALE', 'FEMININ', 'FÉMININ' => 'F',
            default => null,
        };
    }

    // public function getGenreAttribute($value)
    // {
    //     return match ($value) {
    //         'Masculin' => 'M',
    //         'Feminin' => 'F',
    //         default => null,
    //     };
    // }


}
