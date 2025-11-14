<?php

namespace App\Modules\Domains\Authentication\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Domains\Authentication\src\Http\Requests\LoginRequest;
use App\Modules\Domains\Authentication\src\Repository\UserRepository;
use App\Modules\Domains\Authentication\src\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        private UserRepository  $userRepository
    )
    {
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('API Token')->accessToken;

        return response()->json(['token' => $token], 201);
    }

    /**
     * @param Request $request
     * @return UserResource
     */
    public function login(LoginRequest $request): UserResource
    {
        return new UserResource((object)[
            'token' => $this->userRepository->login($request->all()),
        ]);
    }
}
