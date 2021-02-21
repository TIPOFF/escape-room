<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\EscapeRoomLocation;
use Tipoff\EscapeRoom\Tests\TestCase;
use Tipoff\Support\Contracts\Models\UserInterface;

class EscapeRoomLocationPolicyTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function view_any()
    {
        $user = self::createPermissionedUser('view escape room locations', true);
        $this->assertTrue($user->can('viewAny', EscapeRoomLocation::class));

        $user = self::createPermissionedUser('view escape room locations', false);
        $this->assertFalse($user->can('viewAny', EscapeRoomLocation::class));
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_as_creator
     * @param string $permission
     * @param UserInterface $user
     * @param bool $expected
     */
    public function all_permissions_as_creator(string $permission, UserInterface $user, bool $expected)
    {
        $room = EscapeRoomLocation::factory()->make([
            'creator_id' => $user,
        ]);

        $this->assertEquals($expected, $user->can($permission, $room));
    }

    public function data_provider_for_all_permissions_as_creator()
    {
        return [
            'view-true' => [ 'view', self::createPermissionedUser('view escape room locations', true), true ],
            'view-false' => [ 'view', self::createPermissionedUser('view escape room locations', false), false ],
            'create-true' => [ 'create', self::createPermissionedUser('create escape room locations', true), true ],
            'create-false' => [ 'create', self::createPermissionedUser('create escape room locations', false), false ],
            'update-true' => [ 'update', self::createPermissionedUser('update escape room locations', true), true ],
            'update-false' => [ 'update', self::createPermissionedUser('update escape room locations', false), false ],
            'delete-true' => [ 'delete', self::createPermissionedUser('delete escape room locations', true), false ],
            'delete-false' => [ 'delete', self::createPermissionedUser('delete escape room locations', false), false ],
        ];
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_not_creator
     * @param string $permission
     * @param UserInterface $user
     * @param bool $expected
     */
    public function all_permissions_not_creator(string $permission, UserInterface $user, bool $expected)
    {
        $room = EscapeRoomLocation::factory()->make();

        $this->assertEquals($expected, $user->can($permission, $room));
    }

    public function data_provider_for_all_permissions_not_creator()
    {
        // Permissions are identical for creator or others
        return $this->data_provider_for_all_permissions_as_creator();
    }
}
