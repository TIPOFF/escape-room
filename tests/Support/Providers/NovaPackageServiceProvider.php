<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Support\Providers;

use Tipoff\EscapeRoom\Nova\EscaperoomLocation;
use Tipoff\EscapeRoom\Nova\EscaperoomMarket;
use Tipoff\EscapeRoom\Nova\EscaperoomRate;
use Tipoff\EscapeRoom\Nova\EscaperoomTheme;
use Tipoff\EscapeRoom\Nova\Room;
use Tipoff\EscapeRoom\Nova\Supervision;
use Tipoff\TestSupport\Providers\BaseNovaPackageServiceProvider;

class NovaPackageServiceProvider extends BaseNovaPackageServiceProvider
{
    public static array $packageResources = [
        EscaperoomLocation::class,
        EscaperoomMarket::class,
        EscaperoomRate::class,
        Room::class,
        Supervision::class,
        EscaperoomTheme::class,
    ];
}
