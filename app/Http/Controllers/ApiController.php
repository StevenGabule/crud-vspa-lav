<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    public function respondSuccess($data = []): JsonResponse
    {
        return $this->respond(['data' => $data]);
    }

    public function respondCreated($data = []): JsonResponse
    {
        return $this->respond(['data' => $data], Response::HTTP_CREATED);
    }

    public function respondAccepted($data = []): JsonResponse
    {
        return $this->respond(['data' => $data], Response::HTTP_ACCEPTED);
    }

    public function respondNoContent(): JsonResponse
    {
        return $this->respond([], Response::HTTP_NO_CONTENT);
    }

    public function respondWithError($errors = [], int $status = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return $this->respond(['errors' => ['messages' => $errors]], $status);
    }

    public function respondNotFound(string $message = 'Not Found!'): JsonResponse
    {
        return $this->respond(['errors' => ['messages' => $message]], Response::HTTP_NOT_FOUND);
    }

    private function respond($data = [], $status = Response::HTTP_OK, $headers = [], $options = 0): JsonResponse
    {
        return \Response::json($data, $status, $headers, $options);
    }
}
