@extends('layouts.user')
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
  <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{asset('assets/img/bg-detail.jpeg')}}');">
    <div class="position-relative z-index-1 p-4">
        <p class="text-white">Assembling Track Detail:</p>
        @php
            $types = explode(';', $track->Id_Type);
            $No = $types[0];
            $Name_Type = $types[2];
            $Production = $types[3];
        @endphp
        <h2 class="text-primary">{{ $Name_Type }}</h2>
    </div>
    <span class="mask bg-gradient-dark opacity-6 position-absolute top-0 start-0 w-100 h-100 z-index-0"></span>
  </div>
  <div class="card card-body mx-2 mx-md-2 mt-n6">
    <div class="row gx-4 mb-2">
      <div class="col-auto">
        <div class="avatar avatar-xl position-relative text-secondary">
          <i class="material-symbols-rounded" style="font-size: 64px;">account_box</i>
        </div>
      </div>
      <div class="col-auto my-auto">
        <div class="h-100">
          <h5 class="mb-1">
            {{ $track->user->Name_User }}
          </h5>
          <p class="mb-0 font-weight-normal text-sm">
            Area: <span class="text-primary"> {{ $track->area->Name_Area }}</span>
          </p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
        <div class="nav-wrapper position-relative end-0">
          @php
            $time = \Carbon\Carbon::parse($track->Time_Track);
          @endphp
          <h4 class="text-primary">{{ $time->format('Y-m-d') }}</h4>
          <p>{{ $time->format('H:i:s') }}</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
          <div class="nav-wrapper position-relative end-0">
              Back to:
              <a href="{{ route('user_report') }}">
                  <h4 class="text-primary">List Report <span class="material-symbols-rounded">arrow_forward</span></h4>
              </a>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="row">
        <div class="col-12 col-xl-4">
          <div class="card card-plain h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0 text-body">Tractor</h6>
            </div>
            <div class="card-body p-3">
              <p class="text-xs text-secondary mb-0">No: {{ $No }}</p>
              <h4 class="mb-0 text-sm text-primary">Type: {{ $Name_Type }}</h4>
              <p class="text-xs text-secondary mb-0">Production: {{ $Production }}</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-4">
          <div class="card card-plain h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0 text-body">Action</h6>
            </div>
            <div class="card-body p-3">
              <div class="form-check form-switch ps-0">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                    Delete <span class="mx-2"><i class="fas fa-trash text-sm"></i></span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-4">
          <div class="card card-plain h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0 text-body">Report Export</h6>
                  <span class="mx-3"><i class="fas fa-file-export text-secondary text-sm"></i></span>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <a href="{{ route('user_report.export', $track->Id_Track) }}" class="btn btn-primary">
                Download<span class="mx-2"><i class="fas fa-download text-sm"></i></span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-12 mt-4">
          <div class="mb-5 ps-3">
            <h6 class="mb-1">Photos</h6>
            <p class="text-sm">Assembling process tracking</p>
          </div>
          <div class="row">
            @foreach ($track->track_photo as $photo)
              <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                  <div class="card card-blog card-plain">
                      <div class="card-header p-0 m-2">
                          <a class="d-block shadow-xl border-radius-xl">
                              <img src="{{ asset('uploads/' . $photo->Path_Track_Photo) }}"
                                  alt="{{ $photo->Name_Photo_Angle }}"
                                  class="img-fluid shadow border-radius-lg gallery-img"
                                  data-index="0"
                                  data-title1="{{ $Name_Type }}"
                                  data-title2="{{ $photo->Name_Photo_Angle }}"
                                  data-title3="{{ $photo->Icon_Photo_Angle }}">
                          </a>
                      </div>
                      <div class="card-body p-3">
                          <p class="mb-0 text-sm text-secondary">{{ $Name_Type }}</p>
                          <h5 class="text-primary">
                              {{ $photo->Name_Photo_Angle }}
                              <span class="material-symbols-rounded">{{ $photo->Icon_Photo_Angle }}</span>
                          </h5>
                      </div>
                  </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="imageGalleryModal" tabindex="-1" aria-labelledby="imageGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content bg-transparent text-white border-0">
        <!-- Navbar atas -->
        <div class="d-flex justify-content-end align-items-center p-2 border-bottom bg-transparent">
          <button class="btn btn-icon modal-btn me-2" id="zoomIn">
            <span class="material-symbols-rounded">zoom_in</span>
          </button>
          <button class="btn btn-icon modal-btn me-2" id="zoomOut">
            <span class="material-symbols-rounded">zoom_out</span>
          </button>
          <button type="button" class="btn btn-icon modal-btn" data-bs-dismiss="modal" aria-label="Close">
            <span class="material-symbols-rounded">close</span>
          </button>
        </div>
        <!-- Isi Carousel -->
        <div class="modal-body p-0">
          <div id="carouselGallery" class="carousel slide">
            <div class="carousel-inner" id="carousel-inner"></div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselGallery" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselGallery" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
            </button>
          </div>
        </div>

        <!-- Judul bawah -->
        <div class="text-center py-3 bg-transparent border-top">
          <p class="mb-0 text-sm text-white" id="captionLabelTop"></p>
          <h5 class="text-primary">
            <span id="captionLabelBottom"></span>
            <span class="material-symbols-rounded" id="captionLabelArrow"></span>
          </h5>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Konfirmasi Hapus -->
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{ route('user_report.destroy', $track->Id_Track) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="confirmDeleteModalLabel">Delete Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure to delete this tracking record?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  const galleryImages = document.querySelectorAll('.gallery-img');
  const carouselInner = document.getElementById('carousel-inner');
  const captionLabelTop = document.getElementById('captionLabelTop');
  const captionLabelBottom = document.getElementById('captionLabelBottom');
  const captionLabelArrow = document.getElementById('captionLabelArrow');

  // Ambil semua gambar + info judul
  const images = Array.from(galleryImages).map(img => ({
    src: img.getAttribute('src'),
    alt: img.getAttribute('alt') || '',
    title1: img.dataset.title1 || '',
    title2: img.dataset.title2 || '',
    title3: img.dataset.title3 || ''
  }));

  let currentIndex = 0;
  let zoomLevel = 1;

  function updateZoom() {
    const img = document.querySelector('.carousel-item.active img');
    if (img) {
      img.style.transform = `scale(${zoomLevel})`;
    }
  }

  document.getElementById('zoomIn').addEventListener('click', () => {
    zoomLevel += 0.2;
    updateZoom();
  });

  document.getElementById('zoomOut').addEventListener('click', () => {
    zoomLevel = Math.max(0.2, zoomLevel - 0.2);
    updateZoom();
  });

  // Event klik gambar
  galleryImages.forEach((img, index) => {
    img.addEventListener('click', () => {
      carouselInner.innerHTML = '';
      currentIndex = index;
      zoomLevel = 1;

      images.forEach((image, i) => {
        const isActive = i === index ? 'active' : '';
        carouselInner.innerHTML += `
          <div class="carousel-item ${isActive}">
            <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
              <img src="${image.src}" class="img-fluid" style="max-height: 70vh;" alt="${image.alt}">
            </div>
          </div>`;
      });

      // Caption pertama kali
      captionLabelTop.textContent = images[index].title1;
      captionLabelBottom.textContent = images[index].title2;
      captionLabelArrow.textContent = images[index].title3;

      // Tampilkan modal
      const modal = new bootstrap.Modal(document.getElementById('imageGalleryModal'));
      modal.show();

      setTimeout(updateZoom, 200);
    });
  });

  // Update caption saat slide berubah
  document.getElementById('carouselGallery').addEventListener('slid.bs.carousel', (e) => {
    currentIndex = e.to;
    zoomLevel = 1;
    updateZoom();

    captionLabelTop.textContent = images[currentIndex].title1;
    captionLabelBottom.textContent = images[currentIndex].title2;
    captionLabelArrow.textContent = images[currentIndex].title3;
  });
</script>
@endsection