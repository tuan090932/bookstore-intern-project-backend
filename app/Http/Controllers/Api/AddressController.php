<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Http\Requests\AddressRequest;
use Exception;

class AddressController extends Controller
{
    /**
     * Create a new AddressController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the addresses.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $user = auth('api')->user();
            $addresses = Address::where('user_id', $user->user_id)->get();

            return response()->json($addresses);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created address in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AddressRequest $request)
    {
        try {
            $user = auth('api')->user();
            $address = Address::create(array_merge($request->all(), ['user_id' => $user->user_id]));

            return response()->json($address, 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified address.
     *
     * @param  int  $address_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($address_id)
    {
        try {
            $user = auth('api')->user();
            $address = Address::where('user_id', $user->user_id)->where('address_id', $address_id)->firstOrFail();

            return response()->json($address);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified address in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AddressRequest $request, $id)
    {
        try {
            $user = auth('api')->user();
            $address = Address::where('user_id', $user->user_id)->where('address_id', $id)->firstOrFail();

            $address->update($request->all());

            return response()->json($address, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified address from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $user = auth('api')->user();
            $address = Address::where('user_id', $user->user_id)->where('address_id', $id)->firstOrFail();

            $address->delete();

            return response()->json(['message' => 'Address deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
