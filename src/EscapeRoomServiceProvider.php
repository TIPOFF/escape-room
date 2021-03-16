<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom;

use Tipoff\EscapeRoom\Models\EscaperoomLocation;
use Tipoff\EscapeRoom\Models\EscaperoomMarket;
use Tipoff\EscapeRoom\Models\EscaperoomRate;
use Tipoff\EscapeRoom\Models\EscaperoomTheme;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\EscapeRoom\Models\Supervision;
use Tipoff\EscapeRoom\Policies\EscaperoomLocationPolicy;
use Tipoff\EscapeRoom\Policies\EscaperoomMarketPolicy;
use Tipoff\EscapeRoom\Policies\EscaperoomRatePolicy;
use Tipoff\EscapeRoom\Policies\EscaperoomThemePolicy;
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
                EscaperoomLocation::class => EscaperoomLocationPolicy::class,
                EscaperoomMarket::class => EscaperoomMarketPolicy::class,
                EscaperoomRate::class => EscaperoomRatePolicy::class,
                EscaperoomTheme::class => EscaperoomThemePolicy::class,
                Room::class => RoomPolicy::class,
                Supervision::class => SupervisionPolicy::class,
            ])
            ->hasNovaResources([
                \Tipoff\EscapeRoom\Nova\EscaperoomLocation::class,
                \Tipoff\EscapeRoom\Nova\EscaperoomMarket::class,
                \Tipoff\EscapeRoom\Nova\EscaperoomRate::class,
                \Tipoff\EscapeRoom\Nova\EscaperoomTheme::class,
                \Tipoff\EscapeRoom\Nova\Room::class,
                \Tipoff\EscapeRoom\Nova\Supervision::class,
            ])
            ->name('escape-room')
            ->hasConfigFile();
    }
}
