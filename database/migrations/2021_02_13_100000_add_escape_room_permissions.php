<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddEscapeRoomPermissions extends BasePermissionsMigration
{
    public function up()
    {

        $permissions = [
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
             'view escape room locations',
             'create escape room locations',
             'update escape room locations',
             'view escape room markets',
             'create escape room markets',
             'update escape room markets'
        ];

        $this->createPermissions($permissions);
    }
}
