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
            'menus',
            'products',
            'banners',
            'parlour-listing',
            'categories',
            'service-categories',
            'services',
            'service-labels',
            'users',
            'admin-users',
            'roles',
            'sliders',
            'brands',
            'testimonials',
            'attributes',
            'flash-sales',
            'coupons',
            'join-murarkey',
            'faqs',
            'currencies',
        ];

        $subRoutes = [
            'index' => ['index', 'show'],
            'create' => ['create', 'store'],
            'edit' => ['edit', 'update'],
            'delete' => ['destroy', 'bulk-delete'],
        ];

        $routes = [
            'index',
            'create',
            'edit',
            'delete',
        ];

        foreach ($permissions as $permission) {
            for ($i = 0; $i < 4; $i++) {
                $db_route =
                    'admin.' . $permission . '.' . $subRoutes[$routes[$i]][0] . ',' .
                    'admin.' . $permission . '.' . $subRoutes[$routes[$i]][1];

                $slug = $permission . '-' . $routes[$i];
                $dbPermission = Permission::where('slug', $slug)->first();
                if (is_null($dbPermission)) {
                    Permission::create([
                        'name' => $permission . ' ' . $routes[$i],
                        'slug' => $slug,
                        'routes' => $db_route,
                    ]);
                }
            }
        }

    }
}
