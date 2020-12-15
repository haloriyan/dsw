@extends('layouts.admin')

@section('title', 'Sponsor')

@section('content')

@section('content')

<!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Edit Edit</h1>
                <a href="{{ route('admin.sponsor') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Edit</h6>
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

                <form action="{{ route('sponsor.update', [$sponsor->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="data_id" value="{{ $sponsor->id }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Jenis sponsor :</label>
                                <select name="type_id" class="form-control">
                                    @foreach ($sponsorType as $type)
                                        @php
                                            $selected = "";
                                            if ($type->id == $sponsor->type->id) {
                                                $selected = "selected='selected'";
                                            }
                                        @endphp
                                        <option {{ $selected }} value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama :</label>
                                <input type="text" class="form-control" value="{{ $sponsor->name }}" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat :</label>
                                <textarea type="text" class="form-control" name="address" id="address" rows="5" required>{{ $sponsor->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="bidang_kerja">Bidang Pekerjaan :</label>
                                <input type="text" class="form-control" value="{{ $sponsor->bidang_kerja }}" name="bidang_kerja" id="bidang_kerja" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">No. Telepon :</label>
                                <input type="text" class="form-control" value="{{ $sponsor->phone }}" name="phone" id="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="link">Link Website / Social Media :</label>
                                <input type="text" class="form-control" value="{{ $sponsor->link }}" name="link" id="link" required>
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo :</label>
                                <input type="file" class="form-control" value="{{ $sponsor->logo }}" name="logo" id="logo" accept="image/*">
                                <label>Jika Tidak Ingin Di Ubah Kosongkan Saja</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
@endsection

