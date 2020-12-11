@extends('layouts.admin')

@section('title', 'Jenis Sponsor')

@section('breadcrumb')
<button class="btn btn-primary" data-toggle="modal" data-target="#addType"><i class="fa fa-plus"></i> &nbsp; Data</button>
@endsection

@section('content')
<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered w-100">
            <thead>
                <tr>
                    <th>Name</th>
                    <th style="width: 15%;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sponsorType as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        <td>
                            <a href="#" class="text-primary" id="editBtn" data-target="#editType" data-toggle="modal" data-value="{{ json_encode($type) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            &nbsp;
                            <a href="#" class="text-danger" id="deleteBtn" data-target="#deleteType" data-toggle="modal" data-id="{{ $type->id }}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addType" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('sponsorType.store') }}" class="modal-content" method="POST">
            {{ csrf_field() }}
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama :</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-success">Tambah</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="deleteType" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('sponsorType.delete') }}" class="modal-content" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="data_id" id="data_id">
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Yakin ingin menghapus jenis event ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="editType" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('sponsorType.update') }}" class="modal-content" method="POST" id="formEdit">
            {{ csrf_field() }}
            <input type="hidden" name="data_id" id="data_id_edit">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name_edit">Nama :</label>
                    <input type="text" class="form-control" name="name" id="name_edit">
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
<script>
    (function($) {
        $(document).on("click", "#deleteBtn", function() {
            let data = $(this).data('id')
            $("#data_id").val(data)
        })
        $(document).on("click", "#editBtn", function() {
            let data = $(this).data('value')
            $("#data_id_edit").val(data.id)
            $("#formEdit input[name=name]").val(data.name)
        })
    })(jQuery)
</script>
@endsection
