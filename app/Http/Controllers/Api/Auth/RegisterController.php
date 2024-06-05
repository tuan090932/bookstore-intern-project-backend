<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Handles the user registration process.
     *
     * This method validates the input data, creates a new user, and returns a success response.
     * If the validation fails, an error response is returned.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // public function register(RegisterRequest $request)
    // {
    //     try
    //     {
    //         $user = User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //         ]);

    //         return response()->json([
    //             'message' => 'User successfully registered',
    //             'user' => $user
    //         ], 201);
    //     }
    //     catch (\Exception $e)
    //     {
    //         return response()->json([
    //             'message' => 'Registration failed',
    //             'error' => $e->getMessage()
    //         ], 400);
    //     }
    // }

    public function register(RegisterRequest $request)
    {
        try
        {
            $existingUser = User::where('email', $request->email)->first();

            if ($existingUser)
            {
                return response()->json([
                    'message' => 'Email already exists'
                ], 409);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'message' => 'User successfully registered',
                'user' => $user
            ], 201);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 400);
        }
    }

}
