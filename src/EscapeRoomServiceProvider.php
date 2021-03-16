<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom;

use Tipoff\EscapeRoom\Models\EscapeRoomLocation;
use Tipoff\EscapeRoom\Models\EscapeRoomMarket;
use Tipoff\EscapeRoom\Models\EscapeRoomRate;
use Tipoff\EscapeRoom\Models\EscapeRoomTheme;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\EscapeRoom\Models\Supervision;
use Tipoff\EscapeRoom\Policies\EscapeRoomLocationPolicy;
use Tipoff\EscapeRoom\Policies\EscapeRoomMarketPolicy;
use Tipoff\EscapeRoom\Policies\EscapeRoomRatePolicy;
use Tipoff\EscapeRoom\Policies\EscapeRoomThemePolicy;
use Tipoff\EscapeRoom\Policies\RoomPolicy;
use Tipoff\EscapeRoom\Policies\SupervisionPolicy;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class EscapeRoomServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->hasPolicies([
                EscapeRoomRate::class => EscapeRoomRatePolicy::class,
                Room::class => RoomPolicy::class,
                Supervision::class => SupervisionPolicy::class,
                EscapeRoomTheme::class => EscapeRoomThemePolicy::class,
                EscapeRoomLocation::class => EscapeRoomLocationPolicy::class,
                EscapeRoomMarket::class => EscapeRoomMarketPolicy::class,
            ])
            ->hasNovaResources([
                \Tipoff\EscapeRoom\Nova\EscapeRoomRate::class,
                \Tipoff\EscapeRoom\Nova\Room::class,
                \Tipoff\EscapeRoom\Nova\Supervision::class,
                \Tipoff\EscapeRoom\Nova\EscapeRoomTheme::class,
                \Tipoff\EscapeRoom\Nova\EscapeRoomLocation::class,
                \Tipoff\EscapeRoom\Nova\EscapeRoomMarket::class,
            ])
            ->name('escape-room')
            ->hasConfigFile();
    }
}
