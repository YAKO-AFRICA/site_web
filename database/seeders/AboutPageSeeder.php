<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use \App\Models\AboutPage;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutPages = [
            [
            'uuid' => Str::uuid(),
            'content' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate ut molestias aliquid assumenda accusamus, voluptatibus voluptas nemo molestiae voluptates, et ad vero accusantium veniam tempore inventore. Omnis voluptatem eaque temporibus?',
            'image' => 'historique.png',
           'section' => 'sectionHistorique',
        ],
        [
            'uuid' => Str::uuid(),
            'nomPCA' => 'Lorem ipsum dolor',
            'content' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate ut molestias aliquid assumenda accusamus, voluptatibus voluptas nemo molestiae voluptates, et ad vero accusantium veniam tempore inventore. Omnis voluptatem eaque temporibus?',
            'image' => 'PCA.jpg',
           'section' => 'sectionMotPCA',
        
        ],
    ];
    foreach ($aboutPages as $key => $aboutPage) {
        AboutPage::create($aboutPage);
    }
    }
}
