<?php namespace Tipoff\EscapeRoom\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    protected $appends = ['icon_url'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($room) {
            if (auth()->check()) {
                $room->creator_id = auth()->id();
            }
        });

        static::saving(function ($room) {
            if (empty($room->location_id)) {
                throw new \Exception('An escape room must be at a location.');
            }
            if (empty($room->theme_id)) {
                throw new \Exception('An escape room must have a theme.');
            }
            if (empty($room->rate_id)) {
                throw new \Exception('An escape room must have a default rate.');
            }
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
            if (auth()->check()) {
                $room->updater_id = auth()->id();
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
        if (self::where('location_id', $this->location_id)->where('theme_id', $this->theme_id)->count() > 1) {
            return "{$this->theme->title} #{$this->id}";
        }

        // If only room at the location with the theme, return theme title
        return $this->theme->title;
    }

    public function getNameAttribute()
    {
        // Check if the location has multiple rooms with same theme. Will need to edit later for accurate count.
        if (self::where('location_id', $this->location_id)->where('theme_id', $this->theme_id)->count() > 1) {
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
        return $this->belongsTo(config('support.model_class.location'));
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function rate()
    {
        return $this->belongsTo(Rate::class);
    }

    public function supervision()
    {
        return $this->belongsTo(Supervision::class);
    }

    public function image()
    {
        return $this->belongsTo(config('support.model_class.image'));
    }

    public function schedules()
    {
        return $this->hasMany(config('support.model_class.schedule'));
    }

    public function scheduleErasers()
    {
        return $this->hasMany(config('support.model_class.schedule_eraser'));
    }

    public function signatures()
    {
        return $this->hasMany(config('support.model_class.signature'));
    }

    public function games()
    {
        return $this->hasMany(config('support.model_class.game'));
    }

    public function slots()
    {
        return $this->hasMany(config('support.model_class.slot'));
    }

    public function creator()
    {
        return $this->belongsTo(config('support.model_class.user'), 'creator_id');
    }

    public function updater()
    {
        return $this->belongsTo(config('support.model_class.user'), 'updater_id');
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
        return $this->hasMany(config('support.model_class.recurring_schedule'));
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
}
