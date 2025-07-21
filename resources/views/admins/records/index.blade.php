@extends('layouts.main')
@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 py-4 mx-3 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-0 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-primary active" aria-current="page">Record</li>
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
            <h3 class="mb-4 h4 font-weight-bolder">Record</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Record Table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="example" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Number</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Production Date</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Type</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Production Number</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pdfFiles as $index => $file)
                                    @php
                                        $filename = pathinfo(basename($file), PATHINFO_FILENAME); // Hilangkan .pdf
                                        $parts = explode(';', str_replace('Track_Report_', '', $filename));
                                        $number = $parts[0] ?? '-';
                                        $prodDate = $parts[1] ?? '-';
                                        $type = $parts[2] ?? '-';
                                        $prodNum = $parts[3] ?? '-';
                                    @endphp
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold text-secondary">{{ $loop->iteration }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold text-primary">{{ $number }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold text-primary">{{ $prodDate }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold text-primary">{{ $type }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold text-primary">{{ $prodNum }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('record.download', ['filename' => basename($file)]) }}" class="text-primary text-xs">
                                                <i class="material-symbols-rounded">download</i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">There is no files found.</td>
                                    </tr>
                                @endforelse
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
    new DataTable('#example');

</script>
@endsection
