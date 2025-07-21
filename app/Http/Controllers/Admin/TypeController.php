<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Type;

class TypeController extends Controller
{
    public function index(){
        $page = "type";

        $type = Type::all();
        return view('admins.types.index', compact('page', 'type'));
    }

    public function add()
    {
        $page = "type";

        return view('admins.types.add', compact('page'));
    }

    public function create(Request $request)
    {
        // melakukan validasi data
        $request->validate([
            'Name_Type' => 'required'
        ],
        [
            'Name_Type.required' => 'Nama type wajib diisi'
        ]);
        
        //tambah data type
        DB::table('types')->insert([
            'Name_Type' => $request->input('Name_Type')
        ]);
        
        return redirect()->route('type');
    }

    public function edit(Type $Id_Type)
    {
        $page = "type";

        return view('admins.types.edit', compact('page', 'Id_Type'));
    }

    public function update(Request $request, string $Id_Type)
    {
        // melakukan validasi data
        $request->validate([
            'Name_Type' => 'required'
        ],
        [
            'Name_Type.required' => 'Nama type wajib diisi'
        ]);
    
        //update data item
        DB::table('types')->where('Id_Type',$Id_Type)->update([
            'Name_Type' => $request->input('Name_Type')
        ]);
                
        return redirect()->route('type');
    }

    public function destroy(Type $Id_Type)
    {
        $Id_Type->delete();
        
        return redirect()->route('type')->with('success','Data berhasil di hapus' );
    }
}
