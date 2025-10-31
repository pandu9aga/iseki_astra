# Implementasi Yajra DataTables untuk Report

## Perubahan yang Telah Dilakukan

### 1. Instalasi Package
- Menginstall `yajra/laravel-datatables-oracle` versi 12.6.1
- Command: `composer require yajra/laravel-datatables-oracle --ignore-platform-req=ext-gd`

### 2. Controller (ReportController.php)
**Import yang ditambahkan:**
```php
use Yajra\DataTables\Facades\DataTables;
```

**Perubahan Method `index()`:**
- Menambahkan parameter `Request $request`
- Menambahkan logika untuk menangani AJAX request
- Menggunakan `DataTables::of()` untuk memproses data
- Menambahkan kolom-kolom: pic, number, area, user, record, action
- Data diproses server-side untuk performa lebih baik

**Method yang dihapus:**
- `submit()` - Digabung ke dalam `index()` method

### 3. Routes (web.php)
**Perubahan:**
- `Route::get('/report')` dengan name `report.index` (sebelumnya `report`)
- Menghapus route `report.submit`

**Routes yang diupdate di view:**
- `layouts/main.blade.php`: `route('report')` → `route('report.index')`
- `admins/reports/detail.blade.php`: `route('report')` → `route('report.index')`

### 4. View (resources/views/admins/reports/index.blade.php)

**Perubahan HTML:**
- Form filter diubah dari `<form>` menjadi input biasa dengan ID `Time_Track`
- Button filter dengan ID `filterBtn`
- Table ID diubah dari `example` ke `reportTable`
- Body table dikosongkan (akan diisi oleh DataTables via AJAX)

**JavaScript Configuration:**
```javascript
$('#reportTable').DataTable({
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
    columns: [...],
    language: {
        processing: '<div class="spinner-border text-primary">...'
    }
});
```

**Fitur Filter:**
- Click button untuk reload data
- Enter key pada input tanggal untuk reload data

## Fitur DataTables yang Tersedia

1. **Server-Side Processing** - Data diproses di server untuk performa lebih baik
2. **Searching** - Pencarian otomatis (disabled untuk kolom tertentu)
3. **Sorting** - Pengurutan kolom (disabled untuk semua kolom karena data kompleks)
4. **Pagination** - Pagination otomatis dengan opsi entries: **50, 100, 150, 200** (default: **50**)
5. **Loading Indicator** - Spinner saat memuat data
6. **Filter by Date** - Filter berdasarkan tanggal dengan tombol atau Enter key

## Pengaturan Pagination
- **Default entries per page**: 50
- **Pilihan entries**: 50, 100, 150, 200
- User dapat mengubah jumlah entries yang ditampilkan melalui dropdown "Show entries"

## Format Data yang Dipertahankan

Implementasi ini mempertahankan format tampilan yang sama dengan sebelumnya:
- No (auto increment)
- Pic (gambar produk)
- Number (No, Type, Production)
- Area (daftar area)
- User (daftar user)
- Record (waktu tracking)
- Action (link ke detail)

## Cara Penggunaan

1. Buka halaman Report
2. Pilih tanggal di input date picker
3. Klik tombol filter atau tekan Enter
4. Data akan dimuat via AJAX tanpa refresh halaman
5. Gunakan dropdown "Show entries" untuk mengubah jumlah data per halaman
6. Gunakan fitur pagination untuk navigasi antar halaman

## Notes

- DataTables menggunakan jQuery yang sudah ada di assets
- CSS DataTables sudah ada di `assets/datatables/datatables.min.css`
- JS DataTables sudah ada di `assets/datatables/datatables.min.js`
- Semua kolom di-set `orderable: false` dan `searchable: false` karena struktur data yang kompleks (grouped data)
- Default page length: 50 entries
- Length menu options: 50, 100, 150, 200 entries
