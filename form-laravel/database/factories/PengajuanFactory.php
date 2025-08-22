<?php

namespace Database\Factories;
use App\Models\Pengajuan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengajuanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Pengajuan::class;

    public function definition()
    {
        return [
            'proyek'    => $this->faker->sentence(3),
            'penawaran' => $this->faker->numberBetween(1000000, 10000000),
            'pesan'     => $this->faker->optional()->paragraph(1),
            'durasi'    => $this->faker->numberBetween(1, 60), 
            'created_at'=> now(),
            'updated_at'=> now(),
        ];
    }
}
