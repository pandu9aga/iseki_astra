@extends('layouts.main')
@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 py-4 mx-3 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-0 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-primary active" aria-current="page">Angle</li>
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
            <h3 class="mb-4 h4 font-weight-bolder">Angle</h3>
        </div>
    </div>
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('{{asset('assets/img/bg-area.jpg')}}');">
        <div class="position-relative z-index-1 p-4">
            <h2 class="text-primary">{{ $Id_Photo_Angle->Name_Photo_Angle }}</h2>
        </div>
        <span class="mask bg-gradient-dark opacity-6 position-absolute top-0 start-0 w-100 h-100 z-index-0"></span>
    </div>
    <div class="card card-body mx-2 mx-md-2 mt-n6">
        <div class="row gx-4 mb-2">
            <div class="col-auto">
                <h4 class="text-secondary mx-2">Edit Angle</h4>
            </div>
            <div class="col-auto my-auto">
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    Back to:
                    <a href="{{ route('angle') }}">
                        <h4 class="text-primary">List Angle <span class="material-symbols-rounded">arrow_forward</span></h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0 text-body">Angle :</h6>
                    </div>
                    <div class="card-body p-3">
                        @if ($errors->any())
                            <div>
                                @foreach ($errors->all() as $error)
                                    <p style="color:red;">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        <form role="form" class="text-start" action="{{ route('angle.update', ['Id_Photo_Angle' => $Id_Photo_Angle->Id_Photo_Angle]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="input-group input-group-outline my-3 {{ $Id_Photo_Angle->Name_Photo_Angle ? 'is-filled' : '' }}">
                                <label class="form-label">Angle Name</label>
                                <input type="text" class="form-control @error('Name_Photo_Angle') is-invalid @enderror" name="Name_Photo_Angle" id="Name_Photo_Angle" value="{{ $Id_Photo_Angle->Name_Photo_Angle }}">
                            </div>
                            @error('Name_Photo_Angle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="input-group input-group-outline my-3 {{ $Id_Photo_Angle->Icon_Photo_Angle ? 'is-filled' : '' }}">
                                <label class="form-label">Angle Icon</label>
                                <input type="text" class="form-control @error('Icon_Photo_Angle') is-invalid @enderror" name="Icon_Photo_Angle" id="Icon_Photo_Angle" value="{{ $Id_Photo_Angle->Icon_Photo_Angle }}">
                            </div>
                            @error('Icon_Photo_Angle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
            </div>
            <div class="col-12 col-lg-4">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <button type="submit" class="btn bg-gradient-danger w-50 my-2" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$Id_Photo_Angle->Id_Photo_Angle}}">
                            Delete <span class="material-symbols-rounded">delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal-{{$Id_Photo_Angle->Id_Photo_Angle}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title fs-5 text-white" id="exampleModalLabel">Delete Angle</h4>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin akan menghapus data:</p>
                <b class="text-primary">{{$Id_Photo_Angle->Name_Photo_Angle}}</b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModal('exampleModal-{{$Id_Photo_Angle->Id_Photo_Angle}}')">Close</button>
                <form action="{{ route('angle.destroy', $Id_Photo_Angle->Id_Photo_Angle) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection