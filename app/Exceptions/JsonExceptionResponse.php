<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonExceptionResponse
{

    public static function error(string $message = '', int $httpCode = Response::HTTP_BAD_REQUEST, ?\Throwable $e = null) {
        $data = [
            'error' => [
                'code' => $httpCode,
                'message' => $message,
            ]
        ];

        if ($e !== null && config('app.debug')) {
            $data['debug'] = [
                'exceptionClass' => get_class($e),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ];
        }
        return new JsonResponse($data, $httpCode);
    }
}
