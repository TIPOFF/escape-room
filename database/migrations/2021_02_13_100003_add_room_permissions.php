<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\PermissionRegistrar;

class AddRoomPermissions extends Migration
{
    public function up()
    {
        if (app()->has(Permission::class)) {
            app(PermissionRegistrar::class)->forgetCachedPermissions();

            foreach ([
                         'view rooms',
                         'create rooms',
                         'update rooms'
                     ] as $name) {
                app(Permission::class)::findOrCreate($name, null);
            };
        }
    }
}