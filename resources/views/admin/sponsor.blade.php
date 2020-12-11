@extends('layouts.admin')

@section('title', 'Sponsors')

@section('breadcrumb')
<button class="btn btn-primary" data-toggle="modal" data-target="#addSponsor"><i class="fa fa-plus"></i> &nbsp; Sponsor</button>
@endsection

@section('content')
<div class="col-md-12">
    <div class="table-responsive">
        <table id="data" class="table table-bordered w-100">
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
                            <a href="#" class="text-primary" data-toggle="modal" data-target="#editSponsor" data-value="{{ $sponsor }}" id="editBtn">
                                <i class="fas fa-edit"></i>
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
    </div>
</div>

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
                    <div id="bidang_kerja" class="mt-2 text-muted"></div>
                    <p class="mt-4"></p>

                    <div class="row">
                        <div class="col-md-6 text-center mt-4 mb-4">
                            <div id="phone"></div>
                        </div>
                        <div class="col-md-6 text-center mt-4 mb-4">
                            <div id="link"></div>
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
                    <label for="title">Jenis sponsor :</label>
                    <select name="type_id" class="form-control">
                        <option value="">-- Pilih Jenis Sponsor --</option>
                        @foreach ($sponsorType as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nama :</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="address">Alamat :</label>
                    <textarea type="text" class="form-control" name="address" id="address" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="bidang_kerja">Bidang Pekerjaan :</label>
                    <input type="text" class="form-control" name="bidang_kerja" id="bidang_kerja" required>
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
                    <input type="file" class="form-control" name="logo" id="logo" accept="image/*" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editSponsor" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('sponsor.update') }}" class="modal-content" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" id="data_id_edit" name="data_id">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Ubah Data Sponsor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Jenis sponsor :</label>
                    <select name="type_id" class="form-control" id="type_id_edit">
                        <option value="">-- Pilih Jenis Sponsor --</option>
                        @foreach ($sponsorType as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nama :</label>
                    <input type="text" class="form-control" name="name" id="name_edit">
                </div>
                <div class="form-group">
                    <label for="address">Alamat :</label>
                    <textarea type="text" class="form-control" name="address" id="address_edit" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="bidang_kerja">Bidang Pekerjaan :</label>
                    <input type="text" class="form-control" name="bidang_kerja" id="bidang_kerja_edit">
                </div>
                <div class="form-group">
                    <label for="phone">No. Telepon :</label>
                    <input type="text" class="form-control" name="phone" id="phone_edit">
                </div>
                <div class="form-group">
                    <label for="link">Link Website / Social Media :</label>
                    <input type="text" class="form-control" name="link" id="link_edit">
                </div>
                <div class="form-group">
                    <label for="logo">Logo :</label>
                    <input type="file" class="form-control" name="logo" accept="image/*">
                    <p class="text-muted mt-3">Biarkan kosong jika tidak ingin mengganti foto</p>
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

            $("#logoSponsor").attr('src', `{{ asset('storage/sponsor/logo/${data.logo}') }}`)
            $("#detailSponsor h4").html(data.name)
            $("#detailSponsor p").html(data.address)
            $("#detailSponsor #bidang_kerja").html(data.bidang_kerja)
            $("#detailSponsor #phone").html("<i class='fas fa-phone-alt'></i> &nbsp; " + data.phone)
            $("#detailSponsor #link").html(data.link)
        })

        $(document).on("click", "#editBtn", function() {
            let data = $(this).data('value')
            $(`#editSponsor #type_id_edit option[value=${data.type_id}]`).attr('selected', 'selected')
            $("#editSponsor #data_id_edit").val(data.id)
            $("#editSponsor #name_edit").val(data.name)
            $("#editSponsor #address_edit").val(data.address)
            $("#editSponsor #bidang_kerja_edit").val(data.bidang_kerja)
            $("#editSponsor #phone_edit").val(data.phone)
            $("#editSponsor #link_edit").val(data.link)
        })

        $(document).on("click", "#deleteBtn", function() {
            let id = $(this).data('id')
            $("#sponsor_id").val(id)
        })
    })(jQuery)
</script>
@endsection
