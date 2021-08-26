<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::updateOrCreate([
            'name' => 'Admin',
            'slug' => Str::slug('Admin'),
        ]);
        $role->save();

        $role = Role::updateOrCreate([
            'name' => 'Super Admin',
            'slug' => Str::slug('Super Admin'),
        ]);
        $role->save();
    }
}
