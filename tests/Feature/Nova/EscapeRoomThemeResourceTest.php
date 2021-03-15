<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Feature\Nova;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\EscapeRoomTheme;
use Tipoff\EscapeRoom\Tests\TestCase;

class EscapeRoomThemeResourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function index()
    {
        EscapeRoomTheme::factory()->count(1)->create();

        $this->actingAs(self::createPermissionedUser('view themes', true));

        $response = $this->getJson('nova-api/themes')->assertOk();

        $this->assertCount(1, $response->json('resources'));
    }
}
