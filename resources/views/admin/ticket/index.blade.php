@extends('layouts.admin')

@section('title', 'Tiket '.$type->name)

@php
use \Carbon\Carbon;
@endphp

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tiket {{ $type->name }}</h1>
    <a href="{{ route('ticket.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus-square fa-sm text-white-50"></i> Tambah</a>
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
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Event</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $ticket->event->title }}</td>
                        <td>{{ $ticket->name }}</td>
                        <td>{{ $ticket->description }}</td>
                        <td>{{ $ticket->price }}</td>
                        <td>
                            <form action="{{ route('ticket.delete', [$ticket->id]) }}" method="POST">
                                <a href="{{ route('admin.ticket.participant', $ticket->id) }}"
                                    class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="far fa-user"></i>
                                    </span>
                                </a>
                                <a href="{{ route('ticket.edit', $ticket->id) }}"
                                    class="btn btn-success btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="far fa-edit"></i>
                                    </span>
                                </a>
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger btn-icon-split"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>
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
