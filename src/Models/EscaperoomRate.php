<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;
use Tipoff\Support\Contracts\Booking\BookingRateInterface;

class EscaperoomRate extends BaseModel /*implements BookingRateInterface*/
{
    use HasCreator;
    use HasUpdater;
    use HasPackageFactory;

    protected $casts = [];

    public $amount;

    protected static function boot()
    {
        parent::boot();


        static::saving(function ($rate) {
            if (empty($rate->name)) {
                throw new \Exception('A rate must have a name.');
            }
            if (empty($rate->slug)) {
                throw new \Exception('A rate must have a slug.');
            }
            if (empty($rate->public_1)) {
                throw new \Exception('A rate must have a base public rate.');
            }
            if (empty($rate->private_1)) {
                throw new \Exception('A rate must have a base private rate.');
            }
            if (empty($rate->public_2)) {
                $rate->public_2 = $rate->public_1;
            }
            if (empty($rate->public_3)) {
                $rate->public_3 = $rate->public_2;
            }
            if (empty($rate->public_4)) {
                $rate->public_4 = $rate->public_3;
            }
            if (empty($rate->public_5)) {
                $rate->public_5 = $rate->public_4;
            }
            if (empty($rate->public_6)) {
                $rate->public_6 = $rate->public_5;
            }
            if (empty($rate->public_7)) {
                $rate->public_7 = $rate->public_6;
            }
            if (empty($rate->public_8)) {
                $rate->public_8 = $rate->public_7;
            }
            if (empty($rate->public_9)) {
                $rate->public_9 = $rate->public_8;
            }
            if (empty($rate->public_10)) {
                $rate->public_10 = $rate->public_9;
            }
            if (empty($rate->private_2)) {
                $rate->private_2 = $rate->private_1;
            }
            if (empty($rate->private_3)) {
                $rate->private_3 = $rate->private_2;
            }
            if (empty($rate->private_4)) {
                $rate->private_4 = $rate->private_3;
            }
            if (empty($rate->private_5)) {
                $rate->private_5 = $rate->private_4;
            }
            if (empty($rate->private_6)) {
                $rate->private_6 = $rate->private_5;
            }
            if (empty($rate->private_7)) {
                $rate->private_7 = $rate->private_6;
            }
            if (empty($rate->private_8)) {
                $rate->private_8 = $rate->private_7;
            }
            if (empty($rate->private_9)) {
                $rate->private_9 = $rate->private_8;
            }
            if (empty($rate->private_10)) {
                $rate->private_10 = $rate->private_9;
            }
            if (empty($rate->private_11)) {
                $rate->private_11 = $rate->private_10;
            }
            if (empty($rate->private_12)) {
                $rate->private_12 = $rate->private_11;
            }
            if (empty($rate->private_13)) {
                $rate->private_13 = $rate->private_12;
            }
            if (empty($rate->private_14)) {
                $rate->private_14 = $rate->private_13;
            }
            if (empty($rate->private_15)) {
                $rate->private_15 = $rate->private_14;
            }
            if (empty($rate->private_16)) {
                $rate->private_16 = $rate->private_15;
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Generate amount.
     *
     * @param int $participants
     * @param bool $isPrivate
     * @return int
     */
    public function generateAmount(int $participants, bool $isPrivate): int
    {
        $key = ($isPrivate) ? 'private_' : 'public_';
        $key = $key.$participants;

        $this->amount = $this->$key * $participants;

        return $this->amount;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms()
    {
        return $this->hasMany(app('room'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slots()
    {
        return $this->hasMany(app('slot'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(app('booking'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schedules()
    {
        return $this->hasMany(app('schedule'));
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getLabel(): string
    {
        // @todo: implement getLabel
        return "";
    }

    public function getSlug(): string
    {
        // @todo: implement getSlug
        return "";
    }

    public function category(): Relation
    {
        // @todo: implement category
        return null;
    }

    public function getCategory(): BookingRateCategoryInterface
    {
        // @todo: implement getCategory
        return null;
    }

    public function getParticipantsLimit(): ?int
    {
        // @todo: implement getParticipantsLimit
        return 1;
    }
}
