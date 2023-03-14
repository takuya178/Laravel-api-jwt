<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('api', ['except' => ['login']]);
    }

    public function register(Request $request)
    {
        $user = new User;
        $user->fill($request->all());
        $user->password=bcrypt($request->password);
        $user->save();
        return $this->publishToken($request);
    }

    public function login(Request $request)
    {
        // ログインしている場合はトークンを再生成せずに、現在のトークンを返す
        if (auth('api')->check()) {
            $token = auth('api')->getToken();
            return $this->respondWithToken($token);
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'ログインに失敗しました。'], 401);
        }

        $token = Auth::guard('api')->attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'トークンの発行に失敗しました。']);
        }

        return $this->publishToken($request);
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'ログアウトしました。']);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function publishToken($request)
    {
        $token = auth('api')->attempt(['email' => $request->email, 'password' => $request->password]);
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user(),
        ]);
    }
}
