<?php

namespace Database\Factories;

use App\Models\FromWhereList;
use App\Models\Industry;
use Illuminate\Database\Eloquent\Factories\Factory;

class LandingPageContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $x = $this->faker->randomElement(landingPageTypes());
        if ($x == "action") {
            $data = [
                'name' => $this->faker->name(),
                'nationality' => $this->faker->randomElement(["Egyptian", "Emirati", "Saudi Arabian", "American", "British", "English"]),
                'phone_number' => $this->faker->phoneNumber(),
                'email' => $this->faker->email(),
                'profession' => $this->faker->jobTitle(),
                'type' => $x,
                'industry_id' => Industry::all()->random()->id,
                'from_where_id' => FromWhereList::all()->random()->id,
            ];
        } else {
            $data = [
                'name' => $this->faker->name(),
                'nationality' => $this->faker->randomElement(["Egyptian", "Emirati", "Saudi Arabian", "American", "British", "English"]),
                'phone_number' => $this->faker->phoneNumber(),
                'email' => $this->faker->email(),
                'profession' => $this->faker->jobTitle(),
                'type' => $x,
            ];
        }
        return $data;
    }
}
