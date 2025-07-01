<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
            return redirect(route('login'));
        }
        $authUserRole =Auth::user()->role;
        switch($role){
            case 'admin':
                if($authUserRole ==0){
                    return $next($request);
                }
                break;
                case 'seller':
                    if($authUserRole==1){
                        return $next($request);
                    }
                    break;
                    case 'customer':
                        if($authUserRole==2){
                            return $next($request);
                        }
                        break;

        }
        switch($authUserRole){
            case 0:
                return redirect()->route('admin.dashboard');
                case 1:
                     return redirect()->route('seller.dashboard');
                     case 2:
                         return redirect()->route('dashboard');
                        
                
        }
        return redirect()->route('login');
    }
}
