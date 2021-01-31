@extends('layouts.admin')

@section('title', 'Peserta')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Peserta</h1>
    <a href="{{ route('admin.participant') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> kembali</a>
</div>

<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Peserta</h6>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @php
            $hasJoinedDSI = $participant->has_joined_dsi == 1 ? "Sudah" : "Belum";
            if ($participant->interested_with_dsi == 1) {
                $interestedWithDSI = "Ya";
            }else if ($participant->interested_with_dsi === 0) {
                $interestedWithDSI = "Tidak";
            }else if ($participant->interested_with_dsi == NULL) {
                $interestedWithDSI = "";
            }
        @endphp
        <h3>{{ $participant->name }}</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><b>Alamat :</b></label>
                    <p>{{ $participant->address }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><b>Telepon :</b></label>
                    <p>{{ $participant->phone }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><b>Instansi :</b></label>
                    <p>{{ $participant->instance }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><b>Alasan Mengikuti DSW :</b></label>
                    <p>{{ $participant->reason }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><b>Status bergabung di DSI :</b></label>
                    <p>{{ $hasJoinedDSI }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><b>Tertarik bergabung di DSI :</b></label>
                    <p>{{ $interestedWithDSI }}</p>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                @if ($participant->social_linkedin != "")
                    <div class="col-md-6 mb-4">
                        <div class="container">
                            <a href="{{ $participant->social_linkedin }}" target="_blank">
                                <div class="shadow rounded p-4">
                                    <i class="fab fa-linkedin"></i>
                                    LinkedIn
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
                @if ($participant->social_medium != "")
                    <div class="col-md-6 mb-4">
                        <div class="container">
                            <a href="{{ $participant->social_medium }}" target="_blank">
                                <div class="shadow rounded p-4">
                                    <i class="fab fa-medium"></i>
                                    Medium
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
                @if ($participant->social_facebook)
                    <div class="col-md-6 mb-4">
                        <div class="container">
                            <a href="{{ $participant->social_facebook }}" target="_blank">
                                <div class="shadow rounded p-4">
                                    <i class="fab fa-facebook-square"></i>
                                    Facebook
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
                @if ($participant->social_instagram != "")
                    <div class="col-md-6 mb-4">
                        <div class="container">
                            <a href="{{ $participant->social_instagram }}" target="_blank">
                                <div class="shadow rounded p-4">
                                    <i class="fab fa-instagram"></i>
                                    Instagram
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagejs')

<!-- Page level plugins -->
<script src="{{ asset('sb-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('sb-admin/js/demo/datatables-demo.js') }}"></script>

@endsection
