<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\ApiUserExceptionHandler;
use App\Http\Requests\UpdateProfileRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function show($userId): JsonResponse
    {
        try {
            $authUser = auth()->user();

            if ($authUser->user_id != $userId) {
                return response()->json(['error' => __('user.not_authorized')], 403);
            }

            return response()->json($authUser);
        } catch (Exception $ex) {
            return ApiUserExceptionHandler::handle($ex);
        }
    }

    public function update(UpdateProfileRequest $request, $userId): JsonResponse
    {
        try {
            $user = auth()->user();

            if ($user->user_id != $userId) {
                return response()->json(['error' => __('user.update_not_authorized')], 403);
            }


            $updatableAttributes = $request->only(['user_name', 'email', 'name', 'phone_number']);
            foreach ($updatableAttributes as $key => $value) {
                $user->$key = $value;
            }

            if ($request->filled('password')) {
                if (!Hash::check($request->old_password, $user->password)) {
                    return response()->json(['old_password' => __('user.old_password_incorrect')], 400);
                }

                $user->password = Hash::make($request->password);
            }

            User::saved($user);
            return response()->json($user);
        } catch (Exception $ex) {
            return ApiUserExceptionHandler::handle($ex);
        }
    }
}
