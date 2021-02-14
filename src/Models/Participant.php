<?php

namespace Tipoff\EscapeRoom\Models;

use Tipoff\Support\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tipoff\Support\Traits\HasPackageFactory;

class Participant extends BaseModel
{
    use HasPackageFactory;
    use SoftDeletes;

    protected $casts = [
        'dob' => 'date',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(app('user'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedbacks()
    {
        return $this->hasMany(app('feedback'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function signatures()
    {
        return $this->hasMany(app('signature'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function bookings()
    {
        return $this->belongsToMany(app('booking'));
    }
}
