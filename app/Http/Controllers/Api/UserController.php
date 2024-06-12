<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json($user);
        } catch (ModelNotFoundException $ex) {
            return response()->json(['error' => 'Không tìm thấy người dùng', 
        'message' => $ex->getMessage()  ], 404);
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'user_name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:users,email,'.$user->id.',id',
                'phone_number' => 'nullable|string|max:20',
                'password' => 'sometimes|required_with:old_password|string|min:6',
                'old_password' => 'required_with:password|string|min:6',
            ]);

            if ($request->has('user_name')) {
                $user->user_name = $request->user_name;
            }

            if ($request->has('email')) {
                $user->email = $request->email;
            }

            if ($request->has('name')) {
                $user->name = $request->name;
            }
            if ($request->has('phone_number')) {
                $user->phone_number = $request->phone_number;
            }

            if ($request->filled('password')) {
                if (!Hash::check($request->old_password, $user->password)) {
                    return response()->json(['error' => 'Mật khẩu cũ không đúng'], 400);
                }
                
                $user->password = Hash::make($request->password);
            }
            
            $user->save();

            return response()->json($user);
        } catch (ModelNotFoundException $ex) {
            return response()->json(['error' => 'Không tìm thấy người dùng'], 404);
        } catch (ValidationException $ex) {
            return response()->json(['error' => $ex->getMessage()], 400);
        } catch (Exception $ex) {
            return response()->json(['error' => 'Đã xảy ra lỗi không mong muốn'], 500);
        }
    }
}
