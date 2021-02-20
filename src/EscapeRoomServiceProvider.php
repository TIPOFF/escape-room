<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom;

use Tipoff\EscapeRoom\Models\EscapeRoomLocation;
use Tipoff\EscapeRoom\Models\EscapeRoomMarket;
use Tipoff\EscapeRoom\Models\Participant;
use Tipoff\EscapeRoom\Models\Rate;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\EscapeRoom\Models\Supervision;
use Tipoff\EscapeRoom\Models\Theme;
use Tipoff\EscapeRoom\Policies\EscapeRoomLocationPolicy;
use Tipoff\EscapeRoom\Policies\EscapeRoomMarketPolicy;
use Tipoff\EscapeRoom\Policies\ParticipantPolicy;
use Tipoff\EscapeRoom\Policies\RatePolicy;
use Tipoff\EscapeRoom\Policies\RoomPolicy;
use Tipoff\EscapeRoom\Policies\SupervisionPolicy;
use Tipoff\EscapeRoom\Policies\ThemePolicy;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class EscapeRoomServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->hasPolicies([
                Participant::class        => ParticipantPolicy::class,
                Rate::class               => RatePolicy::class,
                Room::class               => RoomPolicy::class,
                Supervision::class        => SupervisionPolicy::class,
                Theme::class              => ThemePolicy::class,
                EscapeRoomLocation::class => EscapeRoomLocationPolicy::class,
                EscapeRoomMarket::class   => EscapeRoomMarketPolicy::class
            ])
            ->hasNovaResources([
                \Tipoff\EscapeRoom\Nova\Participant::class,
                \Tipoff\EscapeRoom\Nova\Rate::class,
                \Tipoff\EscapeRoom\Nova\Room::class,
                \Tipoff\EscapeRoom\Nova\Supervision::class,
                \Tipoff\EscapeRoom\Nova\Theme::class,
                \Tipoff\EscapeRoom\Nova\EscapeRoomLocation::class,
                \Tipoff\EscapeRoom\Nova\EscapeRoomMarket::class
            ])
            ->name('escape-room')
            ->hasConfigFile();
    }
}
