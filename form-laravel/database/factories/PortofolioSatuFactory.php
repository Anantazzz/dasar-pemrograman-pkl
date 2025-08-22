<?php

namespace Database\Factories;
use App\Models\PortofolioSatu;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortofolioSatuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    
    protected $model = PortofolioSatu::class;

    public function definition()
    {
        return [
            'judul_portofolio' => $this->faker->sentence(3),
            'ringkasan'        => $this->faker->paragraph(),
            'keahlian'         => json_encode(
                $this->faker->randomElements(
                    ['Pengembangan Aplikasi Mobile','Penulisan Konten','Pemasaran Digital','Desain UI/UX','SEO'],
                    rand(1,3)
                )
            ),
            'warna_tema'       => $this->faker->safeHexColor(),
        ];
    }
}
