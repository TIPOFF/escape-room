<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Feature\Nova;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\EscapeRoom\Tests\TestCase;

class RoomResourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function index()
    {
        Room::factory()->count(1)->create();

        $this->actingAs(self::createPermissionedUser('view rooms', true));

        $response = $this->getJson('nova-api/rooms')->assertOk();

        $this->assertCount(1, $response->json('resources'));
    }
}
