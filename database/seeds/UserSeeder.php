<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')
                ->insert([
                    'first_name' => $faker->firstNameMale,
                    'last_name' => $faker->lastName,
                    'email' => $faker->freeEmail,
                    'password' => '$2y$10$k2qvKP2rCNbLDRZadNV7U./Z7rv3rmA5N3aOsOtEzh0zlZOW0MKMS',
                    'role' => $faker->randomElement($array = array(
                                                                    'ordinary-user',
                                                                    'associate-seller',
                                                                    'main-seller')
                                                                ),
                    // 'role' => 'main-seller',
                    'verified' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'status' => 'unverified',
                    'phone_number' => $faker->phoneNumber,
                    'profile_pic' => 'public/profile-pics/qLK1tKqo1sCGF0ltXP6K84cV8F1VHva4uvThVKZ3.jpeg',
                    'profile_pic_position' => '{"zoom":"0","position":{"x":"0","y":"0"}}',
                    'shipment_details' => $faker->address,
                ]);
        }

    }
}