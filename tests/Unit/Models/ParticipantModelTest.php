<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\Participant;
use Tipoff\EscapeRoom\Tests\TestCase;

class ParticipantModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = Participant::factory()->create();
        $this->assertNotNull($model);
    }
}
