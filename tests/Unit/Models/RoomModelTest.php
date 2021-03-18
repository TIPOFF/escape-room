<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\EscapeRoom\Models\EscaperoomTheme;
use Tipoff\EscapeRoom\Models\EscaperoomRate;
use Tipoff\EscapeRoom\Tests\TestCase;
use Tipoff\Locations\Models\Location;
use Tipoff\Locations\Models\Market;
use Tipoff\EscapeRoom\Models\Supervision;

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
        $this->assertNotNull($model->escaperoom_theme_id);
    }

    /**
    @test
    *@depends create
    */
    public function it_has_a_rate(Room $model)
    {
        $this->assertNotNull($model->escaperoom_rate_id);
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
        $location = Location::factory()->create();
        $theme = EscaperoomTheme::factory()->create();
        $room = Room::factory()->create(['escaperoom_theme_id' => $theme->id, 'location_id' => $location->id]);
        $this->assertEquals($room->getTitleAttribute(), $room->theme->title);

        $room2 = Room::factory()->create(['escaperoom_theme_id' => $theme->id, 'location_id' => $location->id]);
        $this->assertEquals($room2->getTitleAttribute(), "{$room2->theme->title} #{$room2->id}");
    }

    /**
    @test
    */
    public function it_has_name_attribute()
    {
        $location = Location::factory()->create();
        $theme = EscaperoomTheme::factory()->create();
        $room = Room::factory()->create(['escaperoom_theme_id' => $theme->id, 'location_id' => $location->id]);
        $this->assertEquals($room->getNameAttribute(), "{$room->location->abbreviation} {$room->theme->name}");

        $room2 = Room::factory()->create(['escaperoom_theme_id' => $theme->id, 'location_id' => $location->id]);
        $this->assertEquals($room2->getNameAttribute(), "{$room2->location->abbreviation} {$room2->theme->name} #{$room2->id}");
    }

    /**
    @test
    */
    public function room_has_path_attribute()
    {
        $market = Market::factory()->create();
        $location = Location::factory()->create(['market_id' => $market->id]);
        $theme = EscaperoomTheme::factory()->create();
        $room = Room::factory()->create(['escaperoom_theme_id' => $theme->id, 'location_id' => $location->id]);

        $this->assertEquals($room->getPathAttribute(), "/{$room->location->market->slug}/rooms/{$room->theme->slug}");
    }

    /**
    @test
    */
    public function room_has_location()
    {
        $model = Room::factory()->create();
        $this->assertInstanceOf(Location::class, $model->location);
    }

    /**
    @test
    */
    public function room_has_theme()
    {
        $model = Room::factory()->create();
        $this->assertInstanceOf(EscaperoomTheme::class, $model->theme);
    }

    /**
    @test
    */
    public function room_has_rate()
    {
        $model = Room::factory()->create();
        $this->assertInstanceOf(EscaperoomRate::class, $model->rate);
    }

    /**
    @test
    */
    public function room_has_supervision()
    {
        $model = Room::factory()->create();
        $this->assertInstanceOf(Supervision::class, $model->supervision);
    }

    /**
    @test
    */
    public function room_has_incoming_property()
    {
        $model = Room::factory()->create();
        $this->assertEquals($model->isComing(), $model->opened_at->isFuture());
    }

    /**
    @test
    */
    public function room_has_pitch_attribute()
    {
        $model = Room::factory()->create();
        $this->assertEquals($model->getPitchAttribute(), $model->theme->pitch);
    }

    /**
    @test
    */
    public function room_has_icon_url_attribute()
    {
        $theme = EscaperoomTheme::factory()->create(['icon_id' => null, 'video_id' => rand(0, 1)]);
        $room = Room::factory()->create(['escaperoom_theme_id' => $theme->id]);
        $this->assertEquals($room->getIconUrlAttribute(), null);

        $theme = EscaperoomTheme::factory()->create(['video_id' => rand(2, 3)]);
        $room = Room::factory()->create(['escaperoom_theme_id' => $theme->id]);
        $this->assertEquals($room->getIconUrlAttribute(), $room->theme->icon->url);
    }

    /**
    @test
    */
    public function room_has_youtube_attribute()
    {
        $model = Room::factory()->create();
        $this->assertEquals($model->getYoutubeAttribute(), $model->theme->youtube);
    }
}
