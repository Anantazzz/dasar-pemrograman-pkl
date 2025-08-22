<?php

namespace Database\Factories;
use App\Models\PortofolioItem;
use App\Models\PortofolioSatu;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortofolioItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = PortofolioItem::class;

    public function definition()
    {
       return [
            'judul_proyek'      => $this->faker->sentence(3),
            'deskripsi_singkat' => $this->faker->sentence(10),
            'url_proyek'        => $this->faker->url(),
        ];
    }
}
