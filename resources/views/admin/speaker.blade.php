@extends('layouts.admin')

@section('title', 'Speaker')

@section('breadcrumb')
<button class="btn btn-primary" data-toggle="modal" data-target="#addSpeaker"><i class="fa fa-plus"></i> &nbsp; Speaker</button>
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
                @foreach ($speakers as $speaker)
                    <tr>
                        <td>{{ $speaker->event->title }}</td>
                        <td>{{ $speaker->name }}</td>
                        <td>{{ $speaker->phone }}</td>
                        <td>{{ $speaker->email }}</td>
                        <td>
                            <a href="#" class="text-primary" data-toggle="modal" data-target="#editSpeaker" data-value="{{ $speaker }}" id="editBtn">
                                <i class="fas fa-edit"></i>
                            </a>
                            &nbsp;
                            <a href="#" class="text-danger" data-toggle="modal" data-target="#deleteSpeaker" data-id="{{ $speaker->id }}" id="deleteBtn">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="deleteSpeaker" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('speaker.delete') }}" method="POST" class="modal-content">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="data_id" id="data_id_delete">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Hapus Speaker</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus data speaker ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="addSpeaker" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('speaker.store') }}" class="modal-content" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Tambah Speaker</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="event">Event :</label>
                    <select name="event[]" class="form-control" required id="event">
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
<div class="modal fade" id="editSpeaker" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('speaker.update') }}" class="modal-content" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" id="data_id_edit" name="data_id">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Edit Data Speaker</h5>
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

@section('pagejs')
<script>
    $(document).ready(function ()
    {
            $('#event').select2();

            $('#event').on('change', function() {
                var event = $(this).val();
                console.log(event);
            })
    });
</script>
@endsection
