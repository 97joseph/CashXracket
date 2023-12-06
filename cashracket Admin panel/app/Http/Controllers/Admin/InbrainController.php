<?php

namespace App\Http\Controllers\Admin;

use App\Models\Wallet;
use App\Models\UserGain;
use App\Http\Controllers\Controller;

class InbrainController extends Controller
{
    public function index()
    {
        if (request('userId') && request('reward')) {
            
            $wallet = Wallet::where('user_id', request('userId'))->first();

            $user_earning = UserGain::create([
                'amount' => request('reward'),
                'user_id' => request('userId'),
                'description' => "Inbrain reward added.",
            ]);

            $wallet->update([
                'balance' => $wallet->balance + request('reward')
            ]);
            
            return response()->json([
                'status' => 200,
                'message' => __('Inbrain reward has been added to your wallet.'),
                'data' => $user_earning,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => __('Inbrain reward failed.'),
            ]);
        }
    }
}
