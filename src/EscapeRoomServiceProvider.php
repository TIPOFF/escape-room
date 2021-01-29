<?php

namespace Tipoff\EscapeRoom;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tipoff\EscapeRoom\Commands\EscapeRoomCommand;

class EscapeRoomServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('escape-room')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_escape_room_table')
            ->hasCommand(EscapeRoomCommand::class);
    }
}
