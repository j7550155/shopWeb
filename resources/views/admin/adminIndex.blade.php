@extends('admin.layouts')


@section('content')
<div id="content">
    <h3>管理員登入:</h3>
    <form action="/admin/auth/login" method="post">
        {!! csrf_field() !!}
        @if($errors AND count($errors))
        <ul style='color:red;'>
            @foreach($errors->all() as $err)
            <li> {{ $err }} </li>
            @endforeach
        </ul>
        @endif
        <div class="form-group">
            <label for="email">
                email: <input type="text" class="form-control" id='email' name='email' placeholder="email" value="{{old('email')}}">
            </label>
        </div>
        <div>
            <label for="pwd">
                密碼: <input type="text" class="form-control" name="pwd" id="pwd" placeholder="password" value="{{old('pwd')}}">
            </label>
        </div>
        <button class="btn btn-primary" type="submit">送出</button>
    </form>
</div>
@endsection