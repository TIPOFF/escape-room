<?php

namespace Tipoff\EscapeRoom\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;

class Supervision extends BaseResource
{
    public static $model = \Tipoff\EscapeRoom\Models\Supervision::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'slug',
        'name',
        'title',
    ];

    public static $group = 'Operations Units';

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make(),
            Text::make('Name')->sortable(),
            Text::make('Title')->sortable(),
            Text::make('Slug')->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Name (Internal)', 'name')->required(),
            Text::make('Title (What Customers See)', 'title')->required(),
            Slug::make('Slug')->from('Title'),
            Text::make('Excerpt')->required(),
            Textarea::make('Description')->nullable(),
            Markdown::make('Details')->nullable(),

            new Panel('Data Fields', $this->dataFields()),

            nova('theme') ? HasMany::make('Themes', 'themes', nova('theme')) : null,
            nova('room') ? HasMany::make('Rooms', 'rooms', nova('room')) : null,
            nova('slot') ? HasMany::make('Slots', 'slots', nova('slot')) : null,
            nova('game') ? HasMany::make('Games', 'games', nova('game')) : null,
        ]);
    }

    protected function dataFields(): array
    {
        return [
            ID::make(),
            DateTime::make('Created At')->exceptOnForms(),
            DateTime::make('Updated At')->exceptOnForms(),
        ];
    }
}
