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

    /**
     * Attempt to log in a user.
     *
     * @param array $credentials
     * @return User
     * @throws \Exception
     */
    public function login(array $credentials): User
    {
        $user = $this->authRepository->findByEmail($credentials['email']);
        if (!$user || !\Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            throw new \Exception('Invalid credentials.');
        }
        return $user;
    }

    /**
     * Logout the current user by revoking the current access token.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function logout(User $user): void
    {
        $user->currentAccessToken()?->delete();
    }

    // Register, login, logout və user info üçün metodlar burada olacaq
} 