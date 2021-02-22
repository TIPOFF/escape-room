<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;

class EscapeRoomMarket extends BaseResource
{
    public static $model = \Tipoff\EscapeRoom\Models\EscapeRoomMarket::class;

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public static $group = 'Escape Rooms';

    //public function fieldsForIndex(NovaRequest $request)
    //{
    //    return array_filter([
    //        ID::make()->sortable(),
    //    ]);
    //}

    public function fields(Request $request)
    {
        return array_filter([
            Boolean::make('Corporate'),

            nova('location') ? BelongsTo::make('Location', 'location', nova('location'))->hideWhenUpdating()->required() : null,

            Markdown::make('Rooms Content'),

            Markdown::make('FAQ Content'),

            Markdown::make('Competitors Content'),

            new Panel('Data Fields', $this->dataFields()),
        ]);
    }

    protected function dataFields(): array
    {
        return array_filter([
            ID::make(),
            nova('user') ? BelongsTo::make('Created By', 'creator', nova('user'))->exceptOnForms() : null,
            DateTime::make('Created At')->exceptOnForms(),
            nova('user') ? BelongsTo::make('Updated By', 'updater', nova('user'))->exceptOnForms() : null,
            DateTime::make('Updated At')->exceptOnForms(),
        ]);
    }
}
