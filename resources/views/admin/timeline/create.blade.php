@extends('layouts.admin')

@section('title', 'Timeline')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Timeline</h1>
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
            <form action="{{ route('timeline.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="event">Event :</label>
                    @if ($eventID == NULL)
                        <select name="event_id" id="event" class="form-control" required>
                            <option value="">Pilih event...</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}">{{ $event->title }}</option>
                            @endforeach
                        </select>
                    @else
                        <h4>{{ $events->title }}</h4>
                    @endif
                </div>
                <div class="form-group">
                    <label for="type">Type :</label>
                    <select name="type" id="type" class="form-control">
                        <option value="straight">Straight</option>
                        <option value="waves">Waves</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="openDate">Tanggal Pendaftaran :</label>
                            <input type="date" name="open_date" id="openDate" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="closeDate">Tanggal Penutupan :</label>
                            <input type="date" name="close_date" id="closeDate" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="judgementDate">Tanggal Penjurian :</label>
                    <input type="date" name="judgement_date" id="judgementDate" class="form-control">
                </div>
                <div class="form-group">
                    <label for="mainDate">Tanggal Acara/Main :</label>
                    <input type="date" name="main_date" id="mainDate" class="form-control">
                </div>

                <div class="text-right">
                    <button class="btn btn-primary mt-2">Submit</button>
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
