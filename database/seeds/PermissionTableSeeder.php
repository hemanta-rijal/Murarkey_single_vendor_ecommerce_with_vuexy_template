<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-index',
            'role-create',
            'role-edit',
            'role-delete',

            'permission-index',
            'permission-create',
            'permission-edit',
            'permission-delete',

            'product-index',
            'product-create',
            'product-edit',
            'product-delete',

            'banner-index',
            'banner-create',
            'banner-edit',
            'banner-delete',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'slug' => $permission]);
        }

    }
}
