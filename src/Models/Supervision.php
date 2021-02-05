<?php namespace Tipoff\EscapeRoom\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervision extends Model
{
    use HasFactory;

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
