<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FICHE D'ETAT DE COTISATION</title>
    <style>
        /* input {
            font-size: 20px;
            color: #000;
        } */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 12px;
            color: #444444
        }

        body {
            font-family: Arial, sans-serif;
            padding-left: 35px;
            padding-right: 35px;
            padding-top: 30px;
            padding-bottom: 30px;
            min-height: 100vh; /* Assure que la page occupe au moins 100% de la hauteur de l'écran */
            position: relative;
        }

        .chechbox {
            border: 1px solid black;
            color: #fff;
            max-width: 3px !important;
            max-height: 3px !important;
            font-size: 9px;
            margin-right: 5px;
        }

        .radio {
            margin-right: 10px;
            transform: scale(2.1);
        }

        .radio1 {
            margin-right: 10px;
            transform: scale(1.5);
        }

        .input-border-bottom {
            border: none;
            border-bottom: solid 1px;
        }

        .a4-container {
            width: 100%;
            height: 100%;
            border-left: solid 15px #368257;
            padding: 5px
            /* padding-bottom: 120px; */
        }
        .main-content {
            padding-bottom: 60px; /* Ajuste selon la hauteur du footer pour éviter qu'il recouvre le contenu */
        }
        .footer-fixed {
            /* position: fixed;
            bottom: 0;
            left: 0;
            width: 100%; */
            /* background-color: white; */
            /* padding: 10px 0; */
            /* box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1); */

            position: fixed;
            height: 140px;
            /* border: #444444 solid 1px; */
            bottom: 0;
            /* left: 0; */
            /* width: 100%; */
        }
        @media print {
    .footer-fixed {
        position: fixed;
        bottom: 0;
    }
}
    </style>
</head>

