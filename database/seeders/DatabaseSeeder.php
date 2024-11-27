<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // database/seeders/DatabaseSeeder.php

public function run()
{
    \App\Models\Genre::factory(10)->create();
    \App\Models\Film::factory(50)->create();
    \App\Models\Customer::factory(100)->create();
}
}
