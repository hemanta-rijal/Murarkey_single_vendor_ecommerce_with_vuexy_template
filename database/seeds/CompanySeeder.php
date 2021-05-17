<?php

use App\Models\LocationCountry;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    private $state, $country, $city;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // Trading Company,Distributor/Wholesaler,Other
    public function run()
    {

        $faker = \Faker\Factory::create('en_US');
        for ($i = 0; $i < 100; $i++) {

            $country = LocationCountry::find(LocationCountry::all()->random()->id);
            $state = $country->states->random();
            $city = $state->cities->first();

            $name = $faker->sentence;
            $slug = str_replace(" ", "_", strtolower($name));

            DB::table('companies')
                ->insert([
                    'name' => $name,
                    'established_year' => $faker->year,
                    'business_type' => '["Trading Company","Distributor \/ Wholesaler","Other"]',
                    'products' => $faker->name,
                    'operational_address' => $faker->address,
                    'country_id' => $country ? $country->id : null,
                    'province' => $state ? $state->id : null,
                    'city' => $city ? $city->id : null,
                    'description' => $faker->realText(5000, 5),
                    'logo' => $faker->randomElement($array = array(
                        'public/categories/vUj9sOj36XmNSAXRuzvRGdpdjJeMpbtCk1TKCr3r.png',
                        'public/categories/pzywAwUeA9qG5Al1YEPtdi3pxMJdw9E6KRgjFhqX.jpeg    ',
                        'public/categories/AZCf0eIkNZbGAjRhk3pCDmbeDlcaaSSX58wuV7wL.jpeg',
                        'public/categories/MhAXGcWAx2tHdLaI6q8jxBpXMyZZZX71SpaafzJP.jpeg',
                        'public/categories/wTBbn0Rtk5m8Y3wL9Dcc0SfW39g5DNfMKksYLqaF.jpeg',
                        'public/categories/X78u9qqMDlfY59VSmaadCHL4DoCMTZQXuv4z4KEQ.jpeg',
                        'public/categories/oV7L8ytWDImBq1BdtvJ91kHN8NtbPBdraEUpcK93.jpeg',
                        'public/categories/rP3GSi99EizoJEitslmX3uEIoQpqT5oredK4NxgH.jpeg',
                        'public/categories/s2W6rnmZIlHjNCwBFeIh6AehYoYAVXMPqorlIkDP.jpeg',
                        'public/categories/hVGmCPnVHmaQ6iTfrwJetJMkYP7OSRouUL4NtUuM.jpeg',
                        'public/categories/EPoE3uY1pVWLkE7Efr5rEMToIt676Lcu7fDU0Dbq.jpeg',
                    )),
                    'slug' => $slug,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'owner_id' => User::all()->random()->id,
                ]);
        }
    }
}