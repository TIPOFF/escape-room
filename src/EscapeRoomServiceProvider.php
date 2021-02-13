<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom;

use Illuminate\Support\Facades\Gate;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tipoff\EscapeRoom\Models\Participant;
use Tipoff\EscapeRoom\Models\Rate;
use Tipoff\EscapeRoom\Models\Room;
use Tipoff\EscapeRoom\Models\Supervision;
use Tipoff\EscapeRoom\Models\Theme;
use Tipoff\EscapeRoom\Policies\ParticipantPolicy;
use Tipoff\EscapeRoom\Policies\RatePolicy;
use Tipoff\EscapeRoom\Policies\RoomPolicy;
use Tipoff\EscapeRoom\Policies\SupervisionPolicy;
use Tipoff\EscapeRoom\Policies\ThemePolicy;

class EscapeRoomServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        parent::boot();
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('escape-room')
            ->hasConfigFile();
    }

    public function registeringPackage()
    {
        Gate::policy(Participant::class, ParticipantPolicy::class);
        Gate::policy(Rate::class, RatePolicy::class);
        Gate::policy(Room::class, RoomPolicy::class);
        Gate::policy(Supervision::class, SupervisionPolicy::class);
        Gate::policy(Theme::class, ThemePolicy::class);
    }
}
