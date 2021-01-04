@extends('layouts.admin')

@section('title', 'Event')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Event</h1>
    <a href="{{ route('admin.event') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Event</h6>
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

        <form action="{{ route('event.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="title">Jenis event :</label>
                        <select name="type_id" class="form-control">
                            <option value="">-- Pilih Jenis Event --</option>
                            @foreach ($eventTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Nama event :</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label for="title">Deskripsi :</label>
                        <textarea name="description" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group" >
                        <label for="requirements">Requirements :</label>
                        <div id="requirementsArea">
                            <input type="text" class="form-control" name="requirements[]" id="requierments">
                        </div>
                        <button class="btn btn-primary mt-3" type="button" onclick="moreReq()"><i class="fas fa-plus"></i> lainnya</button>
                    </div>
                    <div class="form-group" >
                        <label for="prize">Prize :</label>
                        <div id="prizeArea">
                            <input type="text" class="form-control" name="prize[]" />
                        </div>
                        <button class="btn btn-primary mt-3" type="button" onclick="morePrize()"><i class="fas fa-plus"></i> lainnya</button>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('pagejs')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('js/base.js') }}"></script>
<script>
    let iPP = 0;
    let iPPPrize = 0;
    
    const moreReq = () => {
        iPP += 1;
        createElement({
            el: 'div',
            attributes: [
                ['class', 'row mt-3 requirements'],
                ['key', iPP]
            ],
            html: `<div class="col-md-11"><input type="text" name="requirements[]" class="form-control" key="${iPP}" /></div>
<div class="col-md-1"><button type="button" onclick="removeReq(${iPP})" class="btn btn-danger"><i class="fas fa-trash"></i></button></div>`,
            createTo: "#requirementsArea"
        });
    }
    const morePrize = () => {
        iPPPrize += 1;
        createElement({
            el: 'div',
            attributes: [
                ['class', 'row mt-3 prize'],
                ['key', iPPPrize]
            ],
            html: `<div class="col-md-11"><input type="text" name="prize[]" class="form-control" key="${iPPPrize}" /></div>
<div class="col-md-1"><button type="button" onclick="removePrize(${iPPPrize})" class="btn btn-danger"><i class="fas fa-trash"></i></button></div>`,
            createTo: "#prizeArea"
        });
    }
    const removeReq = key => {
        select(`.requirements[key='${key}']`).remove();
    }
</script>
@endsection

