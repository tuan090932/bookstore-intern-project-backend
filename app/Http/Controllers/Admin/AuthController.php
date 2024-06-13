<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\AdminLoginRequest;
use App\Models\AdminUser;
use App\Exceptions\AdminException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
     * Store a newly created admin account in the database.
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
                'password' => Hash::make($request->password),
                'email' => $request->email,
            ]);

            return redirect()->route('admin.login')->with('success', 'Tạo tài khoản thành công vui lòng đăng nhập.');
        }
        catch (Exception $e)
        {
            return AdminException::handle($e);
        }
    }

    /**
     * Show the form for logging in.
     *
     * @return \Illuminate\View\View
     */
    public function loginForm()
    {
        return view('admin.pages.auth.login');
    }

    /**
     * Handle an admin login request.
     *
     * @param  \App\Http\Requests\AdminLoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function login(AdminLoginRequest $request)
    // {
    //     try
    //     {
    //         // Lấy thông tin người dùng dựa trên email
    //         $adminUser = AdminUser::where('email', $request->email)->first();

    //         // Kiểm tra xem người dùng có tồn tại không
    //         if (!$adminUser)
    //         {
    //             return back()->withErrors(['email' => 'Thông tin email không chính xác.'])->onlyInput('email');
    //         }



    //         // Sử dụng Hash::check để kiểm tra mật khẩu
    //         if (Hash::check($request->password, $adminUser->password))
    //         {
    //             dd($adminUser);
    //             // Đăng nhập người dùng
    //             Auth::guard('admin')->login($adminUser);
    //             // Lưu tên admin vào session
    //             Session::put('adminName', $adminUser->admin_name);
    //             return redirect()->route('admin.dashboard');
    //         }

    //         return back()->withErrors(['password' => 'Thông tin mật khẩu không chính xác.'])->onlyInput('email');
    //     }
    //     catch (Exception $e)
    //     {
    //         return AdminException::handle($e);
    //     }
    // }

    public function login(AdminLoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::guard('admin')->attempt($credentials)) {
                $adminName = Auth::guard('admin')->user()->admin_name;
                Session::put('adminName', $adminName);
                return redirect()->route('admin.dashboard');
            }

            return back()->withErrors(['password' => 'Thông tin mật khẩu không chính xác.'])->onlyInput('email');
        } catch (Exception $e) {
            return AdminException::handle($e);
        }
    }



    /**
     * Log the admin out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->forget('adminName');
        return redirect()->route('admin.login');
    }

}
