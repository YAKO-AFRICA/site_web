<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Temoignage;
use Illuminate\Support\Str;

class TemoignageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        $Temoignages = [
            [
                'uuid' => Str::uuid(),
                'nom' => 'KOFFI Koffi F.',
                'fonction' => 'Client de YAKO AFRICA',
                'contenu' => " “ je suis client de Yako Africa depuis 10 ans. J'avais d'abord souscrit à un contrat Yako obsèques pour ma mère. Quand elle a été rappelé à Dieu, tout s'est bien passé, j'ai reçu mon chèque et j'ai pu organiser des funérailles dignes pour ma mère. Suite à cela, J’ai pris un Yako obsèques pour ma tante et j´ai souscrit à une épargne pour ma retraite.",
            ],
            [
                'uuid' => Str::uuid(),
                'nom' => 'Donec sollicit',
                'fonction' => 'Donec neque',
                'contenu' => "Ut vel urna et neque ornare scelerisque. Donec sollicitudin, mauris a facilisis tristique, ligula massa consectetur odio, at ultricies est neque vel Ut vel urna et neque ornare scelerisque. Donec sollicitudin, mauris a facilisis tristique, ligula massa consectetur odio, at ultricies est neque vel",
            ],
        ];

        // Ajouter les données dans la base de données en utilisant la méthode create() de la classe Temoignage
        foreach ($Temoignages as $key => $Temoignage) {
            Temoignage::create($Temoignage);
        }
    }
}
