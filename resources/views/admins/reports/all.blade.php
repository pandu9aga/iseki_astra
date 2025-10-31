@extends('layouts.main')
@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 py-4 mx-3 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-0 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('report.index') }}">Report</a></li>
                <li class="breadcrumb-item text-sm text-primary active" aria-current="page">All Reports</li>
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
            <h3 class="mb-4 h4 font-weight-bolder">All Reports</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-dark border-radius-lg pt-4 pb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3 mb-0">All Report Data</h6>
                            <a href="{{ route('report.index') }}" class="btn btn-sm btn-light me-3">
                                <span class="material-symbols-rounded">arrow_back</span> Back to Report
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="reportAllTable" class="table align-items-center mb-0">
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
        var table = $('#reportAllTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 50,
            lengthMenu: [[50, 100, 150, 200], [50, 100, 150, 200]],
            ajax: {
                url: "{{ route('report.index.all') }}"
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
    });
</script>
@endsection

