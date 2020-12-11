@extends('layouts.admin')

@section('title', 'Juri')

@section('breadcrumb')
<button class="btn btn-primary" data-toggle="modal" data-target="#addJudge"><i class="fa fa-plus"></i> &nbsp; Juri</button>
@endsection

@section('content')
<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered w-100">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($judges as $judge)
                    <tr>
                        <td>{{ $judge->event->title }}</td>
                        <td>{{ $judge->name }}</td>
                        <td>{{ $judge->phone }}</td>
                        <td>{{ $judge->email }}</td>
                        <td>
                            <a href="#" class="text-primary" id="editBtn" data-toggle="modal" data-target="#editJudge" data-value="{{ $judge }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            &nbsp;
                            <a href="#" class="text-danger" id="deleteBtn" data-toggle="modal" data-target="#deleteJudge" data-id="{{ $judge->id }}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="deleteJudge" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('judge.delete') }}" method="POST" class="modal-content">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="data_id" id="data_id_delete">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Hapus Juri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus data juri ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="addJudge" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('judge.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            {{ csrf_field() }}
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Tambah Juri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
<div class="modal fade" id="editJudge" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('judge.update') }}" class="modal-content" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" id="data_id_edit" name="data_id">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Edit Data Juri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="event">Event :</label>
                    <select name="event_id" class="form-control" id="event_id_edit">
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}">{{ $event->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nama :</label>
                    <input type="text" class="form-control" name="name" id="name_edit">
                </div>
                <div class="form-group">
                    <label for="name">No. Telepon :</label>
                    <input type="text" class="form-control" name="phone" id="phone_edit">
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" name="email" id="email_edit">
                </div>
                <div class="form-group">
                    <label for="name">Linkedin Profile :</label>
                    <input type="text" class="form-control" name="linkedin_profile" id="linkedin_edit">
                </div>
                <div class="form-group">
                    <label for="name">Foto :</label>
                    <input type="file" class="form-control" name="photo">
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
<script>
    (function($) {
        $(document).on("click", "#editBtn", function() {
            let data = $(this).data('value')
            $(`#editJudge #event_id_edit option[value=${data.event.id}]`).attr('selected', 'selected')
            $("#editJudge #data_id_edit").val(data.id)
            $("#editJudge #name_edit").val(data.name)
            $("#editJudge #phone_edit").val(data.phone)
            $("#editJudge #email_edit").val(data.email)
            $("#editJudge #linkedin_edit").val(data.linkedin_profile)
        })
        $(document).on("click", "#deleteBtn", function() {
            let data = $(this).data('id')
            $("#data_id_delete").val(data)
        })
    })(jQuery)
</script>
@endsection
