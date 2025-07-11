<?php

namespace App\Services;

use App\Repositories\ApplicationRepository;
use App\Models\User;
use App\Models\Application;

class ApplicationService
{
    protected ApplicationRepository $repository;

    public function __construct(ApplicationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list(User $user)
    {
        return $this->repository->allByUser($user);
    }

    public function show(int $id, User $user): ?Application
    {
        return $this->repository->findByIdAndUser($id, $user);
    }

    public function create(array $data, User $user): Application
    {
        $data['user_id'] = $user->id;
        return $this->repository->create($data);
    }

    public function update(int $id, array $data, User $user): ?Application
    {
        $application = $this->repository->findByIdAndUser($id, $user);
        if ($application) {
            return $this->repository->update($application, $data);
        }
        return null;
    }

    public function delete(int $id, User $user): bool
    {
        $application = $this->repository->findByIdAndUser($id, $user);
        if ($application) {
            $this->repository->delete($application);
            return true;
        }
        return false;
    }
} 