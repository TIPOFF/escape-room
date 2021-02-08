<?php namespace Tipoff\EscapeRoom\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class Supervision extends BaseModel
{
    use HasPackageFactory;

    protected $guarded = ['id'];

    protected $casts = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function themes()
    {
        return $this->hasMany(Theme::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function slots()
    {
        return $this->hasMany(config('tipoff.model_class.slot'));
    }

    public function games()
    {
        return $this->hasMany(config('tipoff.model_class.game'));
    }
}
