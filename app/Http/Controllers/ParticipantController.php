<?php

namespace App\Http\Controllers;

use App\Http\Requests\Participant\StoreParticipantRequest;
use App\Http\Requests\Participant\UpdateParticipantRequest;
use App\Http\Resources\ParticipantCollection;
use App\Http\Resources\ParticipantResource;
use App\Models\Participant;
use App\Services\ParticipantService;
use Exception;
use Illuminate\Http\Request;

class ParticipantController extends ApiController
{
    private ParticipantService $service;

    public function __construct(ParticipantService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page');
            if ($perPage) {
                return new ParticipantCollection(Participant::paginate($perPage));
            }

            return new ParticipantCollection($this->service->all());
        } catch (Exception $e) {
            return $this->respondWithError([$e->getMessage()]);
        }
    }

    public function store(StoreParticipantRequest $request)
    {
        try {
            $participant = $this->service->store($request->validated());
            return new ParticipantResource($participant);
        } catch (Exception $e) {
            return $this->respondWithError([$e->getMessage()]);
        }
    }


    public function show(Participant $participant)
    {
        try {
            return new ParticipantResource($participant);
        } catch (Exception $e) {
            return $this->respondWithError([$e->getMessage()]);
        }
    }

    public function update(UpdateParticipantRequest $request, Participant $participant)
    {
        try {
            $participant = $this->service->update($participant, $request->validated());
            return new ParticipantResource($participant);
        } catch (Exception $e) {
            return $this->respondWithError([$e->getMessage()]);
        }
    }

    public function destroy(Participant $participant)
    {
        try {
            $this->service->delete($participant);
            return $this->respondSuccess();
        } catch (Exception $e) {
            return $this->respondWithError([$e->getMessage()]);
        }
    }
}
