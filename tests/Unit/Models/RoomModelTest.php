<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\EscapeRoom\Tests\TestCase;

class RoomModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = Room::factory()->create();
        $this->assertNotNull($model);
    }
}
