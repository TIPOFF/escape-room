<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\EscapeRoomRate;
use Tipoff\EscapeRoom\Tests\TestCase;
use Tipoff\Support\Contracts\Models\UserInterface;

class EscapeRoomRatePolicyTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function view_any()
    {
        $user = self::createPermissionedUser('view rates', true);
        $this->assertTrue($user->can('viewAny', EscapeRoomRate::class));

        $user = self::createPermissionedUser('view rates', false);
        $this->assertFalse($user->can('viewAny', EscapeRoomRate::class));
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_as_creator
     */
    public function all_permissions_as_creator(string $permission, UserInterface $user, bool $expected)
    {
        $rate = EscapeRoomRate::factory()->make([
            'creator_id' => $user,
        ]);

        $this->assertEquals($expected, $user->can($permission, $rate));
    }

    public function data_provider_for_all_permissions_as_creator()
    {
        return [
            'view-true' => [ 'view', self::createPermissionedUser('view rates', true), true ],
            'view-false' => [ 'view', self::createPermissionedUser('view rates', false), false ],
            'create-true' => [ 'create', self::createPermissionedUser('create rates', true), true ],
            'create-false' => [ 'create', self::createPermissionedUser('create rates', false), false ],
            'update-true' => [ 'update', self::createPermissionedUser('update rates', true), true ],
            'update-false' => [ 'update', self::createPermissionedUser('update rates', false), false ],
            'delete-true' => [ 'delete', self::createPermissionedUser('delete rates', true), false ],
            'delete-false' => [ 'delete', self::createPermissionedUser('delete rates', false), false ],
        ];
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_not_creator
     */
    public function all_permissions_not_creator(string $permission, UserInterface $user, bool $expected)
    {
        $rate = EscapeRoomRate::factory()->make();

        $this->assertEquals($expected, $user->can($permission, $rate));
    }

    public function data_provider_for_all_permissions_not_creator()
    {
        // Permissions are identical for creator or others
        return $this->data_provider_for_all_permissions_as_creator();
    }
}
