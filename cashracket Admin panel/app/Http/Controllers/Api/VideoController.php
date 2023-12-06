<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\VideoWatched;

class VideoController extends Controller
{
    public function index()
    {
        if (auth()->check()) {

            $watched_vdo_ids = VideoWatched::where('user_id', auth()->id())
                ->where('created_at', '>', today())
                ->pluck('video_id')
                ->toArray();

            $videos = Video::whereNotIn('id', $watched_vdo_ids)->get();

            return response()->json([
                'status' => 200,
                'message' => __('Data fetched successfully.'),
                'data' => $videos,
            ]);

        } else {
            return response()->json([
                'status' => 200,
                'message' => __('Unauthenticated.'),
            ], 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->check()) {
            $request->validate([
                'video_id' => 'required|exists:videos,id'
            ]);

            $watched = VideoWatched::where('user_id', auth()->id())->where('video_id', $request->video_id)->where('created_at', '>', today())->exists();

            if (!$watched) {
                $video = Video::findOrFail($request->video_id);
                return response()->json([
                    'status' => 200,
                    'message' => __('Data fetched successfully.'),
                    'data' => $video,
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
