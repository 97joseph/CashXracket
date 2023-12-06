<?php

namespace Database\Seeders;

use App\Models\Adnetwork;
use Illuminate\Database\Seeder;

class AdnetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adnetworks = array(
            array('admob_interstitial_android' => 'ca-app-pub-3940256099942544/8691691433', 'admob_interstitial_ios' => 'ca-app-pub-3940256099942544/8691691433', 'admob_rewarded_android' => 'ca-app-pub-3940256099942544/5224354917', 'admob_rewarded_ad_ios' => 'ca-app-pub-3940256099942544/1712485313', 'applovin_rewarded_ad_android' => '6d4421fd379b387e', 'applovin_rewarded_ad_ios' => 'test6', 'audience_network_rewarded_ad_android' => 'test7', 'audience_network_ad_ios' => 'test8', 'audience_network_interstitial_android' => 'test9', 'audience_network_interstitial_ios' => 'test10', 'offertoro_publisher_id' => '15768', 'offertoro_app_id' => '14507', 'offertoro_secret_key' => '33ae40dc7b63c3cb6c3adac396bc4dc7', 'pollfish_andriod_key' => 'Pollfish Integration Id(Andriod)', 'pollfish_ios_key' => 'Pollfish Integration Id(IOS)', 'bitlabs_andriod_key' => 'Bitlabs integration Id (Andriod)', 'bitlabs_ios_key' => 'Bitlabs integration Id (IOS)', 'inbrain_api_key' => 'D4345E85-65DB-4636-96E0-8A28836FC853', 'created_at' => now(), 'updated_at' => now()),
        );

        Adnetwork::insert($adnetworks);
    }
}