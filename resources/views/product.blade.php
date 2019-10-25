@extends('layouts')
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .content {
        margin: 20px auto;
        /* padding: 0 50px; */
        width: 1000px;
        height: 800px;

    }

    dl {
        margin: 0 15px;
    }

    dd {
        float: left;
        width: 230px;
        height: 300px;
        margin: 3px 5px;
        border: 1px solid black;
        text-align: center; //用參照物 讓圖居中
    }

    dd i {
        /* display: inline-block;       */
        height: 100%;
    }


    dd img {
        /* display: inline-block; */
        vertical-align: top;
        margin: 0;
        padding: 0;
        width: 100px;
        height: 200px;
    }
    dd .img {
        width: 100%;
        height: 205px;
        overflow: auto;
    }
    nav {
        margin: 5px 5px;
        height: 40px;
  
    }
    .pagination li {
        border-radius: 50px;
        border: 1px solid black ;
        margin: 0 3px;
        width: 30px;
        height: 30px;
        text-align: center;
        list-style: none;;
        float: left;
    }
   

    
</style>
@section('content')


<div class="content">
        <h1>Product</h1>
        
        <div id='cart'>
            <p></p>
            <button id="del_cart">清空購物車</button>
            <a class="pay" href="#">結帳去</a>
        </div>
{{$data->links()}}
    <dl>
        @foreach($data as $item)
        <dd>
            <b class="pName">{{$item['name']}}</b>
            <div class="cartInfo">
                <select name="count" id="{{$item['id']}}" data-id="{{$item['id']}}">
                    @if($item['count']>0)
                    @for($i=1;$i<=$item['count'];$i++) <option value="{{$i}}">{{$i}}</option>
                        @endfor
                        @else
                        <option value="null">0</option>
                        @endif
                </select>
                @if($item['count']>0)
                <button class="cartBtn" data-id="{{$item['id']}}" data-name="{{$item['name']}}" data-price="{{$item['price']}}"> + 購物車</button>
                @else
                <button disabled="disabled" class="cartBtn" data-id="{{$item['id']}}" data-name="{{$item['name']}}" data-price="{{$item['price']}}"> + 購物車</button>
                @endif
            </div>
            <p>{{$item['description']}}</p>
            <p style="color:red;">NT.<b class="price">{{$item['price']}}</b></p>
            <div class="img">
                <i></i>
                @foreach($item['photo'] as $photo)
                <img src="{{$photo}}" alt="">
                @endforeach
            </div>
        </dd>
        @endforeach
    </dl>

</div>

<script>
    $(document).ready(function() {
        $('#cart p').html($.cookie('cart'))
        $('.cartBtn').on('click', function() {
            var pid = $(this).data('id'); //product id
            var pName = $(this).data('name'); //product name
            var price = $(this).data('price'); //product unit priice
            var count = $(".cartInfo #" + pid).val(); // buy quantity

            var cartinfo = []; // 購物車陣列
            // var cart = {}; //單項購物項目物件
            if ($.cookie('cart')) {
                cartinfo = JSON.parse($.cookie('cart')); //cookie 的cart json字串 覆蓋 轉成array
                //  console.log(JSON.parse($.cookie('cart')));
            }

            // cart[pid] = count; // 單項物件
            // cartinfo[pid] = [pName,price,count]; //存進陣列
            // cart[pid]=[pName,price,count];
            cartinfo.push({
                id: pid,
                name: pName,
                price: price,
                count: count
            });
            console.log(typeof cartinfo)
            var jsonData = JSON.stringify(cartinfo); //轉成json字串
            $.cookie('cart', jsonData, {
                path: '/'
            });

            console.log($.cookie('cart'));
            // $('#cart').html('')
            $('#cart p').html($.cookie('cart'))
            $('.pay').attr('href', '/product/cart') //'/product/cart?pid=' + $.cookie('cart')
        })
        $('#del_cart').on('click', function() {
            $.removeCookie('cart', {
                path: '/'
            });
            $('.pay').attr('href', '#')
        })
    })
</script>
@endsection