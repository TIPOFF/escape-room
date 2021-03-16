<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\EscapeRoom\Models\EscaperoomLocation;

class EscaperoomLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EscaperoomLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'location_id'    => randomOrCreate(app('location')),
            'corporate'      => $this->faker->boolean,
            'booking_cutoff' => $this->faker->numberBetween(1, 127),
            'creator_id'     => randomOrCreate(app('user')),
            'team_image_id'  => randomOrCreate(app('image')),
            'updater_id'     => randomOrCreate(app('user'))
        ];
    }
}
