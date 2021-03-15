<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\EscapeRoomTheme;
use Tipoff\EscapeRoom\Tests\TestCase;

class EscaperoomThemeModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = EscapeRoomTheme::factory()->create();
        $this->assertNotNull($model);
    }
}
