<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\EscapeRoomTheme;
use Tipoff\EscapeRoom\Tests\TestCase;
use Tipoff\Support\Contracts\Models\UserInterface;

class EscapeRoomThemePolicyTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function view_any()
    {
        $user = self::createPermissionedUser('view themes', true);
        $this->assertTrue($user->can('viewAny', EscapeRoomTheme::class));

        $user = self::createPermissionedUser('view themes', false);
        $this->assertFalse($user->can('viewAny', EscapeRoomTheme::class));
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_as_creator
     */
    public function all_permissions_as_creator(string $permission, UserInterface $user, bool $expected)
    {
        $theme = EscapeRoomTheme::factory()->make([
            'creator_id' => $user,
        ]);

        $this->assertEquals($expected, $user->can($permission, $theme));
    }

    public function data_provider_for_all_permissions_as_creator()
    {
        return [
            'view-true' => [ 'view', self::createPermissionedUser('view themes', true), true ],
            'view-false' => [ 'view', self::createPermissionedUser('view themes', false), false ],
            'create-true' => [ 'create', self::createPermissionedUser('create themes', true), true ],
            'create-false' => [ 'create', self::createPermissionedUser('create themes', false), false ],
            'update-true' => [ 'update', self::createPermissionedUser('update themes', true), true ],
            'update-false' => [ 'update', self::createPermissionedUser('update themes', false), false ],
            'delete-true' => [ 'delete', self::createPermissionedUser('delete themes', true), false ],
            'delete-false' => [ 'delete', self::createPermissionedUser('delete themes', false), false ],
        ];
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_not_creator
     */
    public function all_permissions_not_creator(string $permission, UserInterface $user, bool $expected)
    {
        $theme = EscapeRoomTheme::factory()->make();

        $this->assertEquals($expected, $user->can($permission, $theme));
    }

    public function data_provider_for_all_permissions_not_creator()
    {
        // Permissions are identical for creator or others
        return $this->data_provider_for_all_permissions_as_creator();
    }
}
