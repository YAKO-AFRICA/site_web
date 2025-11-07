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
            /* display: flex; */
            width: 100%;
            height: 140px;
            /* justify-content: space-between; */
            margin: 10mm 0;
            font-size: 13px;
            /* line-height: 1.6; */
        }

        .sender {
            float: left;
            line-height: 1.7;
            font-size: 13px;
            margin-top: 7mm;
        }

        .date {
            float: right;
            font-size: 13px;
            text-align: right;
            max-width: 70mm;
            margin-top: 15mm;
        }

        .recipient {
            text-align: right;
            margin: 10mm 0;
            font-size: 13px;
            line-height: 1.3;
        }

        .objet {
            font-weight: bold;
            text-decoration: underline;
            margin: 10mm 0;
            font-size: 14px;
        }

        .body {
            font-size: 14px;
            line-height: 1.3;
            margin: 10mm 0;
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
                    NOM : Doe <br>
                    PRENOMS : John Doe <br>
                    ADRESSE MAIL : johndoe@gmail.com <br>
                    TELEPHONE : +226 66 66 66 66 <br>
                    ID CONTRAT : 123456789 <br>
                    LIEU DE RESIDENCE : Abidjan
                </div>
                <div class="date">
                    Fait à Abidjan , le 10 juin 2023
                </div>
            </div>

            <!-- Destinataire -->
            <div class="recipient">
                 <p style="text-align: right; margin-right: 5mm;"><strong>À</strong></p> 
                <p style="text-align: right;">
                MONSIEUR LE DIRECTEUR GENERAL 
                <br>YAKO AFRICA Assurances Vie</p> 
                
                
            </div>

            <!-- Objet -->
            <div class="objet">OBJET : DEMANDE DE PRET</div>

            <!-- Corps -->
            <div class="body" style="text-align: justify;">
                <p>
                    Monsieur,<br><br>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate, reprehenderit. Quo harum,
                    impedit molestiae libero optio minima quasi cumque amet facere esse nesciunt sapiente repellat, ut a
                    officiis odio accusantium! <br>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, quae. Quia, voluptatum! Natus, eaque.
                    Quisquam, quia. Quo, quibusdam. Quibusdam, quos. Quisquam, quia. Quo, quibusdam.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia accusantium eius aperiam obcaecati
                    corrupti deserunt iusto, ipsam, placeat odio quaerat aut est dolorum, earum delectus architecto a
                    consectetur incidunt minus!
                </p>

            </div>

            <div class="signature" style="width: 100%;">
                <div class="closing-yako" style="width: 50%; float: left;">

                </div>
                <div class="closing" style="width: 50%; float: right; margin-right: 8mm;">
                    <u>L’intéressé(e)</u> <br><br>
                    <small><i>Lu et approuvé</i> </small> <br> <br>
                    <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('cust_assets/images/sign.jpeg'))) }}"
                        alt="" style="width: 170px;">
                </div>
            </div>
            <!-- Pièces jointes -->
            <div class="attachments" style="text-align: justify; margin-top: 200px;">
                <span><strong>Pièce(s) jointe(s) :</strong></span>
                <ul>
                    <li><input type="checkbox" checked> Copie de la pièce d'identité</li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
