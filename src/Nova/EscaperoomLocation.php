<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Nova;

use DrewRoberts\Media\Nova\Image;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;

class EscaperoomLocation extends BaseResource
{
    public static $model = \Tipoff\EscapeRoom\Models\EscaperoomLocation::class;

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public static $group = 'Escape Rooms';

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            nova('location') ? BelongsTo::make('Location', 'location', nova('location')) : null,
            Number::make('Booking Cutoff')->sortable(),
            Boolean::make('Corporate')->sortable(),
            Boolean::make('Covid')->sortable(),
            Text::make('Team Names')->sortable(),
            nova('image') ? BelongsTo::make('team_photo', 'teamPhoto', nova('image')) : null,
            Boolean::make('Booking Cutoff')->sortable(),
            Boolean::make('Use Iframe')->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Boolean::make('Corporate'),

            Number::make('Booking Cutoff')->rules(['required','max:3']),

            nova('location') ? BelongsTo::make('Location', 'location', nova('location'))->rules(['required','unique:escaperoom_locations,location_id'])->hideWhenUpdating() : null,

            new Panel('Location Team', $this->teamFields()),

            new Panel('Booking Fields', $this->bookingFields()),

            new Panel('Data Fields', $this->dataFields()),
        ]);
    }

    protected function teamFields()
    {
        return [
            Text::make('Team Names')->nullable(),
            BelongsTo::make('Team Photo', 'teamPhoto', Image::class)->nullable()->showCreateRelationButton(),
        ];
    }

    protected function bookingFields()
    {
        return [
            Boolean::make('Covid'),
            Boolean::make('Use Iframe?', 'use_iframe'),
            Textarea::make('Booking Iframe')->nullable(),
        ];
    }

    protected function dataFields(): array
    {
        return array_merge(
            parent::dataFields(),
            $this->creatorDataFields(),
            $this->updaterDataFields(),
        );
    }
}
