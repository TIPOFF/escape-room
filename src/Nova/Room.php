<?php

namespace Tipoff\EspaceRoom\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\EscapeRoom\Nova\Filters\Location;
use Tipoff\Support\Nova\BaseResource;

class Room extends BaseResource
{
    public static $model = \Tipoff\EscapeRoom\Models\Room::class;

    public static $orderBy = ['id' => 'asc'];

    public static $title = 'name';

    public static $search = [
        'name',
    ];

    public static $group = 'Escape Rooms';

    public static $perPageViaRelationship = 20;

    public function fieldsForIndex(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Name'),
            BelongsTo::make('Location', 'location', nova('location'))->sortable(),
            BelongsTo::make('Theme', 'theme', nova('theme'))->sortable(),
            BelongsTo::make('Rate', 'rate', nova('rate'))->sortable(),
            Number::make('Max Participants Public', 'participants')->sortable(),
            Number::make('Max Participants Private', 'participants_private')->sortable(),
        ];
    }

    public function fields(Request $request)
    {
        return [
            Text::make('Name')->exceptOnForms(),
            BelongsTo::make('Location', 'location', nova('location'))->hideWhenUpdating()->required(),
            BelongsTo::make('Theme', 'theme', nova('theme'))->hideWhenUpdating()->required(),
            BelongsTo::make('Rate', 'rate', nova('rate'))->required(),
            Number::make('Max Participants Public', 'participants')->min(1)->max(20)->step(1)->nullable(),
            Number::make('Max Participants Private', 'participants_private')->min(1)->max(30)->step(1)->nullable(),

            new Panel('Extra Room Fields', $this->extraFields()),

            HasMany::make('Recurring schedules', 'recurringSchedules', nova('recurring_schedule')),

            new Panel('Override Theme Fields', $this->overrideFields()),

            // HasMany::make('Games'),
            HasMany::make('Slots', 'slots', nova('slot')),
            HasMany::make('Schedule erasers', 'scheduleErasers', nova('schedule_eraser')),

            new Panel('Data Fields', $this->dataFields()),
        ];
    }

    protected function extraFields()
    {
        return [
            Number::make('Reset Time (Minutes)', 'reset_time')->min(1)->max(120)->step(1)->hideWhenCreating()->nullable(),
            Number::make('Occupied Time (Minutes)', 'occupied_time')->min(1)->max(120)->step(1)->hideWhenCreating()->nullable(),
            Date::make('Opened', 'opened_at')->nullable(),
            Date::make('Closed', 'closed_at')->hideWhenCreating()->nullable(),
            BelongsTo::make('Default Supervision', 'supervision', nova('supervision'))->hideWhenCreating()->nullable(),
            Number::make('Priority')->min(1)->max(20)->step(1)->hideWhenCreating()->nullable(),
            Markdown::make('Note')->alwaysShow()->hideWhenCreating()->nullable(),
        ];
    }

    protected function overrideFields()
    {
        return [
            // Text::make('Title')->nullable(),
            Textarea::make('Excerpt')->alwaysShow()->hideWhenCreating()->nullable(),
            Textarea::make('Description')->alwaysShow()->hideWhenCreating()->nullable(),
            BelongsTo::make('Image', 'image', nova('image'))->hideWhenCreating()->nullable()->showCreateRelationButton(),
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
        return [
            new Location,
        ];
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
