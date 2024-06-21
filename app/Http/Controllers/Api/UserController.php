<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\ApiUserExceptionHandler;
use App\Http\Requests\UpdateProfileRequest;
use Exception;

class UserController extends Controller
{
    /**
     * Constructor for the UserController class.
     *
     * This constructor sets up the middleware for the controller's actions.
     * The 'auth:api' middleware is applied to all actions to ensure that only authenticated users can access them.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($userId)
    {
        try {
            // Fetch the authenticated user from the request
            $authUser = auth()->user();

            // Check if the authenticated user's ID matches the requested user's ID
            if ($authUser->user_id != $userId) {
                return response()->json(['error' => 'You are not authorized to view this user information.'], 403);
            }

            // Retrieve the user from the database and return as JSON response
            $user = User::findOrFail($userId);
            return response()->json($user);
        } catch (Exception $ex) {
            // Handle exceptions gracefully through the ApiUserExceptionHandler
            return ApiUserExceptionHandler::handle($ex);
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @param  int  $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProfileRequest $request, $userId)
    {
        try {
            // Fetch the authenticated user from the request
            $authUser = auth()->user();

            // Check if the authenticated user's ID matches the requested user's ID
            if ($authUser->user_id != $userId) {
                return response()->json(['error' => 'You are not authorized to update this user information.'], 403);
            }

            // Retrieve the user from the database
            $user = User::findOrFail($userId);

            // Update the user attributes based on the request
            $updatableAttributes = $request->only(['user_name', 'email', 'name', 'phone_number']);

            foreach ($updatableAttributes as $key => $value) {
                $user->$key = $value;
            }

            // If password is provided, validate and update it
            if ($request->filled('password')) {
                if (!Hash::check($request->old_password, $user->password)) {
                    return response()->json(['old_password' => 'The old password is incorrect.'], 400);
                }

                $user->password = Hash::make($request->password);
            }

            // Save the updated user object
            $user->save();

            // Return the updated user as JSON response
            return response()->json($user);
        } catch (Exception $ex) {
            // Handle exceptions gracefully through the ApiUserExceptionHandler
            return ApiUserExceptionHandler::handle($ex);
        }
    }
}
