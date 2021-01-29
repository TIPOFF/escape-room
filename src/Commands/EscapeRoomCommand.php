<?php

namespace Tipoff\EscapeRoom\Commands;

use Illuminate\Console\Command;

class EscapeRoomCommand extends Command
{
    public $signature = 'escape-room';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
