@extends('layouts.authUser')

@section('title', "Atur Ulang Password - Data Science Weekends")

@section('content')
<form action="{{ route('user.resetPassword.process') }}" method="POST">
    <h3 class="rata-tengah mb-3">Atur Ulang Password</h3>
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
    <input type="hidden" name="encodedEmail" value="{{ $encodedEmail }}">
    <div class="mt-2">Password Baru :</div>
    <input type="password" class="box" name="password" required>
    <div class="mt-2">Ulangi Password Baru :</div>
    <input type="password" class="box" name="passwordRetype" required>
    <button class="lebar-100 primer mt-3">Reset Password</button>
</form>
@endsection