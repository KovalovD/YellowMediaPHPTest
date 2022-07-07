<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthService $service)
    {
    }

    public function signIn(Request $request): JsonResponse
    {
        return response()->json($this->service->signIn($request->post('email'), $request->post('password')));
    }

    public function recoverPassword(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'exists:users,email'],
        ]);

        return response()->json(
            $this->service->submitResetPasswordLink($request->post('email'))
                ? 'We have e-mailed your password reset link!'
                : 'Error'
        );
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'exists:users,email'],
            'token' => ['required', 'string'],
        ]);

        return response()->json($this->service->resetPassword($request->get('email'), $request->get('token')));
    }
}
