@extends('layouts.admin')

@section('title', 'Event')

@section('content')

@section('content')

<!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Event Edit</h1>
                <a href="{{ route('admin.event') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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

                <form action="{{ route('event.update',$event->id) }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="data_id" value="{{ $event->id }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">Jenis event :</label>
                                <select name="type_id" class="form-control">
                                    @foreach ($eventType as $type)
                                        @php
                                            $selected = "";
                                            if ($type->id == $event->type->id) {
                                                $selected = "selected='selected'";
                                            }
                                        @endphp
                                        <option {{ $selected }} value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Nama event :</label>
                                <input type="text"  value="{{ $event->title }}" class="form-control" name="title">
                            </div>
                            <div class="form-group">
                                <label for="title">Deskripsi :</label>
                                <textarea name="description" rows="5" class="form-control">{{ $event->description }}
                                </textarea>
                            </div>
                            <div class="form-group" id="requirementsEditArea">
                                <label for="title">Requirements :</label>
                                <input type="hidden" name="requirements" id="requirements_edit">
                                <div class="area"></div>
                                <button type="button" onclick="moreReqEdit()" id="moreReqEditBtn" class="btn btn-secondary mt-2"><i class="fas fa-plus"></i> More</button>
                            </div>
                            <div class="form-group" id="prizeEditArea">
                                <label for="title">Prize :</label>
                                <input type="hidden" name="prize" id="prize_edit">
                                <div class="area"></div>
                                <button type="button" onclick="morePrizeEdit()" id="morePrizeEditBtn" class="btn btn-secondary mt-2"><i class="fas fa-plus"></i> More</button>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                        <button type="submit" class="btn btn-success">Update</button>
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

    (function($) {
        $(document).on("click", "#editBtn", function() {
           
            let index = 0
            JSON.parse(data.requirements).forEach(req => {
                state['edit']['requirements'].push(req)
                createElement({
                    el: 'div',
                    attributes: [
                        ['class', 'input-group mt-3'],
                        ['id', `edit_req${index}`]
                    ],
                    html: `<input type="text" class="form-control" id="requirements_${index}" oninput="addReqEdit(this)" value="${req}">
<span class="input-group-addon bg-danger text-white transparent" aria-hidden="true" onclick="removeReqEdit(${index})"><i class="fas fa-times"></i></span>`,
                    createTo: '#requirementsEditArea .area'
                })
                index++
            })
            select("#requirements_edit").value = JSON.stringify(state['edit']['requirements'])

            let indexPrize = 0
            JSON.parse(data.prize).forEach(prize => {
                state['edit']['prize'].push(prize)
                createElement({
                    el: 'div',
                    attributes: [
                        ['class', 'input-group mt-3'],
                        ['id', `edit_prize${indexPrize}`]
                    ],
                    html: `<input type="text" class="form-control" id="requirements_${indexPrize}" oninput="addPrizeEdit(this)" value="${prize}">
<span class="input-group-addon bg-danger text-white transparent" aria-hidden="true" onclick="removePrizeEdit(${indexPrize})"><i class="fas fa-times"></i></span>`,
                    createTo: '#prizeEditArea .area'
                })
                indexPrize++
            })
            select("#prize_edit").value = JSON.stringify(state['edit']['prize'])
        })
    })(jQuery)

    const addReqEdit = dom => {
        let index = dom.getAttribute('id').split('_')[1]
        let value = dom.value
        state['edit']['requirements'][index] = value
        select("#requirements_edit").value = JSON.stringify(state['edit']['requirements'])

        if (index == 0) {
            let buttonVisibility = value != "" ? "block" : "none"
            select("button#moreReqEditBtn").style.display = buttonVisibility
        }
    }
    const moreReqEdit = () => {
        let index = state['edit']['requirements'].length
        createElement({
            el: 'div',
            attributes: [
                ['class', 'input-group mt-3'],
                ['id', `edit_req${index}`]
            ],
            html: `<input type="text" class="form-control" id="requirements_${index}" oninput="addReqEdit(this)">
<span class="btn btn-danger ml-1 text-white transparent" aria-hidden="true" onclick="removeReqEdit(${index})"><i class="fas fa-times"></i></span>`,
            createTo: '#requirementsEditArea .area'
        })
    }
    const removeReqEdit = i => {
        select(`#edit_req${i}`).remove()
        state['edit']['requirements'].splice(i, 1)
        select("#requirements_edit").value = JSON.stringify(state['edit']['requirements'])
    }

    const addPrizeEdit = dom => {
        let index = dom.getAttribute('id').split('_')[1]
        let value = dom.value
        state['edit']['prize'][index] = value
        select("#prize_edit").value = JSON.stringify(state['edit']['prize'])
    }
    const morePrizeEdit = () => {
        let index = state['edit']['prize'].length
        createElement({
            el: 'div',
            attributes: [
                ['class', 'input-group mt-3'],
                ['id', `store_prize${index}`]
            ],
            html: `<input type="text" class="form-control" id="prize_${index}" oninput="addPrizeEdit(this)">
<span class="btn btn-danger ml-1 text-white transparent" aria-hidden="true" onclick="removePrizeStore(${index})"><i class="fas fa-times"></i></span>`,
            createTo: '#prizeEditArea .area'
        })
    }
</script>
@endsection