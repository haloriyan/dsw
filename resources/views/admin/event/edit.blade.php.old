@extends('layouts.admin')

@section('title', 'Event')

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

                <form action="{{ route('event.update', [$event->id]) }}" method="POST">
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
                                <input type="text" name="requirements_old" id="requirements_edit" value="{{ $event->requirements }}">
                                <div class="area">
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach (json_decode($event->requirements) as $req)
                                        @php
                                            $iPP = $i++;
                                        @endphp
                                        <input type="text" class="form-control" id="edit_req{{ $iPP }}" name="requirements[]" oninput="addReqEdit(this)" value="{{ $req }}">
                                        <span class="btn btn-danger ml-1 text-white transparent" id="removeBtn{{ $iPP }}" aria-hidden="true" onclick="removeReqEdit('{{ $iPP }}', '{{ $req }}')"><i class="fas fa-times"></i></span>
                                    @endforeach
                                </div>
                                <button type="button" onclick="moreReqEdit()" id="moreReqEditBtn" class="btn btn-secondary mt-2"><i class="fas fa-plus"></i> More</button>
                            </div>
                            <div class="form-group" id="prizeEditArea">
                                <label for="title">Prize :</label>
                                <input type="hidden" name="old_prize" id="prize_edit">
                                <div class="area">
                                    @php
                                        $a = 0;
                                    @endphp
                                    @foreach (json_decode($event->prize) as $prize)
                                        @php
                                            $aPP = $a++;
                                        @endphp
                                        <input type="text" class="form-control" id="edit_prize{{ $iPP }}" name="prizes[]" oninput="addPrizeEdit(this)" value="{{ $prize }}">
                                        <span class="btn btn-danger ml-1 text-white transparent" id="removeBtnPrize{{ $iPP }}" aria-hidden="true" onclick="removePrizeEdit('{{ $iPP }}', '{{ $req }}')"><i class="fas fa-times"></i></span>
                                    @endforeach
                                </div>
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
            requirements: {!! $event->requirements !!}
        },
        store: {
            prize: [],
            requirements: []
        }
    }

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
        console.log(state['edit'])
        createElement({
            el: 'div',
            attributes: [
                ['class', 'input-group mt-3'],
                ['id', `edit_req${index}`]
            ],
            html: `<input type="text" class="form-control" id="requirements_${index}" name="requirements[]" oninput="addReqEdit(this)">
<span class="btn btn-danger ml-1 text-white transparent" aria-hidden="true" onclick="removeReqEdit('${index}')"><i class="fas fa-times"></i></span>`,
            createTo: '#requirementsEditArea .area'
        })
    }
    const removeReqEdit = (index, requirement = null) => {
        if (requirement == null) {
            select(`#edit_req${index}`).remove()
            select(`#removeBtn${index}`).remove()
            state['edit']['requirements'].splice(index, 1)
        }else {
            let i = 0
            state.edit.requirements.forEach(req => {
                let iPP = i++
                if (requirement == req) {
                    state['edit']['requirements'].splice(iPP, 1)
                    select(`#edit_req${iPP}`).remove()
                    select(`#removeBtn${iPP}`).remove()
                }
            })
        }
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
            html: `<input type="text" class="form-control" name="prizes[]" id="prize_${index}" oninput="addPrizeEdit(this)">
<span class="btn btn-danger ml-1 text-white transparent" aria-hidden="true" onclick="removePrizeEdit(${index})"><i class="fas fa-times"></i></span>`,
            createTo: '#prizeEditArea .area'
        })
    }
    const removePrizeEdit = i => {
        select(`#edit_prize${i}`).remove()
        select(`#removeBtnPrize${i}`).remove()
        state['edit']['prize'].splice(i, 1)
    }
</script>
@endsection