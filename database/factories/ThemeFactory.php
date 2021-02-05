<?php namespace Tipoff\EscapeRoom\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\EscapeRoom\Models\Supervision;
use Tipoff\EscapeRoom\Models\Theme;

class ThemeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Theme::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;

        return [
            'slug'            => Str::slug($name),
            'name'            => $name,
            'title'           => $name,
            'full_title'      => $name,
            'excerpt'         => $this->faker->sentences(1, true),
            'description'     => $this->faker->sentences(2, true),
            'synopsis'        => $this->faker->sentences(7, true),
            'story'           => $this->faker->paragraphs(3, true),
            'info'            => $this->faker->sentences(2, true),
            'duration'        => $this->faker->randomElement([45, 60, 60, 60, 60, 60, 75, 90, 120]),
            'occupied_time'   => $this->faker->randomElement([45, 60, 75, 75, 90, 90, 90, 90, 120]),
            'scavenger_level' => $this->faker->numberBetween(1, 5),
            'puzzle_level'    => $this->faker->numberBetween(1, 5),
            'escape_rate'     => $this->faker->numberBetween(1, 100),
            'supervision_id'  => randomOrCreate(Supervision::class),
            'creator_id'      => randomOrCreate(config('support.model_class.user')),
            'updater_id'      => randomOrCreate(config('support.model_class.user')),
        ];
    }
}
