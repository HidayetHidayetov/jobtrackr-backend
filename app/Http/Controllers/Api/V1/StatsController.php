<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StatsService;
use App\Traits\ApiResponse;

class StatsController extends Controller
{
    use ApiResponse;

    protected StatsService $statsService;

    public function __construct(StatsService $statsService)
    {
        $this->statsService = $statsService;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $stats = $this->statsService->getUserStats($user);
        return $this->successResponse($stats, 'User statistics fetched successfully');
    }
}
