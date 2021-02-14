@extends('layouts.authUser')

@section('title', "Forgot Password - Data Science Weekends")

@section('content')
<form action="{{ route('user.forgotPassword.process') }}" method="POST">
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
    <div class="mt-2">Email :</div>
    <input type="email" class="box" name="email" required>
    <button class="lebar-100 primer mt-3">Reset Password</button>

    <div class="rata-tengah mt-3">
        remember your password? <a href="{{ route('user.loginPage') }}">login</a> now
    </div>
</form>
@endsection