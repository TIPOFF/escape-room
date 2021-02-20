<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\EscapeRoom\Models\EscapeRoomLocation;
use Tipoff\Locations\Models\Location;

class EscapeRoomLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EscapeRoomLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'location_id'    => randomOrCreate(Location::class),
            'corporate'      => $this->faker->boolean,
            'booking_cutoff' => $this->faker->numberBetween(1, 127),
            'creator_id'     => randomOrCreate(app('user')),
            'updater_id'     => randomOrCreate(app('user'))
        ];
    }
}
