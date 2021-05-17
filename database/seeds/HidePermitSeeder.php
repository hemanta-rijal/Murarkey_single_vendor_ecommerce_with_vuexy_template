<?php

use Illuminate\Database\Seeder;

class HidePermitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Meta::create(['key' => 'hide-permit', 'value' => true]);
    }
}
