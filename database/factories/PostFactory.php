<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->sentence();

        $subcategory = Subcategory::all()->random();

        $category = $subcategory->category;

        $brands = $category->brands->random(); 

        $precio = $this->faker->randomElement([19.99, 49.99, 99.99]);

        $commission = 8;

        $fee = $precio * $commission / 100;

        $precio_total = $precio + $fee;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(2000),
            'tiempo_entrega' => $this->faker->randomElement([1, 30]),
            'price' => $precio,
            'commission' => $commission,
            'fee' => $fee,
            'price_total' => $precio_total,
            'status' => $this->faker->randomElement([1, 2]),
            'subcategory_id' => $subcategory,
            'brand_id' => $brands->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
