<?php

namespace App\Http\Controllers\Api;

use App\Models\UserEarning;
use App\Models\UserGain;
use App\Models\Wallet;
use Throwable;
use App\Models\Earning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AcnooEarningController extends Controller
{
    public function index()
    {
        if (!request('type')) {
            return response()->json([
                'status' => 400,
                'message' => __('Invalid Request, Please provide me a type.'),
            ]);
        }

        $visited_websites = UserEarning::where('user_id', auth()->id())
                ->where('created_at', '>', today())
                ->pluck('earning_id')
                ->toArray();

        $earnings = Earning::whereNotIn('id', $visited_websites)->where('type', request('type'))->whereStatus(1)->latest()->get();

        return response()->json([
            'status' => 200,
            'message' => __('Data fetched successfully.'),
            'data' => $earnings,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'earning_id' => 'required|exists:earnings,id'
        ]);

        $earning = Earning::findOrFail($request->earning_id);
        $wallet = Wallet::where('user_id', auth()->id())->first();

        $already_visited = UserEarning::where('user_id', auth()->id())->where('earning_id', $request->earning_id)->whereType('website')->where('created_at', '>', today())->exists();

        if ($already_visited) {
            return response()->json([
                'status' => 406,
                'message' => __('Sorry! You have already visited this website today.'),
            ], 406);
        }
        
        if ($earning->type == 'scratch_card' && $wallet->balance < $earning->price) {
            return response()->json([
                'status' => 406,
                'message' => __('Sorry! Insufficient balance.'),
            ], 406);
        }

        DB::beginTransaction();
        try {

            $user_earning = UserEarning::create([
                'type' => $earning->type,
                'user_id' => auth()->id(),
                'earning_id' => $earning->id,
                'reward_point' => $earning->reward_point,
            ]);

            UserGain::create([
                'user_id' => auth()->id(),
                'description' => $earning->title,
                'amount' => $earning->reward_point,
            ]);

            $wallet->update([
                'balance' => $wallet->balance + ($earning->reward_point - ($earning->type == 'scratch_card' ? $earning->price : 0))
            ]);

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => __('Earnigs has been added to your wallet.'),
                'data' => $user_earning,
            ]);

        } catch (Throwable $th) {
            DB::rollback();
            return response()->json([
                'message' => __('Something was wrong, Please contact with author.')
            ], 403);
        }
    }
}
