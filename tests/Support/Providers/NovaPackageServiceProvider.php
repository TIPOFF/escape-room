<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Support\Providers;

use Tipoff\EscapeRoom\Nova\EscapeRoomLocation;
use Tipoff\EscapeRoom\Nova\EscapeRoomMarket;
use Tipoff\EscapeRoom\Nova\EscapeRoomRate;
use Tipoff\EscapeRoom\Nova\EscapeRoomTheme;
use Tipoff\EscapeRoom\Nova\Room;
use Tipoff\EscapeRoom\Nova\Supervision;
use Tipoff\TestSupport\Providers\BaseNovaPackageServiceProvider;

class NovaPackageServiceProvider extends BaseNovaPackageServiceProvider
{
    public static array $packageResources = [
        EscapeRoomLocation::class,
        EscapeRoomMarket::class,
        EscapeRoomRate::class,
        Room::class,
        Supervision::class,
        EscapeRoomTheme::class,
    ];
}
