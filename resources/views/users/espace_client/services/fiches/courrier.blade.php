<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Formulaire de demande de prestation</title>
    <style>
        font-face {
            font-family: 'Gotham-Book';
            src: url('/Polices/Gotham-Book.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        @page {
            size: A4;
        }

        body {
            font-family: 'Gotham-Book', sans-serif;
            color: #000;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        /* Filigrane */
        .content {
            position: relative;
            z-index: 1;
        }

        .header {
            width: 100%;
            height: 140px;
            margin-bottom: 4mm;
            font-size: 13px;
        }

        .sender {
            float: left;
            line-height: 1.7;
            font-size: 13px;
        }

        .date {
            float: right;
            font-size: 13px;
            text-align: right;
            max-width: 70mm;
        }

        .recipient {
            text-align: right;
            margin-bottom: 5mm;
            font-size: 13px;
            line-height: 1.3;
        }

        .objet {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 5mm;
            font-size: 14px;
        }

        .body {
            font-size: 14px;
            line-height: 1.3;
        }

        .body p {
            margin: 0 0 2mm 0;
        }

        .closing {
            margin-top: 5mm;
            text-align: right;
            font-size: 14px;
        }
        .closing-yako {
            margin-top: 5mm;
            text-align: left;
            font-size: 14px;
        }

        .attachments {
            margin-top: 2mm;
            font-size: 14px;
        }

        .attachments ul {
            list-style: none;
            padding: 0;
            margin: 3mm 0 0 0;
        }

        .attachments li {
            margin-bottom: 2mm;
        }

        .attachments input {
            margin-right: 6px;
        }
    </style>
</head>

<body>
    @php
        \Carbon\Carbon::setLocale('fr');
    @endphp

    
    <div class="page">
        <div class="content" style="position: relative; height: 100%; width: 100%; overflow: hidden;">
            <div
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
                    background: url('data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('cust_assets/images/logo.png'))) }}') no-repeat center center; 
                    background-size: contain; opacity: 0.3; z-index: -1;">
            </div>
            <!-- En-tête -->
            <div class="header">
                <div class="sender">
                    NOM : {{ $prestation->nom }} <br>
                    PRENOMS : {{ $prestation->prenom }} <br>
                    ADRESSE MAIL : {{ $prestation->email }} <br>
                    TELEPHONE : {{ $prestation->cel }} <br>
                    ID CONTRAT : {{ $prestation->idcontrat }} <br>
                    LIEU DE RESIDENCE : {{ $prestation->lieuresidence }}
                </div>
                <div class="date">
                    Fait à {{ $prestation->lieuresidence }} , le {{ \Carbon\Carbon::parse($prestation->created_at)->translatedFormat('d F Y') }}
                </div>
            </div>

            <!-- Destinataire -->
            <div class="recipient">
                <strong>À MONSIEUR LE DIRECTEUR GENERAL</strong> <br>
                DE YAKO AFRICA Assurances Vie
            </div>

            <!-- Objet -->
            <div class="objet">OBJET : {{ $prestation->typeprestation }}</div>

            <!-- Corps -->
            <div class="body" style="text-align: justify;">
                {!! $prestation->msgClient !!}
            </div>

            <!-- Clôture -->

            <div class="signature" style="width: 100%;">
                <div class="closing-yako" style="width: 50%; float: left;">
                    YAKO AFRICA Assurances Vie <br><br>
                    <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('cust_assets/images/cachet-yako.jpeg'))) }}"
                        alt="" style="width: 150px; height: 50px;">
                </div>
                
                <div class="closing" style="width: 50%; float: right;">
                    L’intéressé <br><br>
                    <small><i>Lu et approuvé</i> </small> <br>
                    @if ($imageSrc != '')
                        <img src="{{ $imageSrc }}" alt="Signature" style="width: 150px; height: 50px;">
                    @endif
                </div>
            </div>
            

            <!-- Pièces jointes -->
            <div class="attachments" style="text-align: justify; margin-top: 150px;">
                <span><strong>Pièces jointes :</strong></span>
                <ul>
                    @foreach ($prestation->docPrestation as $doc)
                        <li><input type="checkbox" checked> {{ $doc->filename }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
