<?php

namespace App\Repositories;

use App\Models\Application;
use App\Models\User;

class ApplicationRepository
{
    public function allByUser(User $user)
    {
        return Application::where('user_id', $user->id)->latest()->get();
    }

    public function findByIdAndUser(int $id, User $user): ?Application
    {
        return Application::where('id', $id)->where('user_id', $user->id)->first();
    }

    public function create(array $data): Application
    {
        return Application::create($data);
    }

    public function update(Application $application, array $data): Application
    {
        $application->update($data);
        return $application;
    }

    public function delete(Application $application): void
    {
        $application->delete();
    }
} 