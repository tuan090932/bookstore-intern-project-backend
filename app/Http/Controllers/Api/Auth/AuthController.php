<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Constructor for the AuthController class.
     *
     * This constructor sets up the middleware for the controller's actions.
     * The 'auth:api' middleware is applied to all actions, except for the 'login' and 'refresh' actions.
     *
     * The 'auth:api' middleware is responsible for authenticating the user using the API guard.
     * This ensures that all protected actions (everything except 'login' and 'refresh') can only be accessed by authenticated users.
     *
     * The 'except' parameter in the middleware call specifies the actions that should be excluded from the authentication check.
     * In this case, the 'login' and 'refresh' actions are excluded, as they are used for the authentication process itself and do not require the user to be already authenticated.
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
    }

    /**
     * Handles the user login process.
     *
     * This action retrieves the email and password from the request, and attempts to authenticate the user using the API guard.
     * If the authentication is successful, a new access token and refresh token are generated and returned in the response.
     * If the authentication fails, a 401 Unauthorized response is returned.
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials))
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $refreshToken = $this->createRefreshToken();

        return $this->respondWithToken($token, $refreshToken);
    }

    /**
     * Retrieves the authenticated user's profile information.
     *
     * This action uses the 'auth:api' middleware to ensure that only authenticated users can access this endpoint.
     * If the user is authenticated, their profile information is returned in the response.
     * If the user is not authenticated, a 401 Unauthorized response is returned.
     */
    public function profile()
    {
        try
        {
            return response()->json(auth('api')->user());
        }
        catch (JWTException $e)
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    /**
     * Logs out the authenticated user.
     *
     * This action invalidates the user's access token, effectively logging them out.
     * A success message is returned in the response.
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refreshes the user's access token.
     *
     * This action takes a refresh token from the request, decodes it, and uses the user's information to generate a new access token.
     * If the refresh token is valid, a new access token and refresh token are returned in the response.
     * If the refresh token is invalid, a 500 Internal Server Error response is returned.
     */
    public function refresh()
    {
        $refreshToken = request()->refresh_token;
        try
        {
            $decodeToken = JWTAuth::getJWTProvider()->decode($refreshToken);
            $user = User::find($decodeToken['user_id']);
            if (! $user)
            {
                return response()->json(['error', 'User not found'], 404);
            }
            auth('api')->invalidate();

            $token = auth('api')->login($user);

            $refreshToken = $this->createRefreshToken();

            return $this->respondWithToken($token, $refreshToken);
        }
        catch (JWTException $e)
        {
            return response()->json(['error' => 'Refresh Token Invalid'], 500);
        }
    }

    /**
     * Creates a new refresh token for the authenticated user.
     *
     * This private method generates a new refresh token based on the user's ID, a random value, and the configured refresh token TTL.
     * The refresh token is then encoded and returned.
     */
    private function createRefreshToken()
    {
        $data = [
            'user_id' => auth('api')->user()->user_id,
            'random' => rand().time(),
            'exp' => time() + config('jwt.refresh_ttl'),
        ];

        return JWTAuth::getJWTProvider()->encode($data);
    }

    /**
     * Responds with the access token and refresh token.
     *
     * This protected method formats the access token and refresh token in the expected response format, including the token type and expiration time.
     */
    protected function respondWithToken($token, $refreshToken)
    {
        return response()->json([
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60,
        ]);
    }
}