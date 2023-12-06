<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Option;

class SpinController extends Controller
{
    public function index()
    {
        if (auth()->check()) {

            $spins = Option::where('key', 'spins')->first()->value ?? [];
        
            return response()->json([
                'status' => 200,
                'message' => __('Data fetched successfully.'),
                'data' => $spins,
            ]);

        } else {
            return response()->json([
                'status' => 200,
                'message' => __('Unauthenticated.'),
            ], 401);
        }
    }
}
