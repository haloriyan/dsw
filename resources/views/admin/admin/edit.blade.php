@extends('layouts.admin')

@section('title', 'User Admin')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Admin</h1>
</div>

<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data Admin</h6>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <form action="{{ route('admin.update', $admin->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Nama :</label>
                <input type="text" class="form-control" name="name" required value="{{ $admin->name }}">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" class="form-control" name="email" required value="{{ $admin->email }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Ganti Password :</label>
                        <input type="password" class="form-control" name="password">
                        <div class="mt-1 text-muted">biarkan kosong jika tidak ingin mengganti password</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Username :</label>
                        <input type="text" class="form-control" name="username" required value="{{ $admin->username }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Telepon :</label>
                        <input type="text" class="form-control" name="phone" required value="{{ $admin->phone }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="role">Role :</label>
                <select name="role" class="form-control">
                    <option>superadmin</option>
                    <option>admin</option>
                    <option>event</option>
                    <option>publikasi</option>
                    <option>sponsor</option>
                    <option>lo</option>
                </select>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

@section('pagejs')

    <!-- Page level plugins -->
    <script src="{{ asset('sb-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('sb-admin/js/demo/datatables-demo.js') }}"></script>

@endsection
