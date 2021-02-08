<?php namespace Tipoff\EscapeRoom\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupervisionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = app('supervision');

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sentence = $this->faker->unique()->sentence;

        return [
            'name'          => $sentence,
            'slug'          => Str::slug($sentence),
            'title'         => $sentence,
            'excerpt'       => $this->faker->sentence,
            'description'   => $this->faker->paragraph,
            'details'       => $this->faker->paragraph
        ];
    }
}
