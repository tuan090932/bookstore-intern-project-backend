<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Http\JsonResponse;

class ApiUserExceptionHandler
{
    /**
     * Handle the exception.
     *
     * @param Exception $ex
     * @return JsonResponse
     */
    public static function handle(Exception $ex): JsonResponse
    {
        if ($ex instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Không tìm thấy người dùng',
                'message' => $ex->getMessage()
            ], 404);
        } elseif ($ex instanceof ValidationException) {
            return response()->json([
                'error' => 'Lỗi xác thực',
                'messages' => $ex->errors()
            ], 400);
        } elseif ($ex instanceof QueryException) {
            return response()->json([
                'error' => 'Lỗi cơ sở dữ liệu',
                'message' => $ex->getMessage()
            ], 500);
        } else {
            return response()->json([
                'error' => 'Đã xảy ra lỗi không mong muốn',
                'message' => $ex->getMessage()
            ], 500);
        }
    }
}
