@extends('layouts.admin')

@section('title', 'Speaker')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Lihat Data</h1>
    <a href="{{ route('admin.speaker') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Speaker</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Speaker : </strong>
                    {{ $speaker->name }}
                </div>
                <div class="form-group">
                    <strong>Events : </strong>
                    @foreach ($speaker->eventspeaker as $events)
                    {{ $loop->first ? '' : ', ' }}
                    {{ $events['event']['title'] }}
                    @endforeach
                </div>
                <div class="form-group">
                    <strong>Email : </strong>
                    {{ $speaker->email }}
                </div>
                <div class="form-group">
                    <strong>Phone : </strong>
                    {{ $speaker->phone }}
                </div>
                <div class="form-group">
                    <strong>Linkedin : </strong>
                    {{ $speaker->linkedin_profile }}
                </div>
                <div class="form-group">
                    <strong>photo : </strong><br><br>
                    @if (!empty($speaker->photo))
                    <img src="{{ asset('storage/speaker_photo/'.$speaker->photo) }}" style="width: 200px" ;
                        height="200px">
                    @else
                    "Logo Tidak Ada"
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
