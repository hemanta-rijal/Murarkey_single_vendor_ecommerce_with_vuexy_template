<?php

use App\Models\AdminUser;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);

        //tips: at first you have to create role named as "admin" assigning related permissions to
        // $super_admin_role = Role::where('slug', 'super-admin')->first();
        // $super_admin = AdminUser::updateOrCreate(
        //     ['name' => 'super-admin'],
        //     ['email' => 'super-admin@admin.com'],
        //     ['password' => bcrypt('super-admin')],
        //     ['role_id' => $super_admin_role->id],
        // );
        // $super_admin->save();

        $admin_role = Role::where('slug', 'admin')->first();
        $permissions = Permission::all();
        $admin_role->permissions()->sync($permissions);
        $admin = AdminUser::updateOrCreate(
            ['name' => 'admin'],
            ['email' => 'admin@admin.com'],
            ['password' => bcrypt('admin')],
            ['role_id' => $admin_role->id]
        );
        $admin->save();
        $admin->permissions()->sync($permissions);

    }

}
