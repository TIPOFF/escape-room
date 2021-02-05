<?php namespace Tipoff\EscapeRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\EscapeRoom\Models\Rate;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\EscapeRoom\Models\Supervision;
use Tipoff\EscapeRoom\Models\Theme;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'location_id'           => randomOrCreate(config('tipoff.model_class.location')),
            'theme_id'              => randomOrCreate(Theme::class),
            'rate_id'               => randomOrCreate(Rate::class),
            'supervision_id'        => randomOrCreate(Supervision::class),
            'opened_at'             => $this->faker->dateTimeBetween('-1 years', '+3 months'),
            'closed_at'             => null,
            'participants'          => $this->faker->numberBetween(1, 10),
            'participants_private'  => $this->faker->numberBetween(1, 16),
            'priority'              => $this->faker->numberBetween(1, 20),
            'reset_time'            => $this->faker->randomElement([10, 15, 15, 20, 25, 30, 30, 30, 45]),
            'occupied_time'         => $this->faker->randomElement([45, 60, 75, 90, 120]),
            'note'                  => $this->faker->sentences(1, true),
            'creator_id'            => randomOrCreate(config('tipoff.model_class.user')),
            'updater_id'            => randomOrCreate(config('tipoff.model_class.user')),
        ];
    }
}
