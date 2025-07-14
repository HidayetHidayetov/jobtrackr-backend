<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\ApplicationService;
use App\Http\Resources\ApplicationResource;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class ApplicationController extends Controller
{
    use ApiResponse;
    
    protected ApplicationService $service;

    public function __construct(ApplicationService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $applications = $this->service->list($request->user());
        return $this->successResponse(
            ApplicationResource::collection($applications),
            'Applications fetched successfully'
        );
    }

    public function store(StoreApplicationRequest $request): JsonResponse
    {
        $application = $this->service->create($request->validated(), $request->user());
        return $this->successResponse(
            new ApplicationResource($application),
            'Application created successfully',
            201
        );
    }

    public function show($id, Request $request): JsonResponse
    {
        $application = $this->service->show($id, $request->user());
        if (!$application) {
            return $this->errorResponse('Application not found', 404);
        }
        return $this->successResponse(
            new ApplicationResource($application),
            'Application fetched successfully'
        );
    }

    public function update($id, UpdateApplicationRequest $request): JsonResponse
    {
        $application = $this->service->update($id, $request->validated(), $request->user());
        if (!$application) {
            return $this->errorResponse('Application not found or not authorized', 404);
        }
        return $this->successResponse(
            new ApplicationResource($application),
            'Application updated successfully'
        );
    }

    public function destroy($id, Request $request): JsonResponse
    {
        $deleted = $this->service->delete($id, $request->user());
        if (!$deleted) {
            return $this->errorResponse('Application not found or not authorized', 404);
        }
        return $this->successResponse(null, 'Application deleted successfully');
    }
}
