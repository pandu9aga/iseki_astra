@extends('layouts.main')
@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 py-4 mx-3 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-0 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-primary active" aria-current="page">User</li>
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
            <h3 class="mb-4 h4 font-weight-bolder">User</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">User Table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="example" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Type</th>
                                    <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Username</th>
                                    <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Area</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $user as $u )
                                <tr>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold text-secondary">{{ $loop->iteration }}</p>
                                    </td>
                                    <td>
                                        @php
                                            $type = $type_user->firstWhere('Id_Type_User', $u->Id_Type_User);
                                        @endphp
                                        <p class="text-xs text-secondary mb-0">{{ $type ? $type->Name_Type_User : 'Unknown' }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs text-primary mb-0">{{ $u->Username_User }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs text-secondary mb-0">{{ $u->Name_User }}</p>
                                    </td>
                                    <td>
                                        @php
                                            $areas = $area->firstWhere('Id_Area', $u->Id_Area);
                                        @endphp
                                        <p class="text-xs text-secondary mb-0">{{ $areas ? $areas->Name_Area : 'Unknown' }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('user.edit', $u->Id_User) }}"
                                                class="badge badge-sm bg-gradient-primary text-white text-xs">
                                                <i class="material-symbols-rounded">app_registration</i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <a class="btn btn-primary mx-3" href="{{ route('user.add') }}">
                        <span style="padding-left: 50px; padding-right: 50px;"><b>+</b> Add</span>
                    </a>
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
