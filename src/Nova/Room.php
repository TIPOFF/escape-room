<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;

class Room extends BaseResource
{
    public static $model = \Tipoff\EscapeRoom\Models\Room::class;

    public static $orderBy = ['id' => 'asc'];

    public static $title = 'name';

    public static $group = 'Escape Rooms';

    public static $perPageViaRelationship = 20;

    /** @psalm-suppress UndefinedClass */
    protected array $filterClassList = [
        \Tipoff\Locations\Nova\Filters\Location::class,
    ];

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            Text::make('Name'),
            nova('location') ? BelongsTo::make('Location', 'location', nova('location'))->sortable() : null,
            nova('escaperoom_theme') ? BelongsTo::make('Theme', 'escaperoom_theme', nova('escaperoom_theme'))->sortable() : null,
            nova('escaperoom_rate') ? BelongsTo::make('Rate', 'escaperoom_rate', nova('escaperoom_rate'))->sortable() : null,
            Number::make('Max Participants Public', 'participants')->sortable(),
            Number::make('Max Participants Private', 'participants_private')->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Name')->exceptOnForms(),
            nova('location') ? BelongsTo::make('Location', 'location', nova('location'))->hideWhenUpdating()->required() : null,
            nova('escaperoom_theme') ? BelongsTo::make('Theme', 'escaperoom_theme', nova('escaperoom_theme'))->hideWhenUpdating()->required() : null,
            nova('escaperoom_rate') ? BelongsTo::make('Rate', 'escaperoom_rate', nova('escaperoom_rate'))->required() : null,
            Number::make('Max Participants Public', 'participants')->min(1)->max(20)->step(1)->nullable(),
            Number::make('Max Participants Private', 'participants_private')->min(1)->max(30)->step(1)->nullable(),

            new Panel('Extra Room Fields', $this->extraFields()),

            nova('recurring_schedule') ? HasMany::make('Recurring schedules', 'recurringSchedules', nova('recurring_schedule')) : null,

            new Panel('Override Theme Fields', $this->overrideFields()),

            // HasMany::make('Games'),
            nova('slot') ? HasMany::make('Slots', 'slots', nova('slot')) : null,
            nova('schedule_eraser') ? HasMany::make('Schedule erasers', 'scheduleErasers', nova('schedule_eraser')) : null,

            new Panel('Data Fields', $this->dataFields()),
        ]);
    }

    protected function extraFields()
    {
        return array_filter([
            Number::make('Reset Time (Minutes)', 'reset_time')->min(1)->max(120)->step(1)->hideWhenCreating()->nullable(),
            Number::make('Occupied Time (Minutes)', 'occupied_time')->min(1)->max(120)->step(1)->hideWhenCreating()->nullable(),
            Date::make('Opened', 'opened_at')->nullable(),
            Date::make('Closed', 'closed_at')->hideWhenCreating()->nullable(),
            nova('supervision') ? BelongsTo::make('Default Supervision', 'supervision', nova('supervision'))->hideWhenCreating()->nullable() : null,
            Number::make('Priority')->min(1)->max(20)->step(1)->hideWhenCreating()->nullable(),
            Markdown::make('Note')->alwaysShow()->hideWhenCreating()->nullable(),
        ]);
    }

    protected function overrideFields()
    {
        return array_filter([
            // Text::make('Title')->nullable(),
            Textarea::make('Excerpt')->alwaysShow()->hideWhenCreating()->nullable(),
            Textarea::make('Description')->alwaysShow()->hideWhenCreating()->nullable(),
            nova('image') ? BelongsTo::make('Image', 'image', nova('image'))->hideWhenCreating()->nullable()->showCreateRelationButton() : null,
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
