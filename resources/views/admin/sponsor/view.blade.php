@extends('layouts.admin')

@section('title', 'Sponsor')

@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Lihat Data</h1>
                        <a href="{{ route('admin.sponsor') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Sponsor</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Jenis sponsor : </strong>
                                        {{ $sponsor->type->name }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Sponsor : </strong>
                                        {{ $sponsor->name }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Alamat : </strong>
                                        {{ $sponsor->address }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Bidang Pekerjaan : </strong>
                                        {{ $sponsor->bidang_kerja }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Link Website / Social Media : </strong>
                                        {{ $sponsor->link }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Logo : </strong><br><br>
                                        @if (!empty($sponsor->logo))
                                            <img src="{{ asset('storage/sponsor/logo/'.$sponsor->logo) }}" 
                                            style="width: 200px"; height="200px"
                                            >
                                        @else
                                            "Logo Tidak Ada"
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

@endsection
