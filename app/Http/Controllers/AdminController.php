<?php

namespace App\Http\Controllers;


use App\UsersAnn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function index()
    {
        # code...
        $data=[
            'title'=>'管理員',
        ];
        return view('admin.adminIndex',$data);
        
    }
    public function home(Request $request)
    {
        # code...
        // $admin=UsersAnn::where('id',session('user_id'))->firstOrFail();
        $data=[
            'title'=>'管理員',
             'name'=>$request->get('name'), //接收 middleware 傳過來的參數 (request 的屬性)
        ];
        return view('admin.home',$data);
        
    }
    public function allMember()
    {
        # code...
        // $admin=UsersAnn::where('id',session('user_id'))->firstOrFail();
        $data=UsersAnn::all();
        return json_encode($data);
        
    }

    public function login(Request $request)
    {
        # code...
        $data=$request->all();
        $User=UsersAnn::where('email',$data['email'])->firstOrFail();
        if(!Hash::check($data['pwd'],$User->password)){
            return redirect('/admin')->withErrors('密碼錯誤');
        }
        if($User->admin!='Y'){
            return redirect('/admin')->withErrors('權限錯誤');
        }
        session()->put('user_id',$User->id);
        return redirect('/admin/home');
    }
}
