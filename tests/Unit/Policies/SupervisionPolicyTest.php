<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\Supervision;
use Tipoff\EscapeRoom\Tests\TestCase;
use Tipoff\Support\Contracts\Models\UserInterface;

class SupervisionPolicyTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function view_any()
    {
        $user = self::createPermissionedUser('view supervisions', true);
        $this->assertTrue($user->can('viewAny', Supervision::class));

        $user = self::createPermissionedUser('view supervisions', false);
        $this->assertFalse($user->can('viewAny', Supervision::class));
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_as_creator
     */
    public function all_permissions_as_creator(string $permission, UserInterface $user, bool $expected)
    {
        $supervision = Supervision::factory()->make([
            'creator_id' => $user,
        ]);

        $this->assertEquals($expected, $user->can($permission, $supervision));
    }

    public function data_provider_for_all_permissions_as_creator()
    {
        return [
            'view-true' => [ 'view', self::createPermissionedUser('view supervisions', true), true ],
            'view-false' => [ 'view', self::createPermissionedUser('view supervisions', false), false ],
            'create-true' => [ 'create', self::createPermissionedUser('create supervisions', true), true ],
            'create-false' => [ 'create', self::createPermissionedUser('create supervisions', false), false ],
            'update-true' => [ 'update', self::createPermissionedUser('update supervisions', true), true ],
            'update-false' => [ 'update', self::createPermissionedUser('update supervisions', false), false ],
            'delete-true' => [ 'delete', self::createPermissionedUser('delete supervisions', true), false ],
            'delete-false' => [ 'delete', self::createPermissionedUser('delete supervisions', false), false ],
        ];
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_not_creator
     */
    public function all_permissions_not_creator(string $permission, UserInterface $user, bool $expected)
    {
        $supervision = Supervision::factory()->make();

        $this->assertEquals($expected, $user->can($permission, $supervision));
    }

    public function data_provider_for_all_permissions_not_creator()
    {
        // Permissions are identical for creator or others
        return $this->data_provider_for_all_permissions_as_creator();
    }
}
