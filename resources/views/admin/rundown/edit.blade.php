@extends('layouts.admin')

@section('title', 'Rundown')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rundown</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Rundown</h6>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <form action="{{ route('rundown.update', $rundown->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Judul :</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $rundown->title }}">
                </div>
                <div class="form-group">
                    <label for="date">Tanggal :</label>
                    <input type="date" class="form-control" name="date" id="date" value="{{ $rundown->date }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="startTime">Jam Mulai :</label>
                            <input type="time" class="form-control" name="start_time" id="startTime" value="{{ $rundown->start_time }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="endTime">Jam Selesai :</label>
                            <input type="time" class="form-control" name="end_time" id="endTime" value="{{ $rundown->end_time }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="notes">Detail :</label>
                    <textarea name="notes" id="notes" rows="8" class="form-control">{{ $rundown->notes }}</textarea>
                </div>
                <div class="text-right">
                    <button class="btn btn-success">Simpan</button>
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
