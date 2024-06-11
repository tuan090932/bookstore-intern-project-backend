<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['addresses'])->get();
        $users->each(function ($user) {
            $user->addresses = $user->addresses->first();
        });
        return view('admin.pages.users.index', compact('users'));
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
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:250',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:250',
            'password' => 'required|min:6',
            'city' => 'required|string|max:250',
            'country_name' => 'required|string|max:250',
            'shipping_address' => 'required',
        ]);

        // create user
        $user = new User();
        $user->makeVisible(['password']);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * This method deletes the user and related addresses with user_id = $id. 
     * It redirects the user to the users.index page with a success or error message.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        try {
            Address::where('user_id', $id)->delete();
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Failed to delete the user. Please try again.');
        }
    }
}
