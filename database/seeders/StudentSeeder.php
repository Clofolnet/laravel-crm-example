<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Region;
use App\Models\Comment;
use App\Models\Major;
use App\Models\User;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $region = Region::factory()
            ->create();
        $major = Major::factory()
            ->create();
        $comment = Comment::factory()->for(User::factory()
        ->create(), 'author')->create();
        Student::factory()
            ->count(2)
            ->for($region)
            ->for($major)
            ->for($comment)
            ->create();
    }
}