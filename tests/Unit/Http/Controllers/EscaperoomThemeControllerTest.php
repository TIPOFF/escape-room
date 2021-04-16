<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\EscaperoomTheme;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\EscapeRoom\Tests\TestCase;
use Tipoff\Locations\Models\Location;
use Tipoff\Locations\Models\Market;

class EscaperoomThemeControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function listing_with_no_market()
    {
        $market = Market::factory()->create();

        // 3 distinct themes, 3 different locations with same market - room open, location open
        Room::factory()->count(3)->create([
            'closed_at' => null,
            'escaperoom_theme_id' => function () {
                return EscaperoomTheme::factory()->create();
            },
            'location_id' => function () use ($market) {
                return Location::factory()->create([
                    'closed_at' => null,
                    'market_id' => $market,
                ]);
            },
        ]);

        // 3 distinct themes, 3 different locations with different markets - room open, location open
        Room::factory()->count(3)->create([
            'closed_at' => null,
            'escaperoom_theme_id' => function () {
                return EscaperoomTheme::factory()->create();
            },
            'location_id' => function () {
                return Location::factory()->create([
                    'closed_at' => null,
                    'market_id' => Market::factory()->create(),
                ]);
            },
        ]);

        // 7 accounts for an initial randomOrCreate that still gets invoked!!
        $this->assertEquals(7, EscaperoomTheme::query()->count());

        $this->get(route('escape-room.theme-listing'))
            ->assertOk()
            ->assertSee("-- M:0 T:7 --");
    }

    /** @test */
    public function listing_with_market()
    {
        $market = Market::factory()->create();

        // 3 distinct themes, 3 different locations with same market - room open, location open
        Room::factory()->count(3)->create([
            'closed_at' => null,
            'escaperoom_theme_id' => function () {
                return EscaperoomTheme::factory()->create();
            },
            'location_id' => function () use ($market) {
                return Location::factory()->create([
                    'closed_at' => null,
                    'market_id' => $market,
                ]);
            },
        ]);

        // 3 distinct themes, 3 different locations with different markets - room open, location open
        Room::factory()->count(3)->create([
            'closed_at' => null,
            'escaperoom_theme_id' => function () {
                return EscaperoomTheme::factory()->create();
            },
            'location_id' => function () {
                return Location::factory()->create([
                    'closed_at' => null,
                    'market_id' => Market::factory()->create(),
                ]);
            },
        ]);

        // 7 accounts for an initial randomOrCreate that still gets invoked!!
        $this->assertEquals(7, EscaperoomTheme::query()->count());

        $this->get(route('escape-room.market-theme-listing', [
            'market' => $market,
        ]))
            ->assertOk()
            ->assertSee("-- M:{$market->id} T:3 --");
    }

    /** @test */
    public function detail_without_market()
    {
        $market = Market::factory()->create();
        $room = Room::factory()->create([
            'closed_at' => null,
            'escaperoom_theme_id' => EscaperoomTheme::factory()->create(),
            'location_id' => Location::factory()->create([
                'closed_at' => null,
                'market_id' => $market,
            ]),
        ]);

        $this->get(route('escape-room.theme', [
            'theme' => $room->theme,
        ]))
            ->assertOk()
            ->assertSee("-- M:0 T:{$room->theme->id} --");
    }

    /** @test */
    public function detail_with_valid_market()
    {
        $market = Market::factory()->create();
        $room = Room::factory()->create([
            'closed_at' => null,
            'escaperoom_theme_id' => EscaperoomTheme::factory()->create(),
            'location_id' => Location::factory()->create([
                'closed_at' => null,
                'market_id' => $market,
            ]),
        ]);

        $this->get(route('escape-room.market-theme', [
            'market' => $market,
            'theme' => $room->theme,
        ]))
            ->assertOk()
            ->assertSee("-- M:{$market->id} T:{$room->theme->id} --");
    }

    /** @test */
    public function detail_without_valid_market()
    {
        $market = Market::factory()->create();
        Room::factory()->create([
            'closed_at' => null,
            'escaperoom_theme_id' => EscaperoomTheme::factory()->create(),
            'location_id' => Location::factory()->create([
                'closed_at' => null,
                'market_id' => $market,
            ]),
        ]);

        $room = Room::factory()->create([
            'closed_at' => null,
            'escaperoom_theme_id' => EscaperoomTheme::factory()->create(),
            'location_id' => Location::factory()->create([
                'closed_at' => null,
                'market_id' => Market::factory()->create(),
            ]),
        ]);

        $this->get(route('escape-room.market-theme', [
            'market' => $market,
            'theme' => $room->theme,
        ]))
            ->assertNotFound();
    }
}
