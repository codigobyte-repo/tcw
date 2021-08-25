<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');

        Storage::deleteDirectory('categories');
        Storage::makeDirectory('categories');

        Storage::deleteDirectory('subcategories');
        Storage::makeDirectory('subcategories');

        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);
        Tag::factory(8)->create();
        $this->call(PostSeeder::class);
        
    }
}
