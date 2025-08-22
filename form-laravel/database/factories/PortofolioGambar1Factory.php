<?php

namespace Database\Factories;
use App\Models\PortofolioGambar1;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortofolioGambar1Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = PortofolioGambar1::class;

    public function definition()
    {
        return [
            'portofolio_id' => \App\Models\PortofolioSatu::factory(),
            'file_path' => $this->faker->imageUrl(640, 480, 'projects', true),
         ];
    }
}
