<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddEscapeRoomPermissions extends BasePermissionsMigration
{
    public function up()
    {

        $permissions = [
             'view rates' => ['Owner', 'Executive', 'Staff'],
             'create rates' => ['Owner', 'Executive'],
             'update rates' => ['Owner', 'Executive'],
             'view supervisions' => ['Owner', 'Executive', 'Staff'],
             'create supervisions' => ['Owner', 'Executive'],
             'update supervisions' => ['Owner', 'Executive'],
             'view themes' => ['Owner', 'Executive', 'Staff'],
             'create themes' => ['Owner', 'Executive'],
             'update themes' => ['Owner', 'Executive'],
             'view rooms' => ['Owner', 'Executive', 'Staff'],
             'create rooms' => ['Owner', 'Executive'],
             'update rooms' => ['Owner', 'Executive'],
             'view escape room locations' => ['Owner', 'Executive', 'Staff'],
             'create escape room locations' => ['Owner', 'Executive'],
             'update escape room locations' => ['Owner', 'Executive'],
             'view escape room markets' => ['Owner', 'Executive', 'Staff'],
             'create escape room markets' => ['Owner', 'Executive'],
             'update escape room markets' => ['Owner', 'Executive']
        ];

        $this->createPermissions($permissions);
    }
}
