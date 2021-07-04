<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);
        if($validator->fails())
            return (new Collection([]))->add(false, $validator->errors()->all());

        $user = User::query()->where('email','=', $request->email)->first();

        if($user && Hash::check($request->password, $user->password)) {
            return (new Collection([
                'token' => $user->createToken('Blog')->accessToken
            ]))->add(true, ['Successfully logged in!']);
        }

        return (new Collection([]))->add(false, ['Email or password is wrong!']);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255|unique:users',
            'username' => 'required|string|min:6|max:255',
            'password' => 'required|string|min:6|max:32'
        ]);
        if($validator->fails())
            return (new Collection([]))->add(false, $validator->errors()->all());

        $user = new User();
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return (new Collection([]))->add(true, ['Successfully registered!']);
    }
}
