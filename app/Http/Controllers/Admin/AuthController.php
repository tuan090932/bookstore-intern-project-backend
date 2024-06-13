<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\AdminLoginRequest;
use App\Models\AdminUser;
use App\Exceptions\AdminException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Exception;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['loginForm', 'login', 'register', 'store']);
    }

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
                'admin_password' => Hash::make($request->admin_password),
                'admin_email' => $request->admin_email,
            ]);

            return redirect()->route('admin.register')->with('success', 'Tạo tài khoản thành công.');
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
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(AdminLoginRequest $request)
    {
        try
        {
            $credentials = [
                'email' => $request->admin_email,
                'password' => $request->admin_password,
            ];

            $authenticated = Auth::guard('admin')->attempt($credentials);

            if ($authenticated)
            {
                return redirect()->route('admin.dashboard');
            }

            return back()->withErrors(['admin_email' => 'Thông tin email không chính xác.',])->onlyInput('admin_email');
        }
        catch (Exception $e)
        {
            return AdminException::handle($e);
        }
    }
}
