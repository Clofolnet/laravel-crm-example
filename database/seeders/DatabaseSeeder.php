<?php

namespace Database\Seeders;

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
        $this->call(CommentSeeder::class);
        $this->call(MajorSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(StudentSeeder::class);
    }
}
