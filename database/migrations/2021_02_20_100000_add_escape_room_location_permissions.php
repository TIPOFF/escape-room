<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\PermissionRegistrar;

class AddEscapeRoomLocationPermissions extends Migration
{
    public function up()
    {
        if (app()->has(Permission::class)) {
            app(PermissionRegistrar::class)->forgetCachedPermissions();

            $permissions = [
                'view escape room locations',
                'create escape room locations',
                'update escape room locations'
            ];

            foreach ($permissions as $permission) {
                app(Permission::class)::findOrCreate($permission, null);
            };
        }
    }
}
