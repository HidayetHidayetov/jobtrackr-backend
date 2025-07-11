<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthService
{
    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * Register a new user.
     *
     * @param array $data
     * @return User
     */
    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->authRepository->createUser($data);
    }

    // Register, login, logout və user info üçün metodlar burada olacaq
} 