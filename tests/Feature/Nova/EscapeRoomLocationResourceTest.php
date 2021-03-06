<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Feature\Nova;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\EscapeRoomLocation;
use Tipoff\EscapeRoom\Tests\TestCase;

class EscapeRoomLocationResourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function index()
    {
        EscapeRoomLocation::factory()->count(1)->create();

        $this->actingAs(self::createPermissionedUser('view escape room locations', true));

        $response = $this->getJson('nova-api/escape-room-locations')->assertOk();

        $this->assertCount(1, $response->json('resources'));
    }
}
