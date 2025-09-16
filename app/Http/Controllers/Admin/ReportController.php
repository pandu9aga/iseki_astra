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
    public function index()
    {
        $page = 'report';
        $inputDate = Carbon::today()->toDateString();

        $Id_User = session('Id_User');
        $user = User::find($Id_User);

        $top50 = Track::selectRaw("CAST(SUBSTRING_INDEX(Id_Type, ';', 1) AS UNSIGNED) as instruksi_no, Id_Type")
            ->orderByDesc('instruksi_no')
            ->groupBy('instruksi_no', 'Id_Type')
            ->limit(50)
            ->pluck('instruksi_no')
            ->toArray();

        $tracks = Track::whereRaw("CAST(SUBSTRING_INDEX(Id_Type, ';', 1) AS UNSIGNED) IN (" . implode(',', $top50) . ")")
            ->with('user', 'area', 'track_photo')
            ->orderBy('Id_Type', 'desc')
            ->get();

        // Group berdasarkan nomor instruksi (prefix)
        $groupedTracks = $tracks->groupBy(function ($track) {
            return explode(';', $track->Id_Type)[0] ?? null;
        });

        return view('admins.reports.index', compact('page', 'user', 'groupedTracks'));
    }

    public function submit(Request $request)
    {
        $page = 'report';
        $Id_User = session('Id_User');
        $user = User::find($Id_User);

        $startNo = $request->input('start_no');
        $endNo   = $request->input('end_no');

        // Ambil semua Id_Type sesuai range nomor instruksi (prefix sebelum ;)
        $tracks = Track::whereRaw("CAST(SUBSTRING_INDEX(Id_Type, ';', 1) AS UNSIGNED) BETWEEN ? AND ?", [$startNo, $endNo])
            ->with('user', 'area', 'track_photo')
            ->orderBy('Id_Type', 'desc')
            ->get();

        // Group berdasarkan prefix (nomor instruksi), isi tetap full Id_Type
        $groupedTracks = $tracks->groupBy(function ($track) {
            return explode(';', $track->Id_Type)[0] ?? null;
        });

        return view('admins.reports.index', compact('page', 'user', 'groupedTracks', 'startNo', 'endNo'));
    }


    public function detail(string $Id_Type){
        $page = 'report';

        // $tracks = Track::where('Id_Type', $Id_Type)
        $tracks = Track::where('Id_Type', 'like', $Id_Type.';%')
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
        // $tracks = Track::where('Id_Type', $Id_Type)
        $tracks = Track::where('Id_Type', 'like', $Id_Type.';%')
            ->with('user')
            ->with('area')
            ->with('track_photo')
            ->get();

        $pdf = Pdf::loadView('admins.reports.pdf', compact('tracks'))->setPaper('a4', 'potrait')->set_option("enable_php", true)->set_option('isRemoteEnabled', true);
        return $pdf->download('Track_Report_' . $Id_Type . '.pdf');
    }
}
