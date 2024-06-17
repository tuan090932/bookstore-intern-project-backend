<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;
use App\Exceptions\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
    public function register(Request $request): JsonResponse
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if ($validator->fails())
            {
                throw new ValidationException($validator->errors());
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
        }
        catch (ValidationException $e)
        {
            return response()->json($e->getErrors(), 422);
        }
        catch (\Exception $e)
        {
            Log::error('Error registering user: '. $e->getMessage());

            return response()->json(['message' => 'An error occurred while registering the user',
        'erro'=> $e->getMessage()], 500);
        }
    }

}
