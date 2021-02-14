<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\PermissionRegistrar;

class AddEscapeRoomPermissions extends Migration
{
    public function up()
    {
        if (app()->has(Permission::class)) {
            app(PermissionRegistrar::class)->forgetCachedPermissions();

            foreach ([
                         'view rates',
                         'create rates',
                         'update rates',
                         'view supervisions',
                         'create supervisions',
                         'update supervisions',
                         'view themes',
                         'create themes',
                         'update themes',
                         'view rooms',
                         'create rooms',
                         'update rooms',
                         'view participants',
                         'create participants',
                         'update participants'
                     ] as $name) {
                app(Permission::class)::findOrCreate($name, null);
            };
        }
    }
}
