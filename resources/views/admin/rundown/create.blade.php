@extends('layouts.admin')

@section('title', 'Rundown')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rundown</h1>
        <a href="{{ route('admin.rundown') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Rundown</h6>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <form action="{{ route('rundown.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Judul :</label>
                    <input type="text" class="form-control" name="title" id="title">
                </div>
                <div class="form-group">
                    <label for="date">Tanggal :</label>
                    <input type="date" class="form-control" name="date" id="date">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="startTime">Jam Mulai :</label>
                            <input type="time" class="form-control" name="start_time" id="startTime">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="endTime">Jam Selesai :</label>
                            <input type="time" class="form-control" name="end_time" id="endTime">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="notes">Detail :</label>
                    <textarea name="notes" id="notes" rows="8" class="form-control"></textarea>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary">Submit</button>
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
