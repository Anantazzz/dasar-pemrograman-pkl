<?php

namespace Database\Seeders;
use App\Models\Proyek;
use Illuminate\Database\Seeder;

class ProyekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Proyek::factory()->count(10)->create();
    }
}
