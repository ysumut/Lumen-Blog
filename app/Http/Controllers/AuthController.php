<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);
        if($validator->fails()) {
            return [
                'data' => [],
                'status' => [
                    'success' => false,
                    'message' => $validator->errors()->all()
                ]
            ];
        }

        $user = User::where('username', $request->username)->first();

        if($user && Hash::check($request->password, $user->password)) {
            return [
                'data' => [],
                'status' => [
                    'success' => true,
                    'message' => ['Successfully logged in!']
                ]
            ];
        }

        return [
            'data' => [],
            'status' => [
                'success' => false,
                'message' => ['Username or password is wrong!']
            ]
        ];
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);
        if($validator->fails()) {
            return [
                'data' => [],
                'status' => [
                    'success' => false,
                    'message' => $validator->errors()->all()
                ]
            ];
        }

        $user = new User();
        $user->full_name = $request->full_name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return [
            'data' => [],
            'status' => [
                'success' => true,
                'message' => ['Successfully registered!']
            ]
        ];
    }
}
