<?php

namespace Tipoff\EscapeRoom;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tipoff\EscapeRoom\EscapeRoom
 */
class EscapeRoomFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'escape-room';
    }
}
