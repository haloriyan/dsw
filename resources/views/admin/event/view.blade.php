@extends('layouts.admin')

@section('title', 'FAQ')

@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Lihat Data</h1>
                        <a href="{{ route('admin.faq') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Faq</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Pertanyaan : </strong>
                                        {{ $faq->question }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Jawaban : </strong>
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

@endsection
