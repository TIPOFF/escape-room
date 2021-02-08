<?php namespace Tipoff\EscapeRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = app('participant');

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'   => randomOrCreate(app('user')),
            'email'     => $this->faker->unique()->safeEmail,
            'name'      => $this->faker->firstName,
            'name_last' => $this->faker->lastName,
            'dob'       => $this->faker->date('Y-m-d', '-18 years')
        ];
    }
}
