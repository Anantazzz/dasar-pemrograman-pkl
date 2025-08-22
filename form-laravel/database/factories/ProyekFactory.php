<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProyekFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         $kategori = ['Penulisan Konten', 'Desain Grafis', 'Pengembangan Web'];
         $lokasi = ['onsite', 'remote'];

        return [
            'detail' => $this->faker->sentence(4), 
            'deskripsi' => $this->faker->paragraph(3),
            'kategori' => $this->faker->randomElement($kategori),
            'anggaran' => $this->faker->numberBetween(500000, 20000000), 
            'batas_akhir' => $this->faker->dateTimeBetween('+1 week', '+2 months'),
            'lampiran' => $this->faker->optional()->lexify('lampiran-????.pdf'),
            'lokasi_pengerjaan' => $this->faker->randomElement($lokasi),
        ];
    }
}
