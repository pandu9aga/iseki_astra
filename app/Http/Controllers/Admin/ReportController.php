<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Track;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index(Request $request){
        $page = 'report';
        $inputDate = $request->input('Time_Track', Carbon::today()->toDateString());

        $Id_User = session('Id_User');
        $user = User::find($Id_User);

        $date = \Carbon\Carbon::parse($inputDate)->isoFormat('YYYY-MM-DD');

        if ($request->ajax()) {
            // Get search keyword
            $search = $request->get('search')['value'] ?? '';

            // Log the search for debugging
            \Log::info('Index Search Query:', ['search' => $search, 'date' => $inputDate]);

            // Step 1: Cari semua Id_Type dan tanggal pertama kali mereka muncul
            $firstAppearances = Track::select('Id_Type', DB::raw('MIN(DATE(Time_Track)) as first_date'))
                ->groupBy('Id_Type')
                ->pluck('first_date', 'Id_Type');

            // Step 2: Filter Id_Type yang first_date-nya sama dengan tanggal input
            $idTypesForDate = $firstAppearances->filter(function ($date) use ($inputDate) {
                return $date === $inputDate;
            })->keys();

            // Step 3: Ambil semua track yang memiliki Id_Type tersebut
            $tracks = Track::whereIn('Id_Type', $idTypesForDate)
                ->with('user', 'area', 'track_photo')
                ->orderBy('Time_Track')
                ->get();

            // Step 4: Kelompokkan berdasarkan Id_Type
            $groupedTracks = $tracks->groupBy('Id_Type');

            \Log::info('Before Search Filter:', ['count' => $groupedTracks->count()]);

            // Apply search filter if exists - filter the grouped collection
            if (!empty($search)) {
                $groupedTracks = $groupedTracks->filter(function ($group) use ($search) {
                    $firstTrack = $group->first();

                    // Search in Id_Type (number)
                    if (stripos($firstTrack->Id_Type, $search) !== false) {
                        return true;
                    }

                    // Search in any area name within the group
                    foreach ($group as $track) {
                        if (stripos($track->area->Name_Area, $search) !== false) {
                            return true;
                        }
                    }

                    // Search in any user name within the group
                    foreach ($group as $track) {
                        if (stripos($track->user->Name_User, $search) !== false) {
                            return true;
                        }
                    }

                    return false;
                });

                \Log::info('After Search Filter:', ['count' => $groupedTracks->count()]);
            }

            // Get total records
            $totalRecords = Track::whereIn('Id_Type', $idTypesForDate)
                ->select('Id_Type')
                ->distinct()
                ->count();
            $filteredRecords = $groupedTracks->count();

            // Manual pagination
            $start = $request->get('start', 0);
            $length = $request->get('length', 50);
            $paginatedGroups = $groupedTracks->slice($start, $length);

            $data = [];
            $index = $start + 1;

            foreach ($paginatedGroups as $group) {
                $idType = $group->first()->Id_Type;
                $types = explode(';', $idType);
                $no = $types[0] ?? '';
                $nameType = $types[2] ?? '';
                $production = $types[3] ?? '';

                // Build pic HTML
                $picHtml = '<div class="d-flex px-2 py-1">';
                foreach ($group as $track) {
                    if ($track->track_photo->first()) {
                        $picHtml .= '<img src="' . asset('uploads/' . $track->track_photo->first()->Path_Track_Photo) . '"
                                      alt="' . $track->track_photo->first()->Name_Photo_Angle . '"
                                      class="avatar avatar-sm me-3 border-radius-lg">';
                    }
                }
                $picHtml .= '</div>';

                // Build number HTML
                $numberHtml = '<div class="d-flex flex-column justify-content-center">
                                <p class="text-xs text-secondary mb-0">' . $no . '</p>
                                <h6 class="mb-0 text-sm text-primary">' . $nameType . '</h6>
                                <p class="text-xs text-secondary mb-0">' . $production . '</p>
                            </div>';

                // Build area HTML
                $areaHtml = '';
                foreach ($group as $track) {
                    $areaHtml .= '<p class="text-xs text-primary mb-0">' . $track->area->Name_Area . '</p>';
                }

                // Build user HTML
                $userHtml = '';
                foreach ($group as $track) {
                    $userHtml .= '<p class="text-xs text-secondary mb-0">' . $track->user->Name_User . '</p>';
                }

                // Build record HTML
                $recordHtml = '';
                foreach ($group as $track) {
                    $time = \Carbon\Carbon::parse($track->Time_Track);
                    $recordHtml .= '<p class="text-xs text-secondary mb-0">
                                    <span class="text-primary">' . $time->format('Y-m-d') . '</span> ' . $time->format('H:i:s') . '
                                  </p>';
                }

                // Build action HTML
                $actionHtml = '<div class="d-flex justify-content-center">
                                <a href="' . route('report.detail', ['Id_Type' => $idType]) . '"
                                   class="badge badge-sm bg-gradient-primary text-white text-xs">
                                   <i class="material-symbols-rounded">app_registration</i>
                                </a>
                            </div>';

                $data[] = [
                    'DT_RowIndex' => $index++,
                    'pic' => $picHtml,
                    'number' => $numberHtml,
                    'area' => $areaHtml,
                    'user' => $userHtml,
                    'record' => $recordHtml,
                    'action' => $actionHtml
                ];
            }

            return response()->json([
                'draw' => intval($request->get('draw')),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data
            ]);
        }

        return view('admins.reports.index', compact('page', 'user', 'date'));
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

    public function indexAll(Request $request)
    {
        $page = 'report';

        $Id_User = session('Id_User');
        $user = User::find($Id_User);

        if ($request->ajax()) {
            // Get search keyword
            $search = $request->get('search')['value'] ?? '';

            // Log the search for debugging
            \Log::info('IndexAll Search Query:', ['search' => $search, 'request' => $request->all()]);

            // Ambil semua track dan kelompokkan berdasarkan Id_Type
            $tracks = Track::with('user', 'area', 'track_photo')
                ->orderBy('Time_Track', 'desc')
                ->get();

            // Kelompokkan berdasarkan Id_Type
            $groupedTracks = $tracks->groupBy('Id_Type');

            \Log::info('Before Search Filter:', ['count' => $groupedTracks->count()]);

            // Apply search filter if exists - filter the grouped collection
            if (!empty($search)) {
                $groupedTracks = $groupedTracks->filter(function ($group) use ($search) {
                    $firstTrack = $group->first();

                    // Search in Id_Type (number)
                    if (stripos($firstTrack->Id_Type, $search) !== false) {
                        return true;
                    }

                    // Search in any area name within the group
                    foreach ($group as $track) {
                        if (stripos($track->area->Name_Area, $search) !== false) {
                            return true;
                        }
                    }

                    // Search in any user name within the group
                    foreach ($group as $track) {
                        if (stripos($track->user->Name_User, $search) !== false) {
                            return true;
                        }
                    }

                    return false;
                });

                \Log::info('After Search Filter:', ['count' => $groupedTracks->count()]);
            }

            // Get total records before pagination
            $totalRecords = Track::select('Id_Type')->distinct()->count();
            $filteredRecords = $groupedTracks->count();

            // Manual pagination
            $start = $request->get('start', 0);
            $length = $request->get('length', 50);
            $paginatedGroups = $groupedTracks->slice($start, $length);

            $data = [];
            $index = $start + 1;

            foreach ($paginatedGroups as $group) {
                $idType = $group->first()->Id_Type;
                $types = explode(';', $idType);
                $no = $types[0] ?? '';
                $nameType = $types[2] ?? '';
                $production = $types[3] ?? '';

                // Build pic HTML
                $picHtml = '<div class="d-flex px-2 py-1">';
                foreach ($group as $track) {
                    if ($track->track_photo->first()) {
                        $picHtml .= '<img src="' . asset('uploads/' . $track->track_photo->first()->Path_Track_Photo) . '"
                                      alt="' . $track->track_photo->first()->Name_Photo_Angle . '"
                                      class="avatar avatar-sm me-3 border-radius-lg">';
                    }
                }
                $picHtml .= '</div>';

                // Build number HTML
                $numberHtml = '<div class="d-flex flex-column justify-content-center">
                                <p class="text-xs text-secondary mb-0">' . $no . '</p>
                                <h6 class="mb-0 text-sm text-primary">' . $nameType . '</h6>
                                <p class="text-xs text-secondary mb-0">' . $production . '</p>
                            </div>';

                // Build area HTML
                $areaHtml = '';
                foreach ($group as $track) {
                    $areaHtml .= '<p class="text-xs text-primary mb-0">' . $track->area->Name_Area . '</p>';
                }

                // Build user HTML
                $userHtml = '';
                foreach ($group as $track) {
                    $userHtml .= '<p class="text-xs text-secondary mb-0">' . $track->user->Name_User . '</p>';
                }

                // Build record HTML
                $recordHtml = '';
                foreach ($group as $track) {
                    $time = \Carbon\Carbon::parse($track->Time_Track);
                    $recordHtml .= '<p class="text-xs text-secondary mb-0">
                                    <span class="text-primary">' . $time->format('Y-m-d') . '</span> ' . $time->format('H:i:s') . '
                                  </p>';
                }

                // Build action HTML
                $actionHtml = '<div class="d-flex justify-content-center">
                                <a href="' . route('report.detail', ['Id_Type' => $idType]) . '"
                                   class="badge badge-sm bg-gradient-primary text-white text-xs">
                                   <i class="material-symbols-rounded">app_registration</i>
                                </a>
                            </div>';

                $data[] = [
                    'DT_RowIndex' => $index++,
                    'pic' => $picHtml,
                    'number' => $numberHtml,
                    'area' => $areaHtml,
                    'user' => $userHtml,
                    'record' => $recordHtml,
                    'action' => $actionHtml
                ];
            }

            return response()->json([
                'draw' => intval($request->get('draw')),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
                'data' => $data
            ]);
        }

        return view('admins.reports.all', compact('page', 'user'));
    }
}
