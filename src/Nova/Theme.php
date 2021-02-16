<?php

namespace Tipoff\EspaceRoom\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
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

class Theme extends BaseResource
{
    public static $model = \Tipoff\EscapeRoom\Models\Theme::class;

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
        return [
            Text::make('Name')->required(),
            Slug::make('Slug')->from('Name'),
            Text::make('Title')->required(),
            Number::make('Duration (Minutes)', 'duration')->min(0)->max(150)->step(1)->nullable(),
            Number::make('Occupied Time (Minutes)', 'occupied_time')->min(0)->max(150)->step(1)->nullable(),
            Number::make('Scavenger Level')->min(0)->max(5)->step(1)->nullable(),
            Number::make('Puzzle Level')->min(0)->max(5)->step(1)->nullable(),
            Number::make('Escape Rate')->min(0)->max(100)->step(1)->nullable(),

            new Panel('Info Fields', $this->infoFields()),

            BelongsToMany::make('Images', 'images', nova('image')),

            new Panel('Media Fields', $this->mediaFields()),

            HasMany::make('Rooms', 'rooms', nova('room')),

            new Panel('Data Fields', $this->dataFields()),

        ];
    }

    protected function infoFields()
    {
        return [
            Text::make('Excerpt')->nullable(),
            Textarea::make('Description')->rows(3)->alwaysShow()->nullable(),
            Markdown::make('Synopsis')->alwaysShow()->nullable(),
            Markdown::make('Story')->alwaysShow()->nullable(),
            Markdown::make('Info')->alwaysShow()->nullable(),
            BelongsTo::make('Supervision', 'supervision', nova('supervision'))->nullable(),
        ];
    }

    protected function mediaFields()
    {
        return [
            BelongsTo::make('Image', 'image', nova('image'))->nullable()->showCreateRelationButton(),
            BelongsTo::make('Icon', 'icon', nova('icon'))->nullable()->showCreateRelationButton(),
            BelongsTo::make('Poster', 'poster', nova('poster'))->nullable()->showCreateRelationButton(),
            BelongsTo::make('Video', 'video', nova('video'))->nullable()->showCreateRelationButton(),
        ];
    }

    protected function dataFields(): array
    {
        return [
            ID::make(),
            BelongsTo::make('Created By', 'creator', nova('user'))->exceptOnForms(),
            DateTime::make('Created At')->exceptOnForms(),
            BelongsTo::make('Updated By', 'updater', nova('user'))->exceptOnForms(),
            DateTime::make('Updated At')->exceptOnForms(),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }
}
