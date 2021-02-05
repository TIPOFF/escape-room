<?php namespace Tipoff\EscapeRoom\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\EscapeRoom\Models\Rate;

class RateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sentence = $this->faker->sentence;

        return [
            'slug'              => Str::slug($sentence),
            'name'              => $sentence,

            'public_1'          => $this->faker->numberBetween(2500, 5000),
            'public_2'          => $this->faker->numberBetween(2500, 5000),
            'public_3'          => $this->faker->numberBetween(2500, 5000),
            'public_4'          => $this->faker->numberBetween(2500, 5000),
            'public_5'          => $this->faker->numberBetween(2000, 5000),
            'public_6'          => $this->faker->numberBetween(2000, 5000),
            'public_7'          => $this->faker->numberBetween(2000, 5000),
            'public_8'          => $this->faker->numberBetween(2000, 5000),
            'public_9'          => $this->faker->numberBetween(1500, 5000),
            'public_10'         => $this->faker->numberBetween(1500, 5000),

            'private_1'         => $this->faker->numberBetween(2000, 5000),
            'private_2'         => $this->faker->numberBetween(2000, 5000),
            'private_3'         => $this->faker->numberBetween(2000, 5000),
            'private_4'         => $this->faker->numberBetween(2000, 5000),
            'private_5'         => $this->faker->numberBetween(1500, 5000),
            'private_6'         => $this->faker->numberBetween(1500, 5000),
            'private_7'         => $this->faker->numberBetween(1500, 5000),
            'private_8'         => $this->faker->numberBetween(1500, 5000),
            'private_9'         => $this->faker->numberBetween(1500, 5000),
            'private_10'        => $this->faker->numberBetween(1500, 5000),
            'private_11'        => $this->faker->numberBetween(1500, 5000),
            'private_12'        => $this->faker->numberBetween(1500, 5000),
            'private_13'        => $this->faker->numberBetween(1500, 5000),
            'private_14'        => $this->faker->numberBetween(1500, 5000),
            'private_15'        => $this->faker->numberBetween(1500, 5000),
            'private_16'        => $this->faker->numberBetween(1500, 5000),

            'creator_id'        => randomOrCreate(config('support.model_class.user')),
            'updater_id'        => randomOrCreate(config('support.model_class.user')),
        ];
    }
}
