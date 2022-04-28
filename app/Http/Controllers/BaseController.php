<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends Controller
{
    public function createResponse(string $message, array $data = [], int $httpCode = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'message' => $message
        ];

        if (!empty($data)) {
            $response = array_merge($response, $data);
        }

        return response()->json($response, $httpCode);
    }

    public function createResponseErrors(string $message, array $errors, int $httpCode = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'message' => $message
        ];

        if (!empty($errors)) {
            $errors = ['errors' => $errors];
            $response = array_merge($response, $errors);
        }

        return response()->json($response, $httpCode);
    }
}
