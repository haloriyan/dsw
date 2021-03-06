@extends('layouts.admin')

@section('title', 'Role')

@php
    $roles = ["superadmin","admin","event","publikasi","sponsor","lo"];
    $actions = ["view","create","store","edit","update","delete"];
@endphp

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
    <h1 class="h3 mb-0 text-gray-800">Edit Aturan Role</h1>
    <a href="{{ route('admin.role') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
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
        <form action="{{ route('role.update', $data->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="roleName">Role name :</label>
                <select name="role" class="form-control" id="roleName">
                    @foreach ($roles as $role)
                        @php
                            $isSelected = $data->role == $role ? "selected='selected'" : "";
                        @endphp
                        <option {{ $isSelected }}>{{ $role }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="module">Modul :</label>
                <select name="module" id="module" class="form-control">
                    @foreach ($modules as $module)
                        @php
                            $isSelected = $data->module == $module ? "selected='selected'" : "";
                        @endphp
                        <option {{ $isSelected }}>{{ $module }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="actions">Actions :</label>
                <input type="hidden" name="actions" id="actions" value="{{ $data->actions }}">
                <br />
                @foreach ($actions as $action)
                    @php
                        $actionOnData = explode(",", $data->actions);
                        $isActive = in_array($action, $actionOnData) ? "active" : "";
                    @endphp
                    <div class="actions {{ $isActive }}" onclick="toggleActions(this)">{{ $action }}</div>
                @endforeach
            </div>

            <div class="text-right">
                <button class="btn btn-primary mt-2">Submit</button>
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

    <script src="{{ asset('js/base.js') }}"></script>
    <script>
        let selectedActions = select("#actions").value.split(",");
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
