@extends('layouts.admin')

@section('title', 'Speaker')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Speaker</h1>
    <a href="{{ route('admin.speaker') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Speaker</h6>
    </div>
    <div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('speaker.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="event">Event :</label>
                        <select name="event_id" class="form-control" required id="event_id_edit">
                            <option value="">Pilih event...</option>
                            @foreach ($events as $event)
                                @php
                                    $isSelected = $event->id == $speaker->event_id ? "selected='selected'" : "";
                                @endphp
                                <option {{ $isSelected }} value="{{ $event->id }}">{{ $event->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama :</label>
                        <input  value="{{ $speaker->name }}" type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">No. Telepon :</label>
                        <input value="{{ $speaker->phone }}" type="text" class="form-control" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input value="{{ $speaker->email }}" type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Linkedin Profile :</label>
                        <input value="{{ $speaker->linkedin_profile }}" type="text" class="form-control" name="linkedin_profile" required>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" name="photo" accept="image/*">
                        <label class="mt-2">Jika Tidak Ingin Di Ubah Kosongkan Saja</label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
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
