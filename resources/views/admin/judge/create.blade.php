@extends('layouts.admin')

@section('title', 'Juri')

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

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Juri</h1>
    <a href="{{ route('admin.judge') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
</div>

<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <form action="{{ route('judge.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group">
                    <label for="event">Event :</label>
                    <select name="event_id" class="form-control" required id="event_id_edit">
                        <option value="">Pilih event...</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}">{{ $event->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nama :</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="name">No. Telepon :</label>
                    <input type="text" class="form-control" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="name">Linkedin Profile :</label>
                    <input type="text" class="form-control" name="linkedin_profile" required>
                </div>
                <div class="form-group">
                    <label for="name">Foto :</label>
                    <input type="file" class="form-control" name="photo" required>
                </div>
                <div class="form-group">
                    Kontak :
                    <div id="contactArea" class="mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Icon :</label>
                                <input type="text" class="form-control" name="judge_contacts_icon[]" oninput="searchIcon(this.value, this)" id="icon" required>
                                <div class="form-control iconPreview" id="iconPreviewAdd" onclick="removeIcon(this)"><i class="fab fa-facebook"></i> <i class="fas fa-times float-right mt-1 text-danger"></i></div>
                                <div class="suggestionArea" id="iconResult">
                                    <li><i class="fab fa-facebook"></i></li>
                                    <li><i class="fab fa-instagram"></i></li>
                                    <li><i class="fab fa-twitter"></i></li>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Name :</label>
                                <input type="text" class="form-control" name="judge_contacts_name[]" required>
                            </div>
                            <div class="col-md-4">
                                <label>Value :</label>
                                <input type="text" class="form-control" name="judge_contacts_value[]" required>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-2" type="button" onclick="moreContact()">
                        <i class="fas fa-plus"></i> Contact
                    </button>
                </div>
            </div>
             <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('pagejs')

    <!-- Page level plugins -->
    <script src="{{ asset('sb-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('sb-admin/js/demo/datatables-demo.js') }}"></script>
    <script>
        const moreContact = () => {
        createElement({
            el: 'div',
            attributes: [
                ['class', 'row mt-3']
            ],
            html: `<div class="col-md-4">
    <label>Icon :</label>
    <input type="text" class="form-control" name="judge_contacts_icon[]" oninput="searchIcon(this.value, this)" id="icon">
    <div class="form-control iconPreview" id="iconPreviewAdd" onclick="removeIcon(this)"><i class="fab fa-facebook"></i> <i class="fas fa-times float-right mt-1 text-danger"></i></div>
    <div class="suggestionArea" id="iconResult">
        <li><i class="fab fa-facebook"></i></li>
        <li><i class="fab fa-instagram"></i></li>
        <li><i class="fab fa-twitter"></i></li>
    </div>
</div>
<div class="col-md-4">
    <label>Name :</label>
    <input type="text" class="form-control" name="judge_contacts_name[]">
</div>
<div class="col-md-4">
    <label>Value :</label>
    <input type="text" class="form-control" name="judge_contacts_value[]">
</div>`,
            createTo: '#contactArea'
        })
    }

    let fontAwesomeIcon = []
    let fontAwesomeKey = []
    let req = fetch("{{ asset('fa/metadata/icons.json') }}")
    .then(res => res.json())
    .then(res => {
        fontAwesomeIcon = res
        for (let obj in res) {
            fontAwesomeKey.push(obj)
        }
    });

    const searchIcon = (q, target) => {
        if (q.length < 2) {
            return false;
        }
        
        let previewArea = target.parentNode.childNodes[7];

        previewArea.style.display = "block"
        previewArea.innerHTML = ""

        let searchResults = fontAwesomeKey.filter(item => item.toLowerCase().indexOf(q) > -1)
        searchResults.forEach(res => {
            let icon = fontAwesomeIcon[res]
            let prefix = "fab fa";
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
                createTo: previewArea
            })
        })
    }
    const chooseIcon = (dom) => {
        let icon = dom.getAttribute('key');
        let parent = dom.parentNode.parentNode;
        let target = parent.childNodes;
        
        let iconPreviewAdd = target[5];
        let inputIcon = target[3];
        let iconResult = target[7];

        inputIcon.value = icon;
        iconResult.style.display = "none";
        
        iconPreviewAdd.style.display = "block";
        iconPreviewAdd.innerHTML = `<i class="${icon}"></i> <i class="fas fa-times float-right text-danger"></i>`;
    }
    const removeIcon = (dom) => {
        let target = dom.parentNode.childNodes;
        console.log(target);

        let iconPreviewAdd = target[5];
        let inputIcon = target[3];
        iconPreviewAdd.style.display = "none"
        inputIcon.value = ""
    }
    </script>

@endsection
