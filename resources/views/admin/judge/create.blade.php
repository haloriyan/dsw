@extends('layouts.admin')

@section('title', 'Juri')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Juri</h1>
</div>

<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <form action="{{ route('judge.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group">
                    <label for="event">Event :</label>
                    <select name="event_id" class="form-control" required id="event_id_edit">
                        <option value="">Pilih event...</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}">{{ $event->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nama :</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="name">No. Telepon :</label>
                    <input type="text" class="form-control" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="name">Linkedin Profile :</label>
                    <input type="text" class="form-control" name="linkedin_profile" required>
                </div>
                <div class="form-group">
                    <label for="name">Foto :</label>
                    <input type="file" class="form-control" name="photo" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
