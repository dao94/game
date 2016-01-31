<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use Illuminate\Contracts\Auth\Guard;
use \Firebase\JWT\JWT;
class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       $headers = getallheaders();
        if(empty($headers['Authorization'])){
            return response(['error'=> true, 'error_message'=> 'You are not permitted to perform this action.', 'message'=> 'TOKEN_INVALID'], 403);
        }

        $access_token = $headers['Authorization'];

        try {
            $decoded = JWT::decode($access_token, Config::get('app.key'), array('HS256'));
        } catch (Exception $e) {
            return response(['error'=> true, 'error_message'=> 'Access token invalid.', 'message'=>'TOKEN_INVALID'], 403);
        }

        if ($decoded->exp < time()) {
            return response(['error'=> true, 'error_message'=> 'Access token expired', 'message'=>'TOKEN_EXPIRED'], 403);
        }

        $MergeInput = [
            'user_decoded' => $decoded
        ];

        $request->merge($MergeInput);
        return $next($request);
    }
}
