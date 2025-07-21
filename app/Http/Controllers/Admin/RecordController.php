<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class RecordController extends Controller
{
    public function index(){
        $page = 'record';

        $Id_User = session('Id_User');
        $user = User::find($Id_User);

        // Ambil semua file dari public/downloads/track
        $files = Storage::disk('downloads')->files('track');

        // Filter hanya yang berekstensi .pdf
        $pdfFiles = collect($files)->filter(function ($file) {
            return strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'pdf';
        })->values();

        return view('admins.records.index', compact('page', 'user', 'pdfFiles'));
    }

    public function download($filename)
    {
        $filePath = 'track/' . $filename;

        if (Storage::disk('downloads')->exists($filePath)) {
            return response()->download(public_path('downloads/' . $filePath));
        }

        abort(404, 'File not found');
    }
}
