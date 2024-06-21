<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUser;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = AdminUser::paginate(15);

        return view('admin.pages.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.pages.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'admin_name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,role_id',
            'password' => 'required|string|min:6|confirmed',
            'email' => 'required|string|email|max:255|unique:admin,email',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        $admin = new AdminUser();
        $admin->admin_name = $request->admin_name;
        $admin->role_id = $request->role_id;
        $admin->password = Hash::make($request->password);
        $admin->email = $request->email;
        $admin->address = $request->address;
        $admin->phone = $request->phone;

        $admin->save();

        return redirect()->route('admins.index')->with('success', 'Admin user created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

   /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin = AdminUser::findOrFail($id);
        $roles = Role::all();

        return view('admin.pages.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'admin_name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,role_id',
            'password' => 'nullable|string|min:8|confirmed',
            'email' => 'required|string|email|max:255|unique:admin,email,' . $id . ',admin_id',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        $admin = AdminUser::findOrFail($id);

        $admin->admin_name = $request->admin_name;
        $admin->role_id = $request->role_id;
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->email = $request->email;
        $admin->address = $request->address;
        $admin->phone = $request->phone;

        $admin->save();

        return redirect()->route('admin.admins-account')->with('success', 'Admin user updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
