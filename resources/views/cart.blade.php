@extends('layouts'))

@section('content')
<style>
    .content .cart_table {
        border: 1px solid black;
    }
</style>
<div class='content'>

    <table class="cart_table">
        <thead>
            <tr>
                <td>項目號</td>
                <td>商品名</td>
                <td>價格</td>
                <td>數量</td>
                <td>總價</td>
            </tr>
        </thead>
        <tbody class="cartData">

        </tbody>
    </table>
    <p> 總價:<b class="totalPrice"></b></p>
    <button class="pay">結帳 </button>
</div>

<script>
    $(document).ready(function() {

        var cartData = JSON.parse($.cookie('cart'));
        console.log(cartData);
        console.log($.cookie('cart'));
        var content = '';
        var totalPrice=0;
        cartData.forEach(element => {
            content += '<tr id="' + element.id + '"><td>#</td><td>' + element.name + '</td><td>' + element.price + '</td><td>' + element.count + '</td><td>' + parseInt(element.count * element.price) + '</td></tr>'
            totalPrice+=parseInt(element.count * element.price)
        });

        $('.cartData').append(content)
        $('.totalPrice').html(totalPrice)

        // $('.pay a').attr('href','/product/pay?pid='+$.cookie('cart'));
        $('.pay').on('click', function() {
            // alert($.cookie('cart'));
            //console.log( $.cookie('cart'));
            $.ajax({
                url: '/product/pay',
                type: "get",
                data: {
                    'pid':$.cookie('cart'),
                },
                error: function(xhr) {
                    console.log('fails');
                    console.log(xhr)
                     alert(xhr);
                },
                success: function(xhr) {
                    console.log(xhr);
                    $.removeCookie('cart', {
                        path: '/'
                    });
                     window.location.href = '/product';
                }
            })
        })

    })
</script>
@endsection