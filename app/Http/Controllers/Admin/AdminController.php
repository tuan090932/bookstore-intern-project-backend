<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUser;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Log;

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
            'role_id' => 'required|exists:roles,role_id',
            'password' => 'nullable|string|min:8|confirmed',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        $admin = AdminUser::findOrFail($id);

        $admin->role_id = $request->role_id;
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->address = $request->address;
        $admin->phone = $request->phone;

        $admin->save();

        return redirect()->route('admins.index')->with('success', 'Admin user updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $admin = AdminUser::findOrFail($id);



            $admin->delete();
            return redirect()->route('admins.index')->with('success', 'Admin user deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error deleting admin: ' . $e->getMessage());
            return redirect()->route('admins.index')->with('error', 'Failed to delete admin user.');
        }
    }

    public function restore($id)
    {
        try {
            $admin = AdminUser::onlyTrashed()->findOrFail($id);
            $admin->restore();
            return redirect()->route('admins.index')->with('success', 'Admin user restored successfully.');
        } catch (Exception $e) {
            Log::error('Error restoring admin: ' . $e->getMessage());
            return redirect()->route('admins.index')->with('error', 'Failed to restore admin user.');
        }
    }

    public function deleteSelected(Request $request)
    {
        $adminIdsInput = $request->input('admin_ids', '');
        $adminIdsArray = explode(',', $adminIdsInput);
        $adminIds = array_filter($adminIdsArray, function($value) {
            return !empty($value) && is_numeric($value);
        });

        dd($adminIds);

        AdminUser::whereIn('admin_id', $adminIds)->delete();

        return redirect()->back()->with('success', __('Admin user deleted successfully.'));
    }

    public function restoreSelected(Request $request)
    {
        $adminIds = $request->input('admin_ids', []);
        try {
            AdminUser::onlyTrashed()->whereIn('id', $adminIds)->restore();
            return redirect()->route('admins.index')->with('success', 'Selected admin users restored successfully.');
        } catch (Exception $e) {
            Log::error('Error restoring selected admins: ' . $e->getMessage());
            return redirect()->route('admins.index')->with('error', 'Failed to restore selected admin users.');
        }
    }
}
