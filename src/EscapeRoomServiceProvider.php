<?php

namespace Tipoff\EscapeRoom;

use Illuminate\Support\Str;
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
            ->hasMigrations([
                '2020_02_16_100000_create_rates_table',
                '2020_02_16_130000_create_supervisions_table',
                '2020_02_18_100000_create_themes_table',
                '2020_02_18_110000_create_rooms_table',
            ])
            ->hasCommand(EscapeRoomCommand::class);
    }

    /**
     * Using packageBooted lifecycle hooks to override the migration file name.
     * We want to keep the old filename for now.
     */
    public function packageBooted()
    {
        foreach ($this->package->migrationFileNames as $migrationFileName) {
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    $this->package->basePath("/../database/migrations/{$migrationFileName}.php.stub") => database_path('migrations/' . Str::finish($migrationFileName, '.php')),
                ], "{$this->package->name}-migrations");
            }
        }
    }
}
