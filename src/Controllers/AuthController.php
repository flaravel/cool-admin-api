<?php

namespace Cool\Controllers;

use Illuminate\Http\JsonResponse;
use Cool\Requests\AuthLoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Cool\Traits\ResponseTrait as CoolResponseTrait;

class AuthController extends Controller
{
    use CoolResponseTrait;

    /**
     * @param AuthLoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(AuthLoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $token = Auth::guard('cool')->attempt($validated);
        if (!$token) {
            return $this->error('账号或密码错误');
        }
        return $this->respondWithToken($token);
    }


    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::guard('cool')->logout();

        return $this->message('退出成功');
    }

    /**
     * @param $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        return $this->success([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => optional(Auth::guard('cool'))->factory()->getTTL() * 60
        ]);
    }
}
