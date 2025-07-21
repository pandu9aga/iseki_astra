<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Track;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(){
        $page = 'report';
        $inputDate = Carbon::today()->toDateString();

        $Id_User = session('Id_User');
        $user = User::find($Id_User);

        // Step 1: Cari semua Id_Type dan tanggal pertama kali mereka muncul
        $firstAppearances = Track::select('Id_Type', DB::raw('MIN(DATE(Time_Track)) as first_date'))
            ->groupBy('Id_Type')
            ->pluck('first_date', 'Id_Type'); // hasil: [Id_Type => 'YYYY-MM-DD']

        // Step 2: Filter Id_Type yang first_date-nya sama dengan tanggal input
        $idTypesForDate = $firstAppearances->filter(function ($date) use ($inputDate) {
            return $date === $inputDate;
        })->keys(); // Ambil hanya key-nya (Id_Type)

        // Step 3: Ambil semua track yang memiliki Id_Type tersebut (semua tanggal, bukan hanya tanggal input)
        $tracks = Track::whereIn('Id_Type', $idTypesForDate)
            ->with('user', 'area', 'track_photo')
            ->orderBy('Time_Track')
            ->get();

        $date = \Carbon\Carbon::parse($inputDate)->isoFormat('YYYY-MM-DD');

        // Step 4: Kelompokkan berdasarkan Id_Type
        $groupedTracks = $tracks->groupBy('Id_Type');

        return view('admins.reports.index', compact('page', 'user', 'groupedTracks', 'date'));
    }

    public function submit(Request $request){
        $page = 'report';
        $inputDate = $request->input('Time_Track');
        $Id_User = session('Id_User');
        $user = User::find($Id_User);

        // Step 1: Cari semua Id_Type dan tanggal pertama kali mereka muncul
        $firstAppearances = Track::select('Id_Type', DB::raw('MIN(DATE(Time_Track)) as first_date'))
            ->groupBy('Id_Type')
            ->pluck('first_date', 'Id_Type'); // hasil: [Id_Type => 'YYYY-MM-DD']

        // Step 2: Filter Id_Type yang first_date-nya sama dengan tanggal input
        $idTypesForDate = $firstAppearances->filter(function ($date) use ($inputDate) {
            return $date === $inputDate;
        })->keys(); // Ambil hanya key-nya (Id_Type)

        // Step 3: Ambil semua track yang memiliki Id_Type tersebut (semua tanggal, bukan hanya tanggal input)
        $tracks = Track::whereIn('Id_Type', $idTypesForDate)
            ->with('user', 'area', 'track_photo')
            ->orderBy('Time_Track')
            ->get();

        $date = \Carbon\Carbon::parse($inputDate)->isoFormat('YYYY-MM-DD');

        // Step 4: Kelompokkan berdasarkan Id_Type
        $groupedTracks = $tracks->groupBy('Id_Type');

        return view('admins.reports.index', compact('page', 'user', 'groupedTracks', 'date'));
    }

    public function detail(string $Id_Type){
        $page = 'report';

        $tracks = Track::where('Id_Type', $Id_Type)
        ->with('user')
        ->with('area')
        ->with('track_photo')
        ->get();

        return view('admins.reports.detail', compact('page', 'tracks'));
    }

    // public function approvement(Request $request, $id)
    // {
    //     $track = Track::findOrFail($id);

    //     // Checkbox tidak dikirim jika tidak dicentang, jadi default ke 0
    //     $track->Status_Track = $request->has('Status_Track') ? 1 : 0;
    //     $track->save();

    //     return redirect()->back()->with('success', 'Status updated successfully.');
    // }

    public function export(string $Id_Type)
    {
        $tracks = Track::where('Id_Type', $Id_Type)
            ->with('user')
            ->with('area')
            ->with('track_photo')
            ->get();

        $pdf = Pdf::loadView('admins.reports.pdf', compact('tracks'))->setPaper('a4', 'potrait')->set_option("enable_php", true)->set_option('isRemoteEnabled', true);
        return $pdf->download('Track_Report_' . $Id_Type . '.pdf');
    }
}
