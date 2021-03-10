<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddEscapeRoomPermissions extends BasePermissionsMigration
{
    public function up()
    {

        $permissions = [
             'view rates' => ['Owner', 'Staff'],
             'create rates' => ['Owner'],
             'update rates' => ['Owner'],
             'view supervisions' => ['Owner', 'Staff'],
             'create supervisions' => ['Owner'],
             'update supervisions' => ['Owner'],
             'view themes' => ['Owner', 'Staff'],
             'create themes' => ['Owner'],
             'update themes' => ['Owner'],
             'view rooms' => ['Owner', 'Staff'],
             'create rooms' => ['Owner'],
             'update rooms' => ['Owner'],
             'view escape room locations' => ['Owner', 'Staff'],
             'create escape room locations' => ['Owner'],
             'update escape room locations' => ['Owner'],
             'view escape room markets' => ['Owner', 'Staff'],
             'create escape room markets' => ['Owner'],
             'update escape room markets' => ['Owner']
        ];

        $this->createPermissions($permissions);
    }
}
