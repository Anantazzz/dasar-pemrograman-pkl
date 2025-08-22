<?php

namespace Database\Seeders;
use App\Models\Management;
use Illuminate\Database\Seeder;

class ManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Management::factory()->count(10)->create();
    }
}
