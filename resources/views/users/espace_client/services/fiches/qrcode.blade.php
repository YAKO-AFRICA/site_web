{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .page {
            margin-bottom: 20px;
            text-align: center;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="page">
        <img src="data:image/jpeg;base64,{{ $rectoContent }}" alt="CNI Recto">
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code - Espace Client</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            margin-top: 30px;
        }
         .page {
             border-bottom: #ddd dotted 2px;
             margin: 0 auto;
         }
        .qr-container {
            position: relative;
            width: 370px;
            height: 370px;
            margin: 0px auto;
            /* border: #076633 solid 1px; */
        }
        .qr-container img {
            width: 100%;
            height: 100%;
        }
        .logo-overlay {
            position: absolute;
            top: 31%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 70px;
            height: 70px;
            /* padding: 6px; */
            background-color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo-overlay img {
            width: 65px;
            height: 65px;
        }
        .title {
            font-size: 2.2em; 
            color: #076633; 
            margin-bottom: 75px
        }
    </style>
</head>
<body>

    <div class="page">
        <h1 class="title">MON ESPACE CLIENT</h1>
        <div class="container">
            <div class="qr-container">
                <!-- QR Code -->
                <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code">
                
                <!-- Logo centré -->
                <div class="logo-overlay">
                    <img src="{{ $logoUrl }}" alt="Logo">
                </div>
            </div>
        </div>
    </div>
    <div class="page">
        <h1 class="title">MON ESPACE CLIENT</h1>
        <div class="container">
            <div class="qr-container">
                <!-- QR Code -->
                <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code">
                
                <!-- Logo centré -->
                <div class="logo-overlay">
                    <img src="{{ $logoUrl }}" alt="Logo">
                </div>
            </div>
        </div>
    </div>

</body>
</html>
