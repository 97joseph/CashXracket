<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use App\Models\VideoWatched;
use Illuminate\Http\Request;
use App\Helpers\HasUploader;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AcnooVideoController extends Controller
{
    use HasUploader;

    public function index()
    {
        $videos = Video::when(request('search'), function($q) {
                        $q->where('title', 'like', '%'.request('search').'%')
                        ->orWhere('coins', 'like', '%'.request('search').'%');
                    })
                    ->latest()
                    ->paginate();
                    
        return view('back-end.pages.videos.index', compact('videos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'status' => 'required|integer',
            'duration' => 'required|integer',
            'coins' => 'required|integer|min:1',
            'title' => 'required|string|max:200',
            'thumbnail' => 'required|image|max:1024',
            'video_link' => 'required_if:type,url|url',
            'video' => 'required_if:type,video|file|max:512000',
        ]);

        Video::create($request->except('thumbnail', 'video_link') + [
            'thumbnail' => $this->upload($request, 'thumbnail'), 
            'video_link' => $request->type == 'video' ? $this->upload($request, 'video') : $request->video_link
        ]);

        return response()->json([
            'message' => __('Video created successfully.'),
            'redirect' => route('videos.index')
        ]);
    }

    public function edit(Video $video)
    {
        return view('back-end.pages.videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type' => 'required|string',
            'status' => 'required|integer',
            'duration' => 'required|integer',
            'coins' => 'required|integer|min:1',
            'title' => 'required|string|max:200',
            'thumbnail' => 'nullable|image|max:1024',
            'video_link' => 'required_if:type,url|url',
            'video' => 'nullable|file|max:512000',
        ]);

        $video = Video::findOrFail($id);
        if ($request->type == 'video') {
            $video_link = $request->hasFile('video') ? $this->upload($request, 'video', $video->video_link) : $video->video_link;
        } else {
            $video_link = $request->video_link;
        }
        
        $video->update($request->except('thumbnail', 'video_link') + [
            'video_link' => $video_link,
            'thumbnail' => $request->hasFile('thumbnail') ? $this->upload($request, 'thumbnail', $video->thumbnail) : $video->thumbnail
        ]);

        return response()->json([
            'message' => __('Video updated successfully.'),
            'redirect' => route('videos.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $video = Video::findOrFail($id);
        if (file_exists($video->thumbnail)) {
            Storage::delete($video->thumbnail);
        }
        $video->delete();
        return response()->json([
            'message' => __('Video has been deleted.'),
            'redirect' => route('videos.index'),
        ]);
    }

    public function watchedVidoes()
    {
        $watched_videos = VideoWatched::with('user', 'video')->when(request('search'), function($q) {
                                $q->where('duration', 'like', '%'.request('search').'%')
                                ->orWhere('earned_coins', 'like', '%'.request('search').'%')
                                ->orWhereHas('user', function($q) {
                                    $q->where('name', 'like', '%'.request('search').'%');
                                });
                                $q->orWhereHas('video', function($q) {
                                    $q->where('title', 'like', '%'.request('search').'%');
                                });
                            })
                            ->latest()
                            ->paginate(10);
        
        return view('back-end.pages.watched-videos.index', compact('watched_videos'));
    }
}
