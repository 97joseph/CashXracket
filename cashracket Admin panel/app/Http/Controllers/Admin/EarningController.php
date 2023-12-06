<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Earning;
use Illuminate\Http\Request;

class EarningController extends Controller
{
    public function index()
    {
        abort_if(!request('type'), 404);
        $earnings = Earning::where('type', request('type'))->when(request('search'), function($q) {
                        $q->where('title', 'like', '%'.request('search').'%')
                        ->orWhere('reward_point', 'like', '%'.request('search').'%');
                    })
                    ->latest()
                    ->paginate();
                    
        return view('back-end.pages.earnings.index', compact('earnings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'status' => 'required|integer',
            'reward_point' => 'required|integer|min:1',
            'title' => 'required|string|max:200',
        ]);

        if ($request->type == 'website') {
            $request->validate([
                'url' => 'required|url',
                'duration' => 'required|numeric',
            ]);
        } elseif ($request->type == 'scratch_card') {
            $request->validate([
                'price' => 'required|numeric|max:99999999',
            ]);
        } else {
            return response()->json([
                'message' => __("You are a fraud.")
            ]);
        }

        Earning::create($request->all());

        return response()->json([
            'message' => __(ucfirst(str_replace("_", " ", $request->type)) . ' created successfully.'),
            'redirect' => route('earnings.index', ['type' => $request->type])
        ]);
    }

    public function edit(Earning $earning)
    {
        return view('back-end.pages.earnings.edit', compact('earning'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Earning $earning)
    {
        $request->validate([
            'status' => 'required|integer',
            'reward_point' => 'required|integer|min:1',
            'title' => 'required|string|max:200',
        ]);

        if ($earning->type == 'website') {
            $request->validate([
                'url' => 'required|url',
                'duration' => 'required|numeric',
            ]);
        } elseif ($earning->type == 'scratch_card') {
            $request->validate([
                'price' => 'required|numeric|max:99999999',
            ]);
        }

        $earning->update($request->except('type'));

        return response()->json([
            'message' => __(ucfirst(str_replace("_", " ", $earning->type)) . ' updated successfully.'),
            'redirect' => route('earnings.index', ['type' => $earning->type])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Earning $earning)
    {
        $type = $earning->type;
        $earning->delete();
        return response()->json([
            'message' => __(ucfirst(str_replace("_", " ", $type)) . ' has been deleted.'),
            'redirect' => route('earnings.index', ['type' => $type]),
        ]);
    }

    // public function watchedVidoes()
    // {
    //     $watched_videos = VideoWatched::with('user', 'video')->when(request('search'), function($q) {
    //                             $q->where('duration', 'like', '%'.request('search').'%')
    //                             ->orWhere('earned_coins', 'like', '%'.request('search').'%')
    //                             ->orWhereHas('user', function($q) {
    //                                 $q->where('name', 'like', '%'.request('search').'%');
    //                             });
    //                             $q->orWhereHas('video', function($q) {
    //                                 $q->where('title', 'like', '%'.request('search').'%');
    //                             });
    //                         })
    //                         ->latest()
    //                         ->paginate(10);
        
    //     return view('back-end.pages.watched-videos.index', compact('watched_videos'));
    // }
}
