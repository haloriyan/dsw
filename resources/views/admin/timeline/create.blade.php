@extends('layouts.admin')
<style>
    .iconDate {
        margin: -28px 0 0 95%;
    }

    .iconDate2 {
        margin: -28px 0 0 97.5%;
    }
</style>

@section('title', 'Timeline')

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
        <form action="{{ route('timeline.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="event">Event :</label>
                <select name="event_id" id="event" class="form-control" required>
                    <option value="">Pilih event...</option>
                    @foreach ($events as $event)
                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group d-none">
                <label for="type">Type :</label>
                <select name="type" id="type" class="form-control">
                    <option value="straight">Straight</option>
                    <option value="waves">Waves</option>
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="openDate">Tanggal Pendaftaran :</label>
                        <input type="text" name="open_date" id="openDate" class="form-control date">
                        <i class="fas fa-fw fa-calendar iconDate"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="closeDate">Tanggal Penutupan :</label>
                        <input type="text" name="close_date" id="closeDate" class="form-control date">
                        <i class="fas fa-fw fa-calendar iconDate"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="openDate2">Tanggal Pendaftaran Gelombang 2 (opsional) :</label>
                        <input type="text" name="open_date_2" id="openDate2" class="form-control date">
                        <i class="fas fa-fw fa-calendar iconDate"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="closeDate2">Tanggal Penutupan Gelombang 2 (opsional) :</label>
                        <input type="text" name="close_date_2" id="closeDate2" class="form-control date">
                        <i class="fas fa-fw fa-calendar iconDate"></i>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="judgementDate">Tanggal Penjurian :</label>
                <input type="text" name="judgement_date" id="judgementDate" class="form-control date">
                <i class="fas fa-fw fa-calendar iconDate2"></i>
            </div>
            <div class="form-group">
                <label for="mainDate">Tanggal Acara/Main :</label>
                <input type="text" name="main_date" id="mainDate" class="form-control date">
                <i class="fas fa-fw fa-calendar iconDate2"></i>
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
<script>
    $(document).ready(function () {
        const months = ["01","02","03","04","05","06","07","08","09","10","11","12"];
        // $(document).on('click', '.date', function(){
        //         $(this).datepicker({
        //             changeMonth: true,
        //             changeYear: true,
        //             dateFormat: 'yyyy-mm-dd',
        //             todayHighlight: true
        //         }).focus();
        //     });
        $("#openDate").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });
        $("#openDate2").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });
        $("#closeDate").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });
        $("#closeDate2").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });
        $("#judgementDate").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });
        const formatDate = (date) => {
            return `${date.getFullYear()}-${months[date.getMonth()]}-${date.getDate()}`;
        }
        $("#openDate").on('changeDate', selected => {
            // console.log(selected.date.valueOf());
            let date = new Date(selected.date);
            let startDate = formatDate(date);
            $("#closeDate").datepicker({
                minDate: date,
                dateFormat: 'yyyy-mm-dd'
            });
        });
        $("#openDate2").on('changeDate', selected => {
            let startDate = new Date(selected.date.valueOf());
            $("#closeDate2").datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                minDate: '2021-01-10'
            });
        });

        /*
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
        */

        $("#closeDate").on('changeDate', function(selected) {
            var startDate = new Date(selected.date.valueOf());
            // $("#judgementDate").datepicker({
            //         changeMonth: true,
            //         changeYear: true,
            //         format: 'yyyy-mm-dd',
            //         todayHighlight: true,
            //         setStartDate: startDate
            // });
            // $("#judgementDate").datepicker('setStartDate', startDate);
            //     if($("#closeDate").val() > $("#judgementDate").val()){
            //         $("#judgementDate").val($("#closeDate").val());
            //     }
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
</script>

@endsection
