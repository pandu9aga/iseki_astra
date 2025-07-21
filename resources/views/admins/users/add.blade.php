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
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('{{asset('assets/img/bg-profile.jpg')}}');">
        <div class="position-relative z-index-1 p-4">
            <h2 class="text-primary">User</h2>
        </div>
        <span class="mask bg-gradient-dark opacity-6 position-absolute top-0 start-0 w-100 h-100 z-index-0"></span>
    </div>
    <div class="card card-body mx-2 mx-md-2 mt-n6">
        <div class="row gx-4 mb-2">
            <div class="col-auto">
                <h4 class="text-secondary mx-2">Add User</h4>
            </div>
            <div class="col-auto my-auto">
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    Back to:
                    <a href="{{ route('user') }}">
                        <h4 class="text-primary">List User <span class="material-symbols-rounded">arrow_forward</span></h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0 text-body">User :</h6>
                    </div>
                    <div class="card-body p-3">
                        @if ($errors->any())
                            <div>
                                @foreach ($errors->all() as $error)
                                    <p style="color:red;">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        <form role="form" class="text-start" action="{{ route('user.create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="Name_User" value="">
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="Username_User" value="">
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="Password_User" value="">
                            </div>
                            <div class="input-group input-group-outline my-3 is-filled">
                                <label class="form-label">Type</label>
                                <select class="form-control" name="Id_Type_User">
                                    @foreach ($type_user as $type)
                                        <option value="{{ $type->Id_Type_User }}">
                                            {{ $type->Name_Type_User }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-outline my-3 is-filled">
                                <label class="form-label">Area</label>
                                <select class="form-control" name="Id_Area">
                                    @foreach ($area as $areas)
                                        <option value="{{ $areas->Id_Area }}">
                                            {{ $areas->Name_Area }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection