<?php

namespace Database\Seeders;

use Database\Seeders\Testing\DeveloperLevelsSeeder;
use Database\Seeders\Testing\DevelopersSeeder;
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
        if (env('APP_ENV') == 'testing') {
            $this->call(DeveloperLevelsSeeder::class);
            $this->call(DevelopersSeeder::class);
        }
    }
}
