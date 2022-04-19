<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'seeAllProducts',
            'seeAllSales',
            'seeAllUsers',
            'dashboardAdmin'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'admin'])
                ->givePermissionTo([
                    'seeAllProducts',
                    'seeAllSales',
                    'seeAllUsers',
                    'dashboardAdmin'
                ]);
    }
}
