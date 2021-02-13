<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom;

use Tipoff\EscapeRoom\Models\EscapeRoom;
use Tipoff\EscapeRoom\Policies\EscapeRoomPolicy;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class EscapeRoomServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->hasPolicies([
                EscapeRoom::class => EscapeRoomPolicy::class,
            ])
            ->name('escape-room')
            ->hasConfigFile();
    }
}
