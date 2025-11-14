<?php

namespace App\Modules\Domains\Authentication\src\Repository;

use App\Models\User;
use App\Modules\Domains\Core\src\Repository\CoreRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository extends CoreRepository implements  UserRepositoryInterface
{
    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return array|string[]
     */
    public function login(array $data): array
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return ['message' => 'Invalid credentials'];
        }

        $token = $user->createToken('API Token')->accessToken;

        return ['token' => $token];
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
