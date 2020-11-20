@extends('layouts.admin')

@section('title', 'Contact')

@section('head')
<style>
    .iconPreview {
        margin-top: -38px;
        position: relative;
        background-color: #fff !important;
        display: none;
    }
    .iconPreview i.text-danger {
        margin-top: 4px;
        cursor: pointer;
    }
    #iconResult { display: none; }
    .suggestionArea {
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .suggestionArea div {
        border-bottom: 1px solid #ddd;
        padding: 8px 15px;
        box-sizing: border-box;
        cursor: pointer;
        list-style: none;
    }
</style>
@endsection

@section('breadcrumb')
<button class="btn btn-primary" data-toggle="modal" data-target="#addContact"><i class="fa fa-plus"></i> &nbsp; Contact</button>
@endsection

@section('content')
<div class="col-md-12">
    @if ($contacts->count() == 0)
        <h4>Tidak ada data</h4>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Icon</th>
                    <th>Nama</th>
                    <th>Value</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td><i class="{{ $contact->icon }}"></i></td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->value }}</td>
                        <td>
                            <a href="#" class="text-danger" id="deleteBtn" data-target="#deleteContact" data-toggle="modal" data-id="{{ $contact->id }}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<div class="modal fade" id="deleteContact" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('contact.delete') }}" class="modal-content" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="contact_id" id="contact_id">
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Hapus Kontak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Yakin ingin menghapus kontak ini?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="addContact" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('contact.store') }}" class="modal-content" method="POST">
            {{ csrf_field() }}
            <div class="modal-header">
                <h5 class="modal-title float-left" id="scrollmodalLabel">Tambah Kontak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="icon">Icon :</label>
                            <input type="text" name="icon" class="form-control" oninput="searchIcon(this.value)" id="icon">
                            <div class="form-control iconPreview" id="iconPreviewAdd" onclick="removeIcon()"><i class="fab fa-facebook"></i> <i class="fas fa-times float-right mt-1 text-danger"></i></div>
                            <div class="suggestionArea" id="iconResult">
                                <li><i class="fab fa-facebook"></i></li>
                                <li><i class="fab fa-instagram"></i></li>
                                <li><i class="fab fa-twitter"></i></li>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="icon">Nama akun :</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">Value :</label>
                            <input type="text" class="form-control" placeholder="URL, Nomor Telepon, atau Email" name="value">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script>
    let fontAwesomeIcon = []
    let fontAwesomeKey = []

    let req = fetch("{{ asset('fa/metadata/icons.json') }}")
    .then(res => res.json())
    .then(res => {
        fontAwesomeIcon = res
        for (let obj in res) {
            fontAwesomeKey.push(obj)
        }
    })
    
    const select = dom => document.querySelector(dom)
    function createElement(props) {  
        let el = document.createElement(props.el)
        if (props.attributes !== undefined) {
            props.attributes.forEach(res => {
                el.setAttribute(res[0], res[1])
            })
        }
        if(props.html !== undefined) {
            el.innerHTML = props.html
        }
        select(props.createTo).appendChild(el)  
    }

    const searchIcon = q => {
        if (q.length < 2) {
            return false
        }

        select("#iconResult").style.display = "block"
        select("#iconResult").innerHTML = ""

        let searchResults = fontAwesomeKey.filter(item => item.toLowerCase().indexOf(q) > -1)
        searchResults.forEach(res => {
            let icon = fontAwesomeIcon[res]
            let prefix = "fab fa"
            if (icon.styles[0] != "brands") {
                return false
            }

            createElement({
                el: 'div',
                attributes: [
                    ['key', `${prefix}-${res}`],
                    ['onclick', 'chooseIcon(this)'],
                ],
                html: `<i class="${prefix}-${res}"></i>`,
                createTo: '#iconResult'
            })
        })
    }
    const chooseIcon = dom => {
        let icon = dom.getAttribute('key')
        select("input#icon").value = icon
        select("#iconResult").style.display = "none"
        select("#iconPreviewAdd").style.display = "block"
        select("#iconPreviewAdd").innerHTML = `<i class="${icon}"></i> <i class="fas fa-times float-right text-danger"></i>`
    }
    const removeIcon = () => {
        select("#iconPreviewAdd").style.display = "none"
        select("input#icon").value = ""
    }

    (function($) {
        $(document).on("click", "#deleteBtn", function() {
            let data = $(this).data('id')
            $("#contact_id").val(data)
        })
    })(jQuery)
</script>
@endsection