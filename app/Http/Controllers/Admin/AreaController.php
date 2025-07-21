<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Area;
use App\Models\Photo_Angle;

class AreaController extends Controller
{
    public function index(){
        $page = "area";

        // Ambil semua area beserta relasi area_photo dan photo_angle
        $area = Area::with(['area_photo.photo_angle'])->get();
        return view('admins.areas.index', compact('page', 'area'));
    }

    public function add()
    {
        $page = "area";

        $angles = Photo_Angle::all();
        return view('admins.areas.add', compact('page', 'angles'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'Name_Area' => 'required',
            'photo_angles' => 'required|array|min:1' // minimal harus 1 dicentang
        ],
        [
            'Name_Area.required' => 'Nama area wajib diisi',
            'photo_angles.required' => 'Minimal pilih satu photo angle',
            'photo_angles.min' => 'Minimal pilih satu photo angle'
        ]);

        // Insert area dan dapatkan ID-nya
        $id = DB::table('areas')->insertGetId([
            'Name_Area' => $request->input('Name_Area')
        ]);

        // Insert photo angle yang dipilih
        foreach ($request->input('photo_angles') as $photoAngleId) {
            DB::table('area_photos')->insert([
                'Id_Area' => $id,
                'Id_Photo_Angle' => $photoAngleId
            ]);
        }

        return redirect()->route('area')->with('success', 'Area berhasil ditambahkan.');
    }

    public function edit(Area $Id_Area)
    {
        $page = "area";
        
        $angles = Photo_Angle::all(); // Ambil semua angle
        $checkedAngles = $Id_Area->area_photo->pluck('Id_Photo_Angle')->toArray(); // Ambil ID yang sudah terhubung

        return view('admins.areas.edit', compact('page', 'Id_Area', 'angles', 'checkedAngles'));
    }

    public function update(Request $request, string $Id_Area)
    {
        $request->validate([
            'Name_Area' => 'required',
            'photo_angles' => 'required|array|min:1'
        ], [
            'Name_Area.required' => 'Nama area wajib diisi',
            'photo_angles.required' => 'Minimal satu photo angle harus dipilih'
        ]);

        // Update nama area
        DB::table('areas')->where('Id_Area', $Id_Area)->update([
            'Name_Area' => $request->input('Name_Area')
        ]);

        // Hapus semua relasi lama
        DB::table('area_photos')->where('Id_Area', $Id_Area)->delete();

        // Masukkan relasi baru
        foreach ($request->input('photo_angles') as $Id_Photo_Angle) {
            DB::table('area_photos')->insert([
                'Id_Area' => $Id_Area,
                'Id_Photo_Angle' => $Id_Photo_Angle
            ]);
        }

        return redirect()->route('area')->with('success', 'Data area berhasil diperbarui.');
    }

    public function destroy(Area $Id_Area)
    {
        // Hapus semua relasi dari area_photos yang terkait
        DB::table('area_photos')->where('Id_Area', $Id_Area->Id_Area)->delete();
        
        $Id_Area->delete();
        
        return redirect()->route('area')->with('success','Data berhasil di hapus' );
    }
}
