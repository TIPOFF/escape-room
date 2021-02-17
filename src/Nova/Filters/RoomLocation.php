<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Nova\Filters;

use Illuminate\Http\Request;

class RoomLocation extends Filters
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    public $name = 'Location';

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $availableFilters = [
        'room',
    ];

    /**
     * Filter the room query by a given location id.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function room(Request $request, $query, $value)
    {
        return $query->whereHas('room', function ($query) use ($value) {
            $query->where('rooms.location_id', $value);
        });
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return \Tipoff\Locations\Models\Location::pluck('id', 'name');
    }
}
