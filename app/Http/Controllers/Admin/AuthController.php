<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\AdminLoginRequest;
use App\Models\AdminUser;
use App\Exceptions\AdminException;
use App\Exceptions\AdminLoginException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Exceptions\UpdateProfileException;
use Exception;

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
    public function login(AdminLoginRequest $request)
    {
        try
        {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            $emailExists = AdminUser::where('email', $request->email)->exists();

            if (!$emailExists)
            {
                return back()->withErrors(['email' => 'Thông tin email không chính xác.'])->onlyInput('email');
            }

            $authenticated = Auth::guard('admin')->attempt($credentials);

            if ($authenticated)
            {
                // $request->session()->regenerate();
                // $adminName = Auth::guard('admin')->user()->admin_name;
                // Session::put('adminName', $adminName);
                // dd(Auth::guard('admin')->user(), session()->all());
                // return redirect()->route('admin.dashboard');
                $request->session()->regenerate();
                $adminUser = Auth::guard('admin')->user();
                session(['adminUser' => $adminUser]);
                return redirect()->route('admin.dashboard');
            }

            return back()->withErrors(['password' => 'Thông tin mật khẩu không chính xác.'])->onlyInput('email');
        }
        catch (Exception $e)
        {
            return AdminLoginException::handle($e);
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
        return redirect()->route('admin.dashboard');
    }

    /**
     * Show the admin profile.
     *
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {
        $admin = session('adminUser') ?? Auth::guard('admin')->user();

        return view('admin.pages.auth.profile', compact('admin'));
    }

    /**
     * Show the form for editing the admin profile.
     *
     * @return \Illuminate\View\View
     */
    public function editProfile()
    {
        $admin = session('adminUser') ?? Auth::guard('admin')->user();

        return view('admin.pages.auth.update', compact('admin'));
    }

    /**
     * Update the admin profile in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(UpdateProfileRequest $request, $id)
    {
        try
        {
            $admin = AdminUser::findOrFail($id);
            $admin->update($request->only(['phone', 'address', 'email', 'name']));
            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
        }
        catch (Exception $e)
        {
            return redirect()->route('admin.profile')->with('error', 'An error occurred while updating the profile.');
        }
    }
}
