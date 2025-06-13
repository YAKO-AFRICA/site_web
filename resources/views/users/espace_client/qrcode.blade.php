{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="text-align: center; margin-top: 20px;">
        <p style="color: #076633; font-family: sans-serif; font-size: 5.3em; line-height: 0">Scanner moi</p>
        <img style="color: #076633; border-radius: 7px;" src="data:image/svg+xml;base64,{{ $qrcode }}" alt="QR Code">
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <title>Mon espace client</title>
</head>
<body>
    <center class="mt-5">
        <h1 class="text-center text-uppercase text-success mb-4" style="font-size: 3.3em;">MON ESPACE CLIENT</h1>
    
        <div style="position: relative; width: 600px; height: 600px; margin: 0 auto;">
            <!-- QR Code -->
            <div style="width: 100%; height: 100%;">
                {!! $qrCodeSvg !!}
            </div>
    
            <!-- SVG avec le logo centré -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600"
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; height: 100%;">
                <!-- Ajout d'un fond blanc circulaire -->
                <circle cx="300" cy="260" r="50" fill="white" />
    
                <!-- Centrer le logo -->
                <image href="{{ $logoUrl }}" x="255" y="215" width="90" height="90" />
            </svg>
        </div>
    </center>
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>