<?php

namespace App\Http\Controllers;

use App\Http\Requests\Location\StoreLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Services\LocationService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends ApiController
{
    public LocationService $service;

    public function __construct(LocationService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page');
            if ($perPage) {
                return new LocationCollection(Location::paginate($perPage));
            }

            return new LocationCollection($this->service->all());
        } catch (Exception $e) {
            return $this->respondWithError([$e->getMessage()]);
        }
    }

    public function store(StoreLocationRequest $request)
    {
        try {
            $location = $this->service->store($request->validated());
            return new LocationResource($location);
        } catch (Exception $e) {
            return $this->respondWithError([$e->getMessage()]);
        }
    }


    public function show(Location $location)
    {
        try {
            return new LocationResource($location);
        } catch (Exception $e) {
            return $this->respondWithError([$e->getMessage()]);
        }
    }

    public function update(UpdateLocationRequest $request, Location $location)
    {
        try {
            $location = $this->service->update($location, $request->validated());
            return new LocationResource($location);
        } catch (Exception $e) {
            return $this->respondWithError([$e->getMessage()]);
        }
    }

    public function destroy(Location $location): JsonResponse
    {
        try {
            $this->service->delete($location);
            return $this->respondSuccess();
        } catch (Exception $e) {
            return $this->respondWithError([$e->getMessage()]);
        }
    }
}
