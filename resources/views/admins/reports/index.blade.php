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
                        <form role="form" class="mx-3 my-3" action="{{ route('report.submit') }}" method="GET">
							@csrf
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-6 col-sm-4">
                                        <div class="input-group input-group-outline">
                                            <input type="date" name="Time_Track" class="form-control" value="{{ $date }}">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-primary btn-sm">
                                            <span class="material-symbols-rounded">filter_alt</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table id="example" class="table align-items-center mb-0">
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
                                @foreach ( $groupedTracks as $idType => $group )
                                    @php
                                        $types = explode(';', $idType);
                                        $no = $types[0] ?? '';
                                        $nameType = $types[2] ?? '';
                                        $production = $types[3] ?? '';
                                    @endphp
									<tr>
										<td class="align-middle text-center">
											<p class="text-xs font-weight-bold text-secondary">{{ $loop->iteration }}</p>
										</td>
										<td>
                                            <a href="{{ route('report.detail', ['Id_Type' => $idType]) }}">
                                                <div class="d-flex px-2 py-1">
                                                    @foreach($group as $track)
                                                        @if ($track->track_photo->first())
                                                            <img src="{{ asset('uploads/' . $track->track_photo->first()->Path_Track_Photo) }}" 
                                                            alt="{{ $track->track_photo->first()->Name_Photo_Angle }}" 
                                                            class="avatar avatar-sm me-3 border-radius-lg">
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </a>
										</td>
                                        <td>
                                            <a href="{{ route('report.detail', ['Id_Type' => $idType]) }}">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="text-xs text-secondary mb-0">{{ $no }}</p>
                                                    <h6 class="mb-0 text-sm text-primary">{{ $nameType }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $production }}</p>
                                                </div>
                                            </a>
                                        </td>
                                        <td>
                                            @foreach($group as $track)
                                                <p class="text-xs text-primary mb-0">{{ $track->area->Name_Area }}</p>
                                            @endforeach
										</td>
                                        <td class="align-middle text-center text-sm">
                                            @foreach($group as $track)
                                                <p class="text-xs text-secondary mb-0">{{ $track->user->Name_User }}</p>
                                            @endforeach
										</td>
										<td class="align-middle text-left">
                                            @foreach($group as $track)
                                                <p class="text-xs text-secondary mb-0">
                                                    @php
                                                        $time = \Carbon\Carbon::parse($track->Time_Track);
                                                    @endphp
                                                    <span class="text-primary">{{ $time->format('Y-m-d') }}</span> {{ $time->format('H:i:s') }}
                                                </p>
                                            @endforeach
										</td>
										<td class="align-middle text-center">
											<div class="d-flex justify-content-center">
												<a href="{{ route('report.detail', ['Id_Type' => $idType]) }}"
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
