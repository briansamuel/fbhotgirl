<?php

namespace App\Http\Middleware;

use Log;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    public function handle($request, Closure $next, $guard = null)
    {
        Log::info('Log request', ['uri' => $request->path(), 'params' => $request->all()]);
        $request_ip = $request->getClientIp();
        $white_list_ip = explode(',', env('WHITE_LIST_IP'));
        if (! in_array($request_ip, $white_list_ip)) {
            //return response()->json(['error' => ['code' => 403, 'message' => '403 Forbidden! denied from ip '.$request_ip]], 403);
        }

        return $next($request);
    }
}
