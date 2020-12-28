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
            <h6 class="m-0 font-weight-bold text-primary">Data Jenis Tiket</h6>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($types as $type)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $type->name }}</td>
                                <td>
                                    <a href="{{ route('admin.ticket', $type->id) }}" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                        <span class="text">Tiket</span>
                                    </a>
                                    <a href="{{ route('ticketType.edit', $type->id) }}" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="far fa-edit"></i>
                                        </span>
                                        <span class="text">Edit</span>
                                    </a>
                                    <form action="{{ route('ticketType.delete', [$type->id]) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger btn-icon-split" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
