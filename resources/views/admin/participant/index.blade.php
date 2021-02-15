@extends('layouts.admin')

@section('title', 'Peserta')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Peserta</h1>
</div>

<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Peserta
            <input type="hidden" id="datas" value="{{ $toExport }}">
            <button class="btn btn-sm btn-success float-right" onclick="downloadData()">
                <i class="fas fa-file-upload mr-2"></i> Export
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $participant)
                    <tr>
                        <td>{{ $participant->name }}</td>
                        <td>{{ $participant->email }}</td>
                        <td>{{ $participant->phone }}</td>
                        <td>
                            <a href="{{ route('participant.view',$participant->id) }}" class="btn btn-info btn-icon-split">
                                <span class="icon">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </a>
                            @if ($participant->tickets->count() == 0)
                                <a href="{{ route('participant.delete', $participant->id) }}" class="btn btn-danger btn-icon-split" onclick="return confirm('Yakin ingin menghapus peserta ini?')">
                                    <span class="icon">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </a>
                            @endif
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
        let fileName = "Peserta_{{ date('Y-m-d') }}_{{ time() }}.csv";
        let blob = new Blob(["\ufeff", dataCSV]);
        let url = URL.createObjectURL(blob);

        let link = document.createElement('a');
        link.href = url;
        link.download = fileName;
        link.click();
    }
</script>

@endsection
