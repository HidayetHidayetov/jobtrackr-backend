<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\ApplicationService;
use App\Http\Resources\ApplicationResource;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    protected ApplicationService $service;

    public function __construct(ApplicationService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $applications = $this->service->list($request->user());
        return response()->json([
            'success' => true,
            'message' => 'Applications fetched successfully',
            'data' => ApplicationResource::collection($applications),
        ]);
    }

    public function store(StoreApplicationRequest $request): JsonResponse
    {
        $application = $this->service->create($request->validated(), $request->user());
        return response()->json([
            'success' => true,
            'message' => 'Application created successfully',
            'data' => new ApplicationResource($application),
        ], 201);
    }

    public function show($id, Request $request): JsonResponse
    {
        $application = $this->service->show($id, $request->user());
        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found',
                'data' => null,
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Application fetched successfully',
            'data' => new ApplicationResource($application),
        ]);
    }

    public function update($id, UpdateApplicationRequest $request): JsonResponse
    {
        $application = $this->service->update($id, $request->validated(), $request->user());
        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found or not authorized',
                'data' => null,
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Application updated successfully',
            'data' => new ApplicationResource($application),
        ]);
    }

    public function destroy($id, Request $request): JsonResponse
    {
        $deleted = $this->service->delete($id, $request->user());
        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found or not authorized',
                'data' => null,
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Application deleted successfully',
            'data' => null,
        ]);
    }
}
