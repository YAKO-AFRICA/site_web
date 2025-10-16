@extends('users.espace_client.layouts.main')

@section('content')
    <style>
        input[readonly],
        textarea[readonly],
        select[readonly] {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            /* Bordure gris clair */
            /* cursor: not-allowed;        Curseur indiquant que l'action est interdite */
            cursor: no-drop;
            pointer-events: none;
            /* Empêche toute interaction avec ces éléments */
        }

        /* Remplacer le curseur par l'emoji 🚫 lors du survol des champs readonly */
        input[readonly]:hover,
        textarea[readonly]:hover,
        select[readonly]:hover {
            cursor: no-drop;
            /* cursor: wait; */
        }
    </style>
    <!--start stepper one-->
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Prestations</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Demande de prestation |
                        {{ $typePrestation->libelle ?? '' }} : <span id="motifAutre1" class="text-warning"></span> </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div id="stepper1" class="bs-stepper">

        <div class="card" style="background-color: #E7F0EB">
            <div class="card-header text-center">
                <h5 class="mb-1">Demande officielle de prestation | {{ $typePrestation->libelle ?? '' }} :
                    <span id="motifAutre2" class="text-success"></span>
                </h5>
                <p class="mb-4">Veuillez renseigner soigneusement les informations ci-après afin de constituer votre
                    dossier auprès de <strong>YAKO AFRICA Assurance Vie (<span class="star">*</span>
                        Obligatoire)</strong>.</p>
            </div>

            @include('users.espace_client.services.prestations.modals.infosMontantModal')

            <div class="card-body">
                <div class="bs-stepper-content">
                    <form id="PrestationAutre" method="POST" enctype="multipart/form-data" class="submitForm">
                        @csrf
                        <input type="hidden" class="form-control" id="nom" name="nom"
                            value="{{ Auth::guard('customer')->user()->membre->nom ?? '' }}" placeholder="Nom complet">

                        <input type="hidden" name="prestationlibelle" value="{{ $typePrestation->libelle ?? '' }}">
                        <input type="hidden" id="tokGenerate" name="tokGenerate" value="{{ $tok }}">
                        @php
                            $keyUuid = $token['key_uuid'];
                            $operationType = $token['operation_type'];
                        @endphp
                        <input type="hidden" name="idclient"
                            value="{{ Auth::guard('customer')->user()->membre->idmembre ?? '' }}">

                        <input type="hidden" class="form-control" id="prenom" name="prenom"
                            value="{{ Auth::guard('customer')->user()->membre->prenom ?? '' }}" placeholder="Prénom">

                        <!-- Objet de la demande -->
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label for="single-select-field" class="form-label">
                                    Objet de votre requête <span class="star">*</span>
                                </label>
                                <select class="form-select" name="typeprestation" id="single-select-fie" required>
                                    <option selected value="" disabled>Sélectionnez l’objet de votre requête</option>
                                    @foreach ($typeOperation as $operation)
                                        <option value="{{ $operation['MonLibelle'] }}" {{ ($NbreEmission > 1 && $operation['MonLibelle'] == "Changement de date d'effet") || $operation['MonLibelle'] == "Annulation de la garantie Remboursement" || $operation['MonLibelle'] == "Transformation" || (!$peuSuspendreContrat && $operation['MonLibelle'] == "Suspension") || (!$peuModifDureeContrat && $operation['MonLibelle'] == "Modification de la durée du contrat") ? 'disabled' :  '' }}>{{ $operation['MonLibelle'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-3 d-none" id="divNouveauModePaiement">
                            <div class="col-md-6">
                                <label for="nouveauModePaiement" class="form-label">
                                    Nouveau mode de paiement souhaité <span class="star">*</span>
                                </label>
                                <select class="form-select" name="nouveauModePaiement" id="nouveauModePaiement">
                                    {{-- affichage dynamique des options --}}
                                </select> 
                            </div>
                            <div class="col-md-6">
                                <label for="aCompterDu" class="form-label">
                                    À compter du <span class="star">*</span>
                                </label>
                                <input type="date" min="{{ date('Y-m-d') }}" class="form-control"
                                    value="{{ date('Y-m-d') }}" id="aCompterDu" name="aCompterDu">
                            </div>

                        </div>
                        <div class="row g-3 mb-3 d-none" id="divSuspension">
                            <div class="col-md-6">
                                <label for="dureeSuspension" class="form-label">
                                    Durée de la suspension (en mois minimum 1 mois et maximum 6 mois) <span class="star">*</span>
                                </label>
                                <input type="number" class="form-control" min="1" max="6" id="dureeSuspension" value="1" name="dureeSuspension">
                            </div>
                            <div class="col-md-6">
                                <label for="aCompterDuSuspension" class="form-label">
                                    À compter du <span class="star">*</span>
                                </label>
                                <input type="date" min="{{ date('Y-m-d') }}" class="form-control"
                                    value="{{ date('Y-m-d') }}" id="aCompterDuSuspension" name="aCompterDuSuspension">
                            </div>

                        </div>

                        <div class="row g-3 mb-3 d-none" id="divModificationDuree">
                            <div class="col-md-12">
                                <label for="modifDureeContratSouhaitee" class="form-label">
                                    Durée du contrat souhaitée (en année minimum 10 ans) <span class="star">*</span>
                                </label>
                                <input type="number" class="form-control" min="10" id="modifDureeContratSouhaitee" value="10" name="modifDureeContratSouhaitee">
                            </div>
                        </div>

                        <div class="row g-3 mb-3 d-none" id="divNouvelleAdresse">
                            <div class="col-md-12">
                                <label for="nouvelleAdresse" class="form-label">
                                    Quelle est votre nouvelle adresse <span class="star">*</span>
                                </label>
                                <input type="text" class="form-control" id="nouvelleAdresse" name="nouvelleAdresse">
                            </div>
                        </div>
                        <p id="OPSfile" class="d-none">Merci de bien vouloir cliquer <a href="{{ asset('cust_assets/images/docs/ops.pdf') }}" download>ici pour télécharger, remplir, signer et téléverser la fiche d'autorisation de prélèvement sur salaire </a></p>
                        <div class="row g-3 mb-3 d-none" id="divNouvelleDateEffet">
                            <div class="col-12">
                                <label for="nouvelleDateEffet" class="form-label">
                                    Nouvelle date d'effet souhaité <span class="star">*</span>
                                </label>
                                <input type="date" min="{{ date('Y-m-d') }}" class="form-control"
                                    value="{{ date('Y-m-d') }}" id="nouvelleDateEffet" name="nouvelleDateEffet">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12  d-none" id="divAssureeAModifier">
                                <label for="assureeAModifier" class="form-label">
                                    Selectionner l'assuré(e) à modifier <span class="star">*</span>
                                </label>
                                <select class="form-select" name="assureeAModifier" id="assureeAModifier">
                                    @foreach ($assurees as $assuree)
                                        <option value="{{ $assuree['nomAssu'] . ' ' . $assuree['PrenomAssu'] }}">
                                            {{ $assuree['nomAssu'] . ' ' . $assuree['PrenomAssu'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12  d-none" id="divActeurAModifier">
                                <label for="acteurAModifier" class="form-label">
                                    Selectionner l'acteur à modifier <span class="star">*</span>
                                </label>
                                <select class="form-select" name="acteurAModifier" id="acteurAModifier">
                                    @foreach ($acteurs as $acteur)
                                        <option value="{{ $acteur['nomAssu'] . ' ' . $acteur['PrenomAssu'] }}">
                                            {{ $acteur['nomAssu'] . ' ' . $acteur['PrenomAssu'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 d-none" id="divLieuNaissanceCorrect">
                                <label for="lieuNaissanceCorrect" class="form-label">
                                    Lieu de naissance correct de l'assuré(e) <span class="star">*</span>
                                </label>
                                <input type="text" class="form-control" value="" id="lieuNaissanceCorrect"
                                    name="lieuNaissanceCorrect">
                            </div>
                            <div class="col-12 d-none" id="divDateNaissanceCorrect">
                                <label for="dateNaissanceCorrect" class="form-label">
                                    Date de naissance de l'assuré(e) <span class="star">*</span>
                                </label>
                                <input type="date" class="form-control" id="dateNaissanceCorrect"
                                    name="dateNaissanceCorrect">
                            </div>

                            <div class="col-12  d-none" id="divFiliations">
                                <label for="filiations" class="form-label">
                                    Quel est votre lien avec l'assuré(e) ? <span class="star">*</span>
                                </label>
                                <select class="form-select" name="filiations" id="filiations">
                                    @foreach ($filiations as $filiation)
                                        <option
                                            value="{{ $filiation['CodeFiliation'] == 'LUIMM' ? 'Souscripteur' : $filiation['MonLibelle'] }}">
                                            {{ $filiation['CodeFiliation'] == 'LUIMM' ? 'Souscripteur' : $filiation['MonLibelle'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-3 d-none" id="divNouveauContactTelephonique">
                            <div class="col-12">
                                <label for="nouveauContactTelephonique" class="form-label">
                                    Nouveau contact téléphonique souhaité <span class="star">*</span>
                                </label>
                                <input type="number" min="0" class="form-control"
                                    value="{{ Auth::guard('customer')->user()->membre->cel ?? '' }}"
                                    id="nouveauContactTelephonique" name="nouveauContactTelephonique">
                            </div>
                        </div>

                        <!-- Contrat et résidence -->
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-lg-6">
                                <label for="single-select-fiel" class="form-label">
                                    ID de contrat <span class="star">*</span>
                                </label>
                                <select class="form-select" name="idcontrat" id="single-select-fiel" required>
                                    <option selected>Veuillez sélectionner votre ID de contrat</option>
                                    @foreach (Auth::guard('customer')->user()->membre->membreContrat as $contrat)
                                        @if ($contratDetails && $contratDetails['IdProposition'] == $contrat->idcontrat)
                                            <option value="{{ $contrat->idcontrat }}" selected>{{ $contrat->idcontrat }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="lieuresidence" class="form-label">
                                    Lieu de résidence <span class="star">*</span>
                                </label>
                                <input type="text" class="form-control" id="lieuresidence" name="lieuresidence"
                                    value="{{ Auth::guard('customer')->user()->membre->lieuresidence ?? '' }}"
                                    placeholder="Indiquez votre lieu de résidence" required>
                            </div>
                        </div>

                        <!-- Contacts -->
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-lg-6">
                                <label for="cel" class="form-label">
                                    Numéro de téléphone (principal) <span class="star">*</span>
                                </label>
                                <input type="number" class="form-control" id="cel" name="cel"
                                    value="{{ Auth::guard('customer')->user()->membre->cel ?? '' }}"
                                    placeholder="Ex: +2250700000000" required>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="email" class="form-label">
                                    Adresse électronique <span class="star">*</span>
                                </label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ Auth::guard('customer')->user()->membre->email ?? '' }}"
                                    placeholder="exemple@email.com" required>
                            </div>
                        </div>

                        <!-- Description du besoin -->
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label for="AutresInfos" class="form-label">
                                    Description détaillée de votre demande
                                    <span class="text-danger">(Veuillez être clair et précis)</span>
                                </label>
                                <textarea class="form-control tinymce-editor" name="msgClient_display" id="AutresInfos" rows="5"
                                    placeholder="Décrivez avec précision la nature de votre demande afin de faciliter son traitement par YAKO AFRICA Assurance Vie"></textarea>

                                <!-- Champ hidden pour la soumission -->
                                <input type="hidden" name="msgClient" id="msgClientHidden">
                            </div>
                        </div>

                        <!-- Pièces justificatives -->
                        <div class="card mb-3 d-none" id="blockDocument">
                            <div class="card-header">
                                <h5 class="mb-0">Documents à fournir (formats acceptés : PNG, JPEG, JPG ou PDF)</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    {{-- CNI Souscripteur --}}
                                    <div class="col-12 d-none" id="divCNISouscripteur">
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label class="form-label">Carte Nationale d’Identité du souscripteur
                                                        <strong><small>(CNI)</small></strong>
                                                    </label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-12 col-md-6 mb-3">
                                                            <label class="form-label"><strong><small>
                                                                        Recto</small></strong></label>
                                                            <div class="input-group">
                                                                <input id="CNIrecto-file-uploa" class="form-control"
                                                                    type="file" name="libelle[]"
                                                                    accept=".jpg, .png, image/jpeg, image/png"
                                                                    onchange="previewFilesPrestAutre(event, 'CNIrectoSouscripteur')">
                                                                <input type="hidden" name="type[]"
                                                                    value="CNIrectoSouscripteur">
                                                                <input type="hidden" name="filename[]"
                                                                    value="CNI recto du souscripteur">
                                                            </div>
                                                            <div id="CNIrectoSouscripteur" class="mt-3 preview-area">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 mb-3">
                                                            <label class="form-label"><strong><small>
                                                                        Verso</small></strong></label>
                                                            <div class="input-group">
                                                                <input id="CNIverso-file-uploa" class="form-control"
                                                                    type="file" name="libelle[]"
                                                                    accept=".jpg, .png, image/jpeg, image/png"
                                                                    onchange="previewFilesPrestAutre(event, 'CNIversoSouscripteur')">
                                                                <input type="hidden" name="type[]"
                                                                    value="CNIversoSouscripteur">
                                                                <input type="hidden" name="filename[]"
                                                                    value="CNI verso du souscripteur">
                                                            </div>
                                                            <div id="CNIversoSouscripteur" class="mt-3 preview-area">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- OPS --}}
                                    <div class="col-12 d-none" id="divOPS">
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label class="form-label">Fiche d'autorisation de Prélèvement sur Salarie <strong><small class="text-danger">(dûment rempli et signé)</small></strong></label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="input-group">
                                                        <input id="OPS-file-uploa" class="form-control"
                                                            type="file" name="libelle[]"
                                                            accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                            onchange="previewFilesPrestAutre(event, 'OPS')">
                                                        <input type="hidden" name="type[]" value="OPS">
                                                        <input type="hidden" name="filename[]" value="Ordre de prélèvement sur salaire">
                                                    </div>
                                                    <div id="OPS" class="mt-3 preview-area"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- RIB --}}
                                    <div class="col-12 d-none" id="divRIB">
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label class="form-label">Rélévé d'identité bancaire (RIB)</label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="input-group">
                                                        <input id="CNIverso-file-uploa" class="form-control"
                                                            type="file" name="libelle[]"
                                                            accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                            onchange="previewFilesPrestAutre(event, 'RIB')">
                                                        <input type="hidden" name="type[]" value="RIB">
                                                        <input type="hidden" name="filename[]" value="RIB">
                                                    </div>
                                                    <div id="RIB" class="mt-3 preview-area"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Conditions particulières du contrat ou bulletin de souscription --}}
                                    <div class="col-12 d-none" id="divConditionsParticulières">
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label class="form-label">Conditions particulières du contrat ou
                                                        bulletin de souscription</label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="input-group">
                                                        <input id="CNIverso-file-uploa" class="form-control"
                                                            type="file" name="libelle[]"
                                                            accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                            onchange="previewFilesPrestAutre(event, 'conditionsParticulières')">
                                                        <input type="hidden" name="type[]"
                                                            value="conditionsParticulières">
                                                        <input type="hidden" name="filename[]"
                                                            value="CP ou bulletin de souscription">
                                                    </div>
                                                    <div id="conditionsParticulières" class="mt-3 preview-area"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Fiche d'identification du numéro de téléphone (fournie par les operateurs mobile) --}}
                                    <div class="col-12 d-none" id="divFicheIdentification">
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label class="form-label">Fiche d'identification du numéro de téléphone
                                                        (fournie par les operateurs mobile)</label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="input-group">
                                                        <input id="CNIverso-file-uploa" class="form-control"
                                                            type="file" name="libelle[]"
                                                            accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                            onchange="previewFilesPrestAutre(event, 'ficheIdentification')">
                                                        <input type="hidden" name="type[]" value="ficheIdentification">
                                                        <input type="hidden" name="filename[]"
                                                            value="Fiche d'identification du numéro de téléphone">
                                                    </div>
                                                    <div id="ficheIdentification" class="mt-3 preview-area"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Copie de la carte professionnelle --}}
                                    <div class="col-12 d-none" id="divCarteProfessionnelle">
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label class="form-label">Copie de la carte professionnelle</label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="input-group">
                                                        <input id="CNIverso-file-uploa" class="form-control"
                                                            type="file" name="libelle[]"
                                                            accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                            onchange="previewFilesPrestAutre(event, 'CarteProfessionnelle')">
                                                        <input type="hidden" name="type[]"
                                                            value="CarteProfessionnelle">
                                                        <input type="hidden" name="filename[]"
                                                            value="Copie de la carte professionnelle">
                                                    </div>
                                                    <div id="CarteProfessionnelle" class="mt-3 preview-area"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- L'extrait d'acte de naissance de la personne concernée --}}
                                    <div class="col-12 d-none" id="divExtraitActeNaissance">
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label class="form-label">L'extrait d'acte de naissance de la personne
                                                        concernée</label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="input-group">
                                                        <input id="CNIverso-file-uploa" class="form-control"
                                                            type="file" name="libelle[]"
                                                            accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                            onchange="previewFilesPrestAutre(event, 'extraitActeNaissance')">
                                                        <input type="hidden" name="type[]"
                                                            value="extraitActeNaissance">
                                                        <input type="hidden" name="filename[]"
                                                            value="Extrait d'acte de naissance">
                                                    </div>
                                                    <div id="extraitActeNaissance" class="mt-3 preview-area"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Certicat de décès du souscripteur --}}
                                    <div class="col-12 d-none" id="divCerticatDeces">
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label class="form-label">Certicat de décès du souscripteur</label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="input-group">
                                                        <input id="CNIverso-file-uploa" class="form-control"
                                                            type="file" name="libelle[]"
                                                            accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                            onchange="previewFilesPrestAutre(event, 'certicatDeces')">
                                                        <input type="hidden" name="type[]" value="certicatDeces">
                                                        <input type="hidden" name="filename[]"
                                                            value="Certicat de décès du souscripteur">
                                                    </div>
                                                    <div id="certicatDeces" class="mt-3 preview-area"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- L'extrait d'acte de décès du souscripteur --}}
                                    <div class="col-12 d-none" id="divExtraitActeDeces">
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label class="form-label">L'extrait d'acte de décès du
                                                        souscripteur</label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="input-group">
                                                        <input id="CNIverso-file-uploa" class="form-control"
                                                            type="file" name="libelle[]"
                                                            accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                            onchange="previewFilesPrestAutre(event, 'extraitActeDeces')">
                                                        <input type="hidden" name="type[]" value="extraitActeDeces">
                                                        <input type="hidden" name="filename[]"
                                                            value="Extrait d'acte de décès du souscripteur">
                                                    </div>
                                                    <div id="extraitActeDeces" class="mt-3 preview-area"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Carte Nationale d’Identité de l'assuré(e) --}}
                                    <div class="col-12 d-none" id="divCNIAssure">
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label class="form-label">Carte Nationale d’Identité de l'assuré(e)
                                                        <strong><small>(CNI)</small></strong>
                                                    </label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-12 col-md-6 mb-3">
                                                            <label class="form-label"><strong><small>
                                                                        Recto</small></strong></label>
                                                            <div class="input-group">
                                                                <input id="CNIrecto-file-uploa" class="form-control"
                                                                    type="file" name="libelle[]"
                                                                    accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                                    onchange="previewFilesPrestAutre(event, 'CNIrectoAssure')">
                                                                <input type="hidden" name="type[]"
                                                                    value="CNIrectoAssure">
                                                                <input type="hidden" name="filename[]"
                                                                    value="CNI recto de l'assuré(e)">
                                                            </div>
                                                            <div id="CNIrectoAssure" class="mt-3 preview-area"></div>
                                                        </div>
                                                        <div class="col-12 col-md-6 mb-3">
                                                            <label class="form-label"><strong><small>
                                                                        Verso</small></strong></label>
                                                            <div class="input-group">
                                                                <input id="CNIverso-file-uploa" class="form-control"
                                                                    type="file" name="libelle[]"
                                                                    accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                                    onchange="previewFilesPrestAutre(event, 'CNIversoAssure')">
                                                                <input type="hidden" name="type[]"
                                                                    value="CNIversoAssure">
                                                                <input type="hidden" name="filename[]"
                                                                    value="CNI verso de l'assuré(e)">
                                                            </div>
                                                            <div id="CNIversoAssure" class="mt-3 preview-area"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Carte Nationale d’Identité de la personne concernée --}}
                                    <div class="col-12 d-none" id="divCNIPersonneConcernee">
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label class="form-label">Carte Nationale d’Identité de la personne
                                                        concernée
                                                        <strong><small>(CNI)</small></strong>
                                                    </label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-12 col-md-6 mb-3">
                                                            <label class="form-label"><strong><small>
                                                                        Recto</small></strong></label>
                                                            <div class="input-group">
                                                                <input id="CNIrecto-file-uploa" class="form-control"
                                                                    type="file" name="libelle[]"
                                                                    accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                                    onchange="previewFilesPrestAutre(event, 'CNIrecto')">
                                                                <input type="hidden" name="type[]" value="CNIrecto">
                                                                <input type="hidden" name="filename[]"
                                                                    value="CNI recto de la personne concernée">
                                                            </div>
                                                            <div id="CNIrecto" class="mt-3 preview-area"></div>
                                                        </div>
                                                        <div class="col-12 col-md-6 mb-3">
                                                            <label class="form-label"><strong><small>
                                                                        Verso</small></strong></label>
                                                            <div class="input-group">
                                                                <input id="CNIverso-file-uploa" class="form-control"
                                                                    type="file" name="libelle[]"
                                                                    accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                                    onchange="previewFilesPrestAutre(event, 'CNIverso')">
                                                                <input type="hidden" name="type[]" value="CNIverso">
                                                                <input type="hidden" name="filename[]"
                                                                    value="CNI verso de la personne concernée">
                                                            </div>
                                                            <div id="CNIverso" class="mt-3 preview-area"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Carte Nationale d’Identité du bénéficiaire --}}
                                    <div class="col-12 d-none" id="divCNIBeneficiaire">
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label class="form-label">Carte Nationale d’Identité du bénéficiaire
                                                        <strong><small>(CNI)</small></strong>
                                                    </label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-12 col-md-6 mb-3">
                                                            <label class="form-label"><strong><small>
                                                                        Recto</small></strong></label>
                                                            <div class="input-group">
                                                                <input id="CNIrecto-file-uploa" class="form-control"
                                                                    type="file" name="libelle[]"
                                                                    accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                                    onchange="previewFilesPrestAutre(event, 'CNIrectoBeneficiaire')">
                                                                <input type="hidden" name="type[]"
                                                                    value="CNIrectoBeneficiaire">
                                                                <input type="hidden" name="filename[]"
                                                                    value="CNI recto du bénéficiaire">
                                                            </div>
                                                            <div id="CNIrectoBeneficiaire" class="mt-3 preview-area">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 mb-3">
                                                            <label class="form-label"><strong><small>
                                                                        Verso</small></strong></label>
                                                            <div class="input-group">
                                                                <input id="CNIverso-file-uploa" class="form-control"
                                                                    type="file" name="libelle[]"
                                                                    accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                                    onchange="previewFilesPrestAutre(event, 'CNIversoBeneficiaire')">
                                                                <input type="hidden" name="type[]"
                                                                    value="CNIversoBeneficiaire">
                                                                <input type="hidden" name="filename[]"
                                                                    value="CNI verso du bénéficiaire">
                                                            </div>
                                                            <div id="CNIversoBeneficiaire" class="mt-3 preview-area">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Carte Nationale d’Identité du payeur de prime --}}
                                    <div class="col-12 d-none" id="divCNIpayeurPrime">
                                        <div class="mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <label class="form-label">Carte Nationale d’Identité du payeur de prime
                                                        <strong><small>(CNI)</small></strong>
                                                    </label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-12 col-md-6 mb-3">
                                                            <label class="form-label"><strong><small>
                                                                        Recto</small></strong></label>
                                                            <div class="input-group">
                                                                <input id="CNIrecto-file-uploa" class="form-control"
                                                                    type="file" name="libelle[]"
                                                                    accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                                    onchange="previewFilesPrestAutre(event, 'CNIrectoPayeurPrime')">
                                                                <input type="hidden" name="type[]"
                                                                    value="CNIrectoPayeurPrime">
                                                                <input type="hidden" name="filename[]"
                                                                    value="CNI recto du payeur de prime">
                                                            </div>
                                                            <div id="CNIrectoPayeurPrime" class="mt-3 preview-area"></div>
                                                        </div>
                                                        <div class="col-12 col-md-6 mb-3">
                                                            <label class="form-label"><strong><small>
                                                                        Verso</small></strong></label>
                                                            <div class="input-group">
                                                                <input id="CNIverso-file-uploa" class="form-control"
                                                                    type="file" name="libelle[]"
                                                                    accept=".jpg, .png, image/jpeg, image/png, .pdf"
                                                                    onchange="previewFilesPrestAutre(event, 'CNIversoPayeurPrime')">
                                                                <input type="hidden" name="type[]"
                                                                    value="CNIversoPayeurPrime">
                                                                <input type="hidden" name="filename[]"
                                                                    value="CNI verso du payeur de prime">
                                                            </div>
                                                            <div id="CNIversoPayeurPrime" class="mt-3 preview-area"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Signature & Soumission -->
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end gap-3">
                                <button type="button" class="btn-prime" data-bs-toggle="modal"
                                    data-bs-target="#qrCodeModal" id="signatureBtn">
                                    Signer électroniquement
                                </button>
                                <button type="submit" class="btn-prime btn-prime-two d-none" id="submitBtn">
                                    Transmettre à YAKO AFRICA Assurance Vie
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    @include('users.espace_client.services.prestations.modals.signModal')
    <!--end stepper one-->

    <script>
        function previewFilesPrestAutre(event, previewAreaId) {
            const files = event.target.files;
            const previewArea = document.getElementById(previewAreaId);
            previewArea.innerHTML = ''; // Effacer les aperçus précédents

            for (const file of files) {
                const fileType = file.type;
                const reader = new FileReader();

                reader.onload = function(e) {
                    let previewElement;
                    if (fileType.startsWith('image/')) {
                        previewElement = document.createElement('img');
                        previewElement.src = e.target.result;
                        previewElement.style.width = '100px';
                        previewElement.style.margin = '5px';
                    } else if (fileType === 'application/pdf') {
                        previewElement = document.createElement('embed');
                        previewElement.src = e.target.result;
                        previewElement.type = 'application/pdf';
                        previewElement.style.width = '100px';
                        previewElement.style.height = '100px';
                        previewElement.style.margin = '5px';
                    } else {
                        previewElement = document.createElement('p');
                        previewElement.textContent = file.name;
                    }
                    previewArea.appendChild(previewElement);
                };

                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formulaire = document.getElementById('PrestationAutre');
            if (!formulaire) {
                console.error("Le formulaire avec l'ID 'PrestationAutre' est introuvable !");
                return;
            }

            // Cibler l'élément avec le name "typeprestation"
            const typePrestation = formulaire.querySelector('[name="typeprestation"]');
            const motifAutre1 = document.getElementById('motifAutre1'); // ID spécifique pour le span
            const motifAutre2 = document.getElementById('motifAutre2'); // ID spécifique pour le span

            // Vérifiez si les éléments existent
            if (!typePrestation || !motifAutre1 || !motifAutre2) {
                console.error("Un ou plusieurs éléments HTML sont introuvables !");
                return;
            }

            // Fonction pour mettre à jour le texte du span
            function updateMotif() {
                const selectedValue = typePrestation.value; // Récupère la valeur sélectionnée
                console.log("Valeur sélectionnée :", selectedValue); // Log pour déboguer
                motifAutre1.textContent = selectedValue || "Aucun motif sélectionné"; // Met à jour le span
                motifAutre2.textContent = selectedValue || "Aucun motif sélectionné"; // Met à jour le span
            }

            // Ajouter un événement 'change' sur le select
            typePrestation.addEventListener('change', updateMotif);

            // Initialiser la valeur au chargement de la page
            updateMotif();
        });


        document.addEventListener('DOMContentLoaded', function() {
            const formulaire = document.getElementById('PrestationAutre');
            const typeOperation = @json($typeOperation);
            const contratDetails = @json($contratDetails);
            const payeur = @json($payeur);
            const dernierEncaissement = @json($dernierEncaissement);
            const typePrestation = formulaire?.querySelector('[name="typeprestation"]');
            const idContratInput = formulaire?.querySelector('[name="idcontrat"]');

            const divNouveauModePaiement = formulaire?.querySelector('#divNouveauModePaiement');
            const aCompterDuInput = formulaire?.querySelector('[name="aCompterDu"]');
            const nouveauModePaiementInput = formulaire?.querySelector('#nouveauModePaiement');

            const divNouvelleAdresse = formulaire?.querySelector('#divNouvelleAdresse');
            const nouvelleAdresseInput = formulaire?.querySelector('#nouvelleAdresse');

            const divNouvelleDateEffet = formulaire?.querySelector('#divNouvelleDateEffet');
            const nouvelleDateEffetInput = formulaire?.querySelector('#nouvelleDateEffet');

            const divSuspension = formulaire?.querySelector('#divSuspension');
            const dureeSuspensionInput = formulaire?.querySelector('#dureeSuspension');
            const aCompterDuSuspensionInput = formulaire?.querySelector('#aCompterDuSuspension');

            const divModificationDuree = formulaire?.querySelector('#divModificationDuree');
            const modifDureeContratSouhaiteeInput = formulaire?.querySelector('#modifDureeContratSouhaitee');

            const divNouveauContactTelephonique = formulaire?.querySelector('#divNouveauContactTelephonique');
            const nouveauContactTelephoniqueInput = formulaire?.querySelector('#nouveauContactTelephonique');

            const divAssureeAModifier = formulaire?.querySelector('#divAssureeAModifier');
            const divLieuNaissanceCorrect = formulaire?.querySelector('#divLieuNaissanceCorrect');
            const divDateNaissanceCorrect = formulaire?.querySelector('#divDateNaissanceCorrect');
            const divActeurAModifier = formulaire?.querySelector('#divActeurAModifier');
            const divFiliations = formulaire?.querySelector('#divFiliations');
            const assureeAModifierInput = formulaire?.querySelector('#assureeAModifier');
            const lieuNaissanceCorrectInput = formulaire?.querySelector('#lieuNaissanceCorrect');
            const dateNaissanceCorrectInput = formulaire?.querySelector('#dateNaissanceCorrect');
            const acteurAModifierInput = formulaire?.querySelector('#acteurAModifier');
            const filiationsInput = formulaire?.querySelector('#filiations');

            const OPSfileText = formulaire?.querySelector('#OPSfile');


            const divCNISouscripteur = formulaire?.querySelector('#divCNISouscripteur');
            const divOPS = formulaire?.querySelector('#divOPS');
            const divCNIPersonneConcernee = formulaire?.querySelector('#divCNIPersonneConcernee');
            const divRIB = formulaire?.querySelector('#divRIB');
            const divConditionsParticulières = formulaire?.querySelector('#divConditionsParticulières');
            const divFicheIdentification = formulaire?.querySelector('#divFicheIdentification');
            const divCarteProfessionnelle = formulaire?.querySelector('#divCarteProfessionnelle');
            const divExtraitActeNaissance = formulaire?.querySelector('#divExtraitActeNaissance');
            const divCerticatDeces = formulaire?.querySelector('#divCerticatDeces');
            const divExtraitActeDeces = formulaire?.querySelector('#divExtraitActeDeces');
            const divCNIAssure = formulaire?.querySelector('#divCNIAssure');
            const divCNIBeneficiaire = formulaire?.querySelector('#divCNIBeneficiaire');
            const divCNIpayeurPrime = formulaire?.querySelector('#divCNIpayeurPrime');

            const blockDocument = formulaire?.querySelector('#blockDocument');

            const divPreviewAreaCNISouscripteur = divCNISouscripteur?.querySelector('.preview-area');
            const divPreviewAreaCNIPersonneConcernee = divCNIPersonneConcernee?.querySelector('.preview-area');
            const divPreviewAreaRIB = divRIB?.querySelector('.preview-area');
            const divPreviewAreaCarteProfessionnelle = divCarteProfessionnelle?.querySelector('.preview-area');
            const divPreviewAreaExtraitActeNaissance = divExtraitActeNaissance?.querySelector('.preview-area');
            const divPreviewAreaCerticatDeces = divCerticatDeces?.querySelector('.preview-area');
            const divPreviewAreaExtraitActeDeces = divExtraitActeDeces?.querySelector('.preview-area');
            const divPreviewAreaCNIAssure = divCNIAssure?.querySelector('.preview-area');
            const divPreviewAreaCNIBeneficiaire = divCNIBeneficiaire?.querySelector('.preview-area');
            const divPreviewAreaCNIpayeurPrime = divCNIpayeurPrime?.querySelector('.preview-area');
            const divPreviewAreaConditionsParticulières = divConditionsParticulières?.querySelector(
            '.preview-area');
            const divPreviewAreaFicheIdentification = divFicheIdentification?.querySelector('.preview-area');
            const divPreviewAreaOPS = divOPS?.querySelector('.preview-area');


            const filleCNISouscripteur = divCNISouscripteur?.querySelectorAll('input[type="file"]');
            const filleCNIPersonneConcernee = divCNIPersonneConcernee?.querySelectorAll('input[type="file"]');
            const filleRIB = divRIB?.querySelectorAll('input[type="file"]');
            const filleCarteProfessionnelle = divCarteProfessionnelle?.querySelectorAll('input[type="file"]');
            const filleExtraitActeNaissance = divExtraitActeNaissance?.querySelectorAll('input[type="file"]');
            const filleCerticatDeces = divCerticatDeces?.querySelectorAll('input[type="file"]');
            const filleExtraitActeDeces = divExtraitActeDeces?.querySelectorAll('input[type="file"]');
            const filleCNIAssure = divCNIAssure?.querySelectorAll('input[type="file"]');
            const filleCNIBeneficiaire = divCNIBeneficiaire?.querySelectorAll('input[type="file"]');
            const filleCNIpayeurPrime = divCNIpayeurPrime?.querySelectorAll('input[type="file"]');
            const filleConditionsParticulières = divConditionsParticulières?.querySelectorAll('input[type="file"]');
            const filleFicheIdentification = divFicheIdentification?.querySelectorAll('input[type="file"]');
            const filleOPS = divOPS?.querySelectorAll('input[type="file"]');

            const formatDate = (dateString) => {
                if (!dateString) return '-';
                const date = new Date(dateString);
                return date.toLocaleDateString('fr-FR', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
            };
            const modePaiementSelect = [{
                    "idModePaiement": 1,
                    "CodePaiement": "SOURCE",
                    "libelle": "Prélèvement sur salaire au trésor public"
                },
                {
                    "idModePaiement": 2,
                    "CodePaiement": "CHK",
                    "libelle": "Chèque"
                },
                {
                    "idModePaiement": 3,
                    "CodePaiement": "ESP",
                    "libelle": "Espèces"
                },
                {
                    "idModePaiement": 4,
                    "CodePaiement": "VIR",
                    "libelle": "Virement bancaire"
                },
                {
                    "idModePaiement": 5,
                    "CodePaiement": "OVP",
                    "libelle": "Ordre Virement permanent"

                },
                {
                    "idModePaiement": 6,
                    "CodePaiement": "MANDAT",
                    "libelle": "Mandat postal"

                },
                {
                    "idModePaiement": 7,
                    "CodePaiement": "EBANK",
                    "libelle": "Mobile money"

                },
                {
                    "idModePaiement": 8,
                    "CodePaiement": "COMP",
                    "libelle": "Compensation de prime"

                },
                {
                    "idModePaiement": 9,
                    "CodePaiement": "SOCIETE",
                    "libelle": "Société"

                },
                {
                    "idModePaiement": 10,
                    "CodePaiement": "OV",
                    "libelle": "Ordre de Virement"

                },
                {
                    "idModePaiement": 11,
                    "CodePaiement": "VRC",
                    "libelle": "Versement sur compte"

                },
                {
                    "idModePaiement": 12,
                    "CodePaiement": "TRANSFERT",
                    "libelle": "Transfert"

                },
                {
                    "idModePaiement": 14,
                    "CodePaiement": "DEF",
                    "libelle": "DEFENSE"

                },
                {
                    "idModePaiement": 15,
                    "CodePaiement": "EVIR",
                    "libelle": "VIREMENT ELECTRONIQUE"

                }

                {{-- {
                    "idModePaiement": 13,
                    "CodePaiement": "PB",
                    "libelle": "PARTICIPATION AUX BENEFICES"

                }, --}}
            ];

            modePaiementSelect.forEach(mode => {
                const option = document.createElement('option');
                option.value = mode.CodePaiement;
                option.textContent = mode.libelle;
                document.getElementById('nouveauModePaiement').appendChild(option);
            });

            function verifierEtape(etapeId) {
                const etape = document.querySelector(etapeId);
                if (!etape) return;

                const btnSignature = etape.querySelector("#signatureBtn");
                const champsRequis = etape.querySelectorAll("input[required], select[required], textarea[required]");
                let valide = true;

                champsRequis.forEach(champ => {
                    let champValide = true;

                    if (champ.type === "radio" || champ.type === "checkbox") {
                        // Vérifie si au moins une option de ce groupe est cochée
                        const groupChecked = etape.querySelector(`input[name="${champ.name}"]:checked`);
                        champValide = !!groupChecked;
                    } else {
                        champValide = champ.value.trim() !== "";
                    }

                    if (!champValide) {
                        valide = false;
                        champ.classList.remove("is-valid");
                        champ.classList.add("is-invalid");
                    } else {
                        champ.classList.remove("is-invalid");
                        champ.classList.add("is-valid");
                    }
                });

                // Afficher ou masquer le bouton Signature
                if (valide) {
                    btnSignature.classList.remove("d-none");
                } else {
                    btnSignature.classList.add("d-none");
                }
            }


            // Vérifie en live sur tous les champs d'une étape
            function activerSurveillance(etapeId) {
                const etape = document.querySelector(etapeId);
                if (!etape) return;

                const champs = etape.querySelectorAll("input, select, textarea");
                champs.forEach(champ => {
                    champ.addEventListener("input", () => verifierEtape(etapeId));
                    champ.addEventListener("change", () => verifierEtape(etapeId));
                });
            }
   

            // Fonction pour mettre à jour le champ hidden
            function updateHiddenField(content) {
                const hiddenField = document.getElementById('msgClientHidden');
                if (hiddenField) {
                    hiddenField.value = content;
                }
            }

            function buildContent(selectedValue) {
                const CodeTypeOperation = typeOperation.find(op => op.MonLibelle == selectedValue)?.CodeTypeAvenant;
                const contrat = idContratInput?.value || '—';
                let modePaiement = '';
                let modePaiementSouhaite = '';
                let NumCompte = '';
                let societe = '';

                let dateNaissanceAssure = new Date(dateNaissanceCorrectInput?.value)

                let ageAssure = new Date().getFullYear() - dateNaissanceAssure.getFullYear();

                blockDocument.classList.remove('d-none');

                switch (dernierEncaissement?.RegltCodePaiement) {
                    case 'SOURCE':
                        modePaiement = 'Prélèvement sur salaire au trésor public';
                        if (payeur.length > 0) {
                            NumCompte = payeur[0].NumCompte;
                        }
                        break;
                    case 'CHK':
                        modePaiement = 'Chèque';
                        break;
                    case 'ESP':
                        modePaiement = 'Espèces';
                        break;
                    case 'VIR':
                        modePaiement = 'Virement bancaire';
                        if (payeur.length > 0) {
                            societe = payeur[0].Societe;
                        }
                        break;
                    case 'OVP':
                        modePaiement = 'Ordre Virement permanent';
                        break;
                    case 'MANDAT':
                        modePaiement = 'Mandat postal';
                        break;
                    case 'EBANK':
                        modePaiement = 'Mobile money';
                        break;
                    case 'COMP':
                        modePaiement = 'Compensation de prime';
                        break;
                    case 'SOCIETE':
                        modePaiement = 'Société';
                        break;
                    case 'ADF':
                        modePaiement = 'A definir';
                        break;
                    case 'OV':
                        modePaiement = 'Ordre de Virement';
                        break;
                    case 'VRC':
                        modePaiement = 'Versement sur compte';
                        break;
                    case 'TRANSFERT':
                        modePaiement = 'Transfert';
                        break;
                    case 'PB':
                        modePaiement = 'PARTICIPATION AUX BENEFICES';
                        break;
                    case 'DEF':
                        modePaiement = 'DEFENSE';
                        break;
                    case 'EVIR':
                        modePaiement = 'VIREMENT ELECTRONIQUE';
                        break;
                    default:
                        modePaiement = 'Autre';
                        break;
                }

                switch (nouveauModePaiementInput?.value) {
                    case 'SOURCE':
                        modePaiementSouhaite = 'Prélèvement sur salaire au trésor public';
                        if (payeur.length > 0) {
                            NumCompte = payeur[0].NumCompte;
                        }
                        break;
                    case 'CHK':
                        modePaiementSouhaite = 'Chèque';
                        break;
                    case 'ESP':
                        modePaiementSouhaite = 'Espèces';
                        break;
                    case 'VIR':
                        modePaiementSouhaite = 'Virement bancaire';
                        if (payeur.length > 0) {
                            societe = payeur[0].Societe;
                        }
                        break;
                    case 'OVP':
                        modePaiementSouhaite = 'Ordre Virement permanent';
                        break;
                    case 'MANDAT':
                        modePaiementSouhaite = 'Mandat postal';
                        break;
                    case 'EBANK':
                        modePaiementSouhaite = 'Mobile money';
                        break;
                    case 'COMP':
                        modePaiementSouhaite = 'Compensation de prime';
                        break;
                    case 'SOCIETE':
                        modePaiementSouhaite = 'Société';
                        break;
                    case 'ADF':
                        modePaiementSouhaite = 'A definir';
                        break;
                    case 'OV':
                        modePaiementSouhaite = 'Ordre de Virement';
                        break;
                    case 'VRC':
                        modePaiementSouhaite = 'Versement sur compte';
                        break;
                    case 'TRANSFERT':
                        modePaiementSouhaite = 'Transfert';
                        break;
                    case 'PB':
                        modePaiementSouhaite = 'PARTICIPATION AUX BENEFICES';
                        break;
                    case 'DEF':
                        modePaiementSouhaite = 'DEFENSE';
                        break;
                    case 'EVIR':
                        modePaiementSouhaite = 'VIREMENT ELECTRONIQUE';
                        break;
                    default:
                        modePaiementSouhaite = 'Autre';
                        break;
                }
                let content = '';
                if (CodeTypeOperation == '7') {
                    divNouveauModePaiement.classList.remove('d-none');
                    nouveauModePaiementInput.required = true;
                    aCompterDuInput.required = true;
                    divNouvelleAdresse.classList.add('d-none');
                    nouvelleAdresseInput.required = false;

                    divNouvelleDateEffet.classList.add('d-none');
                    nouvelleDateEffetInput.required = false;

                    divSuspension.classList.add('d-none');
                    dureeSuspensionInput.required = false;
                    aCompterDuSuspensionInput.required = false;

                    divModificationDuree.classList.add('d-none');
                    modifDureeContratSouhaiteeInput.required = false;

                    divNouveauContactTelephonique.classList.add('d-none');
                    nouveauContactTelephoniqueInput.required = false;

                    divAssureeAModifier.classList.add('d-none');
                    divLieuNaissanceCorrect.classList.add('d-none');
                    divDateNaissanceCorrect.classList.add('d-none');
                    assureeAModifierInput.required = false;
                    lieuNaissanceCorrectInput.required = false;
                    dateNaissanceCorrectInput.required = false;

                    divActeurAModifier.classList.add('d-none');
                    acteurAModifierInput.required = false;

                    divFiliations.classList.add('d-none');
                    filiationsInput.required = false;

                    divCNISouscripteur.classList.remove('d-none');
                    filleCNISouscripteur.forEach(file => {
                        file.required = true;
                    });

                    if (nouveauModePaiementInput.value == 'SOURCE' || nouveauModePaiementInput.value == 'SOCIETE' || nouveauModePaiementInput.value == 'DEF') {
                        divOPS.classList.remove('d-none');
                        filleOPS.forEach(file => {
                            file.required = true;
                        });
                        OPSfileText.classList.remove('d-none');
                    }else{
                        divOPS.classList.add('d-none');
                        filleOPS.forEach(file => {
                            file.required = false;
                            resetFileInput(file);
                        });
                        divPreviewAreaOPS.innerHTML = '';
                        OPSfileText.classList.add('d-none');
                    }

                    divFicheIdentification.classList.add('d-none');
                    filleFicheIdentification.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaFicheIdentification.innerHTML = '';

                    divCNIPersonneConcernee.classList.add('d-none');
                    filleCNIPersonneConcernee.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIPersonneConcernee.innerHTML = '';

                    divConditionsParticulières.classList.add('d-none');
                    filleConditionsParticulières.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaConditionsParticulières.innerHTML = '';

                    divCarteProfessionnelle.classList.add('d-none');
                    filleCarteProfessionnelle.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCarteProfessionnelle.innerHTML = '';

                    divExtraitActeNaissance.classList.add('d-none');
                    filleExtraitActeNaissance.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaExtraitActeNaissance.innerHTML = '';

                    divCerticatDeces.classList.add('d-none');
                    filleCerticatDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCerticatDeces.innerHTML = '';

                    divExtraitActeDeces.classList.add('d-none');
                    filleExtraitActeDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaExtraitActeDeces.innerHTML = '';

                    divCNIAssure.classList.add('d-none');
                    filleCNIAssure.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIAssure.innerHTML = '';

                    divCNIBeneficiaire.classList.add('d-none');
                    filleCNIBeneficiaire.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIBeneficiaire.innerHTML = '';

                    divCNIpayeurPrime.classList.add('d-none');
                    filleCNIpayeurPrime.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIpayeurPrime.innerHTML = '';

                    if (nouveauModePaiementInput?.value == 'SOURCE' || nouveauModePaiementInput?.value == 'DEF') {
                        divCarteProfessionnelle.classList.remove('d-none');
                        filleCarteProfessionnelle.forEach(file => {
                            file.required = true;
                        });

                        divRIB.classList.add('d-none');
                        filleRIB.forEach(file => {
                            file.required = false;
                            resetFileInput(file);
                        });
                        divPreviewAreaRIB.innerHTML = '';

                    } else if (nouveauModePaiementInput?.value == 'VIR') {
                        divRIB.classList.remove('d-none');
                        filleRIB.forEach(file => {
                            file.required = true;
                        });
                        divCarteProfessionnelle.classList.add('d-none');
                        filleCarteProfessionnelle.forEach(file => {
                            file.required = false;
                            //reintialiser le champ file
                            resetFileInput(file);
                        });
                        divPreviewAreaCarteProfessionnelle.innerHTML = '';

                    } else {
                        divRIB.classList.add('d-none');
                        filleRIB.forEach(file => {
                            file.required = false;
                            resetFileInput(file);
                        });
                        divPreviewAreaRIB.innerHTML = '';

                        divCarteProfessionnelle.classList.add('d-none');
                        filleCarteProfessionnelle.forEach(file => {
                            file.required = false;
                            resetFileInput(file);
                        });
                        divPreviewAreaCarteProfessionnelle.innerHTML = '';
                    }
                    content = `
                        <p>Monsieur,</p>
                        <p>Je viens par la présente demander un <strong>${selectedValue || '...'}</strong> de mon contrat <strong>${contrat}</strong>.</p>
                        <p><strong><u>Mode de paiement actuel :</u></strong></p>
                        <ul>
                            <li>${modePaiement}</li>
                            ${
                                dernierEncaissement?.RegltCodePaiement == 'SOURCE' ? 
                                `<li>Matricule : <strong>${NumCompte}</strong></li>` : 
                                dernierEncaissement?.RegltCodePaiement == 'VIR' ? 
                                `<li>Banque : <strong>${societe}</strong></li>` : ''
                            }
                        </ul>
                        <p><strong><u>Mode de paiement souhaité :</u></strong></p>
                        <ul>
                            <li>${modePaiementSouhaite}</li>
                        </ul>
                        <p>A compter du ${formatDate(aCompterDuInput?.value)}</p>
                        <p>Dans l’attente d’une suite favorable.<br>Veuillez recevoir Monsieur le Directeur, l’expression de mes salutations les plus sincères.</p>
                    `;
                } else if (CodeTypeOperation == '6') {
                    divCNISouscripteur.classList.remove('d-none');
                    filleCNISouscripteur.forEach(file => {
                        file.required = true;
                    });

                    divOPS.classList.add('d-none');
                    filleOPS.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaOPS.innerHTML = '';

                    divCarteProfessionnelle.classList.add('d-none');
                    filleCarteProfessionnelle.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCarteProfessionnelle.innerHTML = '';

                    divCNIPersonneConcernee.classList.add('d-none');
                    filleCNIPersonneConcernee.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIPersonneConcernee.innerHTML = '';

                    divRIB.classList.add('d-none');
                    filleRIB.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaRIB.innerHTML = '';

                    divFicheIdentification.classList.add('d-none');
                    filleFicheIdentification.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaFicheIdentification.innerHTML = '';

                    divConditionsParticulières.classList.add('d-none');
                    filleConditionsParticulières.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaConditionsParticulières.innerHTML = '';

                    divExtraitActeNaissance.classList.add('d-none');
                    filleExtraitActeNaissance.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaExtraitActeNaissance.innerHTML = '';

                    divCerticatDeces.classList.add('d-none');
                    filleCerticatDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCerticatDeces.innerHTML = '';

                    divExtraitActeDeces.classList.add('d-none');
                    filleExtraitActeDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaExtraitActeDeces.innerHTML = '';

                    divCNIAssure.classList.add('d-none');
                    filleCNIAssure.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIAssure.innerHTML = '';

                    divCNIBeneficiaire.classList.add('d-none');
                    filleCNIBeneficiaire.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIBeneficiaire.innerHTML = '';

                    divCNIpayeurPrime.classList.add('d-none');
                    filleCNIpayeurPrime.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIpayeurPrime.innerHTML = '';

                    content = `
                        <p>Monsieur,</p>
                        <p>Je viens par la présente demander un <strong>${selectedValue || '...'}</strong> de mon contrat <strong>${contrat}</strong>.</p>
                        <p><strong><u>Nouvelle date d'effet souhaitée :</u></strong></p>
                        <ul>
                            <li>${formatDate(nouvelleDateEffetInput?.value)}</li>
                        </ul>
                        <p>Dans l’attente d’une suite favorable.<br>Veuillez recevoir Monsieur le Directeur, l’expression de mes salutations les plus sincères.</p>
                    `;
                    divNouvelleDateEffet.classList.remove('d-none');
                    nouvelleDateEffetInput.required = true;
                    divNouvelleAdresse.classList.add('d-none');
                    nouvelleAdresseInput.required = false;

                    divNouveauModePaiement.classList.add('d-none');
                    aCompterDuInput.required = false;
                    nouveauModePaiementInput.required = false;

                    divNouveauContactTelephonique.classList.add('d-none');
                    nouveauContactTelephoniqueInput.required = false;

                    divSuspension.classList.add('d-none');
                    dureeSuspensionInput.required = false;
                    aCompterDuSuspensionInput.required = false;

                    divModificationDuree.classList.add('d-none');
                    modifDureeContratSouhaiteeInput.required = false;

                    divAssureeAModifier.classList.add('d-none');
                    divLieuNaissanceCorrect.classList.add('d-none');
                    divDateNaissanceCorrect.classList.add('d-none');
                    assureeAModifierInput.required = false;
                    lieuNaissanceCorrectInput.required = false;
                    dateNaissanceCorrectInput.required = false;

                    divActeurAModifier.classList.add('d-none');
                    acteurAModifierInput.required = false;

                    divFiliations.classList.add('d-none');
                    filiationsInput.required = false;
                } else if (CodeTypeOperation == '3') {
                    divCNISouscripteur.classList.remove('d-none');
                    filleCNISouscripteur.forEach(file => {
                        file.required = true;
                    });
                    divOPS.classList.add('d-none');
                    filleOPS.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaOPS.innerHTML = '';
                    divCNIPersonneConcernee.classList.add('d-none');
                    filleCNIPersonneConcernee.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIPersonneConcernee.innerHTML = '';

                    divFicheIdentification.classList.remove('d-none');
                    filleFicheIdentification.forEach(file => {
                        file.required = true;
                    });

                    divRIB.classList.add('d-none');
                    filleRIB.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaRIB.innerHTML = '';

                    divConditionsParticulières.classList.add('d-none');
                    filleConditionsParticulières.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaConditionsParticulières.innerHTML = '';

                    divCarteProfessionnelle.classList.add('d-none');
                    filleCarteProfessionnelle.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCarteProfessionnelle.innerHTML = '';

                    divExtraitActeNaissance.classList.add('d-none');
                    filleExtraitActeNaissance.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaExtraitActeNaissance.innerHTML = '';

                    divCerticatDeces.classList.add('d-none');
                    filleCerticatDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCerticatDeces.innerHTML = '';

                    divExtraitActeDeces.classList.add('d-none');
                    filleExtraitActeDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaExtraitActeDeces.innerHTML = '';

                    divCNIAssure.classList.add('d-none');
                    filleCNIAssure.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIAssure.innerHTML = '';

                    divCNIBeneficiaire.classList.add('d-none');
                    filleCNIBeneficiaire.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIBeneficiaire.innerHTML = '';

                    divCNIpayeurPrime.classList.add('d-none');
                    filleCNIpayeurPrime.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIpayeurPrime.innerHTML = '';

                    content = `
                        <p>Monsieur,</p>
                        <p>Je viens par la présente demander un <strong>${selectedValue || '...'}</strong> de mon contrat <strong>${contrat}</strong>.</p>
                        <p><strong><u>Nouveau contact téléphonique souhaitée :</u></strong></p>
                        <ul>
                            <li>${nouveauContactTelephoniqueInput?.value}</li>
                        </ul>
                        <p>Dans l’attente d’une suite favorable.<br>Veuillez recevoir Monsieur le Directeur, l’expression de mes salutations les plus sincères.</p>
                    `;
                    divNouveauContactTelephonique.classList.remove('d-none');
                    nouveauContactTelephoniqueInput.required = true;

                    divNouvelleAdresse.classList.add('d-none');
                    nouvelleAdresseInput.required = false;

                    divSuspension.classList.add('d-none');
                    dureeSuspensionInput.required = false;
                    aCompterDuSuspensionInput.required = false;

                    divModificationDuree.classList.add('d-none');
                    modifDureeContratSouhaiteeInput.required = false;

                    divNouveauModePaiement.classList.add('d-none');
                    nouveauModePaiementInput.required = false;
                    aCompterDuInput.required = false;

                    divNouvelleDateEffet.classList.add('d-none');
                    nouvelleDateEffetInput.required = false;

                    divAssureeAModifier.classList.add('d-none');
                    divLieuNaissanceCorrect.classList.add('d-none');
                    divDateNaissanceCorrect.classList.add('d-none');
                    assureeAModifierInput.required = false;
                    lieuNaissanceCorrectInput.required = false;
                    dateNaissanceCorrectInput.required = false;

                    divActeurAModifier.classList.add('d-none');
                    acteurAModifierInput.required = false;

                    divFiliations.classList.add('d-none');
                    filiationsInput.required = false;

                } else if (CodeTypeOperation == '4' || CodeTypeOperation == '5' || CodeTypeOperation == 'AV1' ||
                    CodeTypeOperation == 'AV2' || CodeTypeOperation == 'AV4' || CodeTypeOperation == 'AV6' ||
                    CodeTypeOperation == 'AV7' || CodeTypeOperation == 'AV16' || CodeTypeOperation == 'AV10') {
                    divCNISouscripteur.classList.add('d-none');
                    filleCNISouscripteur.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNISouscripteur.innerHTML = '';
                    divOPS.classList.add('d-none');
                    filleOPS.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaOPS.innerHTML = '';

                    divCNIPersonneConcernee.classList.add('d-none');
                    filleCNIPersonneConcernee.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIPersonneConcernee.innerHTML = '';
                    divCNIAssure.classList.add('d-none');
                    filleCNIAssure.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIAssure.innerHTML = '';

                    divCNIBeneficiaire.classList.add('d-none');
                    filleCNIBeneficiaire.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIBeneficiaire.innerHTML = '';
                   

                    if (ageAssure < 18) {
                        divExtraitActeNaissance.classList.remove('d-none');
                        filleExtraitActeNaissance.forEach(file => {
                            file.required = true;
                        });

                        if (CodeTypeOperation == '4' || CodeTypeOperation == '5' || CodeTypeOperation == 'AV16' ||
                            CodeTypeOperation == 'AV10') {
                            divCNIAssure.classList.add('d-none');
                            filleCNIAssure.forEach(file => {
                                file.required = false;
                                resetFileInput(file);
                            });
                            divPreviewAreaCNIAssure.innerHTML = '';
                        }
                        if (CodeTypeOperation == 'AV4') {
                            divCNIBeneficiaire.classList.add('d-none');
                            filleCNIBeneficiaire.forEach(file => {
                                file.required = false;
                                resetFileInput(file);
                            });
                            divPreviewAreaCNIBeneficiaire.innerHTML = '';
                        }

                        if (CodeTypeOperation == 'AV1' || CodeTypeOperation == 'AV2' || CodeTypeOperation ==
                            'AV6' || CodeTypeOperation == 'AV7') {
                            divCNIPersonneConcernee.classList.add('d-none');
                            filleCNIPersonneConcernee.forEach(file => {
                                file.required = false;
                                resetFileInput(file);
                            });
                            divPreviewAreaCNIPersonneConcernee.innerHTML = '';
                        }
                    }
                    if (ageAssure >= 18) {
                        if (CodeTypeOperation == 'AV4') {
                            divCNIBeneficiaire.classList.remove('d-none');
                            filleCNIBeneficiaire.forEach(file => {
                                file.required = true;
                            });
                        }
                        if (CodeTypeOperation == 'AV1' || CodeTypeOperation == 'AV2' || CodeTypeOperation ==
                            'AV6' || CodeTypeOperation == 'AV7') {
                            divCNIPersonneConcernee.classList.remove('d-none');
                            filleCNIPersonneConcernee.forEach(file => {
                                file.required = true;
                            });
                        }
                        if (CodeTypeOperation == '4' || CodeTypeOperation == '5' || CodeTypeOperation == 'AV16' ||
                            CodeTypeOperation == 'AV10') {
                            divCNIAssure.classList.remove('d-none');
                            filleCNIAssure.forEach(file => {
                                file.required = true;
                            });
                        }
                        divExtraitActeNaissance.classList.add('d-none');
                        filleExtraitActeNaissance.forEach(file => {
                            file.required = false;
                            resetFileInput(file);
                        });
                        divPreviewAreaExtraitActeNaissance.innerHTML = '';
                    }

                    divCarteProfessionnelle.classList.add('d-none');
                    filleCarteProfessionnelle.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCarteProfessionnelle.innerHTML = '';
                    

                    divRIB.classList.add('d-none');
                    filleRIB.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaRIB.innerHTML = '';

                    divFicheIdentification.classList.add('d-none');
                    filleFicheIdentification.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaFicheIdentification.innerHTML = '';

                    divConditionsParticulières.classList.add('d-none');
                    filleConditionsParticulières.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaConditionsParticulières.innerHTML = '';


                    divCerticatDeces.classList.add('d-none');
                    filleCerticatDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCerticatDeces.innerHTML = '';

                    divExtraitActeDeces.classList.add('d-none');
                    filleExtraitActeDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaExtraitActeDeces.innerHTML = '';

                    divCNIpayeurPrime.classList.add('d-none');
                    filleCNIpayeurPrime.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIpayeurPrime.innerHTML = '';

                    content = `
                        <p>Monsieur,</p>
                        <p style="text-align: justify;">
                            Je viens par la présente demander une/un 
                            <strong>${selectedValue || '...'}</strong> 
                            ${
                                CodeTypeOperation == '4'
                                    ? `<strong>${assureeAModifierInput?.value || '...'}</strong>`
                                    : (CodeTypeOperation == 'AV1' || CodeTypeOperation == 'AV2' || CodeTypeOperation == 'AV6' || CodeTypeOperation == 'AV7')
                                        ? `pour <strong>${acteurAModifierInput?.value || '...'}</strong>`
                                        : ''
                            }
                            sur mon contrat <strong>${contrat}</strong>.
                        </p>
                        ${
                            CodeTypeOperation == '5' || CodeTypeOperation == 'AV6'
                                ? `<p>Le lieu de naissance correct est <strong>${lieuNaissanceCorrectInput?.value || '...'}</strong></p>`
                                : CodeTypeOperation == 'AV16'
                                    ? `<p>La date de naissance correcte est le <strong>${formatDate(dateNaissanceCorrectInput?.value)}</strong></p>`
                                    : CodeTypeOperation == 'AV7'
                                        ? `<p>La filiation correcte est <strong>${filiationsInput?.value || '...'}</strong></p>`
                                        : CodeTypeOperation == 'AV10' || CodeTypeOperation == 'AV4'
                                            ? `<ul>
                                                        <li>Filiation : <strong>${filiationsInput?.value || '...'}</strong></li>
                                                        <li>Date de naissance : <strong>${formatDate(dateNaissanceCorrectInput?.value)}</strong></li>
                                                    </ul>`
                                            : ''
                        }
                        <p>
                            Dans l’attente d’une suite favorable.<br>
                            Veuillez recevoir Monsieur le Directeur, l’expression de mes salutations les plus sincères.
                        </p>
                    `;

                    divNouveauContactTelephonique.classList.add('d-none');
                    nouveauContactTelephoniqueInput.required = false;

                    divNouvelleAdresse.classList.add('d-none');
                    nouvelleAdresseInput.required = false;

                    divSuspension.classList.add('d-none');
                    dureeSuspensionInput.required = false;
                    aCompterDuSuspensionInput.required = false;

                    divModificationDuree.classList.add('d-none');
                    modifDureeContratSouhaiteeInput.required = false;

                    divNouvelleDateEffet.classList.add('d-none');
                    nouvelleDateEffetInput.required = false;

                    divNouveauModePaiement.classList.add('d-none');
                    aCompterDuInput.required = false;
                    nouveauModePaiementInput.required = false;

                    divAssureeAModifier.classList.add('d-none');
                    assureeAModifierInput.required = false;

                    divActeurAModifier.classList.add('d-none');
                    acteurAModifierInput.required = false;

                    divFiliations.classList.add('d-none');
                    filiationsInput.required = false;

                    divDateNaissanceCorrect.classList.add('d-none');
                    dateNaissanceCorrectInput.required = false;

                    divLieuNaissanceCorrect.classList.add('d-none');
                    lieuNaissanceCorrectInput.required = false;

                    if (CodeTypeOperation == '4' || CodeTypeOperation == 'AV16') {
                        divAssureeAModifier.classList.remove('d-none');
                        assureeAModifierInput.required = true;

                        divDateNaissanceCorrect.classList.remove('d-none');
                        dateNaissanceCorrectInput.required = true;
                    } else if (CodeTypeOperation == '5' || CodeTypeOperation == 'AV6') {
                        if (CodeTypeOperation == 'AV6') {
                            divActeurAModifier.classList.remove('d-none');
                            acteurAModifierInput.required = true;

                            divAssureeAModifier.classList.add('d-none');
                            assureeAModifierInput.required = false;
                        } else if (CodeTypeOperation == '5') {
                            divAssureeAModifier.classList.remove('d-none');
                            assureeAModifierInput.required = true;

                            divActeurAModifier.classList.add('d-none');
                            acteurAModifierInput.required = false;
                        }

                        divLieuNaissanceCorrect.classList.remove('d-none');
                        lieuNaissanceCorrectInput.required = true;

                        divDateNaissanceCorrect.classList.remove('d-none');
                        dateNaissanceCorrectInput.required = true;
                    } else if (CodeTypeOperation == 'AV1' || CodeTypeOperation == 'AV2') {
                        divActeurAModifier.classList.remove('d-none');
                        acteurAModifierInput.required = true;

                        divAssureeAModifier.classList.add('d-none');
                        assureeAModifierInput.required = false;

                        divDateNaissanceCorrect.classList.remove('d-none');
                        dateNaissanceCorrectInput.required = true;
                    } else if (CodeTypeOperation == 'AV7') {
                        divActeurAModifier.classList.remove('d-none');
                        acteurAModifierInput.required = true;

                        divFiliations.classList.remove('d-none');
                        filiationsInput.required = true;

                        divDateNaissanceCorrect.classList.remove('d-none');
                        dateNaissanceCorrectInput.required = true;
                    } else if (CodeTypeOperation == 'AV10' || CodeTypeOperation == 'AV4') {
                        divFiliations.classList.remove('d-none');
                        filiationsInput.required = true;
                        divDateNaissanceCorrect.classList.remove('d-none');
                        dateNaissanceCorrectInput.required = true;
                    }
                } else if (CodeTypeOperation == 'AV15') {
                    divCNISouscripteur.classList.remove('d-none');
                    //recuperer tous les inputs de type file du bloc divCNISouscripteur
                    filleCNISouscripteur.forEach(file => {
                        file.required = true;
                    });

                    divCNIPersonneConcernee.classList.add('d-none');
                    filleCNIPersonneConcernee.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIPersonneConcernee.innerHTML = '';

                    divOPS.classList.add('d-none');
                    filleOPS.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaOPS.innerHTML = '';

                    divCarteProfessionnelle.classList.add('d-none');
                    filleCarteProfessionnelle.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCarteProfessionnelle.innerHTML = '';

                    divRIB.classList.add('d-none');
                    filleRIB.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaRIB.innerHTML = '';

                    divFicheIdentification.classList.add('d-none');
                    filleFicheIdentification.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaFicheIdentification.innerHTML = '';

                    divConditionsParticulières.classList.add('d-none');
                    filleConditionsParticulières.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaConditionsParticulières.innerHTML = '';

                    divCerticatDeces.classList.add('d-none');
                    filleCerticatDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCerticatDeces.innerHTML = '';

                    divExtraitActeDeces.classList.add('d-none');
                    filleExtraitActeDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaExtraitActeDeces.innerHTML = '';

                    divCNIBeneficiaire.classList.add('d-none');
                    filleCNIBeneficiaire.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divCNIpayeurPrime.classList.add('d-none');
                    filleCNIpayeurPrime.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIpayeurPrime.innerHTML = '';

                    content = `
                        <p>Monsieur,</p>
                        <p style="text-align: justify;">
                            Je viens par la présente demander le 
                            <strong>${selectedValue || '...'}</strong>, <strong>${assureeAModifierInput?.value || '...'}</strong> sur mon contrat <strong>${contrat}</strong>.
                        </p>
                        <p>
                            Dans l’attente d’une suite favorable.<br>
                            Veuillez recevoir Monsieur le Directeur, l’expression de mes salutations les plus sincères.
                        </p>
                    `;

                    divAssureeAModifier.classList.remove('d-none');
                    assureeAModifierInput.required = true;

                    divNouvelleAdresse.classList.add('d-none');
                    nouvelleAdresseInput.required = false;

                    divSuspension.classList.add('d-none');
                    dureeSuspensionInput.required = false;
                    aCompterDuSuspensionInput.required = false;

                    divModificationDuree.classList.add('d-none');
                    modifDureeContratSouhaiteeInput.required = false;

                    divNouveauContactTelephonique.classList.add('d-none');
                    nouveauContactTelephoniqueInput.required = false;

                    divNouvelleDateEffet.classList.add('d-none');
                    nouvelleDateEffetInput.required = false;

                    divNouveauModePaiement.classList.add('d-none');
                    aCompterDuInput.required = false;
                    nouveauModePaiementInput.required = false;

                    divActeurAModifier.classList.add('d-none');
                    acteurAModifierInput.required = false;

                    divFiliations.classList.add('d-none');
                    filiationsInput.required = false;

                    divDateNaissanceCorrect.classList.add('d-none');
                    dateNaissanceCorrectInput.required = false;

                    divLieuNaissanceCorrect.classList.add('d-none');
                    lieuNaissanceCorrectInput.required = false;

                } else if (CodeTypeOperation == '39') {
                    divCNISouscripteur.classList.remove('d-none');
                    //recuperer tous les inputs de type file du bloc divCNISouscripteur
                    filleCNISouscripteur.forEach(file => {
                        file.required = true;
                    });

                    divCerticatDeces.classList.remove('d-none');
                    filleCerticatDeces.forEach(file => {
                        file.required = true;
                    });
                    divExtraitActeDeces.classList.remove('d-none');
                    filleExtraitActeDeces.forEach(file => {
                        file.required = true;
                    });
                    divCNIpayeurPrime.classList.remove('d-none');
                    filleCNIpayeurPrime.forEach(file => {
                        file.required = true;
                    });

                    divOPS.classList.add('d-none');
                    filleOPS.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaOPS.innerHTML = '';

                    divCNIPersonneConcernee.classList.add('d-none');
                    filleCNIPersonneConcernee.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIPersonneConcernee.innerHTML = '';

                    divCarteProfessionnelle.classList.add('d-none');
                    filleCarteProfessionnelle.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCarteProfessionnelle.innerHTML = '';

                    divRIB.classList.add('d-none');
                    filleRIB.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaRIB.innerHTML = '';

                    divFicheIdentification.classList.add('d-none');
                    filleFicheIdentification.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaFicheIdentification.innerHTML = '';

                    divConditionsParticulières.classList.add('d-none');
                    filleConditionsParticulières.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaConditionsParticulières.innerHTML = '';

                    divCNIBeneficiaire.classList.add('d-none');
                    filleCNIBeneficiaire.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIBeneficiaire.innerHTML = '';

                    content = `
                        <p>Monsieur,</p>
                        <p style="text-align: justify;">
                            Je viens par la présente demander un 
                            <strong>Changement Payeur de Prime</strong> du contrat <strong>${contrat}</strong> en raison du décès du payeur de prime actuel.
                        </p>
                        <p>
                            Dans l’attente d’une suite favorable.<br>
                            Veuillez recevoir Monsieur le Directeur, l’expression de mes salutations les plus sincères.
                        </p>
                    `;

                    divAssureeAModifier.classList.add('d-none');
                    assureeAModifierInput.required = false;

                    divNouvelleAdresse.classList.add('d-none');
                    nouvelleAdresseInput.required = false;

                    divSuspension.classList.add('d-none');
                    dureeSuspensionInput.required = false;
                    aCompterDuSuspensionInput.required = false;

                    divModificationDuree.classList.add('d-none');
                    modifDureeContratSouhaiteeInput.required = false;

                    divNouveauContactTelephonique.classList.add('d-none');
                    nouveauContactTelephoniqueInput.required = false;

                    divNouvelleDateEffet.classList.add('d-none');
                    nouvelleDateEffetInput.required = false;

                    divNouveauModePaiement.classList.add('d-none');
                    aCompterDuInput.required = false;
                    nouveauModePaiementInput.required = false;

                    divActeurAModifier.classList.add('d-none');
                    acteurAModifierInput.required = false;

                    divFiliations.classList.add('d-none');
                    filiationsInput.required = false;

                    divDateNaissanceCorrect.classList.add('d-none');
                    dateNaissanceCorrectInput.required = false;

                    divLieuNaissanceCorrect.classList.add('d-none');
                    lieuNaissanceCorrectInput.required = false;
                } else if (CodeTypeOperation == '45') {
                    divCNISouscripteur.classList.remove('d-none');
                    //recuperer tous les inputs de type file du bloc divCNISouscripteur
                    filleCNISouscripteur.forEach(file => {
                        file.required = true;
                    });

                    divConditionsParticulières.classList.remove('d-none');
                    filleConditionsParticulières.forEach(file => {
                        file.required = true;
                    });

                    divOPS.classList.add('d-none');
                    filleOPS.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaOPS.innerHTML = '';

                    divCerticatDeces.classList.add('d-none');
                    filleCerticatDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCerticatDeces.innerHTML = '';

                    divExtraitActeDeces.classList.add('d-none');
                    filleExtraitActeDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaExtraitActeDeces.innerHTML = '';

                    divCNIpayeurPrime.classList.add('d-none');
                    filleCNIpayeurPrime.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIpayeurPrime.innerHTML = '';

                    divCNIPersonneConcernee.classList.add('d-none');
                    filleCNIPersonneConcernee.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIPersonneConcernee.innerHTML = '';

                    divCarteProfessionnelle.classList.add('d-none');
                    filleCarteProfessionnelle.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCarteProfessionnelle.innerHTML = '';

                    divRIB.classList.add('d-none');
                    filleRIB.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divFicheIdentification.classList.add('d-none');
                    filleFicheIdentification.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaFicheIdentification.innerHTML = '';

                    divCNIBeneficiaire.classList.add('d-none');
                    filleCNIBeneficiaire.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIBeneficiaire.innerHTML = '';

                    content = `
                        <p>Monsieur,</p>
                        <p style="text-align: justify;">
                            Je viens par la présente demander une <strong>${selectedValue || '...'} </strong> de mon contrat <strong>${contrat}</strong>.
                        </p>
                        <p>
                            Dans l’attente d’une suite favorable.<br>
                            Veuillez recevoir Monsieur le Directeur, l’expression de mes salutations les plus sincères.
                        </p>
                    `;

                    divAssureeAModifier.classList.add('d-none');
                    assureeAModifierInput.required = false;

                    divNouvelleAdresse.classList.add('d-none');
                    nouvelleAdresseInput.required = false;

                    divSuspension.classList.add('d-none');
                    dureeSuspensionInput.required = false;
                    aCompterDuSuspensionInput.required = false;

                    divModificationDuree.classList.add('d-none');
                    modifDureeContratSouhaiteeInput.required = false;

                    divNouveauContactTelephonique.classList.add('d-none');
                    nouveauContactTelephoniqueInput.required = false;

                    divNouvelleDateEffet.classList.add('d-none');
                    nouvelleDateEffetInput.required = false;

                    divNouveauModePaiement.classList.add('d-none');
                    aCompterDuInput.required = false;
                    nouveauModePaiementInput.required = false;

                    divActeurAModifier.classList.add('d-none');
                    acteurAModifierInput.required = false;

                    divFiliations.classList.add('d-none');
                    filiationsInput.required = false;

                    divDateNaissanceCorrect.classList.add('d-none');
                    dateNaissanceCorrectInput.required = false;

                    divLieuNaissanceCorrect.classList.add('d-none');
                    lieuNaissanceCorrectInput.required = false;
                } else if (CodeTypeOperation == '2') {
                    divCNISouscripteur.classList.remove('d-none');
                    //recuperer tous les inputs de type file du bloc divCNISouscripteur
                    filleCNISouscripteur.forEach(file => {
                        file.required = true;
                    });

                    divConditionsParticulières.classList.add('d-none');
                    filleConditionsParticulières.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaConditionsParticulières.innerHTML = '';

                    divOPS.classList.add('d-none');
                    filleOPS.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaOPS.innerHTML = '';

                    divCerticatDeces.classList.add('d-none');
                    filleCerticatDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCerticatDeces.innerHTML = '';

                    divExtraitActeDeces.classList.add('d-none');
                    filleExtraitActeDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaExtraitActeDeces.innerHTML = '';

                    divCNIpayeurPrime.classList.add('d-none');
                    filleCNIpayeurPrime.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIpayeurPrime.innerHTML = '';

                    divCNIPersonneConcernee.classList.add('d-none');
                    filleCNIPersonneConcernee.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIPersonneConcernee.innerHTML = '';

                    divCarteProfessionnelle.classList.add('d-none');
                    filleCarteProfessionnelle.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCarteProfessionnelle.innerHTML = '';

                    divRIB.classList.add('d-none');
                    filleRIB.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divFicheIdentification.classList.add('d-none');
                    filleFicheIdentification.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaFicheIdentification.innerHTML = '';

                    divCNIBeneficiaire.classList.add('d-none');
                    filleCNIBeneficiaire.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIBeneficiaire.innerHTML = '';

                    content = `
                        <p>Monsieur,</p>
                        <p>Je viens par la présente demander un <strong>${selectedValue || '...'}</strong> de mon contrat <strong>${contrat}</strong>.</p>
                        <p><strong><u>Nouvelle adresse souhaitée :</u></strong></p>
                        <ul>
                            <li>${nouvelleAdresseInput?.value}</li>
                        </ul>
                        <p>Dans l’attente d’une suite favorable.<br>Veuillez recevoir Monsieur le Directeur, l’expression de mes salutations les plus sincères.</p>
                    `;

                    divAssureeAModifier.classList.add('d-none');
                    assureeAModifierInput.required = false;

                    divNouvelleAdresse.classList.remove('d-none');
                    nouvelleAdresseInput.required = true;

                    divSuspension.classList.add('d-none');
                    dureeSuspensionInput.required = false;
                    aCompterDuSuspensionInput.required = false;

                    divModificationDuree.classList.add('d-none');
                    modifDureeContratSouhaiteeInput.required = false;

                    divNouveauContactTelephonique.classList.add('d-none');
                    nouveauContactTelephoniqueInput.required = false;

                    divNouvelleDateEffet.classList.add('d-none');
                    nouvelleDateEffetInput.required = false;

                    divNouveauModePaiement.classList.add('d-none');
                    aCompterDuInput.required = false;
                    nouveauModePaiementInput.required = false;

                    divActeurAModifier.classList.add('d-none');
                    acteurAModifierInput.required = false;

                    divFiliations.classList.add('d-none');
                    filiationsInput.required = false;

                    divDateNaissanceCorrect.classList.add('d-none');
                    dateNaissanceCorrectInput.required = false;

                    divLieuNaissanceCorrect.classList.add('d-none');
                    lieuNaissanceCorrectInput.required = false;
                } else if (CodeTypeOperation == 'AV5') {
                    divCNISouscripteur.classList.remove('d-none');
                    //recuperer tous les inputs de type file du bloc divCNISouscripteur
                    filleCNISouscripteur.forEach(file => {
                        file.required = true;
                    });

                    divConditionsParticulières.classList.add('d-none');
                    filleConditionsParticulières.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaConditionsParticulières.innerHTML = '';

                    divOPS.classList.add('d-none');
                    filleOPS.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaOPS.innerHTML = '';

                    divCerticatDeces.classList.add('d-none');
                    filleCerticatDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCerticatDeces.innerHTML = '';

                    divExtraitActeDeces.classList.add('d-none');
                    filleExtraitActeDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaExtraitActeDeces.innerHTML = '';

                    divCNIpayeurPrime.classList.add('d-none');
                    filleCNIpayeurPrime.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIpayeurPrime.innerHTML = '';

                    divCNIPersonneConcernee.classList.add('d-none');
                    filleCNIPersonneConcernee.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIPersonneConcernee.innerHTML = '';

                    divCarteProfessionnelle.classList.add('d-none');
                    filleCarteProfessionnelle.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCarteProfessionnelle.innerHTML = '';

                    divRIB.classList.add('d-none');
                    filleRIB.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divFicheIdentification.classList.add('d-none');
                    filleFicheIdentification.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaFicheIdentification.innerHTML = '';

                    divCNIBeneficiaire.classList.add('d-none');
                    filleCNIBeneficiaire.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIBeneficiaire.innerHTML = '';

                    content = `
                        <p>Monsieur,</p>
                        <p>Je viens par la présente demander une <strong>${selectedValue || '...'} </strong> <strong>${contrat}</strong>.</p>
                        <p><strong><u>Durée actuelle du contrat :</u></strong></p>
                        <ul>
                            <li>${contratDetails?.DureeCotisationAns} ans</li>
                        </ul>
                        <p><strong><u>Nouvelle durée souhaitée :</u></strong></p>
                        <ul>
                            <li>${modifDureeContratSouhaiteeInput?.value} ans</li>
                        </ul>
                        <p>Dans l’attente d’une suite favorable.<br>Veuillez recevoir Monsieur le Directeur, l’expression de mes salutations les plus sincères.</p>
                    `;

                    divAssureeAModifier.classList.add('d-none');
                    assureeAModifierInput.required = false;

                    divNouvelleAdresse.classList.add('d-none');
                    nouvelleAdresseInput.required = false;

                    divSuspension.classList.add('d-none');
                    dureeSuspensionInput.required = false;
                    aCompterDuSuspensionInput.required = false;

                    divModificationDuree.classList.remove('d-none');
                    modifDureeContratSouhaiteeInput.required = true;

                    divNouveauContactTelephonique.classList.add('d-none');
                    nouveauContactTelephoniqueInput.required = false;

                    divNouvelleDateEffet.classList.add('d-none');
                    nouvelleDateEffetInput.required = false;

                    divNouveauModePaiement.classList.add('d-none');
                    aCompterDuInput.required = false;
                    nouveauModePaiementInput.required = false;

                    divActeurAModifier.classList.add('d-none');
                    acteurAModifierInput.required = false;

                    divFiliations.classList.add('d-none');
                    filiationsInput.required = false;

                    divDateNaissanceCorrect.classList.add('d-none');
                    dateNaissanceCorrectInput.required = false;

                    divLieuNaissanceCorrect.classList.add('d-none');
                    lieuNaissanceCorrectInput.required = false;
                } else if (CodeTypeOperation == 'SUS') {
                    divCNISouscripteur.classList.remove('d-none');
                    //recuperer tous les inputs de type file du bloc divCNISouscripteur
                    filleCNISouscripteur.forEach(file => {
                        file.required = true;
                    });

                    divConditionsParticulières.classList.add('d-none');
                    filleConditionsParticulières.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaConditionsParticulières.innerHTML = '';

                    divOPS.classList.add('d-none');
                    filleOPS.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaOPS.innerHTML = '';

                    divCerticatDeces.classList.add('d-none');
                    filleCerticatDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCerticatDeces.innerHTML = '';

                    divExtraitActeDeces.classList.add('d-none');
                    filleExtraitActeDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaExtraitActeDeces.innerHTML = '';

                    divCNIpayeurPrime.classList.add('d-none');
                    filleCNIpayeurPrime.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIpayeurPrime.innerHTML = '';

                    divCNIPersonneConcernee.classList.add('d-none');
                    filleCNIPersonneConcernee.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIPersonneConcernee.innerHTML = '';

                    divCarteProfessionnelle.classList.add('d-none');
                    filleCarteProfessionnelle.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCarteProfessionnelle.innerHTML = '';

                    divRIB.classList.add('d-none');
                    filleRIB.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divFicheIdentification.classList.add('d-none');
                    filleFicheIdentification.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaFicheIdentification.innerHTML = '';

                    divCNIBeneficiaire.classList.add('d-none');
                    filleCNIBeneficiaire.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIBeneficiaire.innerHTML = '';

                    content = `
                        <p>Monsieur,</p>
                        <p>Je viens par la présente demander une <strong>${selectedValue || '...'}</strong> de mon contrat <strong>${contrat}</strong> pour <strong>${dureeSuspensionInput?.value}</strong> mois à compter du <strong>${formatDate(aCompterDuSuspensionInput?.value)}</strong>.</p>
                        <p>Dans l’attente d’une suite favorable.<br>Veuillez recevoir Monsieur le Directeur, l’expression de mes salutations les plus sincères.</p>
                    `;

                    divAssureeAModifier.classList.add('d-none');
                    assureeAModifierInput.required = false;

                    divNouvelleAdresse.classList.add('d-none');
                    nouvelleAdresseInput.required = false;

                    divSuspension.classList.remove('d-none');
                    dureeSuspensionInput.required = true;
                    aCompterDuSuspensionInput.required = true;

                    divModificationDuree.classList.add('d-none');
                    modifDureeContratSouhaiteeInput.required = false;

                    divNouveauContactTelephonique.classList.add('d-none');
                    nouveauContactTelephoniqueInput.required = false;

                    divNouvelleDateEffet.classList.add('d-none');
                    nouvelleDateEffetInput.required = false;

                    divNouveauModePaiement.classList.add('d-none');
                    aCompterDuInput.required = false;
                    nouveauModePaiementInput.required = false;

                    divActeurAModifier.classList.add('d-none');
                    acteurAModifierInput.required = false;

                    divFiliations.classList.add('d-none');
                    filiationsInput.required = false;

                    divDateNaissanceCorrect.classList.add('d-none');
                    dateNaissanceCorrectInput.required = false;

                    divLieuNaissanceCorrect.classList.add('d-none');
                    lieuNaissanceCorrectInput.required = false;

                } else {
                    divCNISouscripteur.classList.remove('d-none');
                    //recuperer tous les inputs de type file du bloc divCNISouscripteur
                    filleCNISouscripteur.forEach(file => {
                        file.required = true;
                    });

                    divOPS.classList.add('d-none');
                    filleOPS.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaOPS.innerHTML = '';

                    divCNIPersonneConcernee.classList.add('d-none');
                    filleCNIPersonneConcernee.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIPersonneConcernee.innerHTML = '';

                    divCarteProfessionnelle.classList.add('d-none');
                    filleCarteProfessionnelle.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCarteProfessionnelle.innerHTML = '';

                    divRIB.classList.add('d-none');
                    filleRIB.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaRIB.innerHTML = '';

                    divFicheIdentification.classList.add('d-none');
                    filleFicheIdentification.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaFicheIdentification.innerHTML = '';

                    divConditionsParticulières.classList.add('d-none');
                    filleConditionsParticulières.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaConditionsParticulières.innerHTML = '';

                    divCNIBeneficiaire.classList.add('d-none');
                    filleCNIBeneficiaire.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIBeneficiaire.innerHTML = '';

                    divExtraitActeNaissance.classList.add('d-none');
                    filleExtraitActeNaissance.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaExtraitActeNaissance.innerHTML = '';

                    divCerticatDeces.classList.add('d-none');
                    filleCerticatDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCerticatDeces.innerHTML = '';
                    divExtraitActeDeces.classList.add('d-none');
                    filleExtraitActeDeces.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaExtraitActeDeces.innerHTML = '';

                    divCNIAssure.classList.add('d-none');
                    filleCNIAssure.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIAssure.innerHTML = '';

                    divCNIBeneficiaire.classList.add('d-none');
                    filleCNIBeneficiaire.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIBeneficiaire.innerHTML = '';

                    divCNIpayeurPrime.classList.add('d-none');
                    filleCNIpayeurPrime.forEach(file => {
                        file.required = false;
                        resetFileInput(file);
                    });
                    divPreviewAreaCNIpayeurPrime.innerHTML = '';

                    content = `
                        <p>Monsieur,</p>
                        <p>Je viens par la présente faire une demande de <strong>${selectedValue || '...'}</strong> de mon contrat <strong>${contrat}</strong>.</p>
                        <p>Dans l’attente d’une suite favorable.<br>Veuillez recevoir Monsieur le Directeur, l’expression de mes salutations les plus sincères.</p>
                    `;
                    divNouvelleDateEffet.classList.add('d-none');
                    divNouveauModePaiement.classList.add('d-none');

                    divNouvelleAdresse.classList.add('d-none');
                    nouvelleAdresseInput.required = false;

                    divSuspension.classList.add('d-none');
                    dureeSuspensionInput.required = false;
                    aCompterDuSuspensionInput.required = false;

                    divModificationDuree.classList.add('d-none');
                    modifDureeContratSouhaiteeInput.required = false;

                    divActeurAModifier.classList.add('d-none');
                    divFiliations.classList.add('d-none');
                    divNouveauContactTelephonique.classList.add('d-none');
                    nouveauContactTelephoniqueInput.required = false;
                    divAssureeAModifier.classList.add('d-none');
                    divLieuNaissanceCorrect.classList.add('d-none');
                    divDateNaissanceCorrect.classList.add('d-none');
                    assureeAModifierInput.required = false;
                    lieuNaissanceCorrectInput.required = false;
                    dateNaissanceCorrectInput.required = false;
                    aCompterDuInput.required = false;
                    nouvelleDateEffetInput.required = false;
                    nouveauModePaiementInput.required = false;
                    acteurAModifierInput.required = false;
                    filiationsInput.required = false;
                }
                updateHiddenField(content);
                return content;
            }

            function resetFileInput(fileInput) {
                if (fileInput) {
                    try {
                        fileInput.value = ""; // Méthode simple
                        if (fileInput.value) {
                            // Si le navigateur refuse de vider .value (cas rares)
                            const newInput = fileInput.cloneNode(true);
                            fileInput.parentNode.replaceChild(newInput, fileInput);
                        }
                    } catch (e) {
                        console.error("Impossible de réinitialiser le champ file :", e);
                    }
                }
            }

            function updateMotifInEditor(selectedValue) {
                const editor = tinymce.get('AutresInfos');
                if (editor) {
                    {{-- editor.setContent(buildContent(selectedValue || ''));
                    // Forcer lecture seule après maj
                    editor.mode.set('readonly');

                    // Mettre à jour le champ hidden
                    updateHiddenField(content); --}}

                    const content = buildContent(selectedValue || '');
            
                    editor.setContent(content);
                    // Forcer lecture seule après maj
                    editor.mode.set('readonly');
            
                    // Mettre à jour le champ hidden
                    updateHiddenField(content);
                }
            }

            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: '#AutresInfos',
                    menubar: false,
                    toolbar: false,
                    readonly: true, // lecture seule dès le départ
                    setup: function(editor) {
                        editor.on('init', function() {
                            updateMotifInEditor(typePrestation?.value || '');
                            // 🔒 reforce encore après l’init
                            editor.mode.set('readonly');

                            // Mettre à jour le champ hidden à l'initialisation
                            updateHiddenField(editor.getContent());
                        });
                        // Surveiller les changements (au cas où)
                        editor.on('change', function() {
                            updateHiddenField(editor.getContent());
                        });

                        editor.on('keyup', function() {
                            updateHiddenField(editor.getContent());
                        });
                    }
                });
            }

            if (typePrestation) {
                typePrestation.addEventListener('change', function() {
                    updateMotifInEditor(
                        typePrestation.value || ''
                    );
                });

                aCompterDuInput.addEventListener('change', function() {
                    updateMotifInEditor(
                        typePrestation?.value || ''
                    );
                });

                nouveauModePaiementInput.addEventListener('change', function() {
                    updateMotifInEditor(
                        typePrestation?.value || ''
                    );
                });
                dureeSuspensionInput.addEventListener('input', function() {
                    updateMotifInEditor(
                        typePrestation?.value || ''
                    );
                });
                aCompterDuSuspensionInput.addEventListener('change', function() {
                    updateMotifInEditor(
                        typePrestation?.value || ''
                    );
                });
                modifDureeContratSouhaiteeInput.addEventListener('input', function() {
                    updateMotifInEditor(
                        typePrestation?.value || ''
                    );
                });
                
                nouvelleDateEffetInput.addEventListener('change', function() {
                    updateMotifInEditor(
                        typePrestation?.value || ''
                    );
                });
                assureeAModifierInput.addEventListener('change', function() {
                    updateMotifInEditor(
                        typePrestation?.value || ''
                    );
                });
                acteurAModifierInput.addEventListener('change', function() {
                    updateMotifInEditor(
                        typePrestation?.value || ''
                    );
                });
                filiationsInput.addEventListener('change', function() {
                    updateMotifInEditor(
                        typePrestation?.value || ''
                    );
                });
                lieuNaissanceCorrectInput.addEventListener('input', function() {
                    updateMotifInEditor(
                        typePrestation?.value || ''
                    );
                });
                nouveauContactTelephoniqueInput.addEventListener('input', function() {
                    updateMotifInEditor(
                        typePrestation?.value || ''
                    );
                });
                nouvelleAdresseInput.addEventListener('input', function() {
                    updateMotifInEditor(
                        typePrestation?.value || ''
                    );
                });
                dateNaissanceCorrectInput.addEventListener('change', function() {
                    updateMotifInEditor(
                        typePrestation?.value || ''
                    );
                });
            }
            // Ajouter un gestionnaire pour le formulaire
            if (formulaire) {
                formulaire.addEventListener('submit', function(e) {
                    // S'assurer que le champ hidden est à jour avant soumission
                    const editor = tinymce.get('AutresInfos');
                    if (editor) {
                        updateHiddenField(editor.getContent());
                    }

                    // Validation supplémentaire si nécessaire
                    console.log('Contenu à soumettre:', document.getElementById('msgClientHidden').value);
                });
            }

             // Active la surveillance sur chaque étape
            activerSurveillance("#PrestationAutre");

            // Vérifie au chargement
            verifierEtape("#PrestationAutre");
        });
    </script>

    <script>
        const SIGN_API = "{{ config('services.sign_api') }}";
    </script>


    <script>
        let pollingInterval;

        const qrCodeModal = document.getElementById('qrCodeModal');
        const submitBtn = document.getElementById('submitBtn');
        const signatureBtn = document.getElementById('signatureBtn');

        qrCodeModal.addEventListener('shown.bs.modal', function() {

            const keyUuid = "{{ $keyUuid }}";
            const operationType = "{{ $operationType }}";

            // Polling toutes les 3 secondes pour vérifier l'état de la signature
            pollingInterval = setInterval(() => {
                fetch(`${SIGN_API}api/check-signature-status/${keyUuid}/${operationType}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status == 'completed') {
                            clearInterval(pollingInterval);

                            // Masquer la modale si la signature est terminée
                            const modal = bootstrap.Modal.getInstance(qrCodeModal);
                            modal.hide();

                            // Afficher un message indiquant que la signature est terminée utilise sweetalert
                            Swal.fire({
                                icon: 'success',
                                title: 'Signature terminée avec succès !',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                timer: 2000,
                                timerProgressBar: true,
                            });
                            submitBtn.classList.remove('d-none');
                            signatureBtn.classList.add('d-none');
                        }
                    })
                    .catch(error => {
                        console.error("Erreur de polling :", error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Une erreur s’est produite lors de la vérification.',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            position: 'center',
                            timerProgressBar: true,
                            timer: 5000
                        });
                    });
            }, 3000); // toutes les 3 secondes
        });

        // Si la modale est fermée, on arrête le polling
        qrCodeModal.addEventListener('hidden.bs.modal', function() {
            if (pollingInterval) {
                clearInterval(pollingInterval);
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("PrestationAutre");
            const btn = document.getElementById("submitBtn");

            btn.addEventListener("click", function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Traitement en cours...',
                    text: 'Veuillez patienter...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });

                const formData = new FormData(form);

                axios.post('{{ route('customer.prestation.storePrestAutre') }}', formData)
                    .then(function(response) {
                        if (response.data.type === "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Succès',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                text: response.data.message,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    if (response.data.url) {
                                        window.open(response.data.url, '_blank');
                                    }

                                    if (response.data.urlback) {
                                        window.location.href = response.data.urlback;
                                    }
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur...',
                                showConfirmButton: true,
                                confirmButtonText: 'Reessayer',
                                text: response.data.message,
                            });
                        }
                    })
                    .catch(function(error) {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur...',
                            showConfirmButton: true,
                            confirmButtonText: 'Reessayer',
                            text: response?.data?.message || "Une erreur est survenue.",
                        });
                    });
            });
        });
    </script>
@endsection
