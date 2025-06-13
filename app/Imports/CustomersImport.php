<?php

namespace App\Imports;

use Log;
use App\Models\TblCustomer;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
         // Ignorer la première ligne (en-têtes) 
            // Si vous avez un fichier qui commence par des en-têtes, vous pouvez faire cela :
        if ($row[0] == 'idmembre' && $row[1] == 'login' && $row[2] == 'pass' && 
        $row[3] == 'activer' && $row[4] == 'estajour' && $row[5] == 'memberok') {
            return null; // Ignorer cette ligne
        }
        return new TblCustomer([ 
            'idmembre'    => $row[0] ?? null, // Utilisez null si la clé n'est pas présente
            'login'       => $row[1] ?? null,
            'password'    => $row[2] ?? '',
            'activer'     => $row[3] ?? null,
            'estajour'    => $row[4] ?? null,
            'memberok'    => $row[5] ?? null,
            'isFirstLog'=> false,
        ]);
    }
}
