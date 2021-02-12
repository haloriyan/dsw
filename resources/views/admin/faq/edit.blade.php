@extends('layouts.admin')

@section('title', 'FAQ')

@section('content')

<!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Faq Edit</h1>
                <a href="{{ route('admin.faq') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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

                <form action="{{ route('faq.update',$faq->id) }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="faq_id" value="{{ $faq->id }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="type">Type :</label>
                                <select name="type" class="form-control">
                                    <option value="">General</option>
                                    @foreach ($types as $type)
                                        @php
                                            $isSelected = $faq->type == $type ? "selected='selected'" : "";
                                        @endphp
                                        <option {{ $isSelected }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <strong>Pertanyaan : </strong>
                                <input type="text" name="question" value="{{ $faq->question }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <strong>Jawaban : </strong>
                                <input type="text" name="answer" value="{{ $faq->answer }}" class="form-control">
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

