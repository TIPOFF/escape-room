<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests\Feature\Nova;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\EscapeRoom\Models\EscaperoomLocation;
use Tipoff\EscapeRoom\Tests\TestCase;

use Tipoff\Locations\Models\Location;
use Tipoff\Authorization\Models\User;
use Spatie\Permission\Models\Role;

class EscaperoomLocationResourceTest extends TestCase
{
    use DatabaseTransactions;

    private const NOVA_ROUTE = 'nova-api/escaperoom-locations';

    /** @test */
    public function index_role_location_filter()
    {
        $location1 = Location::factory()->create();
        $location2 = Location::factory()->create();

        EscaperoomLocation::factory()->count(1)->create([
            'location_id' => $location1,
        ]);

        EscaperoomLocation::factory()->count(1)->create([
            'location_id' => $location2,
        ]);

        /** @var User $user */
        $user = User::factory()->create()->givePermissionTo(
            Role::findByName('Admin')->getPermissionNames()     // Use individual permissions so we can revoke one
        );

        $user->locations()->attach($location1);
        $this->actingAs($user);

        $response = $this->getJson(self::NOVA_ROUTE)
            ->assertOk();

        $this->assertCount(2, $response->json('resources'));

        $user->revokePermissionTo('all locations');
        $response = $this->getJson(self::NOVA_ROUTE)
            ->assertOk();

        $this->assertCount(2, $response->json('resources'));
    }

    /**
     * @dataProvider dataProviderForIndexByRole
     * @test
     */
    public function index_by_role(?string $role, bool $hasAccess, bool $canIndex)
    {
        $location = Location::factory()->create();

        EscaperoomLocation::factory()->count(1)->create([
            'location_id' => $location,
        ]);

        $user = User::factory()->create();
        $user->locations()->attach($location);
        if ($role) {
            $user->assignRole($role);
        }
        $this->actingAs($user);

        $response = $this->getJson(self::NOVA_ROUTE)
            ->assertStatus($hasAccess ? 200 : 403);

        if ($hasAccess) {
            $this->assertCount($canIndex ? 1 : 0, $response->json('resources'));
        }
    }

    public function dataProviderForIndexByRole()
    {
        return [
            'Admin' => ['Admin', true, true],
            'Owner' => ['Owner', true, true],
            'Executive' => ['Executive', true, true],
            'Staff' => ['Staff', true, true],
            'Former Staff' => ['Former Staff', false, false],
            'Customer' => ['Customer', false, false],
            'No Role' => [null, false, false],
        ];
    }

    /**
     * @dataProvider dataProviderForShowByRole
     * @test
     */
    public function show_by_role(?string $role, bool $hasAccess, bool $canView)
    {
        $location = Location::factory()->create();

        $model = EscaperoomLocation::factory()->create([
            'location_id' => $location,
        ]);

        $user = User::factory()->create();
        $user->locations()->attach($location);
        if ($role) {
            $user->assignRole($role);
        }
        $this->actingAs($user);

        $response = $this->getJson(self::NOVA_ROUTE . "/{$model->id}")
            ->assertStatus($hasAccess ? 200 : 403);

        if ($hasAccess && $canView) {
            $this->assertEquals($model->id, $response->json('resource.id.value'));
        }
    }

    public function dataProviderForShowByRole()
    {
        return [
            'Admin' => ['Admin', true, true],
            'Owner' => ['Owner', true, true],
            'Executive' => ['Executive', true, true],
            'Staff' => ['Staff', true, false],
            'Former Staff' => ['Former Staff', false, false],
            'Customer' => ['Customer', false, false],
            'No Role' => [null, false, false],
        ];
    }

    /**
     * @dataProvider dataProviderForDeleteByRole
     * @test
     */
    public function delete_by_role(?string $role, bool $hasAccess, bool $canDelete)
    {
        $location = Location::factory()->create();

        $model = EscaperoomLocation::factory()->create([
            'location_id' => $location,
        ]);

        $user = User::factory()->create();
        $user->locations()->attach($location);
        if ($role) {
            $user->assignRole($role);
        }
        $this->actingAs($user);

        // Request never fails
        $this->deleteJson(self::NOVA_ROUTE . "?resources[]={$model->id}")
            ->assertStatus($hasAccess ? 200 : 403);

        // But deletion will only occur if user has permissions
        $this->assertDatabaseCount('escaperoom_locations', $canDelete ? 0 : 1);
    }

    public function dataProviderForDeleteByRole()
    {
        return [
            'Admin' => ['Admin', true, false],
            'Owner' => ['Owner', true, false],
            'Executive' => ['Executive', true, false],
            'Staff' => ['Staff', true, false],
            'Former Staff' => ['Former Staff', false, false],
            'Customer' => ['Customer', false, false],
            'No Role' => [null, false, false],
        ];
    }
}
