<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Feature\Nova;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\EscapeRoomRate;
use Tipoff\EscapeRoom\Tests\TestCase;

class EscapeRoomRateResourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function index()
    {
        EscapeRoomRate::factory()->count(1)->create();

        $this->actingAs(self::createPermissionedUser('view rates', true));

        $response = $this->getJson('nova-api/rates')->assertOk();

        $this->assertCount(1, $response->json('resources'));
    }
}
