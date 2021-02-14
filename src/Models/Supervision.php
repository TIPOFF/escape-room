<?php 

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class Supervision extends BaseModel
{
    use HasPackageFactory;

    protected $casts = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function themes()
    {
        return $this->hasMany(app('theme'));
    }

    public function rooms()
    {
        return $this->hasMany(app('room'));
    }

    public function slots()
    {
        return $this->hasMany(app('slot'));
    }

    public function games()
    {
        return $this->hasMany(app('game'));
    }
}
