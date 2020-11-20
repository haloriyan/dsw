@extends('layouts.admin')

@section('title', 'Sponsors')

@section('breadcrumb')
<button class="btn btn-primary" data-toggle="modal" data-target="#addSponsor"><i class="fa fa-plus"></i> &nbsp; Sponsor</button>
@endsection

@section('content')

@if ($sponsors->count() == 0)
    <h4>Tidak ada data</h4>
@else
    <table id="data" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach ($sponsors as $sponsor)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $sponsor->name }}</td>
                    <td>{{ $sponsor->phone }}</td>
                    <td>
                        <a href="#" data-target="#detailSponsor" id="detailBtn" data-toggle="modal" class="text-primary" data-sponsor="{{ json_encode($sponsor) }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        &nbsp; &nbsp;
                        <a href="#" data-target="#deleteSponsor" id="deleteBtn" data-toggle="modal" class="text-danger" data-id="{{ $sponsor->id }}">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<div class="modal fade" id="deleteSponsor" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('sponsor.delete') }}" class="modal-content" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="sponsor_id" id="sponsor_id">
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Hapus Sponsor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Yakin ingin menghapus sponsor ini?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="detailSponsor" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="#" class="modal-content">
            {{ csrf_field() }}
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Detail Sponsor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img id="logoSponsor">
                    <h4 class="mt-4"></h4>
                    <div id="field" class="mt-2 text-muted"></div>
                    <p class="mt-4"></p>

                    <div class="row">
                        <div class="col-md-6 text-center mt-4 mb-4">
                            <div id="phone"></div>
                        </div>
                        <div class="col-md-6 text-center mt-4 mb-4">
                            <div id="website"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="addSponsor" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('sponsor.store') }}" class="modal-content" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Tambah Sponsor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama :</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="address">Alamat :</label>
                    <textarea type="text" class="form-control" name="address" id="address" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="field">Bidang Pekerjaan :</label>
                    <input type="text" class="form-control" name="field" id="field" required>
                </div>
                <div class="form-group">
                    <label for="phone">No. Telepon :</label>
                    <input type="text" class="form-control" name="phone" id="phone" required>
                </div>
                <div class="form-group">
                    <label for="link">Link Website / Social Media :</label>
                    <input type="text" class="form-control" name="link" id="link" required>
                </div>
                <div class="form-group">
                    <label for="logo">Logo :</label>
                    <input type="file" class="form-control" name="logo" id="logo" required>
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

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('template-admin/assets/js/lib/data-table/datatables.min.js') }}"></script>
<script src="{{ asset('template-admin/assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('template-admin/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
<script>
    (function($) {
        $("#data").DataTable()
        $(document).on("click", "#detailBtn", function() {
            let data = $(this).data('sponsor')
            
            $("#logoSponsor").attr('src', `{{ asset('storage/logo/${data.logo}') }}`)
            $("#detailSponsor h4").html(data.name)
            $("#detailSponsor p").html(data.address)
            $("#detailSponsor #field").html(data.field)
            $("#detailSponsor #phone").html("<i class='fas fa-phone-alt'></i> &nbsp; " + data.phone)
            $("#detailSponsor #website").html(data.link)
        })

        $(document).on("click", "#deleteBtn", function() {
            let id = $(this).data('id')
            $("#sponsor_id").val(id)
        })
    })(jQuery)
</script>
@endsection
