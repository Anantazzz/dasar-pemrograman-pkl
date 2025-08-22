<?php

namespace Database\Factories;
use App\Models\Management;
use Illuminate\Database\Eloquent\Factories\Factory;

class ManagementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Management::class;

    public function definition()
    {
        $status = ['Belum Mulai', 'Dalam Proses', 'Selesai'];

        return [
            'judul_tugas'    => $this->faker->sentence(4),
            'deskripsi_tugas'=> $this->faker->paragraph(1),
            'batas_akhir'    => $this->faker->dateTimeBetween('now', '+2 months'),
            'status'         => $this->faker->randomElement($status),
            'progress'       => $this->faker->numberBetween(0, 100),
            'created_at'     => now(),
            'updated_at'     => now(),
        ];
    }
}
