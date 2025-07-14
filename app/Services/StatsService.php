<?php

namespace App\Services;

use App\Models\User;
use App\Models\Application;
use App\Enums\ApplicationStatusEnum;

class StatsService
{
    public function getUserStats(User $user): array
    {
        $query = Application::where('user_id', $user->id);

        $total = $query->count();
        $statusCounts = [];
        foreach (ApplicationStatusEnum::cases() as $status) {
            $statusCounts[$status->value] = (clone $query)->where('status', $status->value)->count();
        }
        $lastAppliedAt = $query->max('applied_at');
        $cvSentCount = (clone $query)->where('cv_sent', true)->count();

        return [
            'total_applications' => $total,
            'status_counts' => $statusCounts,
            'last_applied_at' => $lastAppliedAt,
            'cv_sent_count' => $cvSentCount,
        ];
    }
} 