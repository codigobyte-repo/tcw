<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Diseño gráfico',
                'slug' => Str::slug('Diseño gráfico'),
                'icon' => '<i class="fas fa-highlighter"></i>',
            ],
            [
                'name' => 'Programación y tecnología',
                'slug' => Str::slug('Programación y tecnología'),
                'icon' => '<i class="fas fa-laptop-code"></i>',
            ],
            [
                'name' => 'Bases de datos',
                'slug' => Str::slug('Bases de datos'),
                'icon' => '<i class="fas fa-database"></i>',
            ],
            [
                'name' => 'Marketing digital',
                'slug' => Str::slug('Marketing digital'),
                'icon' => '<i class="fas fa-bullhorn"></i>',
            ],
            [
                'name' => 'Video y animación',
                'slug' => Str::slug('Video y animación'),
                'icon' => '<i class="fas fa-photo-video"></i>',
            ],
            [
                'name' => 'Negocios y finanzas',
                'slug' => Str::slug('Negocios y finanzas'),
                'icon' => '<i class="fas fa-money-check-alt"></i>',
            ],
        ];

        foreach($categories as $category) {
            $category = Category::factory(1)->create($category)->first();
            
            $brands = Brand::factory(4)->create();

            foreach ($brands as $brand) {
                $brand->categories()->attach($category->id);
            }
        }
    }
}
