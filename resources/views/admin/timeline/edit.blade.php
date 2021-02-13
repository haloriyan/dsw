@extends('layouts.admin')
<style>
    .iconDate { margin: -28px 0 0 95%; }
    .iconDate2 { margin: -28px 0 0 97.5%; }
</style>

@section('title', 'Timeline')

@php
    $types = ["Straight","Waves"];
@endphp

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Timeline</h1>
    <a href="{{ route('admin.timeline') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Timeline</h6>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <form action="{{ route('timeline.update', $timeline->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="event">Event :</label>
                <select name="event_id" id="event" class="form-control" required>
                    <option value="">Pilih event...</option>
                    @foreach ($events as $event)
                    @php
                    $isSelected = $event->id == $timeline->event_id ? "selected='selected'" : "";
                    @endphp
                    <option {{ $isSelected }} value="{{ $event->id }}">{{ $event->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group d-none">
                <label for="type">Type :</label>
                <select name="type" id="type" class="form-control">
                    @foreach ($types as $type)
                    @php
                    $isSelected = $timeline->type == strtolower($type) ? "selected='selected'" : "";
                    @endphp
                    <option {{ $isSelected }} value="{{ strtolower($type) }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div id="dateArea">
                @foreach ($timeline->fields as $field)
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>Item name :</label>
                            <input type="text" class="form-control" name="name[]" value="{{ $field->name }}" required placeholder="ex: Registration, Main Event, etc">
                        </div>
                        <div class="col-md-3">
                            <label>Date Start :</label>
                            <input type="text" class="date form-control" name="date_start[]" required value="{{ $field->date_start }}">
                        </div>
                        <div class="col-md-3">
                            <label>Date End :</label>
                            <input type="text" class="date form-control" name="date_end[]" required value="{{ $field->date_end }}">
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="btn btn-primary mt-3" type="button" onclick="moreDate()">
                <i class="fas fa-plus mr-1"></i> date
            </button>

            <div class="text-right">
                <button class="btn btn-success mt-4">Update</button>
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
    $(document).ready(function () {
        $(document).on('click', '.date', function(){
                $(this).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    format: 'yyyy-mm-dd',
                    todayHighlight: true
                }).focus();
            });

        $("#openDate").on('changeDate', function(selected) {
            var startDate = new Date(selected.date.valueOf());
            $("#closeDate").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    format: 'yyyy-mm-dd',
                    todayHighlight: true,
                    setStartDate: startDate
            });
            $("#closeDate").datepicker('setStartDate', startDate);
                if($("#openDate").val() > $("#closeDate").val()){
                    $("#closeDate").val($("#openDate").val());
                }
        });

        $("#closeDate").on('changeDate', function(selected) {
            var startDate = new Date(selected.date.valueOf());
            $("#judgementDate").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    format: 'yyyy-mm-dd',
                    todayHighlight: true,
                    setStartDate: startDate
            });
            $("#judgementDate").datepicker('setStartDate', startDate);
                if($("#closeDate").val() > $("#judgementDate").val()){
                    $("#judgementDate").val($("#closeDate").val());
                }
        });

        $("#judgementDate").on('changeDate', function(selected) {
            var startDate = new Date(selected.date.valueOf());
            $("#mainDate").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    format: 'yyyy-mm-dd',
                    todayHighlight: true,
                    setStartDate: startDate
            });
            $("#mainDate").datepicker('setStartDate', startDate);
                if($("#judgementDate").val() > $("#mainDate").val()){
                    $("#mainDate").val($("#judgementDate").val());
                }

        });
    });

    $(".date").datepicker({
        format: 'yyyy-mm-dd'
    });

    const moreDate = () => {
        createElement({
            el: 'div',
            attributes: [
                ['class', 'row mt-3']
            ],
            createTo: '#dateArea',
            html: `<div class="col-md-6">
    <label>Item name :</label>
    <input type="text" class="form-control" name="name[]" placeholder="ex: Registration, Main Event, etc">
</div>
<div class="col-md-3">
    <label>Date Start :</label>
    <input type="text" class="date form-control" name="date_start[]">
</div>
<div class="col-md-3">
    <label>Date End :</label>
    <input type="text" class="date form-control" name="date_end[]">
</div>`,
        })
    }
</script>

@endsection
