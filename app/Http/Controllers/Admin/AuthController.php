<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRegisterRequest;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Show the form for creating a new admin.
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {
        return view('admin.pages.auth.register');
    }

    /**
     * Store a newly admin account in database.
     *
     * @param  \App\Http\Requests\AdminRegisterRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminRegisterRequest $request)
    {
        try
        {
            AdminUser::create([
                'admin_name' => $request->admin_name,
                'admin_password' => Hash::make($request->admin_password),
                'admin_email' => $request->admin_email,
            ]);

            return redirect()->route('admin.register')->with('success', 'Tạo tài khoản thành công.');
        }
        catch (Exception $e)
        {
            Log::error('Error creating admin account: ' . $e->getMessage());

            return redirect()->route('admin.register')->with('error', 'Tạo tài khoản thất bại. Vui lòng thử lại.');
        }
    }
}
