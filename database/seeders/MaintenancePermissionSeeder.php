<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

/**
 * Grants the Maintenance module permission (key "25") to existing admin roles.
 *
 * The `admin` middleware (App\Http\Middleware\UserRole) enforces per-route
 * permission via routePermission(); without this key every maintenance route
 * returns 401 even for a super admin.
 *
 * Run with: php artisan db:seed --class=Database\\Seeders\\MaintenancePermissionSeeder
 */
class MaintenancePermissionSeeder extends Seeder
{
    private const MAINTENANCE_PERMISSION = '25';

    public function run(): void
    {
        UserRole::query()->get()->each(function (UserRole $role) {
            $permissions = array_filter(explode(',', (string) $role->permission));

            if (! in_array(self::MAINTENANCE_PERMISSION, $permissions, true)) {
                $permissions[] = self::MAINTENANCE_PERMISSION;
                $role->update(['permission' => implode(',', $permissions)]);
            }
        });
    }
}
