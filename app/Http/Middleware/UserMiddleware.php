<?php

namespace App\Http\Middleware;
use App\UsersAnn;
use Closure;

class UserMiddleware
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
         if(!session()->has('user_id')){
             $err_msg=[
                'msg'=>'請先登入再進行動作',
             ];
            return redirect('/user/auth/login')->withErrors($err_msg);
        }

        
        $sid=session('user_id');
        $User=UsersAnn::where('id',$sid)->firstOrFail();
        
        
        //把管理員 name 傳給 controller 
        $request->attributes->add(['userName'=>$User->name,'uid'=>$sid]);

        return $next($request);
    }
}
