<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\EscapeRoom\Models\EscaperoomMarket;

class EscaperoomMarketFactory extends Factory
{
    protected $model = EscaperoomMarket::class;

    public function definition()
    {
        return [
            'market_id'      => randomOrCreate(app('market')),
            'corporate'      => $this->faker->boolean,
            'creator_id'     => randomOrCreate(app('user')),
            'updater_id'     => randomOrCreate(app('user'))
        ];
    }
}
