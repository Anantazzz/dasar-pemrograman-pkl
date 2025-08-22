<?php

namespace Database\Factories;
use App\Models\Ulasan;
use Illuminate\Database\Eloquent\Factories\Factory;

class UlasanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Ulasan::class;

    public function definition()
    {
        return [
            'rating'    => $this->faker->optional()->numberBetween(1, 5),
            'ulasan'    => $this->faker->optional()->paragraph(1),
            'created_at'=> now(),
            'updated_at'=> now(),
        ];
    }
}
