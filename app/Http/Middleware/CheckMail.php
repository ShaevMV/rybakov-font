<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckMail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::attempt(array('email' => $request->username, 'password' => $request->password))){
            $user = User::where([
                'email' => $request->input('username')
            ])->first();

            if (empty($user->email_verified_at)) {
                return response()->json(['message' => 'Емайл не подверждённ'], 402);
            }
        }
        return $next($request);
    }
}
