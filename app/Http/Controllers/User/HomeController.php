<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Type_User;
use App\Models\Area;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){
        $page = 'home';
        $date = Carbon::today();

        $Id_User = session('Id_User');
        $user = User::find($Id_User);

        $type_user = Type_User::all();
        $area = Area::all();

        return view('users.index', compact('page', 'date', 'user', 'type_user', 'area'));
    }    
}
 