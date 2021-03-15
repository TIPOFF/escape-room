<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Tipoff\Support\Contracts\Models\UserInterface;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class EscapeRoomTheme extends BaseModel
{
    use HasCreator;
    use HasUpdater;
    use HasPackageFactory;

    protected $casts = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($theme) {
            if (empty($theme->duration)) {
                $theme->duration = 60;
            }
            if (empty($theme->occupied_time)) {
                $theme->occupied_time = 90;
            }
            if (empty($theme->supervision_id)) {
                $theme->supervision_id = 2;
            }
        });
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function locations()
    {
        return $this->hasManyThrough(app('location'), Room::class, 'theme_id', 'id', 'id', 'location_id');
    }

    public function supervision()
    {
        return $this->belongsTo(Supervision::class);
    }

    public function images()
    {
        return $this->belongsToMany(app('image'))->withTimestamps();
    }

    public function image()
    {
        return $this->belongsTo(app('image'));
    }

    public function icon()
    {
        return $this->belongsTo(app('image'), 'icon_id');
    }

    public function poster()
    {
        return $this->belongsTo(app('image'), 'poster_image_id');
    }

    public function video()
    {
        return $this->belongsTo(app('video'));
    }

    public function getPathAttribute()
    {
        if (Session::get('current_market_id') != null) {
            /** @var Model $marketModel */
            $marketModel = app('market');

            $market = $marketModel->find(Session::get('current_market_id'))->slug;

            return "/{$market}/rooms/{$this->slug}";
        }

        return "/company/rooms/{$this->slug}";
    }

    public function isScavenger()
    {
        if ($this->scavenger_level >= 4) {
            return true;
        }

        return false;
    }

    public function getPitchAttribute()
    {
        if ($this->scavenger_level >= 4) {
            return 'This is a Scavenger Hunt Room, best for families & groups of all skills levels. To ensure you have the best experience possible, your personal gamemaster will join you in the room.';
        }

        return 'This is an Advanced Escape Room, best for enthusiasts & problem solvers.';
    }

    public function getIconUrlAttribute()
    {
        return $this->icon->url;
    }

    public function getYoutubeAttribute()
    {
        if ($this->video->source == 'youtube') {
            return $this->video->identifier;
        }

        return 'P_BWLv-PQfk';
    }

    public static function scopeFilter($query, $filters)
    {
        if (empty($filters)) {
            return $query;
        }

        foreach ($filters as $filterKey => $filterValue) {
            switch ($filterKey) {
                case 'slug':
                    $query->where($filterKey, $filterValue);

                    break;
                case 'location':
                    $query->whereHas('locations', function ($query) use ($filterValue) {
                        return $query->where('slug', $filterValue);
                    });

                    break;
            }
        }

        return $query;
    }

    public function scopeVisibleBy(Builder $query, UserInterface $user) : Builder
    {
        return $query;
    }

    public function findMarkets()
    {
        $rooms = Room::where('theme_id', $this->id)
            ->whereNull('closed_at')
            ->get();

        /** @var string $locationModel */
        $locationModel = app('location');
        $locationModelInstance = (new $locationModel)->query();

        $locations = $locationModelInstance->whereIn('id', $rooms->pluck('location_id'))
            ->whereNull('closed_at')
            ->get();

        /** @var Model $marketModel */
        $marketModel = app('market')->query();

        $markets = $marketModel->whereIn('id', $locations->pluck('market_id'))
            ->orderBy('state')
            ->orderBy('name')
            ->get();

        if ($markets->count() == 0) {
            return;
        }

        return $markets;
    }
}
