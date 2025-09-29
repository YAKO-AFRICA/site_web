<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="{{ asset('cust_assets/css/custom.css')}}" rel="stylesheet"> --}}
    <title>Formulaire de pré-déclaration de sinistre</title>
    <style>
        font-face {
            font-family: 'Gotham-Book';
            src: url('/Polices/Gotham-Book.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        @page {
            margin: 0;
            /* Supprimer les marges par défaut */
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
            padding: 15px 25px;
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

        .section-prestation {
            display: inline-block;
            padding: 10px 0;
            width: 100%;
        }

        .prestation {
            float: left;
            width: 51%;
            border-right: #ccc solid 1px;
            margin-right: 15px;
        }

        .moyenPaiement {
            float: right;
            width: 48%;
            /* border: red solid 1px; */
        }

        .section-signature {
            position: relative;
            display: inline-block;
            /* padding: 10px 0; */
            margin-top: 90px;
            margin-bottom: -95px;
            width: 100%;
        }

        .Autres {
            position: relative;
            left: -375px;
            /* float: left; */
            width: 48%;
            /* border-right: #ccc solid 1px; */
            margin-right: 15px;
        }

        .Signature {
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

<body>

    @php
        \Carbon\Carbon::setLocale('fr');
    @endphp
    
    <main class="main">
        <section class="main-section" style="position: relative; height: 100%; width: 100%; overflow: hidden;">
            <header class="banner" style="width: 100%; background-color: #ffffff; height: 95px; margin: 0px">
                <div class="left-section" style="float: right; height: 100%; width: 75%;">
                    <div class="yellow-bar" style="background-color: #f7b500; width: 100%; height: 50%;"></div>
                    <div class="green-bar-title"style="width: 100%; height: 50%; border: 1px solid #fff;">
                        <div class="green-bar" style="background-color: #006838; width: 35%; height: 100%;"></div>
                        <div class="center-section"
                            style="float: left; width: 75%; height: 100%; padding: 10px 0; text-align: left;">
                            <h4>FORMULAIRE DE DÉCLARATION DE SINISTRE</h4>
                        </div>
                    </div>
                </div>
                <div class="right-section">
                    <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('cust_assets/images/logo.png'))) }}"
                        alt="Yako Africa Logo" class="logo">
                </div>
            </header>

            <!-- Pseudo-élément pour l'image de fond -->
            <div
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
                background: url('data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('cust_assets/images/bg-logo.png'))) }}') no-repeat center; 
                background-size: contain; opacity: 0.1; z-index: 1;">
            </div>
            <label for="cachet"
                style="position: absolute; top: 55px; left: 200px; max-height: 120px; max-width: 130px; z-index: -2;">
                <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('cust_assets/images/cachet-yako.jpeg'))) }}"
                    alt="Yako Africa Logo" style="height: 120px; width: 130px" class="logo">
            </label>
            <div class="content" style="padding: 0px 20px; margin-top: 14px;">
                <section class="section-identification">
                    <div style="margin: 7px 0; width: 100%;">
                        <div style="width: 50%; text-align: start; float: left;">
                            <p>
                                <label for="nom" style="margin-right: 40px">ID Contrat</label>
                                <input type="text"
                                    style="
                                    margin-bottom: -7px;
                                    margin-top: 25px;
                                    width: 50%;
                                    border: 1px solid #90C8A7;
                                    padding: 5px;
                                    font-size: 14px;
                                    border-radius: 3px;
                                    background-color: #ffffff;"
                                    id="nom" value="{{ $sinistre->idcontrat ?? '.' }}" />
                            </p>
                        </div>
                        <div style="width: 50%; text-align: end; float: right;">
                            <p>
                                <label for="nom" style="margin-right: 40px">Type de Produit </label>
                                <input type="text"
                                    style="
                                    margin-bottom: -7px;
                                    margin-top: 25px;
                                    width: 50%;
                                    border: 1px solid #90C8A7;
                                    padding: 5px;
                                    font-size: 14px;
                                    border-radius: 3px;
                                    background-color: #ffffff;"
                                    id="nom" value="." />
                            </p>
                        </div>
                    </div>
                    <h5><u>IDENTIFICATION DECLARANT / BÉNÉFICIAIRE</u></h5>
                    <div class="form-group">
                        <label for="nom" style="margin-right: 40px">Nom</label>
                        <input type="text"
                            style="
                            margin-bottom: -7px;
                            margin-top: 25px;
                            width: 86%;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            id="nom" value="{{ $sinistre->nomDecalarant ?? '.' }}" />
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
                            background-color: #ffffff;"
                            name="prenom" value="{{ $sinistre->prenomDecalarant ?? '.' }}" />
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
                            background-color: #ffffff;"
                            value="." /> &nbsp; &nbsp;
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
                            background-color: #ffffff;"
                            value="." /> &nbsp; &nbsp; &nbsp;&nbsp;

                        <label for="prenom">Date de naissance&nbsp;</label>
                        <input type="text" id="prenom"
                            style="
                            width: 17%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            name="prenom" value="{{ $sinistre->datenaissanceDecalarant ?? '.' }}" />&nbsp; &nbsp; &nbsp;
                        <label for="prenom">Lieu de naissance&nbsp;</label>
                        <input type="text" id="prenom"
                            style="
                            width: 17%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            name="prenom" value="{{ $sinistre->lieunaissanceDecalarant ?? '.' }}" />
                    </div>
                    <div class="form-group" style="margin-top: -19px;">
                        <label for="nom" style="margin-right: 10px">Téléphone</label>
                        <input type="text"
                            style="
                            margin-bottom: -7px;
                            margin-top: 25px;
                            width: 31%;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            id="nom" name="nom" value="{{ $sinistre->celDecalarant ?? '.' }}" />&nbsp; &nbsp; &nbsp;

                        <label for="nom" style="margin-right: 7px">Filiation avec l'assuré(e) </label>
                        <input type="text"
                            style="
                            margin-bottom: -7px;
                            margin-top: 25px;
                            width: 23%;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            id="nom" name="nom" value="{{ $sinistre->filiation ?? '.' }}" />
                    </div>
                    <div class="form-group" style="margin-top: -5px;">
                        <label for="prenom" style="margin-right: 45px">Email</label>
                        <input type="text" id="prenom"
                            style="
                            width: 31%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            name="prenom" value="{{ $sinistre->emailDecalarant ?? '.' }}" />&nbsp; &nbsp;&nbsp;&nbsp;
                        <label for="prenom" style="margin-right: 2px">Lieu de residence&nbsp;</label>
                        <input type="text" id="prenom"
                            style="
                            width: 30%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            name="prenom" value="{{ $sinistre->lieuresidenceDecalarant ?? '.' }}" />
                    </div>
                </section>
                <section class="section-identification">
                    <h5><u>IDENTIFICATION ASSURÉE</u></h5>
                    <div class="form-group">
                        <label for="nom" style="margin-right: 40px">Nom</label>
                        <input type="text"
                            style="
                            margin-bottom: -7px;
                            margin-top: 25px;
                            width: 86%;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            id="nom" value="{{ $sinistre->nomAssuree ?? '.' }}" />
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
                            background-color: #ffffff;"
                            name="prenom" value="{{ $sinistre->prenomAssuree ?? '.' }}" />
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
                            background-color: #ffffff;"
                            value="{{ $sinistre->genreAssuree == 'M' ? 'X' : '.' }}" /> &nbsp; &nbsp;
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
                            background-color: #ffffff;"
                            value="{{ $sinistre->genreAssuree == 'F' ? 'X' : '.' }}" /> &nbsp; &nbsp; &nbsp;&nbsp;

                        <label for="prenom">Date de naissance&nbsp;</label>
                        <input type="text" id="prenom"
                            style="
                            width: 17%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            name="prenom" value="{{ $sinistre->datenaissanceAssuree ?? '.' }}" />&nbsp; &nbsp; &nbsp;
                        <label for="prenom">Lieu de naissance&nbsp;</label>
                        <input type="text" id="prenom"
                            style="
                            width: 17%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            name="prenom" value="{{ $sinistre->lieunaissanceAssuree ?? '.' }}" />
                    </div>
                    <div class="form-group">
                        <label for="prenom" style="margin-right: 45px">Profession</label>
                        <input type="text" id="prenom"
                            style="
                            width: 25%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            name="prenom" value="{{ $sinistre->professionAssuree ?? '.' }}" />&nbsp; &nbsp;&nbsp;&nbsp;
                        <label for="prenom" style="margin-right: 2px">Lieu de residence&nbsp;&nbsp; &nbsp;</label>
                        <input type="text" id="prenom"
                            style="
                            width: 30%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            name="prenom" value="{{ $sinistre->lieuresidenceAssuree ?? '.' }}" />
                    </div>
                </section>

                <section class="section-identification">
                    <h5><u>DESCRIPTION DU SINISTRE</u></h5>
                    <div class="form-group" style="margin-top: 15px;">
                        <label for="prenom">Nature du sinistre :</label>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="prenom">Décès</label>&nbsp;
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
                            background-color: #ffffff;"
                            value="{{ $sinistre->natureSinistre == 'Deces' ? 'X' : '.' }}" /> &nbsp; &nbsp;
                        <label for="prenom">Invalidité</label>&nbsp;
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
                            background-color: #ffffff;"
                            value="{{ $sinistre->natureSinistre == 'Invalidite' ? 'X' : '.' }}" /> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;

                        <label for="prenom">Date du sinistre&nbsp;</label>
                        <input type="text" id="prenom"
                            style="
                            width: 25%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            name="prenom" value="{{ $sinistre->dateSinistre ?? '.' }}" />&nbsp; &nbsp; &nbsp;
                    </div>
                    <div class="form-group" style="margin-top: -35px;">
                        <label for="nom" style="margin-right: 10px">Cause du sinistre &nbsp; &nbsp; &nbsp;&nbsp;
                            &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
                        <input type="text"
                            style="
                            margin-bottom: -7px;
                            margin-top: 25px;
                            width: 67%;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            id="nom" value="{{ $sinistre->causeSinistre ?? '.' }}" />
                    </div>
                    <div class="form-group" style="margin-top: -5px;">
                        <label for="prenom" style="margin-right: 5px">Lieu de conservation du corps </label>
                        <input type="text" id="prenom"
                            style="
                            width: 67%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                            name="prenom" value="{{ $sinistre->lieuConservation ?? '.' }}" />
                    </div>
                    <div class="form-group" style="margin-top: -5px;width: 100%;">
                        <div style="width: 20%; float: left;">
                            <label for="prenom">Programme des Obsèques</label>
                        </div>
                        <div style="width: 80%; float: right;">
                            <div class="form-group" style="margin-top: 7px;">
                                <label for="prenom">Date levée&nbsp;</label>
                                <input type="text" id="prenom"
                                    style="
                            width: 31%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                                    name="prenom" value="{{ $sinistre->dateLevee ?? '.' }}" />&nbsp; &nbsp; &nbsp;
                                <label for="prenom">Lieu levée&nbsp;</label>
                                <input type="text" id="prenom"
                                    style="
                            width: 31%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                                    name="prenom" value="{{ $sinistre->lieuLevee ?? '.' }}" />&nbsp; &nbsp; &nbsp;
                            </div>
                            <div class="form-group" style="margin-top: -15px;">
                                <label for="prenom">Date inhumation&nbsp;&nbsp;</label>
                                <input type="text" id="prenom"
                                    style="
                            width: 24%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                                    name="prenom" value="{{ $sinistre->dateInhumation ?? '.' }}" />&nbsp; &nbsp; &nbsp;
                                <label for="prenom">Lieu inhumation&nbsp;</label>
                                <input type="text" id="prenom"
                                    style="
                            width: 24%;
                            margin-bottom: -7px;
                            border: 1px solid #90C8A7;
                            padding: 5px;
                            font-size: 14px;
                            border-radius: 3px;
                            background-color: #ffffff;"
                                    name="prenom" value="{{ $sinistre->lieuInhumation ?? '.' }}" />&nbsp; &nbsp; &nbsp;
                            </div>
                        </div>
                    </div>
                </section>
               <div class="clear" style="clear: both; margin-top: -75px;"></div>

                <section class="section-identification" style="margin-top: -45px;">
                    <h5><u>MOYENS DE PAIEMENT</u></h5>
                    <div class="form-group" style="width: 100%; margin-top: -6px;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="nom" style="margin-right: 4px">Mobile Money</label>
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
                            id="nom" name="" value="{{ $sinistre->moyenPaiement == 'Mobile_Money' ? 'X' : '.' }}" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                        <label for="virementBancaire" style="margin-right: 4px">Virement Bancaire
                            &nbsp;&nbsp;&nbsp;</label>
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
                            id="virementBancaire" value="{{ $sinistre->moyenPaiement == 'Virement_Bancaire' ? 'X' : '.' }}" />
                    </div>
                    <div class="form-group" style="width: 100%; margin-top: -2px;">
                        <div class="form-group" style="width: 60%; float: left;">
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
                                    id="orangeMoney" value="{{ $sinistre->Operateur == 'Orange_money' ? 'X' : '.' }}" />
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
                                    id="moovMoney" value="{{ $sinistre->Operateur == 'Moov_money' ? 'X' : '.' }}" />
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
                                    id="mtnMoney" value="{{ $sinistre->Operateur == 'MTN_money' ? 'X' : '.' }}" />
                            </div>&nbsp;&nbsp;
                        </div>
                        <div class="form-group" style="width: 40%; float: right;">
                            <label for="telPaiement" style="margin-right: 4px">N° de paiement</label>
                            <input type="text"
                                style="
                                    margin-bottom: -7px;
                                    margin-top: 5px;
                                    width: 55%;
                                    border: 1px solid #90C8A7;
                                    padding: 5px;
                                    font-size: 14px;
                                    color: #F7A400;
                                    border-radius: 3px;
                                    background-color: #ffffff;"
                                id="telPaiement" value="{{ $sinistre->telPaiement }}" />
                        </div>
                    </div>
                    
                </section>
                <div class="clear" style="clear: both; margin-top: -75px;"></div>

                <section class="section-identificatio" style="margin-top: -45px; padding: 0 -70px; ">
                    <div class="section-documents" style="background-color: #E7F0EB; margin: 2px -20px; height: 150px; padding: 0px 10px;">
                        
                        <div class="form-group" style="width: 60%; float: left; padding-top: 110px;">
                            <label for="nom" style="margin-right: 24px">Fait à {{ $sinistre->lieuresidenceDecalarant }} le {{ \Carbon\Carbon::parse($sinistre->created_at)->translatedFormat('d F Y') ?? '.' }} </label>
                        </div>
                        <div class="form-group" style="width: 40%; float: right; text-align: center;">
                            <h6>Signature du déclarant</h6>
                            {{-- <br> --}}
                            <small>
                                <p style="font-size: 0.57em; margin-top: 10px; font-style: italic;">Contrôle éffectué par
                                    OTP du {{ \Carbon\Carbon::parse($sinistre->created_at)->translatedFormat('d F Y à H:i') ?? '.' }}</p>
                            </small>
                            <p style="margin-top: 20px;">
                                <label for="signature"
                                    style=" max-width: 70px;">
                                    @if($imageSrc != '')
                                        <img src="{{ $imageSrc }}" alt="Signature" style="height: 65px; width: 65px" class="logo">
                                    @endif
                                </label>&nbsp;&nbsp;
                                <label for="qrcode" style="max-height: 65px; max-width: 65px;">
                                    <img src="data:image/png;base64,{{ $qrcode ?? '' }}" alt="QR Code">
                                </label>
                            </p>
                            

                        </div>

                    </div>
                    
                </section>
            </div>
        </section>
    </main>
</body>

</html>
