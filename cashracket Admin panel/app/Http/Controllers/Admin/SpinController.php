<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;

class SpinController extends Controller
{
    public function index()
    {
        $spins = Option::where('key', 'spins')->first();
        return view('back-end.pages.spins.index', compact('spins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'entry_fee' => 'required|integer|gt:0',
            'position0' => 'required',
            'position1' => 'required',
            'position2' => 'required',
            'position3' => 'required',
            'position4' => 'required',
            'position5' => 'required',
            'position6' => 'required',
            'position7' => 'required',
            'position8' => 'required',
            'position9' => 'required',
        ]);

        Option::updateOrCreate(['key' => 'spins'],
            ['value' => $request->except('_token')
        ]);

        return response()->json(__('Spin coins set successfully.'));
    }
}
