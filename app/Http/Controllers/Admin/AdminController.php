<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUser;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\AdminRequest;

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
        $currentAdmin = auth()->guard('admin')->user();

        return view('admin.pages.admins.index', compact('admins', 'currentAdmin'));
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
    public function store(AdminRequest $request)
    {
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
    public function update(AdminRequest $request, $id)
    {
        $admin = AdminUser::findOrFail($id);
        $admin->fill($request->validated());
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

            if ($admin->role_id === 'ALL') {
                return redirect()->route('admins.index')->with('error', 'Admin user with role ALL cannot be delete.');
            }

            $admin->delete();
            return redirect()->route('admins.index')->with('success', 'Admin user deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error deleting admin: ' . $e->getMessage());
            return redirect()->route('admins.index')->with('error', 'Failed to delete admin user.');
        }
    }

    public function deleteSelected(Request $request)
    {
        try {
            $adminIds = $request->input('ids', []);
            $admins = AdminUser::whereIn('admin_id', $adminIds)->get();

            $adminsToDelete = $admins->filter(function ($admin) {
                return $admin->role_id !== 'ALL';
            });

            $adminsToDeleteIds = $adminsToDelete->pluck('admin_id');

            AdminUser::whereIn('admin_id', $adminsToDeleteIds)->delete();

            if ($admins->count() !== $adminsToDelete->count()) {
                return redirect()->back()->with('error', 'Admin user with role ALL cannot be deleted.');
            }

            return redirect()->back()->with('success', __('messages.admin.selected_deleted_success'));
        } catch (Exception $e) {
            Log::error('Error deleting selected admins: ' . $e->getMessage());
            return redirect()->back()->with('error', __('messages.admin.selected_deleted_error'));
        }
    }

    /**
     * Display a listing of the trashed resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $admins = AdminUser::onlyTrashed()->paginate(15);
        return view('admin.pages.admins.restore', compact('admins'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        try {
            $admin = AdminUser::onlyTrashed()->findOrFail($id);
            $admin->restore();

            return redirect()->route('admins.trashed')->with('success', 'Admin user restored successfully.');
        } catch (Exception $e) {
            Log::error('Error restoring admin: ' . $e->getMessage());
            return redirect()->route('admins.trashed')->with('error', 'Failed to restore admin user.');
        }
    }

    /**
     * Restore selected resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restoreSelected(Request $request)
    {
        try {
            $adminIds = $request->input('ids', []);
            // dd($adminIds);

            AdminUser::onlyTrashed()->whereIn('admin_id', $adminIds)->restore();

            return redirect()->back()->with('success', 'Selected admin users restored successfully.');
        } catch (Exception $e) {
            Log::error('Error restoring selected admins: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to restore selected admin users.');
        }
    }

    /**
     * Restore all trashed resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreAll()
    {
        try {
            AdminUser::onlyTrashed()->restore();

            return redirect()->back()->with('success', 'All admin users restored successfully.');
        } catch (Exception $e) {
            Log::error('Error restoring all admins: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to restore all admin users.');
        }
    }
}
