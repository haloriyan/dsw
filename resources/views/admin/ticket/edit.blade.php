@extends('layouts.admin')

@section('title', 'Edit Tiket')

@php
    use \Carbon\Carbon;
@endphp

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Tiket</h1>
        <a href="{{ route('admin.ticket') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
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
            <form action="{{ route('ticket.update', $ticket->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="event">Event :</label>
                    <select name="event_id" class="form-control" required>
                        <option value="">-- PILIH EVENT --</option>
                        @foreach ($events as $event)
                            @php
                                $selected = $ticket->event->id == $event->id ? "selected='selected'" : "";
                            @endphp
                            <option {{ $selected }} value="{{ $event->id }}">{{ $event->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nama :</label>
                    <input type="text" class="form-control" name="name" required value="{{ $ticket->name }}">
                </div>
                <div class="form-group">
                    <label for="name">Deskripsi :</label>
                    <textarea name="description" rows="6" class="form-control" required>{{ $ticket->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="name">Harga :</label>
                    <input type="number" class="form-control" name="price" id="price" value="{{ $ticket->price }}">
                    <div class="mt-3">
                        <input type="checkbox" id="free" onchange="setFree()"> <label for="free">Free</label>
                    </div>
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
    <script>
        let isFree = false;

        const setFree = () => {
            isFree = !isFree;
            if (isFree) {
                select("#price").value = 0;
                select("#price").style.display = "none";
                select("#price").setAttribute('readonly');
            }else {
                select("#price").style.display = "block";
                select("#price").removeAttribute('readonly');
            }
            console.log(isFree);
        }
    </script>

@endsection
