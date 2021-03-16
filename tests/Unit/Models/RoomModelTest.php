<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\EscapeRoom\Tests\TestCase;

class RoomModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = Room::factory()->create();
        $this->assertNotNull($model);

        return $model;
    }

    /**
    @test
    *@depends create
    */
    public function it_has_a_location(Room $model)
    {
        $this->assertNotNull($model->location_id);
    }

    /**
    @test
    *@depends create
    */
    public function it_has_a_theme(Room $model)
    {
        $this->assertNotNull($model->theme_id);
    }

    /**
    @test
    *@depends create
    */
    public function it_has_a_rate(Room $model)
    {
        $this->assertNotNull($model->rate_id);
    }

    /**
    @test
    *@depends create
    */
    public function it_has_a_supervision(Room $model)
    {
        $this->assertNotNull($model->supervision_id);
    }

    /**
    @test
    *@depends create
    */
    public function it_has_a_openAt_date(Room $model)
    {
        $this->assertNotNull($model->opened_at);
    }

    /**
    @test
    *@depends create
    */
    public function it_has_participants(Room $model)
    {
        $this->assertNotNull($model->participants);
    }

    /**
    @test
    *@depends create
    */
    public function it_has_participants_private(Room $model)
    {
        $this->assertNotNull($model->participants_private);
    }

    /**
    @test
    *@depends create
    */
    public function it_has_reset_time(Room $model)
    {
        $this->assertNotNull($model->reset_time);
    }

    /**
    @test
    *@depends create
    */
    public function it_has_occupied_time(Room $model)
    {
        $this->assertNotNull($model->occupied_time);
    }

    /**
    @test
    *@depends create
    */
    public function it_has_priority(Room $model)
    {
        $this->assertNotNull($model->priority);
    }

    /**
    @test
    */
    public function it_has_title_attribute()
    {
        $location = app('location')::factory()->create();
        $theme = app('escaperoom_theme')::factory()->create();
        $room = app('room')::factory()->create(['theme_id' => $theme->id, 'location_id' => $location->id]);
        $this->assertEquals($room->getTitleAttribute(), $room->theme->title);

        $room2 = app('room')::factory()->create(['theme_id' => $theme->id, 'location_id' => $location->id]);
        $this->assertEquals($room2->getTitleAttribute(), "{$room2->theme->title} #{$room2->id}");
    }

    /**
    @test
    */
    public function it_has_name_attribute()
    {
        $location = app('location')::factory()->create();
        $theme = app('escaperoom_theme')::factory()->create();
        $room = app('room')::factory()->create(['theme_id' => $theme->id, 'location_id' => $location->id]);
        $this->assertEquals($room->getNameAttribute(), "{$room->location->abbreviation} {$room->theme->name}");

        $room2 = app('room')::factory()->create(['theme_id' => $theme->id, 'location_id' => $location->id]);
        $this->assertEquals($room2->getNameAttribute(), "{$room2->location->abbreviation} {$room2->theme->name} #{$room2->id}");
    }

    /**
    @test
    */
    public function room_has_path_attribute()
    {
        $market = app('market')::factory()->create();
        $location = app('location')::factory()->create(['market_id' => $market->id]);
        $theme = app('escaperoom_theme')::factory()->create();
        $room = app('room')::factory()->create(['theme_id' => $theme->id, 'location_id' => $location->id]);

        $this->assertEquals($room->getPathAttribute(), "/{$room->location->market->slug}/rooms/{$room->theme->slug}");
    }

    /**
    @test
    */
    public function room_has_location()
    {
        $model = app('room')::factory()->create();
        $this->assertInstanceOf(get_class(app('location')), $model->location);
    }

    /**
    @test
    */
    public function room_has_theme()
    {
        $model = app('room')::factory()->create();
        $this->assertInstanceOf(get_class(app('escaperoom_theme')), $model->theme);
    }

    /**
    @test
    */
    public function room_has_rate()
    {
        $model = app('room')::factory()->create();
        $this->assertInstanceOf(get_class(app('escaperoom_rate')), $model->rate);
    }

    /**
    @test
    */
    public function room_has_supervision()
    {
        $model = app('room')::factory()->create();
        $this->assertInstanceOf(get_class(app('supervision')), $model->supervision);
    }

    /**
    @test
    */
    public function room_has_incoming_property()
    {
        $model = app('room')::factory()->create();
        $this->assertEquals($model->isComing(), $model->opened_at->isFuture());
    }

    /**
    @test
    */
    public function room_has_pitch_attribute()
    {
        $model = app('room')::factory()->create();
        $this->assertEquals($model->getPitchAttribute(), $model->theme->pitch);
    }

    /**
    @test
    */
    public function room_has_icon_url_attribute()
    {
        $theme = app('escaperoom_theme')::factory()->create(['icon_id' => null, 'video_id' => rand(0, 1)]);
        $room = app('room')::factory()->create(['theme_id' => $theme->id]);
        $this->assertEquals($room->getIconUrlAttribute(), null);

        $theme = app('escaperoom_theme')::factory()->create(['video_id' => rand(2, 3)]);
        $room = app('room')::factory()->create(['theme_id' => $theme->id]);
        $this->assertEquals($room->getIconUrlAttribute(), $room->theme->icon->url);
    }

    /**
    @test
    */
    public function room_has_youtube_attribute()
    {
        $model = app('room')::factory()->create();
        $this->assertEquals($model->getYoutubeAttribute(), $model->theme->youtube);
    }
}
