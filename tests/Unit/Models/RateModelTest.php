<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\Rate;
use Tipoff\EscapeRoom\Tests\TestCase;

class RateModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = Rate::factory()->create();
        $this->assertNotNull($model);
    }
}
