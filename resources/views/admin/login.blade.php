@extends('layouts.auth')

@section('content')
    <div class="rata-tengah mt-5">
        <h1>Login</h1>
        <p>as Admin</p>
    </div>
    <form action="{{ route('admin.login') }}" method="POST" class="mt-4">
        {{ csrf_field() }}
        @if ($errors->count() != 0)
            @foreach ($errors->all() as $err)
                <div class="bg-merah-transparan rounded p-2">
                    {{ $err }}
                </div>
            @endforeach
        @endif
        <div class="mt-2">Email :</div>
        <input type="email" class="box" name="email" required>
        <div class="mt-2">Password :</div>
        <input type="password" class="box" name="password" required>

        <button class="biru p-0 tinggi-45 lebar-100 ke-kanan mt-2 mb-4">Login</button>
    </form>
@endsection