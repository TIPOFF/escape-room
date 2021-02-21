<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\EscapeRoomLocation;
use Tipoff\EscapeRoom\Tests\TestCase;

class EscapeRoomLocationModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = EscapeRoomLocation::factory()->create();
        $this->assertNotNull($model);
    }
}
