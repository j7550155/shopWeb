<?php

namespace App\Http\Middleware;


use App\UsersAnn;
use Closure;

class AdminMiddleware
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
        //檢查是否有登入
        if(!session()->has('user_id')){
            return redirect('/');
        }

        //檢查權限是否為管理員
        $sid=session('user_id');
        $User=UsersAnn::where('id',$sid)->firstOrFail();
        $admin=$User->admin;
        if($admin!='Y'){
            return redirect('/');
        }
        //把管理員 name 傳給 controller
        $request->attributes->add(['name'=>$User->name]);

        return $next($request);
    }
}
