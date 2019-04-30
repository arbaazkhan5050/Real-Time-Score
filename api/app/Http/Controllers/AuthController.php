<?php

namespace App\Http\Controllers;
use Dingo\Api\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;

/**
 * Class AuthController
 * @group Authentication
 * APIs for Authenticating users. For registering users, check the Users section
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @var JWTAuth
     */
    private $auth;

    /**
     * Create a new controller instance.
     * @param JWTAuth $auth
     * @return void
     */
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
        $this->middleware('api.auth', ['except' => ['login']]); // set the middleware to protect functions
    }

    /**
     * Authenticates a user and sends back a JWT
     *
     * Logs the user in using email and password and generates a JWT.
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        try {
            $token = $this->auth->attempt($credentials);
            if(! $token ) {
                $this->response->errorUnauthorized();
            }
        } catch (JWTException $e) {
            return $this->response->errorInternal();
        }

        return $this->sendBackToken($token);
    }

    /**
     * Refresh a token.
     *
     * Sends back a fresh JWT and invalidates the old one for the user that requests it. Must has the Authorization header.
     * @return Response
     */
    public function refresh()
    {
        return $this->sendBackToken($this->auth->refresh());
    }

    /**
     * Send formatted token
     *
     * This function takes the token and returns it in an informative way for the front end
     * @param string $token
     * @return mixed
     */
    public function sendBackToken($token)
    {
        if($token) {
            return $this->response->array([
                'access_token'  =>  $token,
                'token_type'    =>  'bearer',
                'expires_in'    =>  $this->auth->factory()->getTTL() * 60
            ]);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return Response
     */
    public function logout()
    {
        $this->auth->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    //
}
