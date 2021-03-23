<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;

class EscaperoomMarket extends BaseResource
{
    public static $model = \Tipoff\EscapeRoom\Models\EscaperoomMarket::class;

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public static $group = 'Escape Rooms';

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Boolean::make('Corporate'),

            nova('market') ? BelongsTo::make('Market', 'market', nova('market'))->hideWhenUpdating()->required() : null,

            Markdown::make('Rooms Content'),

            Markdown::make('FAQ Content'),

            Markdown::make('Competitors Content'),

            new Panel('Data Fields', $this->dataFields()),
        ]);
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
