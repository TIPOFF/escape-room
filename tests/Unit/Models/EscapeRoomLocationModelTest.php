<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\EscapeRoomLocation;
use Tipoff\EscapeRoom\Tests\TestCase;

class EscapeRoomLocationModelTest extends TestCase
{
    use DatabaseTransactions;

    /** 
    @test 
    */
    public function create()
    {
        $model = EscapeRoomLocation::factory()->create();
        $this->assertNotNull($model);
    }

    /** 
    @test 
    */
    public function it_has_a_location()
    {
        $model = EscapeRoomLocation::factory()->create();
        $this->assertInstanceOf(get_class(app('location')), $model->location);
    }

    /** 
    @test
    */
    public function it_may_has_an_teamphoto()
    {
        $model = EscapeRoomLocation::factory()->create();
        $array = array(NULL, rand(1,1));
		$this->assertContains($model->team_image_id, $array);
    }
}
