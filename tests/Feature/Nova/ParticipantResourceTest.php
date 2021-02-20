<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Feature\Nova;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\Participant;
use Tipoff\TestSupport\Models\User;
use Tipoff\EscapeRoom\Tests\TestCase;

class ParticipantResourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function index()
    {
        Participant::factory()->count(1)->create();

        $this->actingAs(User::factory()->create());

        $response = $this->getJson('nova-api/participants')->assertOk();

        $this->assertCount(1, $response->json('resources'));
    }
}
