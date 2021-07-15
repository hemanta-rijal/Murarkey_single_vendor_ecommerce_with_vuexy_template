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
    private $metas = "site_name,primary_contact_number,full_address,site_description,,site_keywords,facebook_link,twitter_link,instagram_link,google-plus_link,youtube_link,linkedin_link,tracking,contact_email,all_right_reserved,supported_countries,default_country,supported_locales,default_locale,default_timezone,maintenance_mode,allowed_IPs,supported_currencies,default_currency,mail_driver,mail_from_address,mail_from_name,mail_host,mail_port,mail_username,mail_password,mail_encryption,newsletter_mode,mailchimp_api_key,mailchimp_list_id,custom_header,custom_footer,esewa_status,esewa_scd,paypal_sandbox,paypal_client_id,paypal_secreate_key,stripe_status,stripe_label,stripe_description,stripe_publishable_key,stripe_secreate_key,cash_on_delivery_status,cash_on_delivery_label,cash_on_delivery_description,bank_transfer_status,cash_on_delivery_instruction,free_shipping_status,free_shipping_label,free_shipping_minimum_amount,local_pick_up_status,local_pickup_label,local_pickup_cost,flat_rate_status,flat_rate_label,flat_rate_cost,bank_transfer_label,bank_transfer_description,paypal_status,paypal_description,paypal_label,supported_units,default_unit,facebook_login_status,facebook_client_secrete,facebook_app_id,google_login_status,google_client_secrete,google_client_id,twitter_login_status,twitter_client_secrete,twitter_client_id,site_map_link,seo_author,seo-revisit,seo_description,admin_dashboard_logo,frontend_footer_logo,frontend_header_background_logo,frontend_header_logo,favicon_icon,custom_tax_on_product,custom_tax_on_service,privacy_policy,'return_policy,support_policy,terms_and_condition";

    public function run()
    {
        $metas = explode(',', $this->metas);

        foreach ($metas as $meta) {
            $dbMeta = Meta::where('key', $meta)->first();

            if (is_null($dbMeta)) {
                Meta::create([
                    'key' => $meta,
                    'value' => null,
                    'description' => null,
                ]);
            }

        }
    }
}
