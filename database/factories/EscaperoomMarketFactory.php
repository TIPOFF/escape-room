<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\EscapeRoom\Models\EscaperoomMarket;
use Tipoff\Locations\Models\Location;

class EscaperoomMarketFactory extends Factory
{
    protected $model = EscaperoomMarket::class;

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
