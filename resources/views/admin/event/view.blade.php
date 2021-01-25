@extends('layouts.admin')

@section('title', 'Event Detail')
@php
    use Carbon\Carbon;
@endphp

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lihat Data Event</h1>
        <a href="{{ route('admin.faq') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Event</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="container mt-2">
                        <p>({{ $event->rundown->title }})</p>
                        <h3>{{ $event->title }}</h3>
                        <p>{{ $event->description }}</p>
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <h4>Requirements</h4>
                                @foreach (explode(",", $event->requirements) as $requirement)
                                    <li>{{ $requirement }}</li>
                                @endforeach
                            </div>
                            <div class="col-md-6 mt-2">
                                <h4>Prize</h4>
                                @foreach (explode(",", $event->prize) as $prize)
                                    <li>{{ $prize }}</li>
                                @endforeach
                            </div>
                            @if ($event->timeline != "")
                                <div class="col-md-6 mt-4">
                                    <h5>Pendaftaran : {{ Carbon::parse($event->timeline->open_date)->format('d M Y') }}</h5>
                                    <h5>Penutupan : {{ Carbon::parse($event->timeline->close_date)->format('d M Y') }}</h5>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <h5>Penjurian : {{ Carbon::parse($event->timeline->judgement_date)->format('d M Y') }}</h5>
                                    <h5>Acara Utama : {{ Carbon::parse($event->timeline->main_date)->format('d M Y') }}</h5>
                                </div>
                            @else
                                <div class="alert alert-danger w-100 mt-4 p-3 rounded">
                                    Event ini belum memiliki timeline.
                                    <a href="{{ route('admin.timeline', $event->id) }}" class="">
                                        Buat Timeline
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
