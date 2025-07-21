<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Photo_Angle;

class PhotoAngleController extends Controller
{
    public function index(){
        $page = "angle";

        $angles = Photo_Angle::all();
        return view('admins.angles.index', compact('page', 'angles'));
    }

    public function add()
    {
        $page = "angle";

        return view('admins.angles.add', compact('page'));
    }

    public function create(Request $request)
    {
        // melakukan validasi data
        $request->validate([
            'Name_Photo_Angle' => 'required|unique:photo_angles,Name_Photo_Angle',
            'Icon_Photo_Angle' => 'required'
        ],
        [
            'Name_Photo_Angle.required' => 'Nama angle wajib diisi',
            'Name_Photo_Angle.unique' => 'Nama angle sudah digunakan',
            'Icon_Photo_Angle.required' => 'Icon angle wajib diisi'
        ]);
        
        // tambah data angle
        DB::table('photo_angles')->insert([
            'Name_Photo_Angle' => $request->input('Name_Photo_Angle'),
            'Icon_Photo_Angle' => $request->input('Icon_Photo_Angle')
        ]);
        
        return redirect()->route('angle');
    }

    public function edit(Photo_Angle $Id_Photo_Angle)
    {
        $page = "angle";

        return view('admins.angles.edit', compact('page', 'Id_Photo_Angle'));
    }

    public function update(Request $request, string $Id_Photo_Angle)
    {
        // melakukan validasi data
        $request->validate([
            'Name_Photo_Angle' => 'required|unique:photo_angles,Name_Photo_Angle,' . $Id_Photo_Angle . ',Id_Photo_Angle',
            'Icon_Photo_Angle' => 'required'
        ],
        [
            'Name_Photo_Angle.required' => 'Nama angle wajib diisi',
            'Name_Photo_Angle.unique' => 'Nama angle sudah digunakan',
            'Icon_Photo_Angle.required' => 'Icon angle wajib diisi'
        ]);
    
        //update data item
        DB::table('photo_angles')->where('Id_Photo_Angle',$Id_Photo_Angle)->update([
            'Name_Photo_Angle' => $request->input('Name_Photo_Angle'),
            'Icon_Photo_Angle' => $request->input('Icon_Photo_Angle')
        ]);
                
        return redirect()->route('angle');
    }

    public function destroy(Photo_Angle $Id_Photo_Angle)
    {
        // Hapus semua relasi dari area_photos
        DB::table('area_photos')
            ->where('Id_Photo_Angle', $Id_Photo_Angle->Id_Photo_Angle)
            ->delete();
            
        $Id_Photo_Angle->delete();
        
        return redirect()->route('angle')->with('success','Data berhasil di hapus' );
    }
}
