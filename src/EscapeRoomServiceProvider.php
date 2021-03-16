<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom;

use Tipoff\EscapeRoom\Models\EscaperoomLocation;
use Tipoff\EscapeRoom\Models\EscaperoomMarket;
use Tipoff\EscapeRoom\Models\EscaperoomRate;
use Tipoff\EscapeRoom\Models\EscapeRoomTheme;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\EscapeRoom\Models\Supervision;
use Tipoff\EscapeRoom\Policies\EscaperoomLocationPolicy;
use Tipoff\EscapeRoom\Policies\EscaperoomMarketPolicy;
use Tipoff\EscapeRoom\Policies\EscaperoomRatePolicy;
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
                EscaperoomRate::class => EscaperoomRatePolicy::class,
                Room::class => RoomPolicy::class,
                Supervision::class => SupervisionPolicy::class,
                EscapeRoomTheme::class => EscapeRoomThemePolicy::class,
                EscaperoomLocation::class => EscaperoomLocationPolicy::class,
                EscaperoomMarket::class => EscaperoomMarketPolicy::class,
            ])
            ->hasNovaResources([
                \Tipoff\EscapeRoom\Nova\EscaperoomRate::class,
                \Tipoff\EscapeRoom\Nova\Room::class,
                \Tipoff\EscapeRoom\Nova\Supervision::class,
                \Tipoff\EscapeRoom\Nova\EscapeRoomTheme::class,
                \Tipoff\EscapeRoom\Nova\EscaperoomLocation::class,
                \Tipoff\EscapeRoom\Nova\EscaperoomMarket::class,
            ])
            ->name('escape-room')
            ->hasConfigFile();
    }
}
