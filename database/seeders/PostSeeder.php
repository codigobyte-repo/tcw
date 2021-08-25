<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use App\Models\Review;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::factory(300)->create();

        foreach($posts as $post) {

            Review::factory(5)->create([
                'post_id' => $post->id
            ]);

            Image::factory(4)->create([
                'imageable_id' => $post->id,
                'imageable_type' => Post::class
            ]);
            $post->tags()->attach([
                rand(1, 4),
                rand(5, 8)
            ]);
        }
    }
}
