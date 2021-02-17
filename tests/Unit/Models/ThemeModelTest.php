<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\Theme;
use Tipoff\EscapeRoom\Tests\TestCase;

class ThemeModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = Theme::factory()->create();
        $this->assertNotNull($model);
    }
}
