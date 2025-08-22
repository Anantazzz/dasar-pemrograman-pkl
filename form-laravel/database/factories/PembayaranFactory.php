<?php

namespace Database\Factories;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class PembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Pembayaran::class;

    public function definition()
    {
         $metode = ['Transfer', 'Tunai'];

        return [
            'proyek' => $this->faker->sentence(3),
            'jumlah' => $this->faker->numberBetween(1000000, 10000000),
            'metode' => $this->faker->randomElement($metode),
            'setuju' => $this->faker->numberBetween(0,1),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
