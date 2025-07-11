<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository
{
    /**
     * Create a new user in the database.
     *
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        return User::create($data);
    }

    /**
     * Find a user by email.
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
    // User məlumatlarının saxlanması və əldə olunması üçün metodlar burada olacaq
} 