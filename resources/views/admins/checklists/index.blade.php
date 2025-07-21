@extends('layouts.main')
@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 py-4 mx-3 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-0 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-primary active" aria-current="page">Checklist</li>
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
            <h3 class="mb-4 h4 font-weight-bolder">Checklist</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Checklist Table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-8">
                                    <form role="form" class="mx-3 my-3" action="{{ route('checklist.submit') }}" method="GET">
                                        @csrf
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-4">
                                                    <div class="input-group input-group-outline">
                                                        <input type="date" name="Time_Track" class="form-control" value="{{ $date }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-4">
                                                    <button class="btn btn-primary btn-sm" type="submit">
                                                        <span class="material-symbols-rounded">filter_alt</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-4 d-flex align-items-center justify-content-end gap-2">
                                    <a href="{{ route('checklist.store', ['Time_Track' => $date]) }}" onclick="setTimeout(() => location.reload(), 2000)"
                                        target="_blank" class="btn btn-info btn-sm">
                                        Store All <span class="material-symbols-rounded">download</span>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteAll">
                                        Delete All<span class="material-symbols-rounded">delete</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <table id="example" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Pic</th>
                                    <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Number</th>
                                    <th class="text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Area</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">User</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Record</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-primary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupedTracks as $idType => $group)
                                    @php
                                        $types = explode(';', $idType);
                                        $no = $types[0] ?? '';
                                        $nameType = $types[2] ?? '';
                                        $production = $types[3] ?? '';

                                        $IsMower = str_contains(strtolower($nameType), 'sxg');
                                        $allDone = $group->every(fn($track) => $track->Status_Track == 1);
                                    @endphp
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold text-secondary">{{ $loop->iteration }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('checklist.detail', ['Id_Type' => $idType]) }}">
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
                                            <a href="{{ route('checklist.detail', ['Id_Type' => $idType]) }}">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="text-xs text-secondary mb-0">{{ $no }}</p>
                                                    <h6 class="mb-0 text-sm text-primary">{{ $nameType }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $production }}</p>
                                                </div>
                                            </a>
                                        </td>
                                        <td>
                                            @foreach($areas as $area)
                                                @if ($area->Name_Area == 'Mower Collector')
                                                    @if ($IsMower)
                                                        <p class="text-xs text-primary mb-0">{{ $area->Name_Area }}</p>
                                                    @endif
                                                @else
                                                    <p class="text-xs text-primary mb-0">{{ $area->Name_Area }}</p>
                                                @endif
                                            @endforeach
										</td>
                                        @php
                                            $trackByArea = $group->keyBy('Id_Area');
                                        @endphp
                                        <td class="align-middle text-center text-sm">
                                            @foreach($areas as $area)
                                                @if(!$IsMower && $area->Name_Area == 'Mower Collector')
                                                    @continue
                                                @endif
                                                @php
                                                    $track = $trackByArea->get($area->Id_Area);
                                                @endphp
                                                <p class="text-xs text-secondary mb-0">
                                                    {{ $track ? $track->user->Name_User : '-' }}
                                                </p>
                                            @endforeach
                                        </td>
                                        <td class="align-middle text-left">
                                            @foreach($areas as $area)
                                                @if(!$IsMower && $area->Name_Area == 'Mower Collector')
                                                    @continue
                                                @endif
                                                @php
                                                    $track = $trackByArea->get($area->Id_Area);
                                                @endphp
                                                <p class="text-xs text-secondary mb-0">
                                                    @if($track)
                                                        @php $time = \Carbon\Carbon::parse($track->Time_Track); @endphp
                                                        <span class="text-primary">{{ $time->format('Y-m-d') }}</span> {{ $time->format('H:i:s') }}
                                                    @else
                                                        -
                                                    @endif
                                                </p>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($allDone)
                                                <div class="text-xs text-white text-center mb-0 p-1 border-radius-lg bg-gradient-success">
                                                    fully stored
                                                </div>
                                            @else
                                                <div class="text-xs text-white text-center mb-0 p-1 border-radius-lg bg-gradient-secondary">
                                                    not stored
                                                </div>
                                            @endif
                                        </td>
                                        @php
                                            $hideDownload = false;
                                            if ($IsMower) {
                                                $mowerArea = $areas->firstWhere('Name_Area', 'Mower Collector');
                                                if ($mowerArea) {
                                                    $mowerTrack = $trackByArea->get($mowerArea->Id_Area);
                                                    if (!$mowerTrack) {
                                                        $hideDownload = true;
                                                    }
                                                }
                                            }
                                        @endphp
                                        <td class="align-middle text-center">
                                            <a href="{{ route('checklist.detail', ['Id_Type' => $idType]) }}" class="text-primary text-xs">
                                                <i class="material-symbols-rounded">app_registration</i>
                                            </a>
                                            @if(!$hideDownload)
                                                <a href="{{ route('checklist.export', ['Id_Type' => $idType]) }}"
                                                    onclick="setTimeout(() => location.reload(), 2000)"
                                                    target="_blank"
                                                    class="text-primary text-xs">
                                                    <i class="material-symbols-rounded">download</i>
                                                </a>
                                            @endif
                                            @if($allDone)
                                                <a type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $idType }}" class="text-primary text-xs">
                                                    <i class="material-symbols-rounded">delete</i>
                                                </a>
                                            @endif
                                        </td>
                                        @if(!$hideDownload)
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal{{ $idType }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $idType }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route('checklist.delete', ['Id_Type' => $idType]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="modal-title text-white" id="deleteModalLabel{{ $idType }}">Delete Confirmation</h5>
                                                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure to delete:
                                                        <p class="mb-0">
                                                        <strong>ID Type: {{ $idType }}</strong>
                                                        </p>
                                                        This action cannot be undone.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </div>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                        @endif
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
<!-- Modal konfirmasi hapus -->
<div class="modal fade" id="modalDeleteAll" tabindex="-1" aria-labelledby="modalDeleteAllLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('checklist.deleteAll') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="modalDeleteAllLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure to delete all of the data on this date?</p>
                    <p class="mb-0"><strong>{{ $date }}</strong></p>
                    <input type="hidden" name="Time_Track" class="form-control" value="{{ $date }}">
                    This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </form>
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
