<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Track;
use App\Models\Area;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use ZipArchive;

class ChecklistController extends Controller
{
    public function index(){
        $page = 'checklist';
        $inputDate = Carbon::today()->toDateString();

        $Id_User = session('Id_User');
        $user = User::find($Id_User);

        $areas = Area::all();

        // Step 1: Ambil semua Id_Type yang muncul di tanggal tertentu dan area = 3
        $idTypesForArea3 = Track::whereDate('Time_Track', $inputDate)
            ->where('Id_Area', 3)
            ->pluck('Id_Type')
            ->unique();

        // Step 2: Ambil semua track yang memiliki Id_Type tersebut (tidak terbatas tanggal)
        $tracks = Track::whereIn('Id_Type', $idTypesForArea3)
            ->with('user', 'area', 'track_photo')
            ->orderBy('Time_Track')
            ->get();

        $date = Carbon::parse($inputDate)->isoFormat('YYYY-MM-DD');

        // Step 3: Kelompokkan berdasarkan Id_Type
        $groupedTracks = $tracks->groupBy('Id_Type');

        // Filter hanya grup yang jumlah datanya minimal 3
        $groupedTracks = $groupedTracks->filter(function ($group) {
            return $group->count() >= 3;
        });

        return view('admins.checklists.index', compact('page', 'user', 'areas', 'groupedTracks', 'date'));
    }

    public function submit(Request $request){
        $page = 'checklist';
        $inputDate = $request->input('Time_Track');

        $Id_User = session('Id_User');
        $user = User::find($Id_User);

        $areas = Area::all();

        // Step 1: Ambil semua Id_Type yang muncul di tanggal tertentu dan area = 3
        $idTypesForArea3 = Track::whereDate('Time_Track', $inputDate)
            ->where('Id_Area', 3)
            ->pluck('Id_Type')
            ->unique();

        // Step 2: Ambil semua track yang memiliki Id_Type tersebut (tidak terbatas tanggal)
        $tracks = Track::whereIn('Id_Type', $idTypesForArea3)
            ->with('user', 'area', 'track_photo')
            ->orderBy('Time_Track')
            ->get();

        $date = Carbon::parse($inputDate)->isoFormat('YYYY-MM-DD');

        // Step 3: Kelompokkan berdasarkan Id_Type
        $groupedTracks = $tracks->groupBy('Id_Type');

        // Filter hanya grup yang jumlah datanya minimal 3
        $groupedTracks = $groupedTracks->filter(function ($group) {
            return $group->count() >= 3;
        });

        return view('admins.checklists.index', compact('page', 'user', 'areas', 'groupedTracks', 'date'));
    }

    public function detail(string $Id_Type){
        $page = 'checklist';

        $areas = Area::all();

        $tracks = Track::where('Id_Type', $Id_Type)
        ->with('user')
        ->with('area')
        ->with('track_photo')
        ->get();

        return view('admins.checklists.detail', compact('page', 'areas', 'tracks'));
    }

    public function export(string $Id_Type)
    {
        // Ambil data track
        $tracks = Track::where('Id_Type', $Id_Type)
            ->with('user', 'area', 'track_photo')
            ->get();

        // Update semua track menjadi status 1
        Track::where('Id_Type', $Id_Type)->update(['Status_Track' => 1]);

        // Generate PDF dari view
        $pdf = Pdf::loadView('admins.checklists.pdf', compact('tracks'))
            ->setPaper('a4', 'portrait')
            ->set_option("enable_php", true)
            ->set_option('isRemoteEnabled', true);

        // Tentukan path penyimpanan (dalam public/downloads)
        $fileName = 'Track_Report_' . $Id_Type . '.pdf';
        $storagePath = 'track/' . $fileName;

        // Simpan file ke storage (downloads)
        Storage::disk('downloads')->put($storagePath, $pdf->output());

        // Kembalikan file sebagai unduhan
        return response()->download(Storage::disk('downloads')->path($storagePath));
    }

