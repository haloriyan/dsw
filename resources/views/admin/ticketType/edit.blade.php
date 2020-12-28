@extends('layouts.admin')

@section('title', 'Jenis Tiket')

@php
    use \Carbon\Carbon;
@endphp

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jenis Tiket</h1>
        <a href="{{ route('ticketType.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus-square fa-sm text-white-50"></i> Tambah</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Data Jenis Tiket</h6>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <form action="{{ route('ticketType.update', $type->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama :</label>
                    <input type="text" class="form-control" name="name" value="{{ $type->name }}">
                </div>
                <div class="form-group">
                    <label for="name">Deskripsi :</label>
                    <textarea name="description" rows="6" class="form-control">{{ $type->description }}</textarea>
                </div>
                <div class="text-right">
                    <button class="btn btn-success">Submit</button>
                </div>
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
