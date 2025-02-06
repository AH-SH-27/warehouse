<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(!Auth::check()){
            return redirect()->route('/login');
        }
        $authUserRole = Auth::user()->role;

        if($authUserRole === $role){
            return $next($request);
        }
        
        switch($authUserRole){
            case 'admin':
                return redirect()->route('admin');
            case 'vendor':
                return redirect()->route('vendor');
            case 'client':
                return redirect()->route('dashboard');
            default:
                return redirect()->route('login');
        }

        return redirect()->route('admin');;
    }
}
