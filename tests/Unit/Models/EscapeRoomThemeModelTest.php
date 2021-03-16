<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\EscapeRoomTheme;
use Tipoff\EscapeRoom\Tests\TestCase;
use Illuminate\Support\Facades\Session;

class EscaperoomThemeModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = EscapeRoomTheme::factory()->create();
        $this->assertNotNull($model);
        return $model;
    }

    /** 
    @test 
	*@depends create
    */
    public function it_has_duration(EscapeRoomTheme $model)
    {
        $this->assertIsInt($model->duration);
    }

    /** 
    @test 
	*@depends create
    */
    public function it_has_occupied_time(EscapeRoomTheme $model)
    {
        $this->assertIsInt($model->occupied_time);
    }


    /** 
    @test 
	*@depends create
    */
    public function it_has_supervision(EscapeRoomTheme $model)
    {
        $this->assertIsInt($model->supervision_id);
    }

    /** 
    @test 
	*@depends create
    */
    public function determinate_if_is_scavenger(EscapeRoomTheme $model)
    {
        $model->scavenger_level = rand(0,3);
        $model->save();
        $this->assertFalse($model->isScavenger());
        
        $model->scavenger_level = 4;
        $model->save();
        $this->assertTrue($model->isScavenger());
    }


    /** 
    @test 
	*@depends create
    */
    public function it_has_pitch_attribute(EscapeRoomTheme $model)
    {
        $model->scavenger_level = rand(0,3);
        $model->save();
        $this->assertStringContainsString('This is an Advanced Escape Room, best for enthusiasts & problem solvers.',$model->getPitchAttribute());
        
        $model->scavenger_level = 4;
        $model->save();
        $this->assertStringContainsString('This is a Scavenger Hunt Room, best for families & groups of all skills levels. To ensure you have the best experience possible, your personal gamemaster will join you in the room.',$model->getPitchAttribute());
    }

    /** 
    @test 
	*@depends create
    */
    public function it_has_path_attribute(EscapeRoomTheme $model)
    {
        $compare1 = NULL;
		if (Session::get('current_market_id') != null) {
        	/** @var Model $marketModel */
        	$marketModel = app('market');
        	$market = $marketModel->find(Session::get('current_market_id'))->slug;
        	$compare1 = "/{$market}/rooms/{$model->slug}";
    	}

		$array = [$compare1, "/company/rooms/{$model->slug}"];
		$this->assertContains($model->getPathAttribute(), $array);
    }

}
