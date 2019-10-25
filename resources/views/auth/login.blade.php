@extends('auth.layouts')

@section('content')
<div id='content'>
    <form action="/user/auth/login" method="post">
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
                email: <input type="text" id='email' name='email' placeholder="email" value="{{old('email')}}">
            </label>
        </div>
        <div>
            <label for="pwd">
                密碼: <input type="text" name="pwd" id="pwd" placeholder="password" value="{{old('pwd')}}">
            </label>
        </div>
        <button type="submit">送出</button>
    </form>
</div>
@endsection