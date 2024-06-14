<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class AdminException extends Exception
{
    public static function handle(Exception $exception): RedirectResponse
    {
        $message = 'Tạo tài khoản thất bại. Vui lòng thử lại.';
        $status = 'error';

        if ($exception instanceof QueryException)
        {
            Log::error('Database error creating admin account: ' . $exception->getMessage());
            $message = 'Có lỗi cơ sở dữ liệu. Vui lòng thử lại.';
        }
        elseif ($exception instanceof ValidationException)
        {
            Log::error('Validation error creating admin account: ' . $exception->getMessage());
            $message = 'Dữ liệu không hợp lệ. Vui lòng kiểm tra lại thông tin.';
        }
        else
        {
            Log::error('Error creating admin account: ' . $exception->getMessage());
        }

        return redirect()->route('admin.register')->with($status, $message);
    }
}
