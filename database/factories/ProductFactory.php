<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'discription' => $this->faker->text,
            'price' => $this->faker->randomFloat,
            'category_id' => $this->faker->numberBetween(1,100),
            'image' => $this->faker->imageUrl
        ];
    }
}