<body>
    <div class="a4-container">
        <div class="main-content">
            <!-- Contenu principal de la page ici -->
            <section style="height: 65px">
                <div class="container1_1 row" style="width: 100%">
    
                    <div class="logo col-4" style="width: 25%; float: left">
    
                        <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('assets/img/logo-min.png'))) }}"
                            alt="Logo" style="width: 100px">
    
                    </div>
                    <div
                        style="width: 45%; font-size: 12px; font-weight: bold; height: 25px; display: flex; justify-content: center; align-items: center; float: right">
                        <h2 style="font-size: 12px; float: right; display: flex; flex-direction: column; justify-content: center; align-items: center">
                            {{$dateConsultation ?? 'N/A'}}
                        </h2>
                    </div>
    
                </div>
            </section>
            <section style="margin-top: 10px">
                <div>
                    <CENTER>
                        <h1><i style="font-size: 25px">ETAT DES COTISATIONS</i></h1>
                    </CENTER>
                </div>
            </section>
            <section style="height: 40px; margin-top: 15px;">
                <div style="width: 100%;">
                    <div style="width: 65%; margin: auto; border: 1px solid #444; padding: 7px; border-radius: 7px;">
                        <strong style="font-size: 15px">N° de Police</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                            style="color: red; font-size: 20px">{{$details[0]['IDUnique'] ?? 'N/A'}}</span></div>
                </div>
                <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
            </section>
            <section style="margin-top: 20px; margin-bottom: 0px; padding: 5px; font-family: Arial, sans-serif;">
                <div class="container-fluid">
    
                    <!-- Contenu -->
                    <div class="content1" style="margin-top: 0px; padding: 5px;">
                        <h1 style="text-align: center; font-size: 60px; color: #368257">{{$details[0]['produit'] ?? 'N/A'}}</h1>
                    </div>
                    <div class="content1" style="margin-top: 0px; padding: 5px;">
                        @if($details[0]['OnStdbyOff'] == 1)
                            <h3 for="" style="text-align: center; font-size: 15px;"> Statut : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color: #F9B233; font-size: 20px;">En cours</span></h3>
                        @elseif($details[0]['OnStdbyOff'] == 2)
                            <h3 for="" style="text-align: center; font-size: 15px;"> Statut : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color: #F9B233; font-size: 20px; ">En veille</span>"></h3>
                        @elseif($details[0]['OnStdbyOff'] == 3)
                            <h3 for="" style="text-align: center; font-size: 15px;"> Statut : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color: #F9B233; font-size: 20px; ">Arrêté</span>"></h3>
                        @else 
                            <h3 for="" style="text-align: center; font-size: 15px;"> Statut : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color: #F9B233; font-size: 20px; ">Inconnu</span>"></h3>
                        @endif
                        
                    </div>
    
                </div>
            </section>
            <section style="margin-top: 30px; margin-bottom: 10px; padding: 5px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
                <div class="container-fluid">
    
                    <!-- Contenu -->
                    <div class="content1" style="margin-top: 0px; padding: 5px; border: 1px solid #444; border-radius: 7px; background-color: #dbdbdb22">
    
                        <!-- Colonne gauche -->
                        <div style="width: 54%; float: left; padding: 7px 5px;">
                            <div class="nom" style="margin-bottom: 10px;">
                                <label><strong>ID : </strong><input type="text" class="input-border-bottom"
                                        style="width: 81%" value="{{$details[0]['IdProposition'] ?? ''}}"> </label>
                            </div>
    
                            <div class="birthday" style="margin-bottom: 10px;">
                                <label><strong>GUUID : </strong><input type="text" class="input-border-bottom"
                                        style="width: 76%" value="{{$details[0]['GUUID'] ?? ''}}"> </label>
                            </div>
    
                            <div class="prenom" style="margin-bottom: 10px;">
                                <label><strong>N° Proposition : </strong><input type="text" class="input-border-bottom"
                                        style="width: 67%" value="{{$details[0]['IDUnique'] ?? ''}}"> </label>
                            </div>
    
                            <div class="domicile" style="margin-bottom: 10px;">
                                <label><strong>N° controle : </strong><input type="text" class="input-border-bottom"
                                        style="width: 75%" value="{{$details[0]['CodeProposition'] ?? ''}}"> </label>
                            </div>
    
                            {{-- <div class="profession" style="margin-bottom: 10px;">
                                <label><strong>Réseau : </strong><input type="text" class="input-border-bottom"
                                        style="width: 85%" value="Réseau"> </label>
                            </div> --}}
                        </div>
    
                        <!-- Colonne droite -->
                        <div style="width: 42%; float: right; padding: 7px 0px;">
                            <div class="nom" style="margin-bottom: 10px;">
                                <label><strong>N° Formulaire : </strong><input type="text" class="input-border-bottom"
                                        style="width: 65%" value="{{$details[0]['CodepropositionForm'] ?? ''}}"> </label>
                            </div>
    
                            <div class="prenom" style="margin-bottom: 10px;">
                                <label><strong>Agent : </strong><input type="text" class="input-border-bottom"
                                        style="width: 81%" value="{{$details[0]['CodeConseiller'] ?? ''}} - {{$details[0]['NomAgent'] ?? ''}}"> </label>
                            </div>
    
                            {{-- <div class="birthday" style="margin-bottom: 10px;">
                                <label><strong>Code : </strong><input type="text" class="input-border-bottom"
                                        style="width: 81%" value="Code assistant Manager"> </label>
                            </div>
    
                            <div class="domicile" style="margin-bottom: 10px;">
                                <label><strong>code : </strong><input type="text" class="input-border-bottom"
                                        style="width: 81%" value="Code Manager"> </label>
                            </div> --}}
                        </div>
    
                        <!-- Clear pour éviter les flottements -->
                        <div style="clear: both;"></div>
    
                    </div>
                    <div style="width: 100%; margin-top: 15px; text-align: center; border-bottom: 1px solid #444; padding-bottom: 10px">
                        <label><strong>Effet adhésion :
                            </strong><span>{{$details[0]['DateEffetReel'] ?? ''}}</span></label>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <label><strong>Durée adhésion :
                            </strong><span>{{$details[0]['DureeCotisationAns'] ?? ''}} ANS</span></label>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <label><strong>Fin cotisation :
                            </strong><span>{{$details[0]['FinAdhesion'] ?? ''}}</span></label>
                    </div>
                    <div style="width: 70%; margin-top: 15px; margin: auto">
                        <div style="width: 100%; margin-top: 15px;">
                            <label><strong>Nbre Emission :
                                </strong><span>{{$details[0]['NbreEmission'] ?? ''}}</span></label>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <label><strong>Nbre Réglement :
                                </strong><span>{{$details[0]['NbreEncaissment'] ?? ''}} ANS</span></label>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <label><strong>Nbre Impayés :
                                </strong><span>{{$details[0]['NbreImpayes'] ?? ''}}</span></label>
                        </div>
                        <div style="width: 100%; margin-top: 15px;">
                            <label><strong>Emissions :
                                </strong><span>{{ number_format($details[0]['TotalEmission'], 0, ',', ' ') ?? ''}}</span></label>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <label><strong>Réglements :
                                </strong><span>{{ number_format($details[0]['TotalEncaissement'], 0, ',', ' ') ?? ''}}</span></label>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <label><strong>Impayés :
                                </strong><span>{{ number_format($details[0]['TotalImpayes'], 0, ',', ' ') ?? ''}}</span></label>
                        </div>
                    </div>
                    
    
                </div>
            </section>
    
            <section style="margin-bottom: 10px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
                <!-- Titre -->
                <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                    <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">I</h4>
                </div>
                <div class=""
                    style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                    <h4 style="color: #fff; font-size: 15px; margin: 0;">SOUSCRIPTEUR</h4>
                </div>
                <!-- Contenu -->
                <div class="content" style="margin-top: 0px; padding: 10px;">
                    <!-- Colonne gauche -->
                    <div style="width: 100%; margin-top: 15px;">
                        <label><strong>Nom :
                            </strong><span>{{$details[0]['nomSous'] ?? ''}} </span></label>
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <label><strong>Prénoms :
                            </strong><span>{{$details[0]['PrenomSous']  ?? ''}}</span></label>
                    </div>
                    <div style="width: 100%; margin-top: 15px;">
                        <label><strong>Né(e) le :
                            </strong><span>{{$details[0]['DateNaissance'] ?? ''}}</span></label> &nbsp;
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <label><strong>à : 
                            </strong><span>{{$details[0]['LieuNaissance'] ?? ''}}</span></label>&nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <label><strong>Profession :
                            </strong><span>{{$details[0]['Profession'] ?? ''}}</span></label> 
                    </div>
                </div>
            </section>
            <section style="margin-bottom: 10px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
                <!-- Titre -->
                <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                    <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">II</h4>
                </div>
                <div class=""
                    style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                    <h4 style="color: #fff; font-size: 15px; margin: 0;">ASSURE</h4>
                </div>
                <!-- Contenu -->
                <div class="content1" style="margin-top: 5px; padding: 10px;">
    
                    <table border="1" cellpadding="5" cellspacing="0" width="100%">
                        <tr>
                            <th>Nom complet</th>
                            <th>Garantie</th>
                            <th>Date éffet</th>
                            <th>Frais Accs.</th>
                            <th>Prime Hors Accs.</th>
                            <th>Prime total </th>
                            <th>Periodicites</th>
                        </tr>
                        @foreach($assures as $assure)
                            <tr>
                                <td>{{$assure['NomPrenom'] ?? ''}}</td>
                                <td>{{$assure['MonLibelle'] ?? ''}}</td>
                                <td>{{ \Carbon\Carbon::parse($assure['DateEffet'])->format('d-m-Y') ?? ''}}</td>
                                <td>
                                    {{ number_format((int) $assure['FraisAcces'], 0, ',', ' ') ?? ''}}
                                </td>
                                <td>{{number_format((int) $assure['PrimePrincipale'], 0, ',', ' ') ?? '' }}</td>
                                <td>{{number_format((int) $assure['Prime'], 0, ',', ' ') ?? '' }}</td>
                                <td>
                                    {{ 
                                        $assure['CodePerodicite'] === 'M' ? 'Mensuelle' : 
                                        ($assure['CodePerodicite'] === 'T' ? 'Trimestrielle' : 
                                        ($assure['CodePerodicite'] === 'S' ? 'Semestrielle' : 
                                        ($assure['CodePerodicite'] === 'A' ? 'Annuelle' : 
                                        ($assure['CodePerodicite'] === 'U' ? 'Versement unique' : 'Inconnu')))) 
                                    }}
                                </td>
                            </tr>
                        @endforeach
                        
                    </table>
                    
                </div>
            </section>
            <section style="margin-bottom: 10px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
                <!-- Titre -->
                <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                    <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">III</h4>
                </div>
                <div class=""
                    style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                    <h4 style="color: #fff; font-size: 15px; margin: 0;">PAYEUR(S) DE PRIME</h4>
                </div>
                <!-- Contenu -->
                <div class="content1" style="margin-top: 5px; padding: 10px;">
    
                    <table border="1" cellpadding="5" cellspacing="0" width="100%">
                        <tr>
                            <th>Nom complet</th>
                            <th>Mode de paiement</th>
                            <th>Organisme</th>
                            <th>N° compte</th>
                        </tr>
                        @foreach($payeurs as $payeur)
                            <tr>
                                <td>{{$payeur['NomPrenom'] ?? ''}}</td>
                                <td>{{$payeur['CodeModePaiement'] ?? ''}}</td>
                                <td>{{ $payeur['Societe'] ?? ''}}</td>
                                <td>{{ $payeur['NumCompte'] ?? ''}}</td>
                            </tr>
                        @endforeach
                        
                    </table>
                    
                </div>
            </section>
            <section style="margin-bottom: 10px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
                <!-- Titre -->
                <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                    <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">IV</h4>
                </div>
                <div class=""
                    style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                    <h4 style="color: #fff; font-size: 15px; margin: 0;">PRIMES NON REGLEES</h4>
                </div>
                <!-- Contenu -->
                <div class="content1" style="margin-top: 5px; padding: 10px;">
    
                    <table border="0.5" cellpadding="7" cellspacing="0" width="100%">
                        <tr>
                            <th>N°</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Montant réglé</th>
                            <th>Date réglt</th>
                            <th>Ref. réglt</th>
                            <th>Mode réglement</th>
                            <th>Statut</th>
                        </tr>
                        @php
                            $MontantNetTotal = 0;
                            $RegltMontantTotal = 0;
                        @endphp
                        @forelse($nonRegle as $enc)
                            @php
                                $MontantNetTotal += (float) $enc['MontantNet'];
                                $RegltMontantTotal += (float) $enc['RegltMontant'];
                            @endphp
                            <tr>
                                <td>{{$enc['IdPresentation'] ?? ''}}</td>
                                <td>{{$enc['MaDate'] ?? ''}}</td>
                                <td>{{ number_format($enc['MontantNet'] , 0, ',', ' ') ?? ''}}</td>
                                <td>{{ number_format($enc['RegltMontant'] , 0, ',', ' ') ?? ''}}</td>
                                <td>{{$enc['RegltDate'] ?? ''}}</td>
                                <td>{{$enc['RegltRef'] ?? ''}}</td>
                                <td>{{$enc['RegltCodePaiement'] ?? ''}}</td>
                                <td>{{$enc['Statut'] ?? ''}}</td>
                            </tr>
                            
                            @empty
                            <tr>
                                <td colspan="8" style="text-align: center">Aucune prime non reglée</td>
                            </tr>
                        @endforelse
                        @if (count($nonRegle) > 0)
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td>{{ number_format($MontantNetTotal , 0, ',', ' ') ?? ''}}</td>
                                <td>{{ number_format($RegltMontantTotal , 0, ',', ' ') ?? ''}}</td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                            </tr>
                        @endif
                    </table>
                    
                </div>
            </section>
    
            <section style="margin-bottom: 10px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
                <!-- Titre -->
                <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                    <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">V</h4>
                </div>
                <div class=""
                    style="width: 55%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                    <h4 style="color: #fff; font-size: 15px; margin: 0;">PRIMES REGLEES PARTIELLEMENTS</h4>
                </div>
                <!-- Contenu -->
                <div class="content1" style="margin-top: 5px; padding: 10px;">
    
                    <table border="1" cellpadding="5" cellspacing="0" width="100%">
                        <tr>
                            <th>N°</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Montant réglé</th>
                            <th>Date réglt</th>
                            <th>Ref. réglt</th>
                            <th>Mode réglement</th>
                            <th>Statut</th>
                        </tr>
                        @php
                            $MontantNetTotalPartielle = 0;
                            $RegltMontantTotalPartielle = 0;
                        @endphp
                        @forelse($partielle as $part)
                            @php
                                $MontantNetTotalPartielle += (float) $enc['MontantNet'];
                                $RegltMontantTotalPartielle += (float) $enc['RegltMontant'];
                            @endphp
                            <tr>
                                <td>{{$part['IdPresentation'] ?? ''}}</td>
                                <td>{{$part['MaDate'] ?? ''}}</td>
                                <td>{{ number_format($part['MontantNet'] , 0, ',', ' ') ?? ''}}</td>
                                <td>{{ number_format($part['RegltMontant'] , 0, ',', ' ') ?? ''}}</td>
                                <td>{{$part['RegltDate'] ?? ''}}</td>
                                <td>{{$part['RegltRef'] ?? ''}}</td>
                                <td>{{$part['RegltCodePaiement'] ?? ''}}</td>
                                <td>{{$part['Statut'] ?? ''}}</td>
                            </tr>
                            
                        @empty
                            <tr>
                                <td colspan="8" style="text-align: center">Aucune prime reglée partiellement</td>
                            </tr>
                        @endforelse
                        @if(count($partielle) > 0)
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td>{{ number_format($MontantNetTotalPartielle , 0, ',', ' ') ?? ''}}</td>
                                <td>{{ number_format($RegltMontantTotalPartielle , 0, ',', ' ') ?? ''}}</td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                            </tr>
                        @endif
                        
                    </table>
                    
                </div>
            </section>
            <section style="margin-bottom: 10px; font-family: Arial, sans-serif; border-bottom: 1px dotted #444;">
                <!-- Titre -->
                <div class="" style="width: 2%; background-color: #747171; padding: 5px; float: left;">
                    <h4 style="color: #fff; font-size: 15px; margin: 0; text-align: center">VI</h4>
                </div>
                <div class=""
                    style="width: 30%; background-color: #747171; padding: 5px; border-radius: 0 7px 7px 0; margin-left: 30px;">
                    <h4 style="color: #fff; font-size: 15px; margin: 0;">PRIMES REGLEES</h4>
                </div>
                <!-- Contenu -->
                <div class="content1" style="margin-top: 5px; padding: 10px;">
    
                    <table border="0.5" cellpadding="7" cellspacing="0" width="100%">
                        <tr>
                            <th>N°</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Montant réglé</th>
                            <th>Date réglt</th>
                            <th>Ref. réglt</th>
                            <th>Mode réglement</th>
                            <th>Statut</th>
                        </tr>
                        @php
                            $MontantNetTotalReglee = 0;
                            $RegltMontantTotalReglee = 0;
                        @endphp
                        @forelse($confirmer as $reglt)
                            @php
                                $MontantNetTotalReglee += (float) $reglt['MontantNet'];
                                $RegltMontantTotalReglee += (float) $reglt['RegltMontant'];
                            @endphp
                            <tr>
                                <td>{{$reglt['IdPresentation'] ?? ''}}</td>
                                <td>{{$reglt['MaDate'] ?? ''}}</td>
                                <td>{{ number_format($reglt['MontantNet'] , 0, ',', ' ') ?? ''}}</td>
                                <td>{{ number_format($reglt['RegltMontant'] , 0, ',', ' ') ?? ''}}</td>
                                <td>{{$reglt['RegltDate'] ?? ''}}</td>
                                <td>{{$reglt['RegltRef'] ?? ''}}</td>
                                <td>{{$reglt['RegltCodePaiement'] ?? ''}}</td>
                                <td>{{$reglt['Statut'] ?? ''}}</td>
                            </tr>
                            
                        @empty
                            <tr>
                                <td colspan="8" style="text-align: center">Aucune prime reglée</td>
                            </tr>
                        @endforelse
                        @if(count($confirmer) > 0)
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td>{{ number_format($MontantNetTotalReglee , 0, ',', ' ') ?? ''}}</td>
                                <td>{{ number_format($RegltMontantTotalReglee , 0, ',', ' ') ?? ''}}</td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                            </tr>
                        @endif
                        
                    </table>
                    
                </div>
            </section>
        </div>
        <section class="footer-fixed">
            <section style="border-bottom: 3px solid #ccc; margin-top: 40px">
                <div style="width: 100%;">
                    <div style="float: left;"><small style="font-size: 10px">Produit conçu et testé par la cellule Recherche
                            & Développement de YAKO AFRICA Assurances Vie</small></div>
                </div>
                <div style="clear: both;"></div> <!-- Pour éviter les problèmes d'affichage -->
            </section>
            <section style="padding: 0 25px; margin: 0 auto; margin-bottom: 20px">
                <div style="width: 100%; margin-bottom: 15px; margin-top: 5px">
                    <div style="float: left; text-align:center;">
                        <p>
                            <small>
                                Société Anonyme d'Assurance Vie au capital de 3 000 000 000 FCFA. Entreprise régie par le
                                code des Assurances CIMA Siège social : Abidjan-Plateau - Immeuble woodin Center 4ème étage
                                - Avenue Noguès 01 BP 11885 Abidjan 01
                            </small>
                        </p>
                        <p>
                            <small><strong>Tél.: (225) 27 20 22 94 64 / 27 20 33 15 00 - Fax : (225) 27 20 22 95 92 - RCC :
                                    CI-ABJ-03-2022-M-22882 </strong></small>
                        </p>
                        <p>
                            <small style="color: #656565">Email : infos@yakoafricassur.com - Site Web :
                                www.yakoafricassur.com</small>
                        </p>
                    </div>
                </div>
            </section>
        </section>
        
    </div>
    
</body>

</html>
