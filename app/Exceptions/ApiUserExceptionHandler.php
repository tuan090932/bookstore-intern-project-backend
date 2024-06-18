<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ApiUserExceptionHandler
{
    /**
     * Handle the exception
     *
     * @param Exception $ex
     * @return JsonResponse
     */
    public static function handle(Exception $ex): JsonResponse
    {
        if ($ex instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Not Found',
                'message' => $ex->getMessage()
            ], 404);
        } elseif ($ex instanceof ValidationException) {
            Log::error($ex->errors());
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $ex->errors()
            ], 400);
        } elseif ($ex instanceof QueryException) {
            return response()->json([
                'error' => 'Query Exception',
                'message' => $ex->getMessage()
            ], 500);
        } else {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }
}

