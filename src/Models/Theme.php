<?php namespace Tipoff\EscapeRoom\Models;

use Illuminate\Support\Facades\Session;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class Theme extends BaseModel
{
    use HasPackageFactory;

    protected $guarded = ['id'];

    protected $casts = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($theme) {
            if (auth()->check()) {
                $theme->creator_id = auth()->id();
            }
        });

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
            if (auth()->check()) {
                $theme->updater_id = auth()->id();
            }
        });
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function locations()
    {
        return $this->hasManyThrough(config('tipoff.model_class.location'), Room::class, 'theme_id', 'id', 'id', 'location_id');
    }

    public function supervision()
    {
        return $this->belongsTo(Supervision::class);
    }

    public function images()
    {
        return $this->belongsToMany(config('tipoff.model_class.image'))->withTimestamps();
    }

    public function image()
    {
        return $this->belongsTo(config('tipoff.model_class.image'));
    }

    public function icon()
    {
        return $this->belongsTo(config('tipoff.model_class.image'), 'icon_id');
    }

    public function poster()
    {
        return $this->belongsTo(config('tipoff.model_class.image'), 'poster_image_id');
    }

    public function video()
    {
        return $this->belongsTo(config('tipoff.model_class.video'));
    }

    public function creator()
    {
        return $this->belongsTo(config('tipoff.model_class.user'), 'creator_id');
    }

    public function updater()
    {
        return $this->belongsTo(config('tipoff.model_class.user'), 'updater_id');
    }

    public function getPathAttribute()
    {
        if (Session::get('current_market_id') != null) {
            /** @var string $marketModel */
            $marketModel = config('tipoff.model_class.market');
            $marketModelInstance = new $marketModel;

            $market = $marketModelInstance->find(Session::get('current_market_id'))->slug;

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

    public function scopeVisibleBy($query, $user)
    {
        return $query;
    }

    public function findMarkets()
    {
        $rooms = Room::where('theme_id', $this->id)
            ->whereNull('closed_at')
            ->get();

        /** @var string $locationModel */
        $locationModel = config('tipoff.model_class.location');
        $locationModelInstance = (new $locationModel)->query();

        $locations = $locationModelInstance->whereIn('id', $rooms->pluck('location_id'))
            ->whereNull('closed_at')
            ->get();

        /** @var string $marketModel */
        $marketModel = config('tipoff.model_class.market');
        $marketModelInstance = (new $marketModel)->query();

        $markets = $marketModelInstance->whereIn('id', $locations->pluck('market_id'))
            ->orderBy('state')
            ->orderBy('name')
            ->get();

        if ($markets->count() == 0) {
            return;
        }

        return $markets;
    }
}
