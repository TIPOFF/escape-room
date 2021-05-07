<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Models;

use Assert\Assert;
use Illuminate\Database\Eloquent\Builder;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class Room extends BaseModel
{
    use HasCreator;
    use HasUpdater;
    use HasPackageFactory;

    protected $casts = [
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    protected $appends = ['icon_url'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($room) {
            Assert::lazy()
                ->that($room->location_id)->notEmpty('An escape room must be at a location.')
                ->that($room->escaperoom_theme_id)->notEmpty('An escape room must have a theme.')
                ->that($room->escaperoom_rate_id)->notEmpty('An escape room must have a default rate.')
                ->verifyNow();
            if (empty($room->supervision_id)) {
                $room->supervision_id = $room->theme->supervision_id;
            }
            if (empty($room->opened_at)) {
                $room->opened_at = '2020-01-01';
            }
            if (empty($room->participants)) {
                $room->participants = 8;
            }
            if (empty($room->participants_private)) {
                $room->participants_private = 8;
            }
            if (empty($room->reset_time)) {
                $room->reset_time = 30;
            }
            if (empty($room->occupied_time)) {
                $room->occupied_time = $room->theme->occupied_time;
            }
            if (empty($room->priority)) {
                $room->priority = 10; // A higher priority shows the room higher on the market page, a priority of 1 shows the room on the bottom of the market page.
            }
        });

        static::addGlobalScope('open', function (Builder $builder) {
            // @todo Update this to look at both opened_at and closed_at and make sure current date is between
            $builder->whereNull('rooms.closed_at');
        });
    }

    public function getTitleAttribute()
    {
        // Check if the location has multiple rooms with same theme. Will need to edit later for accurate count.
        if (self::where('location_id', $this->location_id)->where('escaperoom_theme_id', $this->escaperoom_theme_id)->count() > 1) {
            return "{$this->theme->title} #{$this->id}";
        }

        // If only room at the location with the theme, return theme title
        return $this->theme->title;
    }

    public function getNameAttribute()
    {
        // Check if the location has multiple rooms with same theme. Will need to edit later for accurate count.
        if (self::where('location_id', $this->location_id)->where('escaperoom_theme_id', $this->escaperoom_theme_id)->count() > 1) {
            return "{$this->location->abbreviation} {$this->theme->name} #{$this->id}";
        }

        // If only room at the location with the theme, return theme title
        return "{$this->location->abbreviation} {$this->theme->name}";
    }

    public function getPathAttribute()
    {
        return "/{$this->location->market->slug}/rooms/{$this->theme->slug}";
    }

    public function location()
    {
        return $this->belongsTo(app('location'));
    }

    public function escaperoom_location()
    {
        return $this->belongsTo(EscaperoomLocation::class, 'location_id', 'location_id');
    }

    public function theme()
    {
        return $this->belongsTo(app('escaperoom_theme'), 'escaperoom_theme_id');
    }

    public function rate()
    {
        return $this->belongsTo(app('escaperoom_rate'), 'escaperoom_rate_id');
    }

    public function supervision()
    {
        return $this->belongsTo(app('supervision'));
    }

    public function image()
    {
        return $this->belongsTo(app('image'));
    }

    public function schedules()
    {
        return $this->hasMany(app('schedule'));
    }

    public function scheduleErasers()
    {
        return $this->hasMany(app('schedule_eraser'));
    }

    public function signatures()
    {
        return $this->hasMany(app('signature'));
    }

    public function games()
    {
        return $this->hasMany(app('game'));
    }

    public function slots()
    {
        return $this->hasMany(app('slot'));
    }

    public function isComing()
    {
        return $this->opened_at->isFuture();
    }

    public function getPitchAttribute()
    {
        return $this->theme->pitch;
    }

    public function getIconUrlAttribute()
    {
        if (empty($this->theme->icon)) {
            return;
        }

        return $this->theme->icon->url;
    }

    public function getYoutubeAttribute()
    {
        return $this->theme->youtube;
    }

    public function recurringSchedules()
    {
        return $this->hasMany(app('recurring_schedule'));
    }

    /**
     * Check if room got existing slots at certain time.
     *
     * @param string $dateTime
     * @return bool
     */
    public function hasSlotsAt($dateTime)
    {
        if (is_string($dateTime)) {
            $dateTime = $this->location->toLocalDateTime($dateTime);
        }

        return $this
            ->slots()
            ->where('start_at', '<', $dateTime)
            ->where('room_available_at', '>', $dateTime)
            ->exists();
    }

    public static function scopeFilter($query, $filters)
    {
        if (empty($filters)) {
            return $query;
        }

        foreach ($filters as $filterKey => $filterValue) {
            switch ($filterKey) {
                case 'location':
                    $query->whereHas('location', function ($query) use ($filterValue) {
                        return $query->where('slug', $filterValue);
                    });

                    break;
            }
        }

        return $query;
    }

    public function booking()
    {
        return $this->morphMany(app('booking'), 'subject');
    }
}
