<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Region;
use App\Models\Major;
use App\Models\Comment;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contract_type' => $this->faker->numberBetween(0, 5),
            'name' => $this->faker->name(),
            'surname' => $this->faker->name(),
            'middle_name' => 'sadasdasd',
            'birth_of_date' => $this->faker->date(),
            'email' => $this->faker->email(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'passport_series' => $this->faker->randomLetter(),
            'passport_number' => $this->faker->randomAscii(),
            'PIN' => $this->faker->randomAscii(),
            'authority' => $this->faker->text(),
            'gender' => $this->faker->numberBetween(0, 3),
            'discount' => 0,
            'percent' => null,
            'discount_from' => null,
            'discount_to' => null,
            'super_contract' => 1,
            'super_contract_sum' => $this->faker->randomNumber(),
            'passport_document' => '-',
            'IELTS_document' => '-',
            'status' => $this->faker->numberBetween(0, 4),

            'region_id' => Region::factory()->create()->id,
            'major_id' => Major::factory()->create()->id,
            'comment_id' => Comment::factory()->create()->id,
        ];
    }
}
