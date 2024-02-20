<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Participant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         Participant::factory(100)->create();
         Location::factory(50)->create();
    }
}
