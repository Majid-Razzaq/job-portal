<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->name,
            'user_id' => rand(1,3), // this is because user table has three users
            'job_type_id' => rand(1,5), // it will get random numbers. We can match with data like there are 5 category name each column name has unique id
            'category_id' => rand(1,5),
            'vacancy' => rand(1,5),
            'location' => fake()->city,
            'description' => fake()->text,
            'experience' => rand(1,10),
            'company_name' => fake()->name,
        ];
    }
}
