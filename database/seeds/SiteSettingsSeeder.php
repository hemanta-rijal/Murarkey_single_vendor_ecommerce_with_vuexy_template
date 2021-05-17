<?php

use App\Models\Meta;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $metas = "site_name,site_description,site_keywords,facebook_link,twitter_link,instagram_link,google-plus_link,youtube_link,linkedin_link,tracking,logo,contact_email,all_right_reserved,supported_countries,default_country,supported_locales,default_locale,default_timezone,maintenance_mode,allowed_IPs,supported_currencies,default_currency,mail_from_address,mail_from_name,mail_host,mail_port,mail_username,mail_password,mail_encryption,newsletter_mode,mailchimp_api_key,mailchimp_list_id,custom_header,custom_footer,paypal_sandbox,paypal_client_id,paypal_secreate_key,stripe_status,stripe_label,stripe_description,stripe_publishable_key,stripe_secreate_key,cash_on_delivery_status,cash_on_delivery_label,cash_on_delivery_description,bank_transfer_status,cash_on_delivery_instruction,free_shipping_status,free_shipping_label,free_shipping_minimum_amount,local_pick_up_status,local_pickup_label,local_pickup_cost,flat_rate_status,flat_rate_label,flat_rate_cost,bank_transfer_label,bank_transfer_description,paypal_status,paypal_description,paypal_label";

    public function run()
    {
        $metas = explode(',', $this->metas);

        foreach ($metas as $meta) {
            $dbMeta = Meta::where('key', $meta)->first();

            if (is_null($dbMeta)) {
                Meta::create([
                    'key' => $meta,
                    'value' => 'please change it',
                    'description' => 'Auto Generated',
                ]);
            }

        }
    }
}