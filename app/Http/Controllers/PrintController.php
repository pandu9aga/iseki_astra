<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PrintController extends Controller
{
    public function printTest()
    {
        $printerIp = '192.168.173.137';
        $printerPort = 9100;

        // 1. Generate PDF sederhana
        $html = '
        <h1>Testing Print dari Laravel</h1>
        <p>Tanggal: ' . now()->format('d-m-Y H:i:s') . '</p>
        <p>Printer: Ricoh MP C4504ex</p>
        <p>Status: Berhasil dikirim!</p>
        ';

        $pdf = PDF::loadHTML($html);
        $pdfContent = $pdf->output(); // dapatkan sebagai binary string (tidak simpan ke file)

        // 2. Kirim ke printer via port 9100
        $socket = @fsockopen($printerIp, $printerPort, $errno, $errstr, 10);

        if (!$socket) {
            return response()->json([
                'success' => false,
                'message' => "Gagal terhubung ke printer: $errstr ($errno)"
            ], 500);
        }

        // Set timeout agar tidak hang
        stream_set_timeout($socket, 10);

        // Kirim data PDF
        $bytesSent = fwrite($socket, $pdfContent);
        fclose($socket);

        if ($bytesSent === false || $bytesSent === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim data ke printer.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil dikirim ke printer!',
            'bytes_sent' => $bytesSent
        ]);
    }
}