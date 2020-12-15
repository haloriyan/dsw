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


@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Contact</h1>
                        <a href="{{ route('admin.contact') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Contact</h6>
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

                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf

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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="icon">Nama akun :</label>
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="icon">Value :</label>
                                                <input type="text" class="form-control" placeholder="URL, Nomor Telepon, atau Email" name="value">
                                            </div>
                                        </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

@endsection

@section('pagejs')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
</script>
@endsection
