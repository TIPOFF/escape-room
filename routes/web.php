<?php

declare(strict_types=1);

use DrewRoberts\Blog\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Tipoff\EscapeRoom\Http\Controllers\EscaperoomThemeController;

Route::middleware(config('tipoff.web.middleware_group'))
    ->prefix(config('tipoff.web.uri_prefix'))
    ->group(function () {

        Route::get('/company/rooms', [EscaperoomThemeController::class, 'index'])->name('escape-room.theme-listing');
        Route::get('/company/rooms/{theme}', [EscaperoomThemeController::class, 'show'])->name('escape-room.theme');

        Route::get('/{market}/rooms', [EscaperoomThemeController::class, 'index'])->name('escape-room.market-theme-listing');
        Route::get('/{market}/rooms/{theme}', [EscaperoomThemeController::class, 'marketShow'])->name('escape-room.market-theme');
    });
