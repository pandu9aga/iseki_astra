<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Track;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class UserReportController extends Controller
{
    public function index(){
        $page = 'report';

        $date = Carbon::today();

        $Id_User = session('Id_User');
        $user = User::find($Id_User);

        $tracks = Track::whereDate('Time_Track', $date)
        ->where('Id_User', $Id_User)
        ->with('user')
        ->with('area')
        ->with('track_photo')
        ->orderBy('Time_Track', 'desc')
        ->get();

        $date = Carbon::parse($date)->isoFormat('YYYY-MM-DD');

        return view('users.reports.index', compact('page', 'user', 'tracks','date'));
    }

    public function submit(Request $request){
        $page = 'report';

        $date = $request->input('Time_Track');

        $Id_User = session('Id_User');
        $user = User::find($Id_User);

        $tracks = Track::whereDate('Time_Track', $date)
        ->where('Id_User', $Id_User)
        ->with('user')
        ->with('area')
        ->with('track_photo')
        ->orderBy('Time_Track', 'desc')
        ->get();

        $date = Carbon::parse($date)->isoFormat('YYYY-MM-DD');

        return view('users.reports.index', compact('page', 'user', 'tracks','date'));
    }

    public function detail(string $Id_Track){
        $page = 'report';

        $track = Track::where('Id_Track', $Id_Track)
        ->with('user')
        ->with('area')
        ->with('track_photo')
        ->firstOrFail();

        return view('users.reports.detail', compact('page', 'track'));
    }

    public function destroy($id)
    {
        $track = Track::with('track_photo')->findOrFail($id);

        // Hapus semua file foto dan record track_photos
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

        // Hapus track
        $track->delete();

        return redirect()->route('user_report')->with('success', 'Tracking data deleted successfully!');
    }

    public function export($Id_Track)
    {
        $track = Track::where('Id_Track', $Id_Track)
        ->with('user')
        ->with('area')
        ->with('track_photo')
        ->firstOrFail();

        $pdf = Pdf::loadView('users.reports.pdf', compact('track'))->setPaper('a4', 'potrait')->set_option("enable_php", true)->set_option('isRemoteEnabled', true);
        return $pdf->download('Track_Report_' . $track->user->Name_User . '_' . $track->Time_Track . '.pdf');
    }
}
