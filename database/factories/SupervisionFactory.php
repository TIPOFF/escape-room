<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\EscapeRoom\Models\Supervision;

class SupervisionFactory extends Factory
{
    protected $model = Supervision::class;

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
