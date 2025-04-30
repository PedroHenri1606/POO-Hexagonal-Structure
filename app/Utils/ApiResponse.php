<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;

class ApiResponse{

    public function success(mixed $data = null, string $message = '', int $code = 200): JsonResponse {

        return response()->json([
            "success" => true,
            "message" => $message,
            "data"    => $data,
        ], $code);
    }

    public function error(mixed $data = null, string $message = '', int $code = 400): JsonResponse {

        return response()->json([
            "success" => false,
            "message" => $message,
            "data"    => $data,
        ], $code);
    }

    public function noContent(string $message = 'No Content'): JsonResponse {

        return response()->json([
            "success" => true,
            "message" => $message,
            "data"    => null,
        ], 204);
    }
}
