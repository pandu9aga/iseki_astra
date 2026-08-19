<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Area_Photo;
use App\Models\Track;
use App\Models\Track_Photo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TrackController extends Controller
{
    public function index()
    {
        $page = 'track';

        $Id_User = session('Id_User');
        $user = User::with('area')->find($Id_User);

        // Ambil area photo yang sesuai area user dan sertakan relasi photo_angle
        $parts = Area_Photo::with('photo_angle')
            ->where('Id_Area', $user->Id_Area)
            ->get();

        return view('users.tracks.index', compact('page', 'user', 'parts'));
    }

    public function index2()
    {
        $page = 'track2';

        $Id_User = session('Id_User');
        $user = User::with('area')->find($Id_User);

        // Ambil area photo yang sesuai area user dan sertakan relasi photo_angle
        $parts = Area_Photo::with('photo_angle')
            ->where('Id_Area', $user->Id_Area)
            ->get();

        return view('users.tracks.index2', compact('page', 'user', 'parts'));
    }

    public function store(Request $request)
    {
        // Validasi input teks wajib
        $request->validate([
            'Id_User' => 'required',
            'no' => 'required',
            'type' => 'required',
            'production' => 'required',
            'Id_Type' => 'required',
            'Name_Area' => 'required',
        ]);

        // Cari area berdasarkan nama
        $area = Area::where('Name_Area', $request->Name_Area)->first();
        if (! $area) {
            return redirect()->back()->withErrors(['Name_Area' => 'Area not found.']);
        }

        // Ambil daftar bagian gambar (angle) berdasarkan area
        $areaPhotos = Area_Photo::with('photo_angle')->where('Id_Area', $area->Id_Area)->get();

        // Validasi dinamis input file
        $dynamicValidation = [];
        foreach ($areaPhotos as $photo) {
            $fieldName = (string) $photo->photo_angle->Id_Photo_Angle;
            $dynamicValidation[$fieldName] = 'required|image';
        }
        $request->validate($dynamicValidation);

        // Potong Id_Type jadi hanya 4 bagian awal
        $parts = explode(';', $request->Id_Type);
        $filteredIdType = implode(';', array_slice($parts, 0, 4));

        // Jika ada Id_Type (number) dan area yang sama, ganti data lama (tidak membuat duplikat)
        $existingTracks = Track::with('track_photo')
            ->where('Id_Type', $filteredIdType)
            ->where('Id_Area', $area->Id_Area)
            ->orderBy('Id_Track')
            ->get();

        // Hapus semua foto lama dari direktori dan database
        foreach ($existingTracks as $existing) {
            foreach ($existing->track_photo as $photo) {
                if (Storage::disk('uploads')->exists($photo->Path_Track_Photo)) {
                    Storage::disk('uploads')->delete($photo->Path_Track_Photo);
                }
                $photo->delete();
            }
        }

        // Simpan data track (update data lama jika sudah ada, buat baru jika belum)
        $track = $existingTracks->first();
        if ($track) {
            $track->update([
                'Id_User' => $request->Id_User,
                'Time_Track' => Carbon::now(),
                'Status_Track' => 0,
            ]);

            // Hapus track duplikat yang tersisa (jika ada)
            foreach ($existingTracks->slice(1) as $duplicate) {
                $duplicate->delete();
            }
        } else {
            $track = Track::create([
                'Id_User' => $request->Id_User,
                'Id_Type' => $filteredIdType,
                'Id_Area' => $area->Id_Area,
                'Time_Track' => Carbon::now(),
                'Status_Track' => 0,
            ]);
        }

        // Simpan semua file foto ke track_photos
        foreach ($areaPhotos as $photo) {
            $angle = $photo->photo_angle;
            $fieldName = (string) $angle->Id_Photo_Angle;

            if ($request->hasFile($fieldName)) {
                // $path = $request->file($fieldName)->store("track", 'uploads');
                $folderName = 'track_'.now()->format('m_Y'); // contoh: track_01_2026
                $path = $request->file($fieldName)->store($folderName, 'uploads');

                Track_Photo::create([
                    'Id_Track' => $track->Id_Track,
                    'Name_Photo_Angle' => $angle->Name_Photo_Angle,
                    'Icon_Photo_Angle' => $angle->Icon_Photo_Angle,
                    'Path_Track_Photo' => $path,
                ]);
            }
        }

        return redirect()->route('user_report')->with('success', 'Tracking data uploaded successfully!');
    }

    public function storenew(Request $request)
    {
        // Validasi input teks wajib
        $request->validate([
            'Id_User' => 'required',
            'no' => 'required', // sequence_no
            'dateProd' => 'required', // date production
            'type' => 'required',
            'production' => 'required',
            'Id_Type' => 'required',
            'Name_Area' => 'required',
        ]);

        // Ambil sequence_no dan area_name dari request
        $sequenceNo = $request->input('no'); // Ini adalah 'no' dari form
        $dateProduction = $request->input('dateProd'); // Ini adalah 'dateProd' dari form
        $areaName = $request->input('Name_Area'); // Ini adalah 'Name_Area' dari form

        // --- LOGIKA UPDATE RECORD DI DATABASE PODIUM LANGSUNG (Setelah validasi atau sebelumnya) ---
        // --- PERUBAHAN: Format sequence_no ---
        $sequenceNoFormatted = str_pad($sequenceNo, 5, '0', STR_PAD_LEFT);
        $timestamp = Carbon::now()->format('Y-m-d H:i:s');

        // Ubah area_name menjadi process_name
        $processName = 'astra_'.strtolower(str_replace(' ', '_', $areaName));

        try {
            // 1. Cari plan di database PODIUM berdasarkan Sequence_No_Plan
            $plan = DB::connection('podium')
                ->table('plans')
                ->where('Sequence_No_Plan', $sequenceNoFormatted)
                ->where('Production_Date_Plan', $dateProduction)
                ->first();
            if (! $plan) {
                return redirect()->back()->withErrors(['general' => "Plan dengan Sequence_No_Plan '{$sequenceNoFormatted}' tidak ditemukan di sistem PODIUM."]);
            }

            $modelName = $plan->Model_Name_Plan;

            // 2. Cari rule di database PODIUM berdasarkan Type_Rule
            $rule = DB::connection('podium')->table('rules')->where('Type_Rule', $modelName)->first();
            if (! $rule) {
                return redirect()->back()->withErrors(['general' => "Rule untuk model '{$modelName}' tidak ditemukan di sistem PODIUM."]);
            }

            // 3. Ambil Rule_Rule (ini berupa string JSON dari Query Builder)
            $ruleSequenceRaw = $rule->Rule_Rule;

            // Coba decode string JSON menjadi array
            $ruleSequence = null;
            if (is_string($ruleSequenceRaw)) {
                $ruleSequence = json_decode($ruleSequenceRaw, true); // true untuk mengembalikan array asosiatif
            }

            // Pastikan $ruleSequence adalah array hasil decode JSON.
            if (! is_array($ruleSequence)) {
                return redirect()->back()->withErrors(['general' => "Format rule untuk model '{$modelName}' rusak."]);
            }

            // 4. Cek apakah process_name (area yang sedang diproses) ada dalam rule
            $position = null;
            foreach ($ruleSequence as $key => $process) {
                if ($process === $processName) {
                    $position = (int) $key;
                    break;
                }
            }

            if ($position === null) {
                return redirect()->back()->withErrors(['general' => "Proses '{$processName}' (Area: {$areaName}) tidak termasuk dalam rule untuk model '{$modelName}'."]);
            }

            // 5. Ambil Record_Plan (ini berupa string JSON dari Query Builder)
            $recordRaw = $plan->Record_Plan;

            // Coba decode string JSON menjadi array
            $record = [];
            if (is_string($recordRaw) && ! empty($recordRaw)) {
                $decodedRecord = json_decode($recordRaw, true);
                if (is_array($decodedRecord)) {
                    $record = $decodedRecord;
                } else {
                    return redirect()->back()->withErrors(['general' => 'Format Record_Plan untuk plan ini rusak.']);
                }
            } // Jika null atau kosong, biarkan $record sebagai array kosong

            // --- LOGIKA VALIDASI URUTAN DAPAT DITAMBAHKAN DI SINI JIKA DIPERLUKAN ---
            // Misalnya, cek apakah proses sebelum $position sudah ada di $record
            // for ($i = 1; $i < $position; $i++) {
            //     $prevProcess = $ruleSequence[$i] ?? null;
            //     if ($prevProcess && !isset($record[$prevProcess])) {
            //         return redirect()->back()->withErrors(['general' => "Proses sebelumnya '$prevProcess' belum selesai."]);
            //     }
            // }
            // -----------------------

            // 7. Update record: tambahkan proses dan timestamp
            $record[$processName] = $timestamp;

            // --- LOGIKA TAMBAHAN: Cek apakah SEMUA proses dalam rule sudah selesai ---
            $allProcessesCompleted = true;
            // Kita iterasi semua proses yang *harus* ada berdasarkan rule
            foreach ($ruleSequence as $requiredProcessName) {
                if (! isset($record[$requiredProcessName])) {
                    $allProcessesCompleted = false;
                    // Kita tidak perlu mencari tahu yang mana saja, cukup tahu bahwa belum selesai
                    break; // Cukup satu yang belum selesai untuk menggagalkan status 'done'
                }
            }

            // 8. Siapkan data untuk update
            $updateData = [
                'Record_Plan' => json_encode($record, JSON_UNESCAPED_UNICODE),
            ];

            // Jika semua proses selesai, tambahkan status 'done'
            if ($allProcessesCompleted) {
                $updateData['Status_Plan'] = 'done';
                // Log::info("Status_Plan diupdate menjadi 'done' untuk Id_Plan: {$plan->Id_Plan} (Sequence: {$sequenceNoFormatted}) karena semua proses selesai.");
            }
            // else {
            //     // Opsional: Jika sebelumnya 'done' dan sekarang ada proses yang hilang (misalnya data dihapus), reset status
            //     // Untuk kasusmu, biasanya status hanya berubah ke 'done', jadi bisa diabaikan.
            //     // $updateData['Status_Plan'] = 'pending'; // atau status lain sesuai kebijakan
            // }

            // 9. Simpan kembali ke database PODIUM (Record_Plan dan Status_Plan jika perlu)
            DB::connection('podium')->table('plans')
                ->where('Id_Plan', $plan->Id_Plan) // Gunakan Id_Plan untuk keamanan
                ->update($updateData);

            \Log::info("Berhasil mencatat proses {$processName} ke Record_Plan di database PODIUM untuk Sequence_No_Plan: {$sequenceNoFormatted}. Status Plan: ".($allProcessesCompleted ? 'done' : 'pending'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['general' => 'Gagal mencatat ke sistem PODIUM: '.$e->getMessage()]);
        }

        // --- LANJUTKAN LOGIKA LAMA SIMPAN KE DATABASE ASTRA ---
        // Cari area berdasarkan nama
        $area = Area::where('Name_Area', $areaName)->first(); // Gunakan $areaName dari request
        if (! $area) {
            return redirect()->back()->withErrors(['Name_Area' => 'Area not found.']);
        }

        // Ambil daftar bagian gambar (angle) berdasarkan area
        $areaPhotos = Area_Photo::with('photo_angle')->where('Id_Area', $area->Id_Area)->get();

        // Validasi dinamis input file
        $dynamicValidation = [];
        foreach ($areaPhotos as $photo) {
            $fieldName = (string) $photo->photo_angle->Id_Photo_Angle;
            $dynamicValidation[$fieldName] = 'required|image';
        }
        $request->validate($dynamicValidation);

        // Potong Id_Type jadi hanya 4 bagian awal
        $parts = explode(';', $request->Id_Type);
        $filteredIdType = implode(';', array_slice($parts, 0, 4));

        // Jika ada Id_Type (number) dan area yang sama, ganti data lama (tidak membuat duplikat)
        $existingTracks = Track::with('track_photo')
            ->where('Id_Type', $filteredIdType)
            ->where('Id_Area', $area->Id_Area)
            ->orderBy('Id_Track')
            ->get();

        // Hapus semua foto lama dari direktori dan database
        foreach ($existingTracks as $existing) {
            foreach ($existing->track_photo as $photo) {
                if (Storage::disk('uploads')->exists($photo->Path_Track_Photo)) {
                    Storage::disk('uploads')->delete($photo->Path_Track_Photo);
                }
                $photo->delete();
            }
        }

        // Simpan data track (update data lama jika sudah ada, buat baru jika belum)
        $track = $existingTracks->first();
        if ($track) {
            $track->update([
                'Id_User' => $request->Id_User,
                'Time_Track' => Carbon::now(),
                'Status_Track' => 0,
            ]);

            // Hapus track duplikat yang tersisa (jika ada)
            foreach ($existingTracks->slice(1) as $duplicate) {
                $duplicate->delete();
            }
        } else {
            $track = Track::create([
                'Id_User' => $request->Id_User,
                'Id_Type' => $filteredIdType,
                'Id_Area' => $area->Id_Area,
                'Time_Track' => Carbon::now(),
                'Status_Track' => 0,
            ]);
        }

        // Simpan semua file foto ke track_photos
        foreach ($areaPhotos as $photo) {
            $angle = $photo->photo_angle;
            $fieldName = (string) $angle->Id_Photo_Angle;

            if ($request->hasFile($fieldName)) {
                // $path = $request->file($fieldName)->store("track", 'uploads');
                $folderName = 'track_'.now()->format('m_Y'); // contoh: track_01_2026
                $path = $request->file($fieldName)->store($folderName, 'uploads');

                Track_Photo::create([
                    'Id_Track' => $track->Id_Track,
                    'Name_Photo_Angle' => $angle->Name_Photo_Angle,
                    'Icon_Photo_Angle' => $angle->Icon_Photo_Angle,
                    'Path_Track_Photo' => $path,
                ]);
            }
        }

        return redirect()->route('user_report')->with('success', 'Tracking data uploaded successfully!');
    }

    public function validateRule(Request $request)
    {
        $request->validate([
            'sequence_no' => 'required|string',
            'date_production' => 'required|string',
            'area_name' => 'required|string',
        ]);

        $sequenceNo = $request->input('sequence_no');
        $dateProduction = $request->input('date_production');
        $areaName = $request->input('area_name');

        // --- LOGIKA MENGUBAH NAMA AREA MENJADI NAMA PROSES ASTRA ---
        // Contoh: "Engine" -> "astra_engine", "Main Line Start" -> "astra_main_line_start"
        // Kita ubah ke huruf kecil dan ganti spasi dengan underscore
        $processName = 'astra_'.strtolower(str_replace(' ', '_', $areaName));

        // --- LOGIKA VALIDASI URUTAN DARI DATABASE PODIUM ---
        // --- PERUBAHAN: Format sequence_no ---
        $sequenceNoFormatted = str_pad($sequenceNo, 5, '0', STR_PAD_LEFT);

        try {
            // 1. Cari plan di database PODIUM berdasarkan Sequence_No_Plan
            $plan = DB::connection('podium')
                ->table('plans')
                ->where('Sequence_No_Plan', $sequenceNoFormatted)
                ->where('Production_Date_Plan', $dateProduction)
                ->first();
            if (! $plan) {
                return response()->json([
                    'success' => false,
                    'message' => "Plan dengan Sequence_No_Plan '{$sequenceNoFormatted}' tidak ditemukan di sistem PODIUM.",
                ], 404);
            }

            $modelName = $plan->Model_Name_Plan;

            // 2. Cari rule di database PODIUM berdasarkan Type_Rule
            $rule = DB::connection('podium')->table('rules')->where('Type_Rule', $modelName)->first();
            if (! $rule) {
                return response()->json([
                    'success' => false,
                    'message' => "Rule untuk model '{$modelName}' tidak ditemukan di sistem PODIUM.",
                ], 400);
            }

            // 3. Ambil Rule_Rule (ini berupa string JSON dari Query Builder)
            $ruleSequenceRaw = $rule->Rule_Rule;

            // Coba decode string JSON menjadi array
            $ruleSequence = null;
            if (is_string($ruleSequenceRaw)) {
                $ruleSequence = json_decode($ruleSequenceRaw, true); // true untuk mengembalikan array asosiatif
            }

            // Pastikan $ruleSequence adalah array hasil decode JSON.
            if (! is_array($ruleSequence)) {
                // Jika decode gagal atau nilainya bukan string JSON valid, kembalikan error
                return response()->json([
                    'success' => false,
                    'message' => "Format rule untuk model '{$modelName}' rusak atau tidak valid.",
                ], 400);
            }

            // 4. Cek apakah process_name (area yang sedang diproses) ada dalam rule
            $position = null;
            foreach ($ruleSequence as $key => $process) {
                if ($process === $processName) {
                    $position = (int) $key;
                    break;
                }
            }

            if ($position === null) {
                return response()->json([
                    'success' => false,
                    'message' => "Proses '{$processName}' (Area: {$areaName}) tidak termasuk dalam rule untuk model '{$modelName}'.",
                ], 400);
            }

            // 5. Ambil Record_Plan (ini berupa string JSON dari Query Builder)
            $recordRaw = $plan->Record_Plan;

            // Coba decode string JSON menjadi array
            $record = [];
            if (is_string($recordRaw) && ! empty($recordRaw)) {
                $decodedRecord = json_decode($recordRaw, true);
                if (is_array($decodedRecord)) {
                    $record = $decodedRecord;
                } else {
                    // Jika decode gagal atau nilainya bukan string JSON valid, kembalikan error
                    return response()->json([
                        'success' => false,
                        'message' => 'Format Record_Plan untuk plan ini rusak.',
                    ], 500); // atau 400, tergantung kebijakan
                }
            } // Jika null atau kosong, biarkan $record sebagai array kosong

            // 6. Cek apakah proses sebelumnya sudah dilakukan
            $previousProcessesDone = true;
            $missingPrevious = [];
            for ($i = 1; $i < $position; $i++) {
                $prevProcess = $ruleSequence[$i] ?? null;
                if ($prevProcess && ! isset($record[$prevProcess])) {
                    $previousProcessesDone = false;
                    $missingPrevious[] = $prevProcess;
                }
            }

            if ($areaName == 'Mower Collector') {
                $previousProcessesDone = true;
            }

            if (! $previousProcessesDone) {
                return response()->json([
                    'success' => false,
                    'message' => 'Proses sebelumnya belum selesai: '.implode(', ', $missingPrevious),
                ], 400);
            }

            // Jika semua validasi di atas lolos
            return response()->json([
                'success' => true,
                'message' => "Semua proses sebelumnya sudah selesai. Siap melanjutkan proses {$areaName}.",
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memvalidasi rule di sistem PODIUM: '.$e->getMessage(),
            ], 500);
        }
    }
}
