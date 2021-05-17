<?php

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->aboutUsSeeder();
        $this->contactUsSeeder();
        $this->privacyPolicySeeder();
        $this->userAgreementSeeder();
        $this->howToFindSupplierSeeder();
        $this->howToRegisterAsSupplierSeeder();
    }

    public function aboutUsSeeder()
    {
        $about = Page::whereSlug('about-us')->first();
        if (!$about) {
            Page::create([
                'name' => 'About Us',
                'slug' => 'about-us',
                'content' => file_get_contents(resource_path('data/about-us.txt')),
                'template' => 'default',
                'published' => 1,
                'is_there_php' => false,
            ]);
        }

    }

    public function howToFindSupplierSeeder()
    {
        $page = Page::whereSlug(str_slug('How to Find Supplier'))->first();
        if (!$page) {
            Page::create([
                'name' => 'How to Find Supplier',
                'slug' => str_slug('How to Find Supplier'),
                'content' => file_get_contents(resource_path('data/how-to-find-supplier.txt')),
                'template' => 'default',
                'published' => 1,
                'is_there_php' => false,
            ]);
        }

    }

    public function howToRegisterAsSupplierSeeder()
    {
        $page = Page::whereSlug('how-to-register-as-a-supplier')->first();
        if (!$page) {
            Page::create([
                'name' => 'How to Register as a Supplier',
                'slug' => str_slug('How to Register as a Supplier'),
                'content' => file_get_contents(resource_path('data/how-to-register-as-a-supplier.txt')),
                'template' => 'default',
                'published' => 1,
                'is_there_php' => false,
            ]);
        }

    }

    public function userAgreementSeeder()
    {
        $page = Page::whereSlug('user-agreement')->first();
        if (!$page) {
            Page::create([
                'name' => 'User Agreement',
                'slug' => 'user-agreement',
                'content' => file_get_contents(resource_path('data/user-agreement.txt')),
                'template' => 'default',
                'published' => 1,
                'is_there_php' => false,
            ]);
        }

    }

    public function privacyPolicySeeder()
    {
        $page = Page::whereSlug('privacy-policy')->first();
        if (!$page) {
            Page::create([
                'name' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => file_get_contents(resource_path('data/privacy-policy.txt')),
                'template' => 'default',
                'published' => 1,
                'is_there_php' => false,
            ]);
        }

    }

    public function contactUsSeeder()
    {
        $page = Page::whereSlug('contact-us')->first();
        if (!$page) {
            Page::create([
                'name' => 'Contact Us',
                'slug' => 'contact-us',
                'content' => file_get_contents(resource_path('data/contact-us.txt')),
                'template' => 'default',
                'published' => 1,
                'is_there_php' => true,
            ]);
        }

    }
}
