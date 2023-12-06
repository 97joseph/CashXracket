<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HasUploader;
use App\Models\Api\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    use HasUploader;
    public function authentication(Request $request) 
    {
        if ($request->email || $request->phone) {
            if ($request->email) {
                $request->validate([
                    'email' => 'email'
                ]);
                $user = User::where('email', $request->email)->first();
            } else {
                $request->validate([
                    'phone' => 'string|max:15'
                ]);
                $user = User::where('phone', $request->phone)->first();
            }
            
            if ($user) {
                Auth::login($user);
                return response()->json([
                    'status' => 200,
                    'user' => $user->id,
                    'token' => $user->createToken('maanRocketApp')->plainTextToken,
                ]);
            } else {
                
                $newUser = User::create([
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'refer_code' => 'RF' . random_int(0000, 9999),
                ]);
                \App\Models\User::balanceAdd($newUser->id);

                return response()->json([
                    'status' => 201,
                    'user_id' => $newUser->id,
                    'token' => $newUser->createToken('maanRocketApp')->plainTextToken,
                ], 201);
            }
        } else {
            return response()->json([
                'status' => 400,
                'message' => __('Sorry this is not possible without any email or phone.')
            ]);
        }
    }

    public function completeProfile(Request $request) 
    {
        if (auth()->check()) {
            $request->validate([
                'last_name' => 'nullable|string|max:20',
                'first_name' => 'nullable|string|max:20',
                'refer' => 'nullable|exists:users,refer_code',
                'phone' => 'nullable|unique:users,phone,' . auth()->id(),
                'email' => 'nullable|unique:users,email,' . auth()->id(),
                'image' => 'nullable|image|max:1024',
            ]);
            
            $user = auth()->user();

            if ($request->refer) {
                \App\Models\User::referBalanceAdd($user->id, $request->refer);
            }

            $user->update($request->except('image') + [
                'name' => $request->first_name,
                'image' => $request->image ? $this->upload($request, 'image') : null,
            ]);          
        
            return response()->json([
                'status' => 200,
                'message' => __('Profile completed successfully.'),
            ]);

        } else {
            return response()->json([
                'status' => 200,
                'message' => __('Unauthenticated.'),
            ], 401);
        }
    }
}