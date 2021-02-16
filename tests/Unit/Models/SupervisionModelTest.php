<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\Supervision;
use Tipoff\EscapeRoom\Tests\TestCase;

class SupervisionModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = Supervision::factory()->create();
        $this->assertNotNull($model);
    }
}
