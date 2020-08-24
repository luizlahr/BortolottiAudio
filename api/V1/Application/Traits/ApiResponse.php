<?php

declare(strict_types = 1);

namespace Borto\Application\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    /** @param array|string|number $message */
    public function sendResponse($message = null, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json($message, $statusCode);
    }

    /** @param string|array $data */
    public function sendError(string $message, $data = null, int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json([
            "message" => $message,
            "errors" => $data,
        ], $statusCode);
    }
}
