<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRegisterRequest;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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
     * Store a newly created admin in the database.
     *
     * @param  \App\Http\Requests\AdminRegisterRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminRegisterRequest $request)
    {
        try {
            // Create the admin
            AdminUser::create([
                'admin_name' => $request->admin_name,
                'admin_password' => Hash::make($request->admin_password),
                'admin_email' => $request->admin_email,
            ]);

            return redirect()->route('admin.register')->with('success', 'Admin account created successfully.');
        }
        catch (\Exception $e)
        {
            // Log the error message if necessary
            \Log::error('Error creating admin account: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('admin.register')->with('error', 'Failed to create admin account. Please try again.');
        }
    }
}
