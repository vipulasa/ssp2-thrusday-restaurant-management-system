<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(
        Request $request,
        Closure $next,
        string  ...$args
    ): Response
    {
        // check if there are any arguments passed to the middleware
        if (empty($args)) {
            abort(
                code: 403,
                message: 'WTF, you need to add a role to the middleware'
            );
        }

        // check if a user is authenticated
        if (!$request->user()) {
            // send the user to the login page
            return redirect()->route('login');
        }

        // loop through the arguments and check if the user has the role
        foreach ($args as $role) {
            if ($request->user()->role->name === $role) {
                return $next($request);
            }
        }

        // if the user does not have the role, send them to the home page
        abort(
            code: 403,
            message: 'WTF, you do not have the required role'
        );
    }
}
