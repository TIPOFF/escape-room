<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Http\Controllers;

use Tipoff\EscapeRoom\Models\EscaperoomTheme;
use Tipoff\Locations\Models\Market;
use Tipoff\Support\Http\Controllers\BaseController;

class EscaperoomThemeController extends BaseController
{
    public function index(?Market $market = null)
    {
        $themes = $market ? EscaperoomTheme::query()->byMarket($market)->get() : EscaperoomTheme::all();

        return view(config('escape-room.views.theme_listing'))->with([
            'market' => $market,
            'themes' => $themes,
        ]);
    }

    public function show(EscaperoomTheme $theme)
    {
        return view(config('escape-room.views.theme'))->with([
            'market' => null,
            'theme' => $theme,
        ]);
    }

    public function marketShow(Market $market, EscaperoomTheme $theme)
    {
        return view(config('escape-room.views.theme'))->with([
            'market' => $market,
            'theme' => $theme,
        ]);
    }
}
