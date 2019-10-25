@extends('admin.layouts')


@section('content')
<div id='content'>
    <h3>管理員:{{$name}}</h3>
    <div class="view1">
        <ul id="list">
            <li data-v='1'><b>庫存查詢</b></li>
            <li data-v='2'><b>訂單查詢</b></li>
            <li data-v='3'><b>客服專區</b></li>
            <li data-v='4'><b>會員管理</b></li>
            <li data-v='5' disabled="disabled"><b>商品新增</b></li>
        </ul>
    </div>
    <div class="view2">
        <div class="c1">
            <div class='c1 content'>
                <img src="/img/loading.gif" alt="" id="load" style="display:none;">
                <table class="product">
                    <thead>
                        <tr>
                            <td>
                                <div class="pageBox"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>商品編號</th>
                            <th>商品名</th>
                            <th>商品描述</th>
                            <th>照片</th>
                            <th>價格</th>
                            <th>數量</th>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <table class="member" style="display:none;">
                    <thead>
                        <tr>
                            <th>會員編號</th>
                            <th>會員名</th>
                            <th>管理員權限</th>
                            <th>啟用</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <table class="order" style="display:none;">
                    <thead>
                        <tr>
                            <td>
                                <div class="pageBox"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>訂單編號</th>
                            <th>會員名</th>
                            <th>訂單資訊</th>
                            <th>狀態</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <table class="customer_service" style="display:none;">
                    <thead>
                        <tr>
                            <th>客服單號</th>
                            <th>會員名</th>
                            <th>客服資訊</th>
                            <th>狀態</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="c2">
            <div class='c2 content'>
                <div class="productEdit">
                    <form class="editUrl" action="/product/edit/" method="post" enctype="multipart/form-data">
                        {!!csrf_field()!!}
                        <div>
                            <label for="name">商品名:<input id="pName" type="text" name="name" value=""></label>
                        </div>
                        <div>
                            <label for="description">商品描述:<textarea name="description" id="pDesc" cols="30" rows="3"></textarea></label>
                        </div>
                        <div class="prePhoto">
                            <input type="hidden" id="delPhoto" name="delPhoto" value=''>
                            <label id="prePhoto" for="prePhoto"></label>
                        </div>
                        <div>
                            <label for="photo">照片:<input type="file" name="photo[]" multiple id=""></label>
                        </div>
                        <div>
                            <label for="price">價格:<input id="pPrice" type="text" name="price" value=""></label>
                        </div>
                        <div>
                            <label for="count">數量:<input id="pCount" type="text" name="count" value=""></label>
                        </div>
                        <button type="sumbit">更改</button>
                    </form>
                </div>
                <div class="orderEdit" style="display:none;">
                    <form class="editUrl" action="/order/edit/" method="post">
                        {!!csrf_field()!!}@if($errors AND count($errors))
                        <ul style="color:red;">@foreach($errors->all() as $err)<li> {{ $err }} </li>@endforeach
                        </ul>@endif
                        <div>
                            <label for="status">訂單付款狀態:
                                <select name="status">
                                    <option value="Y">Y</option>
                                    <option value="N" selected>N</option>
                                </select>
                            </label>
                        </div>
                        <button type="submit">送出</button>
                    </form>
                </div>
                <div class="memberEdit" style="display:none;">
                    <form class="editUrl" action="/user/auth/edit" method="post">
                        {!!csrf_field()!!}@if($errors AND count($errors))
                        <ul style="color:red;">@foreach($errors->all() as $err)<li> {{ $err }} </li>@endforeach</ul>@endif
                        <div>
                            <input id="id" name="id" value="" type="hidden">
                            <label for="name">
                                name: <input type="text" id="name" name="name" placeholder="name" value="">
                            </label>
                        </div>
                        <div>
                            <label for="admin">管理員權限: <select name="admin">
                                    <option value="Y">Y</option>
                                    <option value="N" selected>N</option>
                                </select>
                            </label>
                            <label for="admin">啟用: <select name="active">
                                    <option value="Y">Y</option>
                                    <option value="N">N</option>
                                </select>
                            </label>
                        </div>
                        <button type="submit">送出</button>
                    </form>
                </div>
                <div class="productCreate" style="display:none;">
                    <form class="create" action="/product/createProduct" method="post" enctype="multipart/form-data">
                        {!! csrf_field() !!}@if($errors AND count($errors))
                        <ul style="color:red;">@foreach($errors->all() as $err)<li> {{ $err }} </li>@endforeach</ul>@endif
                        <div>
                            <label for="name">
                                商品名:<input type="text" name="name" id="name">
                            </label>
                        </div>
                        <div>
                            <label for="description">
                                商品描述:<input type="text" name="description" id="description">
                            </label>
                        </div>
                        <div>
                            <label for="photo">
                                照片:<input type="file" name="photo[]" id="photo" multiple>
                            </label>
                        </div>
                        <div>
                            <label for="price">
                                價格:<input type="text" name="price" id="price">
                            </label>
                        </div>
                        <div>
                            <label for="count">
                                數量:<input type="text" name="count" id="count">
                            </label>
                        </div>
                        <button type="submit">新增</button>
                    </form>
                </div>

            </div>
        </div>


    </div>
