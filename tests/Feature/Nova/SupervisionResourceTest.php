<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Feature\Nova;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\Supervision;
use Tipoff\EscapeRoom\Tests\TestCase;

class SupervisionResourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function index()
    {
        Supervision::factory()->count(1)->create();

        $this->actingAs(self::createPermissionedUser('view supervisions', true));

        $response = $this->getJson('nova-api/supervisions')->assertOk();

        $this->assertCount(1, $response->json('resources'));
    }
}
