<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;

class EscaperoomTheme extends BaseResource
{
    public static $model = \Tipoff\EscapeRoom\Models\EscaperoomTheme::class;

    public static $title = 'name';

    public static $search = [
        'name',
        'title',
    ];

    public static $group = 'Escape Rooms';

    public function fieldsForIndex(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug')->sortable(),
            Text::make('Name')->sortable(),
        ];
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Name')->required(),
            Slug::make('Slug')->from('Name'),
            Text::make('Title')->required(),
            Text::make('Full Title')->required(),
            Number::make('Duration (Minutes)', 'duration')->min(0)->max(150)->step(1)->nullable(),
            Number::make('Occupied Time (Minutes)', 'occupied_time')->min(0)->max(150)->step(1)->nullable(),
            Number::make('Scavenger Level')->min(0)->max(5)->step(1)->nullable(),
            Number::make('Puzzle Level')->min(0)->max(5)->step(1)->nullable(),
            Number::make('Escape Rate')->min(0)->max(100)->step(1)->nullable(),

            new Panel('Info Fields', $this->infoFields()),

            nova('image') ? BelongsTo::make('Image', 'image', nova('image')) : null,

            new Panel('Media Fields', $this->mediaFields()),

            nova('room') ? HasMany::make('Rooms', 'rooms', nova('room')) : null,

            new Panel('Data Fields', $this->dataFields()),

        ]);
    }

    protected function infoFields()
    {
        return array_filter([
            Text::make('Excerpt')->nullable(),
            Textarea::make('Description')->rows(3)->alwaysShow()->nullable(),
            Markdown::make('Synopsis')->alwaysShow()->nullable(),
            Markdown::make('Story')->alwaysShow()->nullable(),
            Markdown::make('Info')->alwaysShow()->nullable(),
            nova('supervision') ? BelongsTo::make('Supervision', 'supervision', nova('supervision'))->nullable() : null,
        ]);
    }

    protected function mediaFields()
    {
        return array_filter([
            nova('image') ? BelongsTo::make('Image', 'image', nova('image'))->nullable()->showCreateRelationButton() : null,
            nova('icon') ? BelongsTo::make('Icon', 'icon', nova('icon'))->nullable()->showCreateRelationButton() : null,
            nova('poster') ? BelongsTo::make('Poster', 'poster', nova('poster'))->nullable()->showCreateRelationButton() : null,
            nova('video') ? BelongsTo::make('Video', 'video', nova('video'))->nullable()->showCreateRelationButton() : null,
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
