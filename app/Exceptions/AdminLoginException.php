<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class AdminLoginException extends Exception
{
    public static function handle(Exception $exception): RedirectResponse
    {
        $message = 'Đăng nhập thất bại. Vui lòng thử lại.';
        $status = 'error';

        if ($exception instanceof QueryException) {
            Log::error('Database error during admin login: ' . $exception->getMessage());
            $message = 'Có lỗi cơ sở dữ liệu. Vui lòng thử lại.';
        } elseif ($exception instanceof ValidationException) {
            Log::error('Validation error during admin login: ' . $exception->getMessage());
            $message = 'Dữ liệu không hợp lệ. Vui lòng kiểm tra lại thông tin.';
        } else {
            Log::error('Error during admin login: ' . $exception->getMessage());
        }

        return redirect()->route('admin.login')->with($status, $message);
    }
}
