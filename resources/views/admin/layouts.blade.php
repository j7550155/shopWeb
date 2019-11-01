<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>{{$title}}</title>
</head>

<body>
    <nav id="nav" class="navbar navbar-expand-sm bg-info navbar-dark">
        <ul class="navbar-nav">
            @if(session()->has('user_id'))
            <li class="nav-item" >
                <a class="nav-link" href="/user/auth/signOut">登出</a>
            </li>
            @else
            <li class="nav-item" >
                <a class="nav-link" href="/user/auth/signUp">註冊</a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" href="/user/auth/login">登入</a>
            </li>
            @endif

        </ul>
        <!-- <a href="#">{{session('user_id')}}</a> -->
    </nav>
    @yield('content')

    <div id="footer">
        0900-000-000
    </div>
</body>

</html>