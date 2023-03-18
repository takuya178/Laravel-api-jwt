<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\RegisterOwnerRequest;
use App\Http\Requests\LoginOwnerRequest;

class OwnerAuthController extends Controller
{
    public function __construct()
    {
        Config::set('auth.defaults.guard', 'owner-api');
    }

    public function login(LoginOwnerRequest $request)
    {
       $credentials = $request->validated();
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    public function register(RegisterOwnerRequest $request)
    {
        $owner = Owner::create(array_merge(
            $request->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json([
            'message' => 'ユーザー登録に成功しました。',
            'owner' => $owner
        ], 201);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'ログアウトに成功しました。']);
    }

    public function userProfile()
    {
        return response()->json([auth()->user()]);
    }

    public function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => strtotime(date('Y-m-d H:i:s', strtotime("+60 min"))),
            'owner' => auth()->user()
        ]);
    }
}
