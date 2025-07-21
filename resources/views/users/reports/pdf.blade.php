<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Track Report</title>
    <style>
        @page {
            margin: 40px 50px 40px 50px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .img {
            margin-top: 10px;
            max-width: 100%;
            height: auto;
            max-height: 260px;
        }

        .footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 50px;
        }
    </style>
</head>
<body>
    @php
        $types = explode(';', $track->Id_Type);
        $No = $types[0];
        $Name_Type = $types[2];
        $Production = $types[3];
    @endphp
    <h2>Track Report</h2>
    <p><strong>Tractor:</strong> {{ $track->Id_Type }}</p>
    <p><strong>Area:</strong> {{ $track->area->Name_Area ?? '-' }}</p>
    <p><strong>User:</strong> {{ $track->user->Name_User ?? '-' }}</p>
    <p><strong>Time:</strong> {{ $track->Time_Track ?? '-' }}</p>
    <h3><strong>Type:</strong> {{ $Name_Type ?? '-' }}</h3>

    <p><strong>Image:</strong></p>
    @foreach($track->track_photo as $photo)
        <div style="page-break-inside: avoid;">
            <h5>- {{ $photo->Name_Photo_Angle }}</h5>
            <img src="{{ asset('uploads/' . $photo->Path_Track_Photo) }}" alt="Image" class="img">
        </div>
    @endforeach

    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("DejaVu Sans", "normal");
                $size = 10;
                $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
                $x = 520;
                $y = 820;
                $pdf->text($x, $y, $pageText, $font, $size);
            ');
        }
    </script>
</body>
</html>
