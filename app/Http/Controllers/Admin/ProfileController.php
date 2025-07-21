<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Type_User;
use App\Models\Area;

class ProfileController extends Controller
{
    public function index()
    {
        $page = "profile";

        $Id_User = session('Id_User');
        $user = User::find($Id_User);

        $type_user = Type_User::all();
        $area = Area::all();
        return view('admins.profile.index', compact('page', 'user','type_user', 'area'));
    }

    public function update(Request $request, string $Id_User)
    {
        // melakukan validasi data
        $request->validate([
            'Name_User' => 'required',
            'Username_User' => 'required|unique:users,Username_User,' . $Id_User . ',Id_User',
            'Password_User' => 'required'
        ],
        [
            'Name_User.required' => 'Nama wajib diisi',
            'Username_User.required' => 'Username wajib diisi',
            'Username_User.unique' => 'Username sudah digunakan, pilih yang lain',
            'Password_User.required' => 'Password wajib diisi'
        ]);
    
        //update data user
        DB::table('users')->where('Id_User',$Id_User)->update([
            'Name_User' => $request->input('Name_User'),
            'Username_User' => $request->input('Username_User'),
            'Password_User' => $request->input('Password_User')
        ]);

        session(['Username_User' => $request->input('Username_User')]);
                
        return redirect()->route('profile');
    }
}
