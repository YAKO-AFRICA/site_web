<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="{{ asset('cust_assets/css/custom.css')}}" rel="stylesheet"> --}}
    <title>Formulaire de demande de prestation</title>
    <style>
        font-face {
            font-family: 'Gotham-Book';
            src: url('/Polices/Gotham-Book.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }
        @page {
            margin: 0; /* Supprimer les marges par défaut */
            padding: 0;
        }
        * {
            margin: 0px;
            padding: 0px;
            /* box-sizing: border-box; */
        }
        body {
            font-family: 'Gotham-Book', sans-serif;
            margin: 0px;
            padding: 0px;
            height: 100%;
            width: 100%;
            /* font-family: Arial, sans-serif; */
        }
        
        .green-bar {
            float: right;
            
        }

        /* .banner{
            border: #ccc solid 1px;
        } */

        /* Section droite : logo et sous-titre */
        .right-section {
            float: left;
            width: 18%;
            /* border: #ccc solid 1px; */
            margin-right: 10px;
            padding:15px 25px;
            height: 80%;
        }

        .logo {
            height: 80%;
            width: 90%;

            /* margin-bottom: 5px; */
        }
        .form-group {
            margin-bottom: 15px;
            position: relative;
        } 
        .section-prestation{
            display: inline-block;
            padding: 10px 0;
            width: 100%;
        }
        
        .prestation{
            float: left;
            width: 51%;
            border-right: #ccc solid 1px;
            margin-right: 15px;
        }
        .moyenPaiement{
            float: right;
            width: 48%;
            /* border: red solid 1px; */
        }
        .section-signature{
            position: relative;
            display: inline-block;
            /* padding: 10px 0; */
            margin-top: 90px;
            margin-bottom: -95px;
            width: 100%;
        }
        .Autres{
            position: relative;
            left: -375px;
            /* float: left; */
            width: 48%;
            /* border-right: #ccc solid 1px; */
            margin-right: 15px;
        }
        .Signature{
            /* float: right; */
            position: relative;
            left: 40px;
            top: -195px;
            width: 48%;
            /* border: red solid 1px; */
        }
        .section-documents {
            border-top: 1px dashed #ccc;
        }
    </style>
</head>
<body >

    
    <main class="main">   
        <section class="main-section" style="position: relative; height: 100%; width: 100%; overflow: hidden;">
            <header class="banner" style="width: 100%; background-color: #ffffff; height: 95px; margin: 0px">
                <div class="left-section" style="float: right; height: 100%; width: 75%;">
                    <div class="yellow-bar" style="background-color: #f7b500; width: 100%; height: 50%;"></div>
                    <div class="green-bar-title"style="width: 100%; height: 50%; border: 1px solid #fff;">
                        <div class="green-bar" style="background-color: #006838; width: 35%; height: 100%;"></div>
                        <div class="center-section" style="float: left; width: 75%; height: 100%; padding: 10px 0; text-align: left;">
                            <h4>FORMULAIRE DE DEMANDE DE PRESTATION</h4>
                        </div>
                    </div>
                </div>
                <div class="right-section">
                    <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('cust_assets/images/logo.png'))) }}" alt="Yako Africa Logo" class="logo">
                </div>
            </header>
            <!-- Pseudo-élément pour l'image de fond -->
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
                background: url('data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path("cust_assets/images/bg-logo.png"))) }}') no-repeat center; 
                background-size: contain; opacity: 0.1; z-index: 1;">
            </div>
            <label for="cachet" style="position: absolute; top: 55px; left: 200px; max-height: 120px; max-width: 130px; z-index: -2;">
                <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('cust_assets/images/cachet-yako.jpeg'))) }}" alt="Yako Africa Logo" style="height: 120px; width: 130px" class="logo">
            </label>
            <div class="content" style="padding: 0px 20px; margin-top: 14px;">
                <section class="section-identification">
                    <h5>IDENTIFICATION DECLARANT</h5>
                    <div class="form-group">
                        <label for="nom" style="margin-right: 40px">Nom</label>
                        <input type="text" style="
                            margin-bottom: -7px;
                            margin-top: 25px;
                            width: 86%;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;" id="nom" value="jhdcsdyh" />
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom(s)</label>
                        <input type="text" id="prenom" 
                        style="
                            width: 86%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;" name="prenom" value="jdfvihjvfij" />
                    </div>
                    <div class="form-group">
                        <label for="prenom">M</label>&nbsp;
                        <input type="text" 
                        style="
                            width: 2%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            text-align:center;
                            color: #F7A400;
                            border-radius: 3px;
                            background-color: #ffffff;" value="dzd" /> &nbsp; &nbsp;
                        <label for="prenom">F</label>&nbsp;
                        <input type="text" 
                        style="
                            width: 2%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            color: #F7A400;
                            text-align:center;
                            border-radius: 3px;
                            background-color: #ffffff;" value="X" /> &nbsp; &nbsp; &nbsp;&nbsp;

                        <label for="prenom">Date de naissance&nbsp;</label>
                        <input type="text" id="prenom" 
                        style="
                            width: 17%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;" name="prenom" value="czc" />&nbsp; &nbsp; &nbsp;
                        <label for="prenom">Lieu de naissance&nbsp;</label>
                        <input type="text" id="prenom" 
                        style="
                            width: 17%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;" name="prenom" value="czc" />
                    </div>
                    <div class="form-group">
                        <label for="nom" style="margin-right: 10px">Téléphone</label>
                        <input type="text" style="
                            margin-bottom: -7px;
                            margin-top: 25px;
                            width: 31%;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;" id="nom" name="nom" value="xaxa" />&nbsp; &nbsp; &nbsp;

                        <label for="nom" style="margin-right: 55px">WhatsApp </label>
                        <input type="text" style="
                            margin-bottom: -7px;
                            margin-top: 25px;
                            width: 30%;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;" id="nom" name="nom" value="dazx" />
                    </div>
                    <div class="form-group">
                        <label for="prenom" style="margin-right: 45px">Email</label>
                        <input type="text" id="prenom" 
                        style="
                            width: 31%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;" name="prenom" value="dadz" />&nbsp; &nbsp;&nbsp;&nbsp;
                        <label for="prenom" style="margin-right: 2px">Lieu de residence&nbsp;</label>
                        <input type="text" id="prenom" 
                        style="
                            width: 30%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;" name="prenom" value="azdéc" />
                    </div>
                </section>
                <section class="section-prestation">
                    <div class="prestation">
                        <h5>PRESTATION</h5>
                        <div class="form-group">
                            <label for="nom" style="margin-right: 4px">ID Contrat &nbsp;</label>
                            <input type="text" style="
                                margin-bottom: -7px;
                                margin-top: 25px;
                                width: 64%;
                                border: 1px solid #90C8A7;
                                padding: 5px;
                                font-size: 14px;
                                border-radius: 3px;
                                background-color: #ffffff;" id="nom" name="nom" value="vzc" />
                        </div>
                        <div class="form-group" style="margin-top: 15px; width: 100%;">
                            {{-- <div style="width: 100%; margin-bottom: 15px;">
                                <label for="nom" style="margin-right: 10px;">Type de prestation</label>
                            </div> --}}
                            <div style="display: inline-block; width: 45%;">
                                <label for="prenom">Transformation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input type="text" 
                                style="
                                    width: 4%;
                                    margin-bottom: -7px;
                                    border: 1px solid #90C8A7;
                                    padding: 5px 10px;
                                    font-size: 14px;
                                    text-align:center;
                                    color: #F7A400;
                                    border-radius: 3px;
                                    background-color: #ffffff;" name="prenom" value="X" />
                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div style="display: inline-block; width: 45%; margin-left: 10px;">
                                <label for="prenom">Terme &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input type="text" 
                                style="
                                    width: 4%;
                                    margin-bottom: -7px;
                                    border: 1px solid #90C8A7;
                                    padding: 5px 10px;
                                    font-size: 14px;
                                    text-align:center;
                                    color: #F7A400;
                                    border-radius: 3px;
                                    background-color: #ffffff;" name="prenom" value="X" />
                            </div>
                            <div style="display: inline-block; width: 45%; margin-top: 15px;">
                                <label for="prenom">Rachat total &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input type="text" 
                                style="
                                    width: 4%;
                                    margin-bottom: -7px;
                                    border: 1px solid #90C8A7;
                                    padding: 5px 10px;
                                    font-size: 14px;
                                    text-align:center;
                                    color: #F7A400;
                                    border-radius: 3px;
                                    background-color: #ffffff;" name="prenom" value="X" />
                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div style="display: inline-block; width: 45%;">
                                <label for="prenom">Renonciation &nbsp;</label>
                                <input type="text" 
                                style="
                                    width: 4%;
                                    margin-bottom: -7px;
                                    border: 1px solid #90C8A7;
                                    padding: 5px 10px;
                                    font-size: 14px;
                                    text-align:center;
                                    color: #F7A400;
                                    border-radius: 3px;
                                    background-color: #ffffff;" name="prenom" value="X" />
                            </div>
                            <div style="display: inline-block; width: 45%; margin-top: 15px;">
                                <label for="prenom">Résiliation &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input type="text" 
                                style="
                                    width: 4%;
                                    margin-bottom: -7px;
                                    border: 1px solid #90C8A7;
                                    padding: 5px 10px;
                                    font-size: 14px;
                                    text-align:center;
                                    color: #F7A400;
                                    border-radius: 3px;
                                    background-color: #ffffff;" name="prenom" value="X" />
                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div style="display: inline-block; width: 45%;">
                                <label for="prenom">Dénonciation &nbsp;</label>
                                <input type="text" 
                                style="
                                    width: 4%;
                                    margin-bottom: -7px;
                                    border: 1px solid #90C8A7;
                                    padding: 5px 10px;
                                    font-size: 14px;
                                    text-align:center;
                                    color: #F7A400;
                                    border-radius: 3px;
                                    background-color: #ffffff;" name="prenom" value="X" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nom" style="margin-right: 4px">Montant souhaité</label>
                            <input type="text" style="
                                margin-bottom: -7px;
                                margin-top: 5px;
                                width: 53%;
                                border: 1px solid #90C8A7;
                                padding: 5px;
                                font-size: 14px;
                                border-radius: 3px;
                                background-color: #ffffff;" id="nom" name="nom" value="ccdc  FCFA" />
                        </div>
                    </div>
                    <div class="moyenPaiement">
                        <h5>MOYENS DE PAIEMENT</h5>
                        <div class="form-group">
                            <label for="nom" style="margin-right: 4px">Mobile Money</label>
                            <input type="text" style="
                                margin-bottom: -7px;
                                margin-top: 25px;
                                width: 4%;
                                text-align: center;
                                border: 1px solid #90C8A7;
                                padding: 5px;
                                font-size: 14px;
                                color: #F7A400;
                                border-radius: 3px;
                                background-color: #ffffff;" id="nom" name="" value="X" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <label for="virementBancaire" style="margin-right: 4px">Virement Bancaire &nbsp;&nbsp;&nbsp;</label>
                            <input type="text" 
                                style="
                                    margin-bottom: -7px;
                                    margin-top: 25px;
                                    width: 4%;
                                    text-align: center;
                                    border: 1px solid #90C8A7;
                                    padding: 5px;
                                    font-size: 14px;
                                    color: #F7A400;
                                    border-radius: 3px;
                                    background-color: #ffffff;" 
                                id="virementBancaire" 
                                value="X" />
                        </div>
                        <div class="form-group" style="width: 100%;margin-top: 25px;">
                            <div style="display: inline-block;width: 30%;">
                                <label for="orangeMoney">Orange <br> Money &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input type="text" 
                                style="
                                width: 4%;
                                margin-bottom: -7px;
                                border: 1px solid #90C8A7;
                                padding: 5px 10px;
                                font-size: 14px;
                                text-align: center;
                                color: #F7A400;
                                border-radius: 3px;
                                background-color: #ffffff;" 
                                id="orangeMoney" 
                                value="X" />
                            </div>&nbsp;&nbsp;
                            <div style="display: inline-block;width: 30%;">
                                <label for="moovMoney">Moov <br> Money &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input type="text" 
                                style="
                                    width: 4%;
                                    margin-bottom: -7px;
                                    border: 1px solid #90C8A7;
                                    padding: 5px 10px;
                                    font-size: 14px;
                                    text-align: center;
                                    color: #F7A400;
                                    border-radius: 3px;
                                    background-color: #ffffff;" 
                                id="moovMoney" 
                                value="X" />
                            </div>&nbsp;&nbsp;
                            <div style="display: inline-block;width: 30%;">
                                <label for="mtnMoney">MTN <br> Money &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input type="text" 
                                style="
                                    width: 4%;
                                    margin-bottom: -7px;
                                    border: 1px solid #90C8A7;
                                    padding: 5px 10px;
                                    font-size: 14px;
                                    text-align: center;
                                    color: #F7A400;
                                    border-radius: 3px;
                                    background-color: #ffffff;" 
                                id="mtnMoney" 
                                value="X" />
                            </div>&nbsp;&nbsp;
                        </div>
                        <div class="form-group" style="margin-top: 5px;">
                            <label for="telPaiement" style="margin-right: 4px">Numéro de paiement</label>
                            <input type="text" 
                                style="
                                    margin-bottom: -7px;
                                    margin-top: 5px;
                                    width: 50%;
                                    border: 1px solid #90C8A7;
                                    padding: 5px;
                                    font-size: 14px;
                                    color: #F7A400;
                                    border-radius: 3px;
                                    background-color: #ffffff;" 
                                id="telPaiement" 
                            value="fev"/> 
                        </div>
                        
                    </div>
                    
                </section>
                <section class="section-signature" style="border: #fff solid 1px">
                    <div class="Autres" >
                        <h6>Autres Informations</h6>
                        
                        <div class="form-group">
                            <textarea name="" id="" style="
                            margin-bottom: -7px;
                            margin-top: 5px;
                            width: 100%;
                            padding: 5px;
                            text-align: justify;
                            border: 1px solid #90C8A7;
                            height: 120px;
                            font-size: 12px;
                            border-radius: 3px;
                            background-color: #ffffff;" cols="30" rows="100">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit ex, debitis, perspiciatis suscipit quae beatae rem in, possimus corrupti sequi sit fuga error dignissimos necessitatibus dicta. Illo, distinctio a, delectus saepe voluptatem nihil esse nostrum dolorem ab mollitia blanditiis error molestias, alias accusantium consequatur facilis sapiente quasi. Labore aut iusto, facere neque voluptate quaerat omnis!</textarea>
                            
                        </div>
                    </div>
                    <div class="Signature">
                        <h6>Signature du déclarant</h6><small><p style="font-size: 0.57em; margin-top: -98px; margin-left:130px">Contrôle éffectué par OTP du 17/12/2024 14:52</p></small>
                        <div class="form-group">
                            <label for="nom" style="margin-right: 24px">Fait à</label>
                            <input type="text" style="
                                margin-bottom: -7px;
                                margin-top: 25px;
                                width: 67%;
                                border: 1px solid #90C8A7;
                                padding: 5px;
                                font-size: 14px;
                                border-radius: 3px;
                                background-color: #ffffff;" id="nom" name="nom" value="czczc" />
                        </div>
                        <div class="form-group">
                            <label for="prenom">Le &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</label>&nbsp;
                            <input type="text" 
                            style="
                                width: 67%;
                                margin-bottom: -7px;
                                border: 1px solid #90C8A7;
                                padding: 5px;
                                font-size: 14px;
                                border-radius: 3px;
                                background-color: #ffffff;" name="" value="dzcsdc" /> <br> <br>
                            
                        </div>
                        
                    </div>
                    
                    <label for="signature" style="position: absolute; top: 200px; left: 200px; max-height: 65px; max-width: 65px;">
                        <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('cust_assets/images/logo.png'))) }}" alt="Yako Africa Logo" style="height: 65px; width: 65px" class="logo">
                    </label>
                    <label for="qrcode" style="position: absolute; top: 200px; left: 280px;">
                        <img src="data:image/png;base64,{{ $qrcode }}" alt="QR Code">
                    </label>
                </section>
            </div>
            <section class="section-documents" style="background-color: #E7F0EB; padding: 0px 20px; height: 322px; margin-top: -15px;">
                <h5 style="color: #006838">Zone réservée à YAKO AFRICA</h5>
                <div class="form-group" style="margin-top: 15px">
                    <label for="prenom" style="margin-right: 2px;">Nom et Prenoms &nbsp;</label>
                    <input type="text" id="prenom" 
                        style="
                            width: 40%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                        value="sas&z" />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
                    <label for="prenom" style="margin-right: 2px;">Code Manager&nbsp;</label>
                    <input type="text" id="prenom" 
                        style="
                            width: 15%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                        value="dzde" />
                </div>
                <div class="form-group" style="margin-top: 15px">
                    <label for="" style="margin-right: 2px;">Date RDV &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" id="" 
                        style="
                            width: 40%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                        value="sas&z" />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
                    <label for="prenom" style="margin-right: 2px;">Code RDV &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" id="prenom" 
                        style="
                            width: 15%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                        value="dzde" />
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <label for="" style="margin-right: 2px;">Montants <br> des primes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="" style="margin-right: 2px;">Invest</label>
                    <input type="text" id="" 
                        style="
                            width: 20%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                        value="sas&z" />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
                    <label for="prenom" style="margin-right: 2px;">Sureté </label>
                    <input type="text" id="prenom" 
                        style="
                            width: 20%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                        value="dzde" />
                </div>
                <p for="prenom" style="margin-right: 2px; margin-top: 20px;"><strong>Pièce jointes</strong></p>
                <div class="form-group" style="margin-top: 20px">
                    <label for="prenom">Copie du contrat &nbsp; &nbsp;&nbsp;&nbsp;</label>
                            <input type="text" 
                                style="width: 4%; margin-bottom: -7px; border: 1px solid #90C8A7; padding: 5px; font-size: 14px; text-align:center; color: #F7A400; border-radius: 3px; background-color: #ffffff;"
                                value="X" />&nbsp; &nbsp;

                    <label for="prenom">Bulletin de souscription Invest &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</label>
                    <input type="text" 
                           style="width: 4%; margin-bottom: -7px; border: 1px solid #90C8A7; padding: 5px; font-size: 14px; text-align:center; color: #F7A400; border-radius: 3px; background-color: #ffffff;"
                           value="X" />&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                    <label for="prenom">RIB &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" style="width: 4%; margin-bottom: -7px; border: 1px solid #90C8A7; padding: 5px; font-size: 14px; text-align:center; color: #F7A400; border-radius: 3px; background-color: #ffffff;"
                           value="X" /> <br><br>
                    <label for="prenom">Attestation de <br> déclaration de <br>perte du contrat &nbsp; &nbsp;&nbsp;&nbsp; </label> 
                    <input type="text" style="width: 4%; margin-bottom: -7px; border: 1px solid #90C8A7; padding: 5px; text-align:center; color: #F7A400; font-size: 14px; border-radius: 3px; background-color: #ffffff;"
                           value="X" />&nbsp; &nbsp; 
                    <label for="prenom">Fiche d'identification du N° de téléphone &nbsp;&nbsp;</label>
                    <input type="text" style="width: 4%; margin-bottom: -7px; border: 1px solid #90C8A7; padding: 5px; text-align:center; color: #F7A400; font-size: 14px; border-radius: 3px; background-color: #ffffff;"
                           value="X" />&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                
                    <label for="prenom">Copie CNI&nbsp;&nbsp;</label>
                    <input type="text" style="width: 4%; margin-bottom: -7px; border: 1px solid #90C8A7; padding: 5px; text-align:center; color: #F7A400; font-size: 14px; border-radius: 3px; background-color: #ffffff;"
                           value="X" />&nbsp; &nbsp;
                </div>
            </section>
        </section>
    </main>
</body>
</html>