@extends('layouts.admin')

@section('title', 'Timeline')

@php
    use Carbon\Carbon;
@endphp

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Timeline</h1>
    <a href="{{ route('admin.timeline') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
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
        <h3>{{ $timeline->event->title }}</h3>
        <p>{{ $timeline->event->description }}</p>
        <table class="table w-100">
            <thead>
                <tr>
                    <th>Pendaftaran</th>
                    <th>Penutupan</th>
                    @if ($timeline->open_date_2 != null)
                        <th>Pendaftaran Gel. 2</th>
                    @endif
                    @if ($timeline->close_date_2 != null)
                        <th>Penutupan Gel. 2</th>
                    @endif
                    <th>Penjurian</th>
                    <th>Main Event</th>
                    <th></th>
                </tr>
                <tbody>
                    <td>{{ Carbon::parse($timeline->open_date)->format('d M Y') }}</td>
                    <td>{{ Carbon::parse($timeline->close_date)->format('d M Y') }}</td>
                    @if ($timeline->open_date_2 != null)
                        <td>{{ Carbon::parse($timeline->open_date_2)->format('d M Y') }}</td>
                    @endif
                    @if ($timeline->close_date_2 != null)
                        <td>{{ Carbon::parse($timeline->close_date_2)->format('d M Y') }}</td>
                    @endif
                    <td>{{ Carbon::parse($timeline->judgement_date)->format('d M Y') }}</td>
                    <td>{{ Carbon::parse($timeline->main_date)->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('timeline.edit',$timeline->id) }}" class="btn btn-success btn-icon-split">
                            <span class="icon">
                                <i class="far fa-edit"></i>
                            </span>
                        </a>
                    </td>
                </tbody>
            </thead>
        </table>
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
