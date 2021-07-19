<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // In location seeder States and Categories should be import firstly

        $this->call(AdminUserSeeder::class);
        $this->call(BannerTypeSeeder::class);
        // $this->call(BusinessTypeSeeder::class);
        // $this->call(CategoryKeywordSeeder::class);
        // $this->call(HidePermitSeeder::class);
        // $this->call(LocationSeeder::class);
        // $this->call(PagesSeeder::class);
        $this->call(UnitTypeSeeder::class);
        $this->call(SiteSettingsSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(CompanySeeder::class);
        // $this->call(ProductSeeder::class);

    }
}
