<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class UpdateProfileException extends Exception
{
    public static function handle(Exception $exception): RedirectResponse
    {
        $message = 'Đã xảy ra lỗi khi cập nhật hồ sơ. Vui lòng thử lại.';
        $status = 'error';

        if ($exception instanceof ModelNotFoundException)
        {
            Log::error('Model not found during profile update: ' . $exception->getMessage());
            $message = 'Không tìm thấy admin.';
        }
        elseif ($exception instanceof ValidationException)
        {
            Log::error('Validation error during profile update: ' . $exception->getMessage());
            return redirect()->route('admin.profile')->withErrors($exception->validator)->withInput();
        }
        elseif ($exception instanceof QueryException)
        {
            Log::error('Database error during profile update: ' . $exception->getMessage());
            $message = 'Lỗi cơ sở dữ liệu. Vui lòng thử lại.';
        }
        else
        {
            Log::error('Lỗi trong quá trình cập nhật hồ sơ: ' . $exception->getMessage());
        }

        return redirect()->route('admin.profile')->with($status, $message);
    }
}
