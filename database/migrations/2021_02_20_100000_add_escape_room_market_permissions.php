<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\PermissionRegistrar;

class AddEscapeRoomMarketPermissions extends Migration
{
    public function up()
    {
        if (app()->has(Permission::class)) {
            app(PermissionRegistrar::class)->forgetCachedPermissions();

            $permissions = [
                'view escape room markets',
                'create escape room markets',
                'update escape room markets'
            ];

            foreach ($permissions as $permission) {
                app(Permission::class)::findOrCreate($permission, null);
            };
        }
    }
}
