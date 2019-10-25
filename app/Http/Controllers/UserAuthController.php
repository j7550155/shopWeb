<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\UsersAnn;

class UserAuthController extends Controller
{
    //


    public function index()
    {
        $data = ['title' => '會員'];
        return view('welcome', $data);
    }

    public function signUpPage()
    {
        $data = ['title' => '註冊'];
        return view('auth.signUp', $data);
    }

    public function signUp(Request $request)
    {

        $data = $request->all();
        $rules = [
            'email' => [
                'required',
                'max:150',
                'email',
            ],
            'pwd' => [
                'required',
                'min:6',
                'max:60',
                'same:pwd2'
            ],
            'pwd2' => [
                'required',
                'min:6',
                'max:60',
            ],
            'name' => [
                'required',
                'max:20'
            ],
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect('/user/auth/signUp')
                ->withErrors($validator)
                ->withInput(); //返回原本input
        }
        $User = UsersAnn::where('email', $data['email'])->first();

        if ($User) {
            $err_msg = [
                'msg' => 'email重複'
            ];
            return redirect('/user/auth/signUp')->withErrors($err_msg)->withInput();
        }
        $data['pwd'] = Hash::make($data['pwd']);
        $data = [
            'email' => $data['email'],
            'password' => $data['pwd'],
            'name' => $data['name'],
            'admin' => 'N',
        ];

        $Users = UsersAnn::create($data);
        // var_dump($data);
        return redirect('/user/auth/login');
    }

    public function loginPage()
    {
        # code...
        $data = [
            'title' => '登入'
        ];

        return view('auth.login', $data);
    }

    public function login(Request $request)
    {
        # code...
        $data = $request->all();
        $rules = [
            'email' => [
                'required',
                'email',
            ],
            'pwd' => [
                'required',
                'min:6',
            ],
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect('/user/auth/login')->withErrors($validator)->withInput();
        }
        $User = UsersAnn::where('email', $data['email'])->firstOrFail();


        $checkPwd = Hash::check($data['pwd'], $User->password);

        if (!$checkPwd) {
            $err_msg = [
                'msg' => '密碼錯誤',
            ];

            return redirect('/user/auth/login')->withErrors($err_msg)->withInput();
        }

        session()->put('user_id', $User->id);
        return redirect('/product');
    }

    public function signOut()
    {
        # code...
        session()->forget('user_id');
        return redirect('/user/auth/login');
    }

    public function edit(Request $request)
    {
        # code...
        $data = $request->all();

        $User = UsersAnn::find($data['id']);
        $User->name = $data['name'];
        $User->admin = $data['admin'];
        $User->active = $data['active'];
        $User->save();
        return redirect()->intended('/admin/home');
    }

    public function own(Request $request)
    {
        # code...
        $user = [
            'name' => $request->get('userName'),
            'uid' => $request->get('uid'),
        ];

        $User = UsersAnn::where('id', $user['uid'])->first();
        $User->order = $User->orders()->get();
        foreach ($User['order'] as $order) {
            $order['products'] = json_decode($order['products'], true);
        }
        //   dd( $User);
        return view('auth.own', ['title' => '會員中心', 'data' => $User]);
    }

    public function ownEdit(Request $request)
    {
        # code...
        $uid = session('user_id');
        $User = UsersAnn::find($uid);
        // dd($User);
        $rules = [
            'password' => [
                'required',
                'min:6',
                'same:password2'
            ],
            'password2' => [
                'required',
                'min:6'
            ]
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('/user/auth/own')->withErrors($validator)->withInput();
        }
        // if($request->input('password')!=$request->input('password2')){
        //     return redirect('/user/auth/own')->withErrors(['err_msg'=>])->withInput();
        // }
        $password = Hash::make($request->input('password')); //密碼加密
        $User->name = $request->input('name');
        $User->password = $password;
        $User->save();
        return redirect('/user/auth/own');
    }
}
