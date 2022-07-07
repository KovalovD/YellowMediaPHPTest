<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function __construct(private UserService $service)
    {

    }

    public function register(Request $request): UserResource
    {
        $this->validate($request, [
            'first_name' => ['sometimes', 'string', 'nullable'],
            'last_name'  => ['sometimes', 'string', 'nullable'],
            'email'      => ['required', 'string', 'email', 'unique:users,email'],
            'password'   => ['required', 'string', (new Password(8))->letters()->mixedCase()->numbers()],
            'phone'      => ['sometimes', 'string', 'nullable', 'unique:users,phone'],
        ]);

        return new UserResource($this->service->register($request->all()));
    }
}
