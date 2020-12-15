@extends('layouts.admin')

@section('title', 'Sponsor Type')

@section('content')

@section('content')

<!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Edit Edit</h1>
                <a href="{{ route('admin.eventType') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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

                <form action="{{ route('eventType.update', $eventType->id) }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="data_id" value="{{ $eventType->id }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <strong>Jenis Sponsor: </strong>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" value="{{ $eventType->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
@endsection

