@extends('layouts.admin')

@section('title', 'Tiket')

@php
    use \Carbon\Carbon;
@endphp

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Tiket</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tiket</h6>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <form action="{{ route('ticket.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="type">Type :</label>
                    <select name="type_id" class="form-control" required>
                        <option value="">-- PILIH JENIS TIKET --</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nama :</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="name">Deskripsi :</label>
                    <textarea name="description" rows="6" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="name">Harga :</label>
                    <input type="number" class="form-control" name="price">
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
