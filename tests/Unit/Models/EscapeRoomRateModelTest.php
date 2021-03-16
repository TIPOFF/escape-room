<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\EscapeRoomRate;
use Tipoff\EscapeRoom\Tests\TestCase;

class EscapeRoomRateModelTest extends TestCase
{
    use DatabaseTransactions;

    /** 
    @test
    */
    public function create()
    {
        $model = EscapeRoomRate::factory()->create();
        $this->assertNotNull($model);
        return $model;
    }

    /** 
    @test 
	*@depends create
    */
    public function it_has_a_name(EscapeRoomRate $model)
    {
        $this->assertNotNull($model->name);
    }

    /** 
    @test 
	*@depends create
    */
    public function it_has_a_slug(EscapeRoomRate $model)
    {
        $this->assertNotNull($model->slug);
    }

    /** 
    @test 
	*@depends create
    */
    public function it_has_a_base_public_rate(EscapeRoomRate $model)
    {
        $this->assertNotNull($model->public_1);
    }

    /** 
    @test 
	*@depends create
    */
    public function it_has_a_base_private_rate(EscapeRoomRate $model)
    {
        $this->assertNotNull($model->private_1);
    }

    /** 
    @test 
	*@depends create
    */
    public function it_has_all_the_rates_privates_not_including_the_first_one(EscapeRoomRate $model)
    {
        $this->assertNotNull($model->private_2);
        $this->assertNotNull($model->private_3);
        $this->assertNotNull($model->private_4);
        $this->assertNotNull($model->private_5);
        $this->assertNotNull($model->private_6);
        $this->assertNotNull($model->private_7);
        $this->assertNotNull($model->private_8);
        $this->assertNotNull($model->private_9);
        $this->assertNotNull($model->private_10);
        $this->assertNotNull($model->private_11);
        $this->assertNotNull($model->private_12);
        $this->assertNotNull($model->private_13);
        $this->assertNotNull($model->private_14);
        $this->assertNotNull($model->private_15);
        $this->assertNotNull($model->private_16);
    }

    /** 
    @test 
	*@depends create
    */
    public function it_has_all_the_rates_publics_not_including_the_first_one(EscapeRoomRate $model)
    {
        $this->assertNotNull($model->public_2);
        $this->assertNotNull($model->public_3);
        $this->assertNotNull($model->public_4);
        $this->assertNotNull($model->public_5);
        $this->assertNotNull($model->public_6);
        $this->assertNotNull($model->public_7);
        $this->assertNotNull($model->public_8);
        $this->assertNotNull($model->public_9);
        $this->assertNotNull($model->public_10);
    }

    /** 
    @test 
	*@depends create
    */
    public function always_return_amount(EscapeRoomRate $model)
    {
        $isPrivate = (bool)rand(0,1);
        $participants = rand(1,9);
        $amount = $model->getAmount($participants, $isPrivate);
        $this->assertIsInt($amount);
    }

    /** 
    @test 
	*@depends create
    */
    public function it_has_a_creator_and_updator(EscapeRoomRate $model)
    {
        $this->assertNotNull($model->creator_id);
        $this->assertNotNull($model->updater_id);
    }


}
