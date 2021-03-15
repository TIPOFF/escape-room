<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Support\Providers;

use Tipoff\EscapeRoom\Nova\EscapeRoomLocation;
use Tipoff\EscapeRoom\Nova\EscapeRoomMarket;
use Tipoff\EscapeRoom\Nova\Rate;
use Tipoff\EscapeRoom\Nova\Room;
use Tipoff\EscapeRoom\Nova\Supervision;
use Tipoff\EscapeRoom\Nova\EscapeRoomTheme;
use Tipoff\TestSupport\Providers\BaseNovaPackageServiceProvider;

class NovaPackageServiceProvider extends BaseNovaPackageServiceProvider
{
    public static array $packageResources = [
        EscapeRoomLocation::class,
        EscapeRoomMarket::class,
        Rate::class,
        Room::class,
        Supervision::class,
        EscapeRoomTheme::class,
    ];
}
