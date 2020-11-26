@extends('layouts.admin')

@section('title', 'Event')

@section('breadcrumb')
<button class="btn btn-primary" data-toggle="modal" data-target="#addEvent"><i class="fa fa-plus"></i> &nbsp; Event</button>
@endsection

@section('content')
<div class="col-md-12">
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Requirements</th>
                <th>Hadiah</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->description }}</td>
                    <td>
                        @foreach (json_decode($event->requirements) as $key => $req)
                            <li>{{ $req }}</li>
                        @endforeach
                    </td>
                    <td>
                        @foreach (json_decode($event->prize) as $key => $prize)
                            <li>{{ $prize }}</li>
                        @endforeach
                    </td>
                    <td>
                        <a href="#" class="text-primary" id="editBtn" data-value="{{ $event }}" data-toggle="modal" data-target="#editEvent">
                            <i class="fas fa-edit"></i>
                        </a>
                        &nbsp;
                        <a href="#" class="text-danger" id="deleteBtn" data-id="{{ $event->id }}" data-toggle="modal" data-target="#deleteEvent">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="deleteEvent" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('event.delete') }}" class="modal-content" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="data_id" id="data_id_delete">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Hapus Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus event ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editEvent" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('event.update') }}" class="modal-content" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="data_id" id="data_id_edit">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Edit Data Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Jenis event :</label>
                    <select name="type_id" class="form-control" id="eventType_edit">
                        @foreach ($eventTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Nama event :</label>
                    <input type="text" class="form-control" name="title" id="title_edit">
                </div>
                <div class="form-group">
                    <label for="title">Deskripsi :</label>
                    <textarea id="description_edit" name="description" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group" id="requirementsEditArea">
                    <label for="title">Requirements :</label>
                    <input type="hidden" name="requirements" id="requirements_edit">
                    <div class="area"></div>
                    <button type="button" onclick="moreReqEdit()" id="moreReqEditBtn" class="mt-3"><i class="fas fa-plus"></i> More</button>
                </div>
                <div class="form-group" id="prizeEditArea">
                    <label for="title">Prize :</label>
                    <input type="hidden" name="prize" id="prize_edit">
                    <div class="area"></div>
                    <button type="button" onclick="morePrizeEdit()" id="morePrizeEditBtn" class="mt-3"><i class="fas fa-plus"></i> More</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-success">Ubah</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="addEvent" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('event.store') }}" class="modal-content" method="POST">
            {{ csrf_field() }}
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Tambah Data Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Jenis event :</label>
                    <select name="type_id" class="form-control">
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
                        </div>
                    </div>
                    <button type="button" onclick="moreReqStore()" id="moreReqStoreBtn" class="mt-3" style="display: none;"><i class="fas fa-plus"></i> More</button>
                </div>
                <div class="form-group" id="prizeAddArea">
                    <label for="prize">Hadiah :</label>
                    <input type="hidden" name="prize" id="prize_add">
                    <div class="area">
                        <div class="input-group">
                            <input type="text" class="form-control" id="prize_0" oninput="addPrizeStore(this)">
                        </div>
                    </div>
                    <button type="button" id="morePrizeStoreBtn" class="mt-3" style="display: none;" onclick="morePrizeStore()"><i class="fas fa-plus"></i> More</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-success">Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
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
<span class="input-group-addon bg-danger text-white transparent" aria-hidden="true" onclick="removeReqStore(${index})"><i class="fas fa-times"></i></span>`,
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
<span class="input-group-addon bg-danger text-white transparent" aria-hidden="true" onclick="removePrizeStore(${index})"><i class="fas fa-times"></i></span>`,
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

    (function($) {
        $(document).on("click", "#deleteBtn", function() {
            let data = $(this).data('id')
            $("#data_id_delete").val(data)
        })

        $(document).on("click", "#editBtn", function() {
            let data = $(this).data('value')
            $("#data_id_edit").val(data.id)
            $("#title_edit").val(data.title)
            $("#description_edit").val(data.description)
            $(`#eventType_edit option[value=${data.type_id}]`).attr('selected', 'selected')

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
<span class="input-group-addon bg-danger text-white transparent" aria-hidden="true" onclick="removeReqEdit(${index})"><i class="fas fa-times"></i></span>`,
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
<span class="input-group-addon bg-danger text-white transparent" aria-hidden="true" onclick="removePrizeStore(${index})"><i class="fas fa-times"></i></span>`,
            createTo: '#prizeEditArea .area'
        })
    }
</script>
@endsection