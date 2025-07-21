@extends('layouts.user')
@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 py-4 mx-3 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-0 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-primary active" aria-current="page">Track</li>
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
            <h3 class="mb-4 h4 font-weight-bolder">Track</h3>
        </div>
    </div>
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('{{asset('assets/img/bg-detail.jpeg')}}');">
        <div class="position-relative z-index-1 p-4">
            <p class="text-white">Assembling Tracking</p> 
            <h2 class="text-primary">{{ $user->Name_User }}</h2>
        </div>
        <span class="mask bg-gradient-dark opacity-6 position-absolute top-0 start-0 w-100 h-100 z-index-0"></span>
    </div>
    <div class="card card-body mx-2 mx-md-2 mt-n6" id="parent_qrcode">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="ps-3 mb-4">
                    <h5 class="text-primary mb-1">Tracking Form</h5>
                    <p class="text-sm">Assembling process tracking</p>
                </div>
                <div class="row">
                    <form action="{{ route('track.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <span style="font-size: small;">QR Code Type</span>
                                <div class="container-fluid d-flex justify-content-start p-0">
                                    <div id="reader_type" class="mx-auto"></div>
                                    {{-- <div id="qrcode_type"></div> --}}
                                </div>
                                <br>
                                <button type="button" id="scanType" class="btn btn-primary btn-sm px-4">
                                    Scan
                                </button>
                            </div>
                            <div class="col-lg-8">
                                <p class="text-sm">Tractor Type:</p>
                                <input type="hidden" name="Id_Type" id="Id_Type" value="" readonly>
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label for="no" class="form-label">No</label>
                                    <input type="text" class="form-control @error('no') is-invalid @enderror" name="no" id="no" value="" readonly>
                                    @error('no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label for="type" class="form-label">Type Tractor</label>
                                    <input type="text" class="form-control @error('type') is-invalid @enderror" name="type" id="type" value="" readonly>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label for="Id_Type" class="form-label">Production</label>
                                    <input type="production" class="form-control @error('production') is-invalid @enderror" name="production" id="production" value="" readonly>
                                    @error('production')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <span style="font-size: small;">Area</span>
                                <div class="container-fluid d-flex justify-content-start p-0">
                                    {{-- <div id="reader_area" class="mx-auto" ></div> --}}
                                    {{-- <div id="qrcode_area"></div> --}}
                                    {{-- Kode area sudah otomatis terisi (tidak perlu scan QR lagi) --}}
                                </div>
                                {{-- <br> --}}
                                {{-- <button type="button" id="scanArea" class="btn btn-primary btn-sm px-4">
                                    Scan
                                </button> --}}
                            </div>
                            <div class="col-lg-8">
                                <p class="text-sm">Selected Area:</p>
                                <div class="input-group input-group-outline my-3 is-filled">
                                    <label for="Name_Area" class="form-label">Area</label>
                                    <input type="text" class="form-control @error('Name_Area') is-invalid @enderror" name="Name_Area" id="Name_Area" value="{{ $user->area->Name_Area }}" readonly>
                                    @error('Name_Area')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="Id_User" value="{{ $user->Id_User }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb-2 ps-3">
                            <h6 class="text-primary mb-1">Upload Photos:</h6>
                        </div>
                        <div class="row">
                            @foreach($parts as $part)
                            <div class="col-md-3 mb-2 text-center">
                                <div class="card card-blog card-plain shadow-xl border border-radius-xl p-1 border-primary">
                                    <label class="form-label text-primary d-block">{{ $part->photo_angle->Name_Photo_Angle }} <span class="material-symbols-rounded">{{ $part->photo_angle->Icon_Photo_Angle }}</span></label>
                                    <div class="input-group input-group-outline my-3 is-filled @error($part) is-invalid @enderror">
                                        <label class="form-label">{{ $part->photo_angle->Name_Photo_Angle }}</label>
                                        <input type="file" class="form-control image-input" name="{{ $part->photo_angle->Id_Photo_Angle }}" data-preview="#preview-{{ $part->photo_angle->Id_Photo_Angle }}" accept="image/*" capture="environment">
                                    </div>
                                    <div class="invalid-feedback">You must upload this photo.</div>
                                    @error($part)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <img id="preview-{{ $part->photo_angle->Id_Photo_Angle }}" class="img-fluid my-2 gallery-img" style="max-height: 150px; cursor: pointer;"
                                    data-bs-toggle="modal" data-bs-target="#imageGalleryModal" data-title="{{ $part->photo_angle->Name_Photo_Angle }}" data-title2="{{ $part->photo_angle->Icon_Photo_Angle }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row justify-content-center mt-4 mb-3">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                                {{-- <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Submit</button> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="imageGalleryModal" tabindex="-1" aria-labelledby="imageGalleryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent text-white border-0">
                <!-- Navbar atas -->
                <div class="position-relative p-2 border-bottom bg-transparent">
                    <h5 class="text-primary text-center m-0" style="line-height: 1.5;">
                        <span id="modalTitle"></span>
                        <span class="material-symbols-rounded" id="captionLabelArrow"></span>
                    </h5>
                    <button type="button"
                            class="btn btn-icon modal-btn position-absolute end-0 top-50 translate-middle-y me-2"
                            data-bs-dismiss="modal" aria-label="Close">
                        <span class="material-symbols-rounded">close</span>
                    </button>
                </div>
                <!-- Isi Carousel -->
                <div class="modal-body p-0 mt-1 text-center">
                    <div id="carouselGallery" class="carousel slide">
                        <img id="modalImage" class="img-fluid" style="max-height: 70vh;" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- QR Code Library -->
<script src="{{ asset('assets/js/html5-qrcode.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
{{-- <script src="{{ asset('assets/js/qrcode.min.js') }}"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script> --}}

<!-- QR Code Generation Script -->
<script>
    var element = document.getElementById('parent_qrcode');
    var width = element.offsetWidth;
    // var width = 100;

    let typeScanner = new Html5QrcodeScanner(
        "reader_type", {
            fps: 10,
            qrbox: {
                width: width,
                height: width,
            },
            focusMode:"continuous",
        }
    );

    // let areaScanner = new Html5QrcodeScanner(
    //     "reader_area", {
    //         fps: 10,
    //         qrbox: {
    //             width: width,
    //             height: width,
    //         },
    //     }
    // );

    // var qrcode_type = new QRCode("qrcode_type", {
    //     width: width,
    //     height: width
    // });

    // var qrcode_area = new QRCode("qrcode_area", {
    //     width: width,
    //     height: width
    // });

    function onScanSuccessType(decodedText, decodedResult) {    
        // Hilangkan semua tanda baca dan spasi
        // decodedText = decodedText.replace(/[^\w]/g, '');
        // Ambil 10 karakter pertama
        // decodedText = decodedText.substring(0, 12);

        // Split decodedText melalui tanda semicolon [;]
        let splitText = decodedText.split(";");

        if (splitText.length >= 4) {
            document.getElementById("Id_Type").value = decodedText;
            document.getElementById("no").value = splitText[0];
            document.getElementById("type").value = splitText[2];
            document.getElementById("production").value = splitText[3];
            typeScanner.clear();
            // makeCodeType ();
        } else {
            alert("QR Code tidak valid atau format tidak sesuai. Coba scan QR yang lainnya.");
        }
    }

    document.getElementById("scanType").addEventListener("click", function () {
        // let imgElement = document.querySelector("#qrcode_type img");
        // if (imgElement) {
        //     imgElement.src = "";
        // }
        typeScanner.render(onScanSuccessType);
    });

    // function makeCodeType () {    
    //     var typeText = document.getElementById("Id_Type");
    //     qrcode_type.makeCode(typeText.value);
    // }

    // $("#Id_Type").
    // on("blur", function () {
    //     makeCodeType();
    // });

    // function onScanSuccessArea(decodedText, decodedResult) {        
    //     document.getElementById("Name_Area").value = decodedText;
    //     areaScanner.clear();
    //     // makeCodeArea ();
    // }

    // document.getElementById("scanArea").addEventListener("click", function () {
    //     // let imgElement = document.querySelector("#qrcode_area img");
    //     // if (imgElement) {
    //     //     imgElement.src = "";
    //     // }
    //     areaScanner.render(onScanSuccessArea);
    // });

    // function makeCodeArea () {    
    //     var areaText = document.getElementById("Name_Area");
    //     qrcode_area.makeCode(areaText.value);
    // }

    // $("#Name_Area").
    // on("blur", function () {
    //     makeCodeArea();
    // });
</script>

<script>
document.querySelectorAll('.image-input').forEach(input => {
    input.addEventListener('click', function() {
        const previewId = this.dataset.preview;
        document.querySelector(previewId).src = ''; // Hapus gambar preview
    });
    
    input.addEventListener('change', async function(e) {
        const file = this.files[0];
        if (!file) return;

        const previewId = this.dataset.preview;
        const reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector(previewId).src = e.target.result;
        };
        reader.readAsDataURL(file);

        // 🔽 Kompres gambar sebelum submit
        let compressedFile;
        let quality = 0.9;

        do {
            compressedFile = await compressImage(file, quality);
            quality -= 0.1;
        } while (compressedFile.size > 500 * 1024 && quality > 0.1);

        // Ganti file input dengan file hasil kompresi
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(compressedFile);
        this.files = dataTransfer.files;
    });
});

// 🎯 Fungsi kompresi pakai canvas
function compressImage(file, quality = 0.7, maxWidth = 1024) {
    return new Promise(resolve => {
        const img = new Image();
        const canvas = document.createElement('canvas');
        const reader = new FileReader();

        reader.onload = e => {
            img.src = e.target.result;
        };

        img.onload = () => {
            let width = img.width;
            let height = img.height;

            if (width > maxWidth) {
                height = height * (maxWidth / width);
                width = maxWidth;
            }

            canvas.width = width;
            canvas.height = height;

            const ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, width, height);

            canvas.toBlob(blob => {
                const compressedFile = new File([blob], file.name, {
                    type: 'image/jpeg',
                    lastModified: Date.now()
                });
                resolve(compressedFile);
            }, 'image/jpeg', quality);
        };

        reader.readAsDataURL(file);
    });
}

// 🔍 Modal preview tetap
document.querySelectorAll('.gallery-img').forEach(img => {
    img.addEventListener('click', function () {
        const src = this.src;
        const title = this.dataset.title;
        const title2 = this.dataset.title2;
        document.getElementById('modalImage').src = src;
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('captionLabelArrow').innerText = title2;
    });
});
</script>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    let isValid = true;

    // Validasi input teks: no, type, production, Id_Type
    const requiredTextInputs = [
        document.getElementById('no'),
        document.getElementById('type'),
        document.getElementById('production'),
        document.getElementById('Id_Type')
    ];

    requiredTextInputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
    });

    // Validasi semua file input harus diisi
    const imageInputs = document.querySelectorAll('.image-input');
    imageInputs.forEach(input => {
        if (!input.files.length) {
            isValid = false;
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
    });

    if (!isValid) {
        e.preventDefault(); // batalkan submit
        alert('Fill all the form first!');
    }
});
</script>
@endsection
