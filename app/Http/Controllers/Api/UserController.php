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
     * Display the specified resource.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            return response()->json($user);
        } catch (Exception $ex) {
            return ApiUserExceptionHandler::handle($ex);
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @param  int  $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProfileRequest $request, $user_id)
    {
        try {
            $user = User::findOrFail($user_id);
    
            $updatableAttributes = $request->only(['user_name', 'email', 'name', 'phone_number']);

            foreach ($updatableAttributes as $key => $value) {
                $user->$key = $value;
            }
    
            if ($request->filled('password')) {
                if (!Hash::check($request->old_password, $user->password)) {
                    return response()->json(['old_password' => 'Mật khẩu cũ không đúng'], 400);
                }
    
                $user->password = Hash::make($request->password);
            }
    
            $user->save();
    
            return response()->json($user);
        } catch (Exception $ex) {
            return ApiUserExceptionHandler::handle($ex);
        }
    }    
}
