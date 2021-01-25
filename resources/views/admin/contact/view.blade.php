@extends('layouts.admin')

@section('title', 'Contact')

@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Lihat Data</h1>
                        <a href="{{ route('admin.contact') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Contact</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Icon : </strong>
                                        <td><i class="{{ $contact->icon }}"></i></td>
                                    </div>
                                    <div class="form-group">
                                        <strong>Nama : </strong>
                                        <td>{{ $contact->name }}</td>
                                    </div>
                                    <div class="form-group">
                                        <strong>Link : </strong>
                                        <td>{{ $contact->value }}</td>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

@endsection
