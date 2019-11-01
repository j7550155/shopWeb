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
        height: 1200px;

    }


    .img {
        float: left;
        width: 190px;
        height: 300px;
        margin: 0 0;
        border: 1px solid black;
        text-align: center; //用參照物 讓圖居中
        overflow: auto;
    }

    .img i {
        /* display: inline-block;       */
        height: 100%;
    }

    .img img {
        vertical-align: top;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
    }


    .card {
        height: 485px;
        float: left;
        margin: 2px 1px;
    }

    /* .pagination li {
        border-radius: 50px;
        border: 1px solid black ;
        margin: 0 3px;
        width: 30px;
        height: 30px;
        text-align: center;
        list-style: none;;
        float: left;
    } */
</style>
@section('content')


<div class="content">
    <h1>Product</h1>

    <div id='cart'>
        <p></p>
        <button id="del_cart" class="btn btn-warning mb-1">清空購物車</button>
        <a class="pay btn btn-success mb-1" href="#">結帳去</a>
    </div>
    {{$data->links()}}


    <div>
        @foreach($data as $item)
        <div class="card" style="width:230px">
            <div class="card-body">
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
                    <button class="cartBtn btn btn-primary btn-sm" data-id="{{$item['id']}}" data-name="{{$item['name']}}" data-price="{{$item['price']}}"> + 購物車</button>
                    @else
                    <button class="btn disabled btn-sm" data-id="{{$item['id']}}" data-name="{{$item['name']}}" data-price="{{$item['price']}}"> + 購物車</button>
                    @endif
                </div>
                <p>{{$item['description']}}</p>
                <p style="color:red;">NT.<b class="price">{{$item['price']}}</b>
                    @if(count($item['photo'])>1)
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal{{$item['name']}}">
                        此商品有更多圖片
                    </button>
                    <div class="modal fade" id="myModal{{$item['name']}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- 模态框头部 -->
                                <div class="modal-header">
                                    <h4 class="modal-title">更多圖片</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- 模态框主体 -->
                                <div class="modal-body">
                                   @foreach($item['photo'] as $photo)
                                   <img src="{{ asset($photo) }}" class="card-img-bottom" alt="">
                                   @endforeach
                                </div>
                                <!-- 模态框底部 -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </p>
                <div class="img">
                    <i></i>
                    <img src="{{ asset($item['photo'][0]) }}" class="card-img-bottom" alt="">
                </div>
            </div>
        </div>
        @endforeach
    </div>

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