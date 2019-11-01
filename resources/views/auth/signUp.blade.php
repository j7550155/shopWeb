@extends('auth.layouts')

@section('content')
<div id="content">
    <form action="/user/auth/signUp" method="post">
        {!! csrf_field() !!}
        @if($errors AND count($errors))
        <ul style='color:red;'>
            @foreach($errors->all() as $err)
            <li> {{ $err }} </li>
            @endforeach
        </ul>
        @endif
        <div>
            <label for="email">
                email: <input type="text" id='email'class="form-control" name='email' placeholder="email" value="{{old('email')}}">
            </label>
        </div>
        <div>
            <label for="pwd">
                密碼: <input type="text" name="pwd" class="form-control" id="pwd" placeholder="password" value="{{old('pwd')}}">
            </label>
        </div>
        <div>
            <label for="pwd2">
                確認密碼: <input type="text" name="pwd2" class="form-control" id="pwd2" placeholder="password">
            </label>
        </div>
        <div>
            <label for="name">
                暱稱: <input type="text" name="name" class="form-control" id=" name" placeholder="暱稱" value="{{old('name')}}">
            </label>
        </div>
        <button class="btn btn-primary" type="submit">送出</button>
    </form>
</div>
@endsection