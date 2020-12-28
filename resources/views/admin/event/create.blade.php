@extends('layouts.admin')

@section('title', 'Event')

@section('content')

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
                                        <div class="form-group" id="requirementsAddArea">
                                            <label for="title">Requirements :</label>
                                            <input type="hidden" name="requirements" id="requirements_add">
                                            <div class="area">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="requirements_0" oninput="addReqStore(this)">
                                                    <button type="button" onclick="moreReqStore()" id="moreReqStoreBtn" class="btn btn-secondary ml-2"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="prizeAddArea">
                                            <label for="prize">Hadiah :</label>
                                            <input type="hidden" name="prize" id="prize_add">
                                            <div class="area">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="prize_0" oninput="addPrizeStore(this)">
                                                    <button type="button" id="morePrizeStoreBtn" class="btn btn-secondary ml-2" onclick="morePrizeStore()"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
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
    let state = {
        edit: {
            prize: [],
            requirements: []
        },
        store: {
            prize: [],
            requirements: []
        }
    }

    const addReqStore = dom => {
        let index = dom.getAttribute('id').split('_')[1]
        let value = dom.value
        state['store']['requirements'][index] = value
        select("#requirements_add").value = JSON.stringify(state['store']['requirements'])

        if (index == 0) {
            let buttonVisibility = value != "" ? "block" : "none"
            select("button#moreReqStoreBtn").style.display = buttonVisibility
        }
    }
    const addPrizeStore = dom => {
        let index = dom.getAttribute('id').split('_')[1]
        let value = dom.value
        state['store']['prize'][index] = value
        select("#prize_add").value = JSON.stringify(state['store']['prize'])

        if (index == 0) {
            let buttonVisibility = value != "" ? "block" : "none"
            select("button#morePrizeStoreBtn").style.display = buttonVisibility
        }
    }
    const moreReqStore = () => {
        let index = state['store']['requirements'].length
        createElement({
            el: 'div',
            attributes: [
                ['class', 'input-group mt-3'],
                ['id', `store_req${index}`]
            ],
            html: `<input type="text" class="form-control" id="requirements_${index}" oninput="addReqStore(this)">
<span class="btn btn-danger ml-1 text-white transparent" aria-hidden="true" onclick="removeReqStore(${index})"><i class="fas fa-times"></i></span>`,
            createTo: '#requirementsAddArea .area'
        })
    }
    const morePrizeStore = () => {
        let index = state['store']['prize'].length
        createElement({
            el: 'div',
            attributes: [
                ['class', 'input-group mt-3'],
                ['id', `store_prize${index}`]
            ],
            html: `<input type="text" class="form-control" id="prize_${index}" oninput="addPrizeStore(this)">
<span class="btn btn-danger ml-1 text-white transparent" aria-hidden="true" onclick="removePrizeStore(${index})"><i class="fas fa-times"></i></span>`,
            createTo: '#prizeAddArea .area'
        })
    }
    const removeReqStore = i => {
        select(`#store_req${i}`).remove()
        state['store']['requirements'].splice(i, 1)
        select("#requirements_add").value = JSON.stringify(state['store']['requirements'])
    }
    const removePrizeStore = i => {
        select(`#store_prize${i}`).remove()
        state['store']['prize'].splice(i, 1)
        select("#prize_add").value = JSON.stringify(state['store']['prize'])
    }
</script>
@endsection

