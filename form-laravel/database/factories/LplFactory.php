<?php

namespace Database\Factories;
use App\Models\Lpl;
use App\Models\PortofolioSatu;
use Illuminate\Database\Eloquent\Factories\Factory;

class LplFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Lpl::class;

    public function definition()
    {
        return [
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
            'terbuka_klien' => $this->faker->boolean(),
            'layanan' => json_encode($this->faker->randomElements(
                ['Konsultasi','Maintenance','Pelatihan'], rand(1,3)
            )),
            'setuju' => $this->faker->boolean(),
        ];
    }
}
