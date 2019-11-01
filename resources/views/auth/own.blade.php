<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        #list {
            height: 27px;
            border-bottom: 1px solid black;
            margin: 5px 0;
        }

        #list li {
            list-style: none;
            float: left;
            margin: 0 5px;
            padding: 1px 5px;
            border: 1px solid black;
            border-bottom: none;
            line-height: 25px;
        }

        #list li:hover {
            color: white;
            float: left;
            background: gray;
            border: 1px solid black;
            border-bottom: none;
            line-height: 25px;
        }

        #list .active {
            color: white;
            float: left;
            background: gray;
            border: 1px solid black;
            border-bottom: none;
            line-height: 25px;
        }

        span {
            margin: 0 5px;
        }

        td {
            margin: 0 10px;
            border: 1px solid black;
            text-align: center;
        }

        li {}
    </style>
</head>

<body>
    <nav id="nav" class="navbar navbar-expand-sm bg-info navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/product">回主頁</a>
            </li>
            @if(session()->has('user_id'))
            <li class="nav-item">
                <a class="nav-link" href="/user/auth/signOut">登出</a>
            </li>

            @else
            <li class="nav-item">
                <a class="nav-link" href="/user/auth/login">登入</a>
            </li>
            @endif
        </ul>
        <!-- <a href="#">{{session('user_id')}}</a> -->
    </nav>
    <h3>會員名稱:{{$data->name}}</h3> <a href="/user/auth/signOut">登出</a>
    <ul id="list">
        <li id="order" class="active">購買紀錄</li>
        <li id="member">會員資料更改</li>
    </ul>
    <div class="orderHistory">
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>#</td>
                    <td>品項</td>
                    <td>總金額</td>
                    <td>付款狀態</td>
                </tr>
            </thead>
            <tbody>
                @foreach($data['order'] as $order)
                <tr>
                    <td>1</td>
                    <td>
                        <ul>
                            @foreach($order['products'] as $product)
                            <li style="list-style:none;"><span>產品名:{{$product['name']}}</span><span>單價:{{$product['price']}}</span><span>數量:{{$product['count']}}</span></li>
                            @endforeach
                        </ul>
                    </td>
                    <td> {{$order['total_price']}}</td>
                    <td> {{$order['status']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="memberData" style="display:none;">
        @if($errors AND count($errors))
        <ul style='color:red;'>
            @foreach($errors->all() as $err)
            <li> {{ $err }} </li>
            @endforeach
        </ul>
        @endif
        <form class="m-2" action="/user/auth/ownEdit" method="post">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="name">
                    暱稱:<input type="text" class="form-control" id="name" value="{{$data->name}}" disabled="disabled" name="name"> <span class='edit'>編輯</span>
                </label>
            </div>
            <div class="form-group">
                <label for="pwd">
                    密碼:<input type="text" class="form-control" id="pwd" name="password">
                </label>
            </div>
            <div class="form-group">
                <label for="pwd2">
                    密碼確認:<input type="text" class="form-control" id="pwd2" name="password2">
                </label>
            </div>
            <button type="submit" class="btn btn-success">送出更改</button>

        </form>
    </div>


</body>
<script>
    $(document).ready(function() {
        var preDiv = $('.orderHistory');
        var preList = $('#order');
        $('#list').on('click', 'li', function() {
            var item = $(this).attr('id');
            console.log(item);
            switch (item) {
                case 'order':
                    preDiv.toggle();
                    preDiv = $('.orderHistory');
                    $('.orderHistory').toggle();
                    preList.removeClass('active');
                    preList = $('#order')
                    $(this).addClass('active');
                    break;
                case 'member':
                    preDiv.toggle();
                    preDiv = $('.memberData');
                    $('.memberData').toggle();
                    preList.removeClass('active');
                    preList = $('#member')
                    $(this).addClass('active');
                    break;
                default:
                    break;
            }
        })

        $('.memberData .edit').on('click', function() {
            console.log($('.memberData #name').attr('disabled'))
            if ($('.memberData #name').attr('disabled') == 'disabled') {
                $('.memberData #name').removeAttr('disabled');
            } else {
                $('.memberData #name').attr('disabled', 'disabled')
            }

        })

    })
</script>

</html>