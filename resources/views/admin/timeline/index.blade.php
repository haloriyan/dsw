@extends('layouts.admin')

@section('title', 'Timeline')

@php
    use \Carbon\Carbon;
@endphp

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Timeline</h1>
        <a href="{{ route('timeline.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus-square fa-sm text-white-50"></i> Tambah</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Timeline</h6>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            @if ($event != "")
                <h6 class="m-0 font-weight-bold text-primary">Timeline untuk {{ $event->title }}
                    &nbsp; <a href="{{ route('admin.timeline') }}"><i class="fas fa-times"></i></a>
                </h6>
            @endif
            <div class="table-responsive mt-4">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Event</th>
                            <th>Type</th>
                            <th>Register</th>
                            <th>Close</th>
                            <th>Judgement</th>
                            <th>Main</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($timelines as $timeline)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $timeline->event->title }}</td>
                                <td>{{ $timeline->type }}</td>
                                <td>{{ Carbon::parse($timeline->open_date)->format('d M Y') }}</td>
                                <td>{{ Carbon::parse($timeline->close_date)->format('d M Y') }}</td>
                                <td>{{ Carbon::parse($timeline->judgement_date)->format('d M Y') }}</td>
                                <td>{{ Carbon::parse($timeline->main_date)->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('timeline.edit',$timeline->id) }}" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="far fa-edit"></i>
                                        </span>
                                        <span class="text">Edit</span>
                                    </a>
                                    <form action="{{ route('timeline.delete', $timeline->id) }}" method="POST">
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
