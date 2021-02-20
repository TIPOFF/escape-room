<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\EscapeRoom\Models\EscapeRoomMarket;
use Tipoff\Locations\Models\Location;

class EscapeRoomMarketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EscapeRoomMarket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'corporate'      => $this->faker->boolean,
            'location_id'    => randomOrCreate(Location::class),
            'creator_id'     => randomOrCreate(app('user')),
            'updater_id'     => randomOrCreate(app('user'))
        ];
    }
}
