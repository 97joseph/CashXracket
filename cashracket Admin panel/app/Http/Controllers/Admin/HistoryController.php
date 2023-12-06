<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserGain;

class HistoryController extends Controller
{
    public function maanHistory()
    {
        $histories = UserGain::with('user')
                        ->when(request('search'), function($q) {
                            $q->where('description', 'like', '%'.request('search').'%')
                            ->orWhere('amount', 'like', '%'.request('search').'%')
                            ->orWhere('status', 'like', '%'.request('search').'%')
                            ->orWhere('note', 'like', '%'.request('search').'%');
                        })
                        ->orWhereHas('user', function($query) {
                            $query->where('name', 'like', '%'.request('search').'%');
                        })
                        ->latest()
                        ->paginate(10);

        return view('back-end.pages.history.history', compact('histories'));
    }
}
