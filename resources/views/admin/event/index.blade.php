@extends('layouts.admin')

@section('title', 'Event')

@section('content')

<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Event</h1>
                        <a href="{{ route('event.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus-square fa-sm text-white-50"></i> Tambah</a>
                    </div>

                    <!-- DataTales Example -->

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Event</h6>
                        </div>
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                            @endif
                            @if ($rundown != "")
                                <h6 class="mt-2 mb-3 font-weight-bold text-primary">Event dengan rundown {{ $rundown->title }}
                                    &nbsp; <a href="{{ route('admin.event') }}"><i class="fas fa-times"></i></a>
                                </h6>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Rundown</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($events as $event)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $event->title }}</td>
                                                <td>{{ $event->rundown->title }}</td>
                                                <td>
                                                    <form action="{{ route('event.delete',$event->id) }}" method="POST">
                                                        <a href="{{ route('admin.timeline', $event->id) }}" class="btn btn-info btn-icon-split">
                                                            <span class="icon text-white">
                                                                Timeline
                                                            </span>
                                                        </a>
                                                    <a href="{{ route('event.view',$event->id) }}" class="btn btn-info btn-icon-split">
                                                        <span class="icon text-white">
                                                            <i class="fas fa-eye"></i> 
                                                        </span>
                                                    </a>
                                                    <a href="{{ route('event.edit',$event->id) }}" class="btn btn-success btn-icon-split" id="editBtn">
                                                        <span class="icon text-white">
                                                            <i class="far fa-edit"></i>
                                                        </span>
                                                    </a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-icon-split" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <span class="icon text-white">
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
