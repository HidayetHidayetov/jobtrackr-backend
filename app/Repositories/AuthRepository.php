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
    // User məlumatlarının saxlanması və əldə olunması üçün metodlar burada olacaq
} 