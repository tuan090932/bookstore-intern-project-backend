<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Factory|View
    {
        $users = User::with(['addresses'])->paginate(15);
        $users->each(function ($user) {
            $user->addresses = $user->addresses->first();
        });

        return view('admin.pages.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            // create user
            $user = new User();

            $user->user_name = $request->input('user_name');
            $user->email = $request->input('email');
            $user->phone_number = $request->input('phone_number');

            $user->password = Hash::make($request->input('password'));
            $user->save();

            // create address of user
            Address::create([
                'city' => $request->input('city'),
                'country_name' => $request->input('country_name'),
                'shipping_address' => $request->input('shipping_address'),
                'user_id' => $user->user_id,
            ]);
            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the user. Please try again.');
        }
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
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $addresses = Address::where('user_id', $id)->get();
        return view('admin.pages.users.edit', compact('user', 'addresses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        try {
            $user->update($request->validated());
            return redirect()->route('users.edit', $id)->with('success', 'User updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->route('users.index')->with('error', 'Failed to update the user. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * This method deletes the user and related addresses with user_id = $id.
     * It redirects the user to the users.index page with a success or error message.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            $user->bookOrders()->delete();

            $user->addresses()->delete();

            $user->favorites()->delete();
            if ($user->cart) {
                $user->cart->delete();
            }

            $user->delete();

            DB::commit();
            return redirect()->route('users.index')->with('success', 'User and all related data deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->route('users.index')->with('error', 'Failed to delete the user. Error: ' . $e->getMessage());
        }
    }
}
