@extends('layouts.main')
@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 py-4 mx-3 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-0 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-primary active" aria-current="page">Report</li>
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            </div>
            <ul class="navbar-nav d-flex align-items-center  justify-content-end">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<div class="container-fluid py-2">
    <div class="row">
        <div class="ms-3">
            <h3 class="mb-4 h4 font-weight-bolder">Report</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Report Table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="mx-3 my-3">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    <div class="d-flex align-items-center gap-2 flex-grow-1" style="max-width: 300px;">
                                        <button type="button" class="btn btn-outline-primary btn-sm mb-0 px-2" id="prevDateBtn">
                                            <span class="material-symbols-rounded">chevron_left</span>
                                        </button>
                                        <div class="input-group input-group-outline mb-0 flex-grow-1">
                                            <input type="date" name="Time_Track" id="Time_Track" class="form-control text-center px-2" value="{{ $date }}">
                                        </div>
                                        <button type="button" class="btn btn-outline-primary btn-sm mb-0 px-2" id="nextDateBtn">
                                            <span class="material-symbols-rounded">chevron_right</span>
                                        </button>
                                    </div>
                                    <button id="filterBtn" class="btn btn-primary btn-sm mb-0 px-3">
                                        <span class="material-symbols-rounded">filter_alt</span>
                                    </button>
                                </div>
                                <div class="text-end">
                                    <a href="{{ route('report.index.all') }}" class="btn btn-info btn-sm mb-0">
                                        <span class="material-symbols-rounded">list_alt</span> View All Reports
                                    </a>
                                </div>
                            </div>
                        </div>
                        <table id="reportTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Pic</th>
                                    <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Number</th>
                                    <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Area</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">User</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Record</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('style')
<link href="{{asset('assets/datatables/datatables.min.css')}}" rel="stylesheet">
@endsection

@section('script')
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/datatables/datatables.min.js')}}"></script>
<script>
    $(document).ready(function() {
        var table = $('#reportTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 50,
            lengthMenu: [[50, 100, 150, 200], [50, 100, 150, 200]],
            ajax: {
                url: "{{ route('report.index') }}",
                data: function(d) {
                    d.Time_Track = $('#Time_Track').val();
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'align-middle text-center'
                },
                {
                    data: 'pic',
                    name: 'pic',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'number',
                    name: 'number_search',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'area',
                    name: 'area_search',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'user',
                    name: 'user_search',
                    orderable: false,
                    searchable: true,
                    className: 'align-middle text-center'
                },
                {
                    data: 'record',
                    name: 'record',
                    orderable: false,
                    searchable: false,
                    className: 'align-middle text-left'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'align-middle text-center'
                }
            ],
            language: {
                processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
            }
        });

        // Filter button click event
        $('#filterBtn').on('click', function() {
            table.ajax.reload();
        });

        $('#prevDateBtn').on('click', function() {
            let dateInput = document.getElementById('Time_Track');
            if(dateInput.value) {
                let currentDate = new Date(dateInput.value);
                currentDate.setDate(currentDate.getDate() - 1);
                let year = currentDate.getFullYear();
                let month = String(currentDate.getMonth() + 1).padStart(2, '0');
                let day = String(currentDate.getDate()).padStart(2, '0');
                dateInput.value = `${year}-${month}-${day}`;
                table.ajax.reload();
            }
        });

        $('#nextDateBtn').on('click', function() {
            let dateInput = document.getElementById('Time_Track');
            if(dateInput.value) {
                let currentDate = new Date(dateInput.value);
                currentDate.setDate(currentDate.getDate() + 1);
                let year = currentDate.getFullYear();
                let month = String(currentDate.getMonth() + 1).padStart(2, '0');
                let day = String(currentDate.getDate()).padStart(2, '0');
                dateInput.value = `${year}-${month}-${day}`;
                table.ajax.reload();
            }
        });

        // Enter key on date input
        $('#Time_Track').on('keypress', function(e) {
            if (e.which === 13) {
                table.ajax.reload();
            }
        });
    });
</script>
@endsection
