<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adnetwork;
use Illuminate\Http\Request;

class AdnetworksController extends Controller
{
    /**
     * Display the data of the Adnetworks
     */
    public function maanAdnetwork()
    {
        $info = Adnetwork::first();
        return view('back-end.pages.adnetworks.addnetworks_info',compact('info'));
    }

    /**
     * Updated a listing of the  requested data.
     */
    public function maanUpdateAdnetwork (Request $request, $id)
    {
        $request->validate([
            'admob_interstitial_android' => 'nullable|string|max:250',
            'admob_interstitial_ios' => 'nullable|string|max:250',
            'admob_rewarded_android' => 'nullable|string|max:250',
            'admob_rewarded_ad_ios' => 'nullable|string|max:250',
            'applovin_rewarded_ad_android' => 'nullable|string|max:250',
            'applovin_rewarded_ad_ios' => 'nullable|string|max:250',
            'audience_network_rewarded_ad_android' => 'nullable|string|max:250',
            'audience_network_ad_ios' => 'nullable|string|max:250',
            'audience_network_interstitial_android' => 'nullable|string|max:250',
            'audience_network_interstitial_ios' => 'nullable|string|max:250',
            'offertoro_publisher_id' => 'nullable|string|max:250',
            'offertoro_app_id' => 'nullable|string|max:250',
            'offertoro_secret_key' => 'nullable|string|max:250',
            'pollfish_andriod_key' => 'nullable|string|max:250',
            'pollfish_ios_key' => 'nullable|string|max:250',
            'bitlabs_andriod_key' => 'nullable|string|max:250',
            'bitlabs_ios_key' => 'nullable|string|max:250',
            'inbrain_api_key' => 'nullable|string|max:250',
        ]);

        $adnetwork = Adnetwork::findOrFail($id);
        $adnetwork->update($request->all());
        return response()->json(__('Adnetwork updated successfully!'));
    }
}
