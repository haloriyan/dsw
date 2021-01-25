@extends('layouts.admin')

@section('title', 'Detail Team')

@php
    use \Carbon\Carbon;
@endphp

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Team</h1>
        <a href="{{ route('admin.team') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Team</h6>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <h3>{{ $team->name }}</h3>
            <div class="row mt-4">
                <div class="col-md-4">
                    <h5>Chief :</h5>
                    <p>{{ $team->chief->name }}</p>
                    <ul>
                        @if ($team->chief->social_linkedin != null)
                            <li>
                                <a href="{{ $team->chief->social_linkedin }}" target="_blank">
                                    <i class="fab fa-linkedin"></i> &nbsp; LinkedIn
                                </a>
                            </li>
                        @endif
                        @if ($team->chief->social_medium != null)
                            <li>
                                <a href="{{ $team->chief->social_medium }}" target="_blank">
                                    <i class="fab fa-medium"></i> &nbsp; Medium
                                </a>
                            </li>
                        @endif
                        @if ($team->chief->social_facebook != null)
                            <li>
                                <a href="{{ $team->chief->social_facebook }}" target="_blank">
                                    <i class="fab fa-facebook"></i> &nbsp; Facebook
                                </a>
                            </li>
                        @endif
                        @if ($team->chief->social_instagram != null)
                            <li>
                                <a href="{{ $team->chief->social_instagram }}" target="_blank">
                                    <i class="fab fa-instagram"></i> &nbsp; Instagram
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                @if ($team->first_member != null)
                    <div class="col-md-4">
                        <h5>Member 1 :</h5>
                        <p>{{ $team->first_member->name }}</p>
                        <ul>
                            @if ($team->first_member->social_linkedin != null)
                                <li>
                                    <a href="{{ $team->first_member->social_linkedin }}" target="_blank">
                                        <i class="fab fa-linkedin"></i> &nbsp; LinkedIn
                                    </a>
                                </li>
                            @endif
                            @if ($team->first_member->social_medium != null)
                                <li>
                                    <a href="{{ $team->first_member->social_medium }}" target="_blank">
                                        <i class="fab fa-medium"></i> &nbsp; Medium
                                    </a>
                                </li>
                            @endif
                            @if ($team->first_member->social_facebook != null)
                                <li>
                                    <a href="{{ $team->first_member->social_facebook }}" target="_blank">
                                        <i class="fab fa-facebook"></i> &nbsp; Facebook
                                    </a>
                                </li>
                            @endif
                            @if ($team->first_member->social_instagram != null)
                                <li>
                                    <a href="{{ $team->first_member->social_instagram }}" target="_blank">
                                        <i class="fab fa-instagram"></i> &nbsp; Instagram
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                @endif
                @if ($team->second_member != null)
                    <div class="col-md-4">
                        <h5>Member 2 :</h5>
                        <p>{{ $team->second_member->name }}</p>
                        <ul>
                            @if ($team->second_member->social_linkedin != null)
                                <li>
                                    <a href="{{ $team->second_member->social_linkedin }}" target="_blank">
                                        <i class="fab fa-linkedin"></i> &nbsp; LinkedIn
                                    </a>
                                </li>
                            @endif
                            @if ($team->second_member->social_medium != null)
                                <li>
                                    <a href="{{ $team->second_member->social_medium }}" target="_blank">
                                        <i class="fab fa-medium"></i> &nbsp; Medium
                                    </a>
                                </li>
                            @endif
                            @if ($team->second_member->social_facebook != null)
                                <li>
                                    <a href="{{ $team->second_member->social_facebook }}" target="_blank">
                                        <i class="fab fa-facebook"></i> &nbsp; Facebook
                                    </a>
                                </li>
                            @endif
                            @if ($team->second_member->social_instagram != null)
                                <li>
                                    <a href="{{ $team->second_member->social_instagram }}" target="_blank">
                                        <i class="fab fa-instagram"></i> &nbsp; Instagram
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                @endif
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
