<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function info()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Você foi desconectado com sucesso!']);
    }

//    /**
//     * Refresh a token.
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function refresh()
//    {
//        return $this->respondWithToken(auth('api')->refresh());
//    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    /**
     * Welcome message.
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $welcome = 'Bem vindo a Api do Desafio WeCont!';
        return response()->json(['message' => $welcome]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->validate($request, [
//            'name' => 'required',
//            'email' => 'required|email|unique:users',
//            'password' => 'required',
//        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->remember_token = Str::random(10);
        $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->password = Hash::make($request->password);

        if($user->save()){
            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Desculpe, o usuário não pode ser criado'
            ], 500);
        }

    }



}
