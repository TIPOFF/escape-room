<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\Locations\Models\Location;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'location_id'           => randomOrCreate(app('location')),
            'theme_id'              => randomOrCreate(app('theme')),
            'rate_id'               => randomOrCreate(app('rate')),
            'supervision_id'        => randomOrCreate(app('supervision')),
            'opened_at'             => $this->faker->dateTimeBetween('-1 years', '+3 months'),
            'closed_at'             => null,
            'participants'          => $this->faker->numberBetween(1, 10),
            'participants_private'  => $this->faker->numberBetween(1, 16),
            'priority'              => $this->faker->numberBetween(1, 20),
            'reset_time'            => $this->faker->randomElement([10, 15, 15, 20, 25, 30, 30, 30, 45]),
            'occupied_time'         => $this->faker->randomElement([45, 60, 75, 90, 120]),
            'note'                  => $this->faker->sentences(1, true),
            'creator_id'            => randomOrCreate(app('user')),
            'updater_id'            => randomOrCreate(app('user'))
        ];
    }
}
