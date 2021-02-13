<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom;

use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class EscapeRoomServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->name('escape-room')
            ->hasConfigFile();
    }
}
