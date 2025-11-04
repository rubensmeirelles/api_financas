<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success($data, $message): JsonResponse
    {
        return response()->json(
            [
                'status_code' => 200,
                'message' => $message,
                'data' => $data
            ],200
        );
    }

    public static function created($data, $message): JsonResponse
    {
        return response()->json(
            [
                'status_code' => 201,
                'message' => $message,
                'data' => $data
            ],201
        );
    }

    public static function error($message): JsonResponse
    {
        return response()->json(
            [
                'status_code' => 404,
                'message' => $message,
            ],404
        );
    }

    public static function unauthorized(): JsonResponse
    {
        return response()->json(
            [
                'status_code' => 401,
                'message' => 'Acesso não autorizado.',
            ],401
        );
    }
}