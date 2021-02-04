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
        return $this->hasMany(config('escape-room.model_class.theme'));
    }

    public function rooms()
    {
        return $this->hasMany(config('escape-room.model_class.room'));
    }

    public function slots()
    {
        return $this->hasMany(config('escape-room.model_class.slot'));
    }

    public function games()
    {
        return $this->hasMany(config('escape-room.model_class.game'));
    }
}