    public function store(Request $request)
    {
        $inputDate = $request->input('Time_Track');

        // Ambil semua Id_Type yang muncul di tanggal tertentu dan area = 3
        $idTypes = Track::whereDate('Time_Track', $inputDate)
            ->where('Id_Area', 3)
            ->pluck('Id_Type')
            ->unique();

        // Filter hanya Id_Type yang valid:
        $validIdTypes = $idTypes->filter(function ($idType) {
            $parts = explode(';', $idType);
            $name = strtolower($parts[2] ?? '');

            $count = Track::where('Id_Type', $idType)->count();

            if (str_contains($name, 'sxg')) {
                return $count >= 4;
            }

            return $count >= 3;
        });

        // Jika kosong, kembalikan tanpa respons (biar reload normal di frontend)
        if ($validIdTypes->isEmpty()) {
            return response()->noContent(); // atau bisa pakai: return back();
        }

        $downloadPath = public_path('downloads/track');

        foreach ($validIdTypes as $Id_Type) {
            $tracks = Track::where('Id_Type', $Id_Type)
                ->with('user', 'area', 'track_photo')
                ->get();

            // Update status track
            Track::where('Id_Type', $Id_Type)->update(['Status_Track' => 1]);

            // Generate PDF
            $pdf = \PDF::loadView('admins.checklists.pdf', compact('tracks'))
                ->setPaper('a4', 'portrait')
                ->set_option("enable_php", true)
                ->set_option('isRemoteEnabled', true);

            $fileName = "Track_Report_{$Id_Type}.pdf";
            Storage::disk('downloads')->put("track/{$fileName}", $pdf->output());
        }

        // Buat ZIP
        $zipFileName = 'Track_Report_All_' . now()->format('Ymd_His') . '.zip';
        $zipFilePath = storage_path("app/{$zipFileName}");

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($validIdTypes as $Id_Type) {
                $filePath = $downloadPath . "/Track_Report_{$Id_Type}.pdf";
                if (File::exists($filePath)) {
                    $zip->addFile($filePath, "Track_Report_{$Id_Type}.pdf");
                }
            }
            $zip->close();
        }

        // Kirim file ZIP sebagai respons dan hapus setelah dikirim
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function delete(string $Id_Type)
    {
        $tracks = Track::where('Id_Type', $Id_Type)->with('track_photo')->get();

        // Cek kalau ada yang Status_Track = 0
        if ($tracks->contains(fn($track) => $track->Status_Track == 0)) {
            return redirect()->back()->with('error', 'Cannot delete: some data has Status_Track = 0');
        }

        foreach ($tracks as $track) {
            // Hapus semua file dan track_photos
            foreach ($track->track_photo as $photo) {
                // $filePath = storage_path('app/public/' . $photo->Path_Track_Photo);
                // if (file_exists($filePath)) {
                //     @unlink($filePath);
                // }
                if (Storage::disk('uploads')->exists($photo->Path_Track_Photo)) {
                    Storage::disk('uploads')->delete($photo->Path_Track_Photo);
                }
                $photo->delete();
            }

            // Hapus track-nya
            $track->delete();
        }

        return redirect()->route('checklist')->with('success', 'Data deleted successfully.');
    }

    public function deleteAll(Request $request)
    {
        $inputDate = $request->input('Time_Track');

        // Ambil semua Id_Type dari tanggal dan area = 3
        $idTypes = Track::whereDate('Time_Track', $inputDate)
            ->where('Id_Area', 3)
            ->pluck('Id_Type')
            ->unique();

        // Filter hanya Id_Type yang valid
        $validIdTypes = $idTypes->filter(function ($idType) {
            $parts = explode(';', $idType);
            $name = strtolower($parts[2] ?? '');

            $tracks = Track::where('Id_Type', $idType)->with('track_photo')->get();
            $count = $tracks->count();

            if (str_contains($name, 'sxg') && $count < 4) {
                return false;
            }

            if (!str_contains($name, 'sxg') && $count < 3) {
                return false;
            }

            // Semua harus Status_Track = 1
            return $tracks->every(fn($track) => $track->Status_Track == 1);
        });

        if ($validIdTypes->isEmpty()) {
            return redirect()->back()->with('error', 'No valid data to delete.');
        }

        foreach ($validIdTypes as $Id_Type) {
            $tracks = Track::where('Id_Type', $Id_Type)->with('track_photo')->get();

            foreach ($tracks as $track) {
                foreach ($track->track_photo as $photo) {
                    // $filePath = storage_path('app/public/' . $photo->Path_Track_Photo);
                    // if (file_exists($filePath)) {
                    //     @unlink($filePath);
                    // }
                    if (Storage::disk('uploads')->exists($photo->Path_Track_Photo)) {
                        Storage::disk('uploads')->delete($photo->Path_Track_Photo);
                    }
                    $photo->delete();
                }

                $track->delete();
            }
        }

        return back()->with('success', 'Data deleted successfully.');
    }
}
