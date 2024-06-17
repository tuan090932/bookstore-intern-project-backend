<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Http\Requests\AddressRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request)
    {
        $request->validated();
        $user_id = $request->input('user_id');
        try {
            Address::create([
                'city' => $request->input('city'),
                'country_name' => $request->input('country_name'),
                'shipping_address' => $request->input('shipping_address'),
                'user_id' => $user_id,
            ]);
            return redirect()->route('users.edit', $user_id);
        } catch (Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->route('users.index')->with('error', 'Failed to add the address. Please try again.');
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
        $address = Address::findOrFail($id);
        return view('admin.pages.users.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request, string $id)
    {
        $request->validated();
        $address = Address::findOrFail($id);
        try {
            $address->update($request->all());
            return redirect()->route('users.edit', $id)->with('success', 'Address updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating address: ' . $e->getMessage());
            return redirect()->route('addresses.edit')->with('error', 'Failed to update the address. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $address = Address::findOrFail($id);
            $address->delete();
            return redirect()->back()->with('success', 'Address deleted successfully');
        } catch (Exception $e) {
            Log::error('Error deleting address: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete the address. Please try again.');
        }
    }
}
