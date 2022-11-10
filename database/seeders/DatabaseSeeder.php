<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Traits\ReferenceTrait;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    use ReferenceTrait;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\File::factory()->create();


    }
}
