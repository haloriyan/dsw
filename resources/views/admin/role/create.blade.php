@extends('layouts.admin')

@section('title', 'Role')

@section('head')
<style>
    .actions {
        display: inline-block;
        background-color: #ddd;
        padding: 10px 25px;
        border-radius: 900px;
        margin-top: 12px;
        margin-right: 5px;
        cursor: pointer;
    }
    .actions.active {
        background-color: #2ecc71;
        color: #fff;
    }
</style>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Aturan Role</h1>
    <a href="{{ route('role.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus-square fa-sm text-white-50"></i> Tambah</a>
</div>

<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Role</h6>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <form action="{{ route('role.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="roleName">Role name :</label>
                <select name="role" class="form-control" id="roleName">
                    <option>superadmin</option>
                    <option>admin</option>
                    <option>event</option>
                    <option>publikasi</option>
                    <option>sponsor</option>
                    <option>lo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="module">Modul :</label>
                <select name="module" id="module" class="form-control">
                    @foreach ($modules as $module)
                        <option>{{ $module }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="actions">Actions :</label>
                <input type="hidden" name="actions" id="actions">
                <br />
                <div class="actions" onclick="toggleActions(this)">view</div>
                <div class="actions" onclick="toggleActions(this)">create</div>
                <div class="actions" onclick="toggleActions(this)">store</div>
                <div class="actions" onclick="toggleActions(this)">edit</div>
                <div class="actions" onclick="toggleActions(this)">update</div>
                <div class="actions" onclick="toggleActions(this)">delete</div>
            </div>

            <button class="btn btn-primary mt-3">Submit</button>
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

    <script src="{{ asset('js/base.js') }}"></script>
    <script>
        let selectedActions = [];
        const toggleActions = btn => {
            let action = btn.innerText;
            if (inArray(action, selectedActions)) {
                btn.classList.remove('active')
                removeArray(action, selectedActions);
            }else {
                btn.classList.add('active')
                selectedActions.push(action);
            }
            select("#actions").value = selectedActions.join(",");
        }
    </script>

@endsection
