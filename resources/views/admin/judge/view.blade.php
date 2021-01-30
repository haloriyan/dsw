@extends('layouts.admin')

@section('title', 'Juri')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Lihat Data</h1>
    <a href="{{ route('admin.judge') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Juri</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Juri : </strong>
                    {{ $judge->name }}
                </div>
                <div class="form-group">
                    <strong>Events : </strong>
                    {{ $judge->event->title }}
                </div>
                <div class="form-group">
                    <strong>Email : </strong>
                    {{ $judge->email }}
                </div>
                <div class="form-group">
                    <strong>Phone : </strong>
                    {{ $judge->phone }}
                </div>
                <div class="form-group">
                    <strong>Linkedin : </strong>
                    <a href="{{ $judge->linkedin_profile }}" target="_blank">{{ $judge->linkedin_profile }}</a>
                </div>
                <div class="form-group">
                    <strong>photo : </strong><br><br>
                    @if (!empty($judge->photo))
                    <img src="{{ asset('storage/judge_photo/'.$judge->photo) }}" style="width: 200px" ;
                        height="200px">
                    @else
                    "Logo Tidak Ada"
                    @endif
                </div>
                <div class="form-group">
                    <strong>Contacts :</strong> <br />
                    @foreach ($judge->contacts as $contact)
                        <li class="mt-3">
                            <a href="{{ $contact->value }}" target="_blank">
                                <i class="{{ $contact->icon }}"></i> {{ $contact->name }}
                            </a>
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
