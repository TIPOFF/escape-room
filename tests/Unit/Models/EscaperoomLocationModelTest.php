<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\EscaperoomLocation;
use Tipoff\EscapeRoom\Tests\TestCase;
use Tipoff\Locations\Models\Location;

class EscaperoomLocationModelTest extends TestCase
{
    use DatabaseTransactions;

    /**
    @test
    */
    public function create()
    {
        $model = EscaperoomLocation::factory()->create();
        $this->assertNotNull($model);
    }

    /**
    @test
    */
    public function it_has_a_location()
    {
        $model = EscaperoomLocation::factory()->create();
        $this->assertInstanceOf(Location::class, $model->location);
    }

    /**
    @test
    */
    public function it_may_has_an_teamphoto()
    {
        $model = EscaperoomLocation::factory()->create();
        $array = [null, rand(1, 1)];
        $this->assertContains($model->team_image_id, $array);
    }
}
