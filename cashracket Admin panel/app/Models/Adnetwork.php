<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adnetwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'inbrain_api_key',
        'bitlabs_ios_key',
        'pollfish_ios_key',
        'offertoro_app_id',
        'bitlabs_andriod_key',
        'pollfish_andriod_key',
        'offertoro_secret_key',
        'admob_rewarded_ad_ios',
        'admob_rewarded_android',
        'admob_interstitial_ios',
        'offertoro_publisher_id',
        'audience_network_ad_ios',
        'applovin_rewarded_ad_ios',
        'admob_interstitial_android',
        'applovin_rewarded_ad_android',
        'audience_network_interstitial_ios',
        'audience_network_rewarded_ad_android',
        'audience_network_interstitial_android',
    ];
}
