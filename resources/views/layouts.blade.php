<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>


    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <title>{{$title}}</title>
    <style>
        /* #nav {
            margin: 0 auto 5px;
            width: 1000px;
            height: 50px;
            background: red;
        }
        
        #nav a {
            display: inline-block;
            text-decoration: none;
            color: black;
            margin: 10px 5px;
            border-bottom: 1px solid black;
        }
        */

        #footer {
            margin: 10px auto 5px;
            padding: 25px 0 25px;
            width: 1397px;
            height: 60px;
            background: #17a2b8;
            text-align: center;
        }

        #footer b {
            /* line-height: 60px; */
            font-size: 18px;
        }
    </style>
</head>

<body>

    <nav id="nav" class="navbar navbar-expand-sm bg-info navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="">上一頁</a>
            </li>
            @if(session()->has('user_id'))
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="history.go(-2);">登出</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user/auth/own">會員中心</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="/user/auth/signUp">註冊</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user/auth/login">登入</a>
            </li>
            @endif
        </ul>
        <!-- <a href="#">{{session('user_id')}}</a> -->
    </nav>
    @yield('content')
    <div id="footer"><b>購物車包含後台練習</b>
</body>
<script>

</script>
</html>