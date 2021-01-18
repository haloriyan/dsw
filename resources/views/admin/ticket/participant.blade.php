@extends('layouts.admin')

@section('title', 'Peserta '.$ticket->name)

@php
    use \Carbon\Carbon;
@endphp

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tiket {{ $ticket->name }} ({{ $ticket->event->title}})</h1>
        <a href="{{ route('ticket.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus-square fa-sm text-white-50"></i> Tambah</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Peserta
                <input type="hidden" name="datas" id="datas" value="{{ $participants }}">
                <button class="btn btn-success float-right" onclick="downloadData()">
                    <i class="fas fa-download"></i> &nbsp; Download Data
                </button>
            </h6>
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
                            <th>Quantity Ticket</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($participants as $participant)
                            @php
                                if ($participant->status == 0) {
                                    $displayStatus = "<span class='rounded bg-danger text-white p-1 pl-3 pr-3'>Belum dibayar</span>";
                                } else {
                                    $displayStatus = "<span class='rounded bg-success text-white p-1 pl-3 pr-3'>Sudah dibayar</span>";
                                }
                            @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $participant->user->name }}</td>
                                <td>{{ $participant->qty }}</td>
                                <td>
                                    {!! $displayStatus !!}
                                </td>
                                <td>
                                    <a href="#"></a>
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
    <script src="{{ asset('js/base.js') }}"></script>
    <script src="{{ asset('sb-admin/js/demo/datatables-demo.js') }}"></script>
    <script>
        const datas = JSON.parse(select("#datas").value);
        const replacer = (key, val) => {
            return val === null ? '' : val;
        }
        const downloadData = () => {
            let header = Object.keys(datas[0]);
            let csv = datas.map(row => header.map(fieldName => JSON.stringify(row[fieldName], replacer)).join(','));
            csv.unshift(header.join(','));
            csv = csv.join('\r\n');

            downloadFile(csv);
        }
        const downloadFile = dataCSV => {
            let fileName = "data.csv";
            let blob = new Blob(["\ufeff", dataCSV]);
            let url = URL.createObjectURL(blob);

            let link = document.createElement('a');
            link.href = url;
            link.download = fileName;
            link.click();
        }
    </script>

@endsection
