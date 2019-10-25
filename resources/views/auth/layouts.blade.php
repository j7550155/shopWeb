<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <title>{{$title}}</title>
</head>
<body>
    <div id="nav">
        @if(session()->has('user_id'))
        <a href="/user/auth/signOut">登出</a>
        <a href="#">{{session('user_id')}}</a>
        @else
        <a href="/user/auth/signUp">註冊</a>
        <a href="/user/auth/login">登入</a>
        @endif
    </div>
    @yield('content')
    
    <div id="footer">
        0900-000-000
    </div>
</body>
</html>