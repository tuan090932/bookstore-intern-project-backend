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
     * Display a listing of the admin users.
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
     * Show the form for creating a new admin user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.pages.admins.create', compact('roles'));
    }

    /**
     * Store a newly created admin user in storage.
     *
     * @param  \App\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminRequest $request)
    {
        try {
            $admin = new AdminUser();

            $admin->fill($request->validated());
            $admin->password = Hash::make($request->password);
            $admin->save();

            return redirect()->route('admins.index')->with('success', __('messages.admin.created_success'));
        } catch (Exception $e) {
            Log::error('Error creating admin: ' . $e->getMessage());

            return redirect()->route('admins.create')->with('error', __('messages.admin.created_error'));
        }
    }

    /**
     * Show the form for editing the specified admin user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = AdminUser::findOrFail($id);
        $roles = Role::all();

        return view('admin.pages.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified admin user in storage.
     *
     * @param  \App\Http\Requests\AdminRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminRequest $request, $id)
    {
        try {
            $admin = AdminUser::findOrFail($id);
            $admin->fill($request->validated());
            $admin->save();

            return redirect()->route('admins.index')->with('success', __('messages.admin.updated_success'));
        } catch (Exception $e) {
            Log::error('Error updating admin: ' . $e->getMessage());

            return redirect()->route('admins.index')->with('error', __('messages.admin.updated_error'));
        }
    }

    /**
     * Remove the specified admin user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $admin = AdminUser::findOrFail($id);

            if ($admin->isAllRole()) {
                return redirect()->route('admins.index')->with('error', __('messages.admin.delete_all_role_error'));
            }
            $admin->delete();

            return redirect()->route('admins.index')->with('success', __('messages.admin.deleted_success'));
        } catch (Exception $e) {
            Log::error('Error deleting admin: ' . $e->getMessage());

            return redirect()->route('admins.index')->with('error', __('messages.admin.deleted_error'));
        }
    }

    /**
     * Delete selected admin users from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSelected(Request $request)
    {
        try {
            $adminIds = $request->input('ids', []);
            $admins = AdminUser::whereIn('admin_id', $adminIds)->get();

            $adminsToDelete = $admins->reject(function ($admin) {
                return $admin->isAllRole();
            });

            $adminsToDeleteIds = $adminsToDelete->pluck('admin_id');

            AdminUser::whereIn('admin_id', $adminsToDeleteIds)->delete();

            if ($admins->count() !== $adminsToDelete->count()) {
                return redirect()->back()->with('error', __('messages.admin.delete_all_role_error'));
            }

            return redirect()->back()->with('success', __('messages.admin.selected_deleted_success'));
        } catch (Exception $e) {
            Log::error('Error deleting selected admins: ' . $e->getMessage());

            return redirect()->back()->with('error', __('messages.admin.selected_deleted_error'));
        }
    }

    /**
     * Delete all admin users except those with 'ALL' role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        try {
            $admins = AdminUser::all();
            $adminsToDelete = $admins->reject(function ($admin) {
                return $admin->isAllRole();
            });

            $adminsToDeleteIds = $adminsToDelete->pluck('admin_id');

            AdminUser::whereIn('admin_id', $adminsToDeleteIds)->delete();

            if ($admins->count() !== $adminsToDelete->count()) {
                return redirect()->back()->with('warning', __('messages.admin.delete_all_except_all_role'));
            }

            return redirect()->back()->with('success', __('messages.admin.all_deleted_success'));
        } catch (Exception $e) {
            Log::error('Error deleting all admins: ' . $e->getMessage());

            return redirect()->back()->with('error', __('messages.admin.all_deleted_error'));
        }
    }

    /**
     * Display a listing of the trashed admin users.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $admins = AdminUser::onlyTrashed()->paginate(15);
        return view('admin.pages.admins.restore', compact('admins'));
    }

    /**
     * Restore the specified trashed admin user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        try {
            $admin = AdminUser::onlyTrashed()->findOrFail($id);
            $admin->restore();

            return redirect()->route('admins.trashed')->with('success', __('messages.admin.restored_success'));
        } catch (Exception $e) {
            Log::error('Error restoring admin: ' . $e->getMessage());

            return redirect()->route('admins.trashed')->with('error', __('messages.admin.restored_error'));
        }
    }

    /**
     * Restore selected trashed admin users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreSelected(Request $request)
    {
        try {
            $adminIds = $request->input('ids', []);
            AdminUser::onlyTrashed()->whereIn('admin_id', $adminIds)->restore();

            return redirect()->back()->with('success', __('messages.admin.selected_restored_success'));
        } catch (Exception $e) {
            Log::error('Error restoring selected admins: ' . $e->getMessage());

            return redirect()->back()->with('error', __('messages.admin.selected_restored_error'));
        }
    }

    /**
     * Restore all trashed admin users.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        try {
            AdminUser::onlyTrashed()->restore();

            return redirect()->back()->with('success', __('messages.admin.all_restored_success'));
        } catch (Exception $e) {
            Log::error('Error restoring all admins: ' . $e->getMessage());

            return redirect()->back()->with('error', __('messages.admin.all_restored_error'));
        }
    }
}
