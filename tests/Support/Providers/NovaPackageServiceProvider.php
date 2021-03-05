<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Support\Providers;

use Tipoff\TestSupport\Providers\BaseNovaPackageServiceProvider;
use Tipoff\EscapeRoom\Nova\EscapeRoomLocation;
use Tipoff\EscapeRoom\Nova\EscapeRoomMarket;
use Tipoff\EscapeRoom\Nova\Rate;
use Tipoff\EscapeRoom\Nova\Room;
use Tipoff\EscapeRoom\Nova\Supervision;
use Tipoff\EscapeRoom\Nova\Theme;

class NovaPackageServiceProvider extends BaseNovaPackageServiceProvider
{
	public static array $packageResources = [
        EscapeRoomLocation::class,
        EscapeRoomMarket::class,
        Rate::class,
        Room::class,
        Supervision::class,
        Theme::class,
    ];
}
