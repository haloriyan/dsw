@extends('layouts.authUser')

@section('title', "Login - Data Science Weekends")

@section('content')
<form action="{{ route('user.login') }}" method="POST">
    @if ($message != "")
        <div class="bg-hijau-transparan p-2 rounded">
            {{ $message }}
        </div>
    @endif
    @if ($errors->count() > 0)
        @foreach ($errors->all() as $err)
            <div class="bg-merah-transparan p-2 rounded">
                {{ $err }}
            </div>
        @endforeach
    @endif
    {{ csrf_field() }}
    <input type="hidden" name="ref" value="{{ $ref }}">
    <div class="mt-2">Email :</div>
    <input type="email" class="box" name="email" required>
    <div class="mt-2">Password :</div>
    <input type="password" class="box" name="password" required>
    <button class="lebar-100 primer mt-3">Login</button>

    <div class="rata-tengah mt-3">
        belum punya akun? <a href="{{ route('user.registerPage') }}">register</a> sekarang
    </div>
    <div class="rata-tengah mt-2">
        Forgot your password? <a href="{{ route('user.forgotPassword') }}">reset</a> password
    </div>
</form>
@endsection