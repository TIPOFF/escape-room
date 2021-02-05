<?php

return [

    'model_class' => [

        'user' => \App\Models\User::class,

        'slot' => \App\Models\Slot::class,

        'booking' => \App\Models\Booking::class,

        'schedule' => \App\Models\Schedule::class,

        'schedule_eraser' => \App\Models\ScheduleEraser::class,

        'signature' => \App\Models\Signature::class,

        'recurring_schedule' => \App\Models\RecurringSchedule::class,

        'game' => \App\Models\Game::class,

        'location' => \App\Models\Location::class,

        'market' => \App\Models\Market::class,

        'image' => \DrewRoberts\Media\Models\Image::class,

        'video' => \DrewRoberts\Media\Models\Video::class,

    ]

];
