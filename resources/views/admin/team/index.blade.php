@extends('layouts.admin')

@section('title', 'Team')

@php
    use \Carbon\Carbon;
@endphp

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Team</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Team
                <button class="btn btn-sm btn-success float-right" onclick="exportCsv()">
                    <i class="fas fa-file-upload mr-3"></i> Export
                </button>
            </h6>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="table-responsive mt-4">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Chief</th>
                            <th>Member 1</th>
                            <th>Member 2</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($teams as $team)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $team->name }}</td>
                                <td>{{ $team->chief->name }}</td>
                                <td>
                                    @if ($team->first_member != null)
                                        {{ $team->first_member->name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($team->second_member != null)
                                        {{ $team->second_member->name }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.team.detail',$team->id) }}" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="far fa-eye"></i>
                                        </span>
                                    </a>
                                    {{--
                                    <form action="{{ route('timeline.delete', $timeline->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger btn-icon-split" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Delete</span>
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                        <input style="margin-top: -500px;opacity: 0.01;" type="text" id="toExport" value="{{ $toExport }}">
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
    <script>
        const replacer = (key, val) => {
            return val === null ? '' : val;
        }
        const downloadFile = (dataCSV, fileName) => {
            let downloadLink = document.createElement('a');
            let blob = new Blob(["\ufeff", dataCSV]);
            let url = URL.createObjectURL(blob);
            downloadLink.href = url;
            downloadLink.download = fileName;
            downloadLink.click();
        }

        const exportToCSV = (datas, fileName) => {
            datas = JSON.parse(datas);
            const header = Object.keys(datas[0]);
            let csv = datas.map(row => header.map(fieldName => JSON.stringify(row[fieldName], replacer)).join(','));
            csv.unshift(header.join(','));
            csv = csv.join('\r\n');
            downloadFile(csv, fileName);
        }
        const exportCsv = () => {
            let toExport = select("#toExport").value;
            let fileName = "Team_{{ date('Y-m-d') }}_{{ time() }}.csv";
            exportToCSV(toExport, fileName);
        }
    </script>

@endsection
