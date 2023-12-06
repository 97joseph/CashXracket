<?php

namespace App\Http\Controllers\Api;

use App\Models\Video;
use App\Models\UserGain;
use App\Models\VideoWatched;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoWatchedController extends Controller
{
    public function index()
    {
        if (auth()->check()) {

            $watched_vdo_ids = VideoWatched::where('user_id', auth()->id())->get();

            return response()->json([
                'status' => 200,
                'message' => __('Data fetched successfully.'),
                'data' => $watched_vdo_ids,
            ]);

        } else {
            return response()->json([
                'status' => 200,
                'message' => __('Unauthenticated.'),
            ], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->check()) {

            $request->validate([
                'video_id' => 'required|exists:videos,id',
            ]);

            $video = Video::findOrFail($request->video_id);
            $watched = VideoWatched::where('user_id', auth()->id())->where('video_id', $request->video_id)->where('created_at', '>', today())->exists();
    
            if (!$watched) {
                $watched_video = VideoWatched::create([
                    'user_id' => auth()->id(),
                    'video_id' => $request->video_id,
                    'earned_coins' => $video->coins,
                    'duration' => $video->duration,
                ]);

                UserGain::create([
                    'amount' => $video->coins,
                    'user_id' => auth()->id(),
                    'description' => $video->title,
                ]);

                $wallet = Wallet::where('user_id', auth()->id())->first();
                $wallet->update([
                    'balance' => $wallet->balance + $video->coins
                ]);
        
                return response()->json([
                    'status' => 200,
                    'message' => __('You have earned ' . $watched_video->earned_coins . ' coins'),
                    'data' => $watched_video,
                ]);
            } else {
                return response()->json([
                    'status' => 403,
                    'message' => __('You have already watched this video today.'),
                ], 403);
            }

        } else {
            return response()->json([
                'status' => 200,
                'message' => __('Unauthenticated.'),
            ], 401);
        }
    }
}
