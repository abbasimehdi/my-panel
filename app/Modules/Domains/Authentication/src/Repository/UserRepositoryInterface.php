<?php

namespace App\Modules\Domains\Authentication\src\Repository;

interface UserRepositoryInterface
{
    public function login(array $data): array;
}
