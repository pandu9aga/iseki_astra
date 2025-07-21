<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Track;
use App\Models\Area_Photo;
use App\Models\Track_Photo;
use Carbon\Carbon;

class TrackController extends Controller
{
    public function index(){
        $page = 'track';

        $Id_User = session('Id_User');
        $user = User::with('area')->find($Id_User);

        // Ambil area photo yang sesuai area user dan sertakan relasi photo_angle
        $parts = Area_Photo::with('photo_angle')
            ->where('Id_Area', $user->Id_Area)
            ->get();

        return view('users.tracks.index', compact('page', 'user', 'parts'));
    }

    public function index2(){
        $page = 'track2';

        $Id_User = session('Id_User');
        $user = User::with('area')->find($Id_User);

        // Ambil area photo yang sesuai area user dan sertakan relasi photo_angle
        $parts = Area_Photo::with('photo_angle')
            ->where('Id_Area', $user->Id_Area)
            ->get();

        return view('users.tracks.index3', compact('page', 'user', 'parts'));
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
        if (!$area) {
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

        $exists = Track::where('Id_User', $request->Id_User)
            ->where('Id_Type', $filteredIdType)
            ->where('Id_Area', $area->Id_Area)
            ->whereBetween('Time_Track', [
                Carbon::now()->subSeconds(10),
                Carbon::now()->addSeconds(10)
            ])
            ->exists();
        if ($exists) {
            return redirect()->route('user_report')->withErrors('Tracking data already submitted for today!');
        }

        // Simpan data track
        $track = Track::create([
            'Id_User' => $request->Id_User,
            'Id_Type' => $filteredIdType,
            'Id_Area' => $area->Id_Area,
            'Time_Track' => Carbon::now(),
            'Status_Track' => 0,
        ]);

        // Simpan semua file foto ke track_photos
        foreach ($areaPhotos as $photo) {
            $angle = $photo->photo_angle;
            $fieldName = (string) $angle->Id_Photo_Angle;

            if ($request->hasFile($fieldName)) {
                $path = $request->file($fieldName)->store("track", 'uploads');

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
}
