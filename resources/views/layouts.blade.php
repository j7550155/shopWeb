<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <title>{{$title}}</title>
    <style>
        #nav {
            margin: 0 auto 5px;
            /* padding: 0 50px; */
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

        #footer {
            margin: 10px auto 5px;
            padding: 25px 0 25px;
            width: 1000px;
            height: 60px;
            background: red;
            text-align: center;
        }

        #footer b {
            line-height: 60px;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div id="nav">
        @if(session('user_id'))
        <a href="user/auth/signOut">登出</a>
        <a href="user/auth/own">會員中心</a>

        @else
        <a href="/user/auth/login"">登入</a>
        <a href="/user/auth/signUp">註冊 </a> @endif </div> @yield('content') <div id="footer"><b>購物車包含後台練習</b></div>


</body>

</html>