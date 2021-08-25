<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = [
            /* Diseño gráfico */
            [
                'category_id' => 1,
                'name' => 'Diseño de logo',
                'slug' => Str::slug('Diseño de logo'),
            ],
            [
                'category_id' => 1,
                'name' => 'Diseño de flyers',
                'slug' => Str::slug('Diseño de flyers'),
            ],
            [
                'category_id' => 1,
                'name' => 'Tarjetas y papelería',
                'slug' => Str::slug('Tarjetas y papelería'),
            ],

            /* Programación y tecnología */
            [
                'category_id' => 2,
                'name' => 'Programación web',
                'slug' => Str::slug('Programación web'),
            ],
            [
                'category_id' => 2,
                'name' => 'Desarrollo de aplicaciones',
                'slug' => Str::slug('Desarrollo de aplicaciones'),
            ],
            [
                'category_id' => 2,
                'name' => 'Desarrollo de juegos',
                'slug' => Str::slug('Desarrollo de juegos'),
            ],
            [
                'category_id' => 2,
                'name' => 'Chatbots',
                'slug' => Str::slug('Chatbots'),
            ],
            
            /* Bases de datos */
            [
                'category_id' => 3,
                'name' => 'Base de datos',
                'slug' => Str::slug('Base de datos'),
            ],
            [
                'category_id' => 3,
                'name' => 'Análisis de datos',
                'slug' => Str::slug('Análisis de datos'),
            ],

            /* Marketing digital */
            [
                'category_id' => 4,
                'name' => 'Marketing de medios sociales',
                'slug' => Str::slug('Marketing de medios sociales'),
            ],
            [
                'category_id' => 4,
                'name' => 'Optimización SEO',
                'slug' => Str::slug('Optimización SEO'),
            ],
            [
                'category_id' => 4,
                'name' => 'Marketing de contenido',
                'slug' => Str::slug('Marketing de contenido'),
            ],
            [
                'category_id' => 4,
                'name' => 'Video de contenido',
                'slug' => Str::slug('Video de contenido'),
            ],
            
            /* Video y animación */
            [
                'category_id' => 5,
                'name' => 'Edición de video',
                'slug' => Str::slug('Edición de video'),
            ],
            [
                'category_id' => 5,
                'name' => 'Animación',
                'slug' => Str::slug('Animación'),
            ],

            /* Negocios y finanzas */
            [
                'category_id' => 6,
                'name' => 'Estrategias de ventas',
                'slug' => Str::slug('Estrategias de ventas'),
            ],
            [
                'category_id' => 6,
                'name' => 'Comercio exterior',
                'slug' => Str::slug('Comercio exterior'),
            ],
            [
                'category_id' => 6,
                'name' => 'Contador público',
                'slug' => Str::slug('Contador público'),
            ],
            [
                'category_id' => 6,
                'name' => 'Impuesto tributario',
                'slug' => Str::slug('Impuesto tributario'),
            ],


        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::factory(1)->create($subcategory);
        }
    }
}
