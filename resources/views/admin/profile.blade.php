@extends('layouts.admin')

@section('title', 'Profile')

@section('head')
    <style>
        .photo {
            background-color: #4d73df;
            color: #fff;
            display: inline-block;
            width: 90px;
            line-height: 90px;
            border-radius: 200px;
            margin-bottom: 30px;
            font-size: 25px;
        }
    </style>
@endsection

@section('breadcrumb')
<button class="btn btn-primary" data-toggle="modal" data-target="#scrollmodal"><i class="fas fa-plus"></i> &nbsp; New FAQ</button>
@endsection

@php
    $name = explode(" ", $myData->name);
    $initial = $name[0][0].$name[1][0];
@endphp

@section('content')
    <div class="col-md-12">
        <h2>Profile</h2>
        <div class="mt-5 text-center">
            <div class="photo">{{ $initial }}</div>
            <h3>{{ $myData->name }}</h3>
            <p>{{ $myData->username }}</p>
            <h5>{{ $myData->email }}</h5>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST" class="shadow bg-white p-4 mt-5">
            {{ csrf_field() }}
            <h4 class="mb-4">Change password</h4>
            @if ($errors->count() != 0)
                @foreach ($errors->all() as $err)
                    <div class="bg-danger p-3 rounded mb-3 text-white">
                        {{ $err }}
                    </div>
                @endforeach
            @endif
            @if ($message != "")
                <div class="bg-success p-3 rounded mb-3 text-white">
                    {{ $message }}
                </div>
            @endif
            <div class="form-group">
                <label for="oldPasword">Old Password :</label>
                <input type="password" class="form-control" name="old_password" id="oldPassword">
            </div>
            <div class="form-group">
                <label for="newPasword">New Password :</label>
                <input type="password" class="form-control" name="new_password" id="newPassword">
            </div>
            <button class="btn btn-success mt-2">Update</button>
        </form>
    </div>
@endsection

@section('javascript')
<script>
    // 
</script>
@endsection
