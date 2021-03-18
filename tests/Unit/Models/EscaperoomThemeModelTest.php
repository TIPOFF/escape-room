<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Carbon\Carbon;
use DrewRoberts\Media\Models\Image;
use DrewRoberts\Media\Models\Video;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use Tipoff\EscapeRoom\Models\EscaperoomTheme;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\EscapeRoom\Tests\TestCase;
use Tipoff\Locations\Models\Location;
use Tipoff\Locations\Models\Market;
use Tipoff\EscapeRoom\Models\Supervision;

class EscaperoomThemeModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = EscaperoomTheme::factory()->create();
        $this->assertNotNull($model);

        return $model;
    }

    /**
    @test
    *@depends create
    */
    public function it_has_duration(EscaperoomTheme $model)
    {
        $this->assertIsInt($model->duration);
    }

    /**
    @test
    *@depends create
    */
    public function it_has_occupied_time(EscaperoomTheme $model)
    {
        $this->assertIsInt($model->occupied_time);
    }

    /**
    @test
    *@depends create
    */
    public function it_has_supervision(EscaperoomTheme $model)
    {
        $this->assertIsInt($model->supervision_id);
    }

    /**
    @test
    *@depends create
    */
    public function determinate_if_is_scavenger(EscaperoomTheme $model)
    {
        $model->scavenger_level = rand(0, 3);
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
    public function it_has_pitch_attribute(EscaperoomTheme $model)
    {
        $model->scavenger_level = rand(0, 3);
        $model->save();
        $this->assertStringContainsString('This is an Advanced Escape Room, best for enthusiasts & problem solvers.', $model->getPitchAttribute());
        
        $model->scavenger_level = 4;
        $model->save();
        $this->assertStringContainsString('This is a Scavenger Hunt Room, best for families & groups of all skills levels. To ensure you have the best experience possible, your personal gamemaster will join you in the room.', $model->getPitchAttribute());
    }

    /**
    @test
    *@depends create
    */
    public function it_has_path_attribute(EscaperoomTheme $model)
    {
        $compare1 = null;
        if (Session::get('current_market_id') != null) {
            /** @var Model $marketModel */
            $marketModel = app('escaperoom_market');
            $market = $marketModel->find(Session::get('current_market_id'))->slug;
            $compare1 = "/{$market}/rooms/{$model->slug}";
        }

        $array = [$compare1, "/company/rooms/{$model->slug}"];
        $this->assertContains($model->getPathAttribute(), $array);
    }

    /**
    @test
    */
    public function it_can_find_markets()
    {
        $market = Market::factory()->create();
        $location = Location::factory()->create(['closed_at' => null, 'market_id' => $market->id]);
        $theme = EscaperoomTheme::factory()->create();
        $room = Room::factory()->create(['escaperoom_theme_id' => $theme->id, 'location_id' => $location->id]);
        $markets = $theme->findMarkets();
        $this->assertEquals($room->location->market->id,$markets[0]->id);

        $market2 = Market::factory()->create();
        $location2 = Location::factory()->create(['closed_at' => Carbon::now(), 'market_id' => $market2->id]);
        $theme2 = EscaperoomTheme::factory()->create();
        $room2 = Room::factory()->create(['escaperoom_theme_id' => $theme2->id, 'location_id' => $location2->id]);
        $markets2 = $theme2->findMarkets();
        $this->assertEquals(null,$markets2);
    }

    /**
    @test
    */
    public function it_has_a_supervision()
    {
        $model = EscaperoomTheme::factory()->create();
        $this->assertInstanceOf(Supervision::class, $model->supervision);
    }

    /**
    @test
    */
    public function it_has_poster()
    {
        $model = EscaperoomTheme::factory()->create();
        $this->assertInstanceOf(Image::class, $model->poster);
    }

    /**
    @test
    */
    public function it_has_icon()
    {
        $model = EscaperoomTheme::factory()->create();
        $this->assertInstanceOf(Image::class, $model->icon);
    }

    /**
    @test
    */
    public function it_has_image()
    {
        $model = EscaperoomTheme::factory()->create();
        $this->assertInstanceOf(Image::class, $model->image);
    }

    /**
    @test
    */
    public function it_has_video()
    {
        $model = EscaperoomTheme::factory()->create();
        $this->assertInstanceOf(Video::class, $model->video);
    }

    /**
    @test
    */
    public function it_has_youtube_attribute()
    {
        $video = Video::factory()->create(['source' => 'youtube']);
        $theme = EscaperoomTheme::factory()->create(['video_id' => $video->id]);
        $this->assertIsString($theme->getYoutubeAttribute());

        $video2 = Video::factory()->create(['source' => 'vimeo']);
        $theme2 = EscaperoomTheme::factory()->create(['video_id' => $video2->id]);
        $this->assertEquals('P_BWLv-PQfk', $theme2->getYoutubeAttribute());
    }

    /**
    @test
    */
    public function it_has_icon_url_attribute()
    {
        $icon = Image::factory()->create();
        $theme = EscaperoomTheme::factory()->create(['icon_id' => $icon->id]);
        $this->assertEquals($theme->icon->url, $theme->getIconUrlAttribute());
    }
}
