<?php

declare(strict_types=1);

namespace Tipoff\EscapeRoom\Tests;

use DrewRoberts\Media\MediaServiceProvider;
use Laravel\Nova\NovaCoreServiceProvider;
use Spatie\Permission\PermissionServiceProvider;
use Tipoff\Addresses\AddressesServiceProvider;
use Tipoff\Authorization\AuthorizationServiceProvider;
use Tipoff\EscapeRoom\EscaperoomServiceProvider;
use Tipoff\EscapeRoom\Tests\Support\Providers\NovaPackageServiceProvider;
use Tipoff\Locations\LocationsServiceProvider;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\TestSupport\BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            NovaCoreServiceProvider::class,
            NovaPackageServiceProvider::class,
            SupportServiceProvider::class,
            PermissionServiceProvider::class,
            AuthorizationServiceProvider::class,
            MediaServiceProvider::class,
            AddressesServiceProvider::class,
            LocationsServiceProvider::class,
            EscaperoomServiceProvider::class,
        ];
    }
}