</div>

<script>
    $(document).ready(function() {
        // var parms = window.location.search;

        var c1Pre = $('.view2 .c1 .content .product'); //預設第一個表格
        var c2Pre = $('.view2 .c2 .content .productEdit'); //預設第二個表格
        $('#list li').on('click', function() {

            console.log($(this).data('v'));
            var v = $(this).data('v');
            switch (v) {
                case 1:
                    $('.view2 .c1 .product tbody').html(''); //清空表格
                    c1Pre.toggle(); //前一個表個display切換
                    c1Pre = $('.view2 .c1 .content .product'); //記錄下當下表格
                    $('.view2 .c1 .content .product').toggle(); //當下表格切換
                    product();
                    $('.product .pageBox').on('click', 'button', function() {
                        var parms = $(this).data('path');
                        console.log('parms:' + parms);
                        product(parms);
                    })
                    break;
                case 2:
                    $('.view2 .c1 .order tbody').html(' ');
                    c1Pre.toggle();
                    c1Pre = $('.view2 .c1 .content .order');
                    $('.view2 .c1 .content .order').toggle();

                    order();
                    $('.order .pageBox').on('click', 'button', function() {
                        var parms = $(this).data('path');
                        console.log('parms:' + parms);
                        order(parms);
                    })

                    break;
                case 3:
                    $('.view2 .c1 .customer_service tbody').html(' ');
                    c1Pre.toggle();
                    c1Pre = $('.view2 .c1 .content .customer_service');
                    $('.view2 .c1 .content .customer_service').toggle();
                    break;
                case 4:
                    $('.view2 .c1 .member tbody').html(' ');
                    c1Pre.toggle();
                    c1Pre = $('.view2 .c1 .content .member');
                    $('.view2 .c1 .content .member').toggle();
                    member();
                    break;
                case 5:
                    c2Pre.toggle();
                    c2Pre = $('.view2 .c2 .content .productCreate');
                    $('.view2 .c2 .content .productCreate').toggle();
                    break;
                default:
                    break;
            }
        })

        $('.c1 .content .member').on('click', 'tr', function() {
            c2Pre.toggle();
            c2Pre = $('.view2 .c2 .content .memberEdit');
            $('.view2 .c2 .content .memberEdit').toggle();
            var name = $(this).data("name");
            var uid = $(this).data("id");

            $('.c2 .memberEdit #id').attr('value', uid);
            $('.c2 .memberEdit #name').attr('value', name);
            console.log(name);
            // var content = '<form action="/user/auth/change" method="post">{!!csrf_field()!!}@if($errors AND count($errors))<ul style="color:red;">@foreach($errors->all() as $err)<li> {{ $err }} </li>@endforeach</ul>@endif<div><input name="id" value="' + uid + '" type="hidden"><label for="name">name: <input type="text" id="name" name="name" placeholder="name" value="' + name + '"></label></div><div><label for="admin">管理員權限: <select name="admin"><option value="Y">Y</option><option value="N" selected>N</option></select></label><label for="admin">啟用: <select name="active"><option value="Y">Y</option><option value="N">N</option></select></label></div><button type="submit">送出</button></form>'
            // $('.c2 .content').html(content)
        })

        $('.c1 .content .order tbody').on('click', 'tr', function() {
            c2Pre.toggle();
            c2Pre = $('.view2 .c2 .content .orderEdit');
            $('.view2 .c2 .content .orderEdit').toggle();
            var oid = $(this).data("id");
            $('.c2 .orderEdit .editUrl').attr('action', '/order/edit/' + oid);
            // var content = '<form action="/order/edit/' + oid + '" method="post">{!!csrf_field()!!}@if($errors AND count($errors))<ul style="color:red;">@foreach($errors->all() as $err)<li> {{ $err }} </li>@endforeach</ul>@endif<div><label for="status">訂單付款狀態: <select name="status"><option value="Y">Y</option><option value="N" selected>N</option></select></label></div><button type="submit">送出</button></form>'
            // $('.c2 .content').html(content)

        })

        var delPhoto = [];
        $('.productEdit #prePhoto').on('click', 'img', function() {

            if (delPhoto.indexOf($(this).attr('src')) != -1) { //重複點選刪除
                console.log('repeat' + delPhoto.indexOf($(this).attr('src')))
                delPhoto.splice(delPhoto.indexOf($(this).attr('src')), 1);
                $(this).removeClass('click')
            } else {
                delPhoto.push($(this).attr('src'))
                $(this).addClass('click');
            }
            $('.productEdit .prePhoto #delPhoto').attr('value',delPhoto);
            console.log(delPhoto)

        })
        $('.c1 .content .product tbody').on('click', 'tr', function() {
            c2Pre.toggle();
            c2Pre = $('.view2 .c2 .content .productEdit');
            $('.view2 .c2 .content .productEdit').toggle();
            var pid = $(this).data("id");
            //    content='<form action="/user/auth/change" method="post">{!!csrf_field()!!}@if($errors AND count($errors))<ul style="color:red;">@foreach($errors->all() as $err)<li> {{ $err }} </li>@endforeach</ul>@endif<div><input name="id" value="'+uid+'" type="hidden"><label for="name">name: <input type="text" id="name" name="name" placeholder="name" value="'+name+'"></label></div><div><label for="admin">管理員權限: <select name="admin"><option value="Y">Y</option><option value="N" selected>N</option></select></label><label for="admin">啟用: <select name="active"><option value="Y">Y</option><option value="N">N</option></select></label></div><button type="submit">送出</button></form>'
            $.ajax({
                url: '/product/' + pid,
                type: 'get',
                error: function(xhr) {
                    console.log('ajax fails');
                },
                success: function(xhr) {
                    console.log(xhr)
                    // $('.c2 .content').html('');
                    // data = JSON.parse(xhr);
                    var prePhoto = xhr['photo'].split(';');
                    prePhoto.pop();
                    console.log(prePhoto)
                    var photo = ''
                    prePhoto.forEach((e) => {
                        photo += '<img id="' + e + '" src="' + e + '">';
                    })
                    console.log(photo)
                    $('.c2 .productEdit .editUrl').attr('action', '/product/edit/' + pid);
                    $('.c2 .productEdit #pName').attr('value', xhr.name);
                    $('.c2 .productEdit #pDesc').html(xhr.description);
                    $('.c2 .productEdit #prePhoto').html(photo);
                    $('.c2 .productEdit #pPrice').attr('value', xhr.price);
                    $('.c2 .productEdit #pCount').attr('value', xhr.count);
                    // var content = '<form action="/product/edit/' + pid + '" method="post" enctype="multipart/form-data">{!!csrf_field()!!}<div><label for="name">商品名:<input type="text" name="name" value="' + xhr.name + '"></label></div><div><label for="description">商品描述:<textarea name="description" id="" cols="30" rows="3">' + xhr.description + '</textarea></label></div><div class="prePhoto"><label for="prePhoto">' + photo + '</label></div><div><label for="photo">照片:<input type="file" name="photo[]" multiple id=""></label></div><div><label for="price">價格:<input type="text" name="price" value="' + xhr.price + '"></label></div><div><label for="count">數量:<input type="text" name="count" value="' + xhr.count + '"></label></div><button type="sumbit">更改</button></form>'
                    // $('.c2 .content').html(content)

                    // $('.c2 .content .prePhoto').on('click', 'img', function() {
                    //     console.log(1);
                    // })
                }
            });
            // $('.c2 .product').html(pid)
        })


        function product(parms) {
            if (parms == undefined) {
                parms = '';
            }
            $.ajax({
                url: '/product/page' + parms,
                type: 'get',
                beforeSend: function() {
                    $('#load').show();
                },
                complete: function() {
                    $('#load').hide();
                },
                error: function(xhr) {
                    console.log('ajax fails');
                },
                success: function(xhr) {
                    console.log(xhr);
                    $('.view2 .c1 .product tbody').html('');
                    xhr['data'].forEach(element => {
                        var photo = element.photo.split(';');
                        photo.pop();
                        var img = '';
                        for (var i = 0; i < photo.length; i++) {
                            img += ' <img src="' + photo[i] + '" alt="">'
                        }
                        content = '<tr data-id="' + element.id + '"><td>' + element.id + '</td><td>' + element.name + '</td></td></td><td>' + element.description + '</td><td><div class="td-img">' + img + '</div></td><td>' + element.price + '</td><td>' + element.count + '</td><td><button>編輯</button></td></tr>';
                        $('.view2 .c1 .product tbody').append(content);
                    });
                    if (xhr.prev_page_url != null && xhr.next_page_url != null) {
                        // xhr.prev_page_url.replace('/order','/admin/home') 
                        var pageBox = '<button data-path="' + xhr.prev_page_url.replace('http://localhost:8000/product/page', '') + '">上一頁</button><button data-path="' + xhr.next_page_url.replace('http://localhost:8000/order', '') + '">下一頁</button>';
                    } else if (xhr.next_page_url == null) {
                        var pageBox = '<button data-path="' + xhr.prev_page_url.replace('http://localhost:8000/product/page', '') + '">上一頁</button>';
                    } else {
                        var pageBox = '<button data-path="' + xhr.next_page_url.replace('http://localhost:8000/product/page', '') + '">下一頁</button>';

                    }
                    $('.product .pageBox').html(pageBox);
                }

            })

        }

        function order(parms) {
            if (parms == undefined) {
                parms = '';
            }

            $.ajax({
                url: '/order' + parms,
                type: 'get',
                beforeSend: function() {
                    $('#load').show();
                },
                complete: function() {
                    $('#load').hide();
                },
                error: function(xhr) {
                    console.log('ajax fails');
                },
                success: function(xhr) {
                    console.log(xhr);
                    $('.view2 .c1 .order tbody').html('');
                    xhr['data'].forEach(element => {
                        var product = '';
                        JSON.parse(element.products).forEach((e) => {
                            product += '<li style="list-style:none;">產品編號:' + e.id + '||產品名:' + e.name + '||數量:' + e.count + '</li>';
                        });
                        // console.log( product)
                        content = '<tr data-id="' + element.id + '"><td>' + element.id + '</td><td>' + element.user_id + '/' + element.name + '</td></td></td><td><ul>' + product + '</ul></td><td>' + element.status + '</td></tr>';
                        $('.view2 .c1 .order tbody').append(content);
                    });

                    if (xhr.prev_page_url != null && xhr.next_page_url != null) {
                        // xhr.prev_page_url.replace('/order','/admin/home') 
                        var pageBox = '<button data-path="' + xhr.prev_page_url.replace('http://localhost:8000/order', '') + '">上一頁</button><button data-path="' + xhr.next_page_url.replace('http://localhost:8000/order', '') + '">下一頁</button>';
                    } else if (xhr.next_page_url == null) {
                        var pageBox = '<button data-path="' + xhr.prev_page_url.replace('http://localhost:8000/order', '') + '">上一頁</button>';
                    } else {
                        var pageBox = '<button data-path="' + xhr.next_page_url.replace('http://localhost:8000/order', '') + '">下一頁</button>';

                    }
                    $('.order .pageBox').html(pageBox);
                }
            })


        }

        function member() {
            $.ajax({
                url: '/admin/allMember',
                type: 'get',
                beforeSend: function() {
                    $('#load').show();
                },
                complete: function() {
                    $('#load').hide();
                },
                error: function(xhr) {
                    console.log('ajax fails');
                },
                success: function(xhr) {
                    console.log(typeof xhr);
                    //var content = '<table class="member"><tr><th>會員編號</th><th>會員名稱</th><th>權限</th><th>啟用</th></tr>';
                    $.each(JSON.parse(xhr), function(i, data) {
                        console.log(i + ":" + data.name);
                        content = '<tr data-id="' + data.id + '" data-name="' + data.name + '"><td>' + data.id + '</td><td>' + data.name + '</td></td></td><td>' + data.admin + '</td><td>' + data.active + '</td></tr>';
                        $('.view2 .c1 .member tbody').append(content);
                    })
                }
            })
        }
    });
</script>
@endsection