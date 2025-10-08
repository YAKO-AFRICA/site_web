@extends('users.sinistre.layouts.main')

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

        @media (min-width: 992px) {

            /* lg breakpoint */
            .w-lg-20 {
                max-width: 20%;
            }

            .w-lg-15 {
                max-width: 25% !important;
            }
        }

        ul li {
            list-style: none;
        }

        /* Couleur de fond du bouton sélectionné */
        .nav-pills .nav-link.active {
            background-color: #076633 !important;
            color: #fff !important;
            /* Pour que le texte reste lisible */
        }

        .nav-pills .nav-link {
            color: #076633 !important;
        }
    </style>


    <!--breadcrumb-->

    {{-- <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

        <div class="breadcrumb-title pe-3">Sinistre</div>

        <div class="ps-3">

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb mb-0 p-0">

                    <li class="breadcrumb-item"><a href="javascript:;">
                            <i class="bx bx-home-alt"></i></a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">Modifier une proposition</li>

                </ol>

            </nav>

        </div>



    </div> --}}

    <div class="ms-auto">
        <div class="d-flex justify-content-end my-4">
            <div class="btn-group gap-1 gap-md-2 gap-lg-3">

                @if ($sinistre->etape != 1)
                    <form action="{{ route('sinistre.transmettreSinistre', $sinistre->code) }}" method="POST" class="submitForm">
                        @csrf
                        <button type="submit" class="btn-prime p-2 border-0 text-center"> Transmettre</button>
                    </form>
                @endif

            </div>
        </div>
    </div>

    <!--end breadcrumb-->

    <div class="row">

        <div class="col-12 col-lg-3">

            <div class="card">

                <center>
                    <div class="card-header">
                        <p>
                            <strong>Code :</strong> <span>{{ $sinistre->code ?? '' }}</span>
                        </p>
                        <p>
                            <center>Status :
                                @if ($sinistre->etape == 0)
                                    <span class="text-info badge rounded-pill  bg-light-info">En attente de
                                        transmission</span>
                                @elseif ($sinistre->etape == 1)
                                    <span class="text-primary badge rounded-pill  bg-light-primary">Transmise pour
                                        traitement</span>
                                @elseif ($sinistre->etape == 2)
                                    <span class="text-success badge rounded-pill  bg-light-success">Acceptée et en cours de
                                        traitement</span>
                                @elseif ($sinistre->etape == 3)
                                    <span class="text-danger badge rounded-pill bg-light-danger">Pré-déclaration
                                        rejetée</span>
                                @endif
                            </center>
                        </p>
                    </div>
                </center>

                <div class="card-body">

                    <h5 class="my-3 text-center text-uppercase">Modifier ma pré-déclaration</h5>

                </div>

            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-0 font-weight-bold">Documents joint <span data-bs-toggle="modal" data-bs-target="#add-doc-sinistre"
                            class="float-end text-secondary"> <i class="bx bx-add-to-queue"></i> </span></h5>
                    </p>
                    <div class="mt-3"></div>
                    @if ($sinistre && $sinistre->docSinistre && $sinistre->docSinistre->where('idSinistre', $sinistre->id)->count() > 0)
                        @forelse ($sinistre->docSinistre->where('idSinistre', $sinistre->id) as $doc)
                            <div class="d-flex align-items-center mt-3">
                                <div class="fm-file-box text-success"><i class='bx bxs-file-doc'></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0" style="font-size: 10px">
                                        {{ $doc->libelle }}
                                    </h6>
                                    <p class="mb-0 text-secondary" style="font-size: 0.6em">
                                        {{ $doc->created_at ?? '' }}
                                    </p>
                                </div>
                                <h6 class="text-primary mb-0 text-center">
                                    <a class="btn-prime py-2 px-4" data-bs-target="#view-bulletin{{ $doc->id }}"
                                        data-bs-toggle="modal" title="Preview">
                                        <i class="bx bx-show"></i>
                                    </a>
                                </h6>
                                <div class="modal fade" id="view-bulletin{{ $doc->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ $doc->libelle }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="width: 100%; height: 80vh">
                                                <iframe style="width: 100%; height: 100%" src="{{ asset($doc->path) }}"
                                                    frameborder="0"></iframe>
                                            </div>
                                            <div class="modal-footer">
                                            @if ($doc->libelle == 'Fiche de déclaration de sinistre')
                                                <button type="button" class="btn-prime btn-prime-two text-white">
                                                    <a class="text-white" href="{{ asset($doc->path) }}"
                                                        id="download-bulletin" title="Telecharger" download>Telecharger
                                                        <i class="bx bx-download"></i>
                                                    </a></button>
                                            @else
                                                <a href="javascript:;"
                                                    class="deleteConfirmation border ms-3 btn-prime btn-prime-two"
                                                    data-uuid="{{ $doc->id }}" data-type="confirmation_redirect"
                                                    data-placement="top" data-token="{{ csrf_token() }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Supprimer"
                                                    data-url="{{ route('sinistre.destroyDoc', $doc->id) }}"
                                                    data-title="Vous êtes sur le point de supprimer le document {{ $doc->libelle }} "
                                                    data-id="{{ $sinistre->code }}" data-param="0"
                                                    data-route="{{ route('sinistre.destroyDoc', $doc->id) }}">Supprimer
                                                    <i class='bx bxs-trash' style="cursor: pointer"></i>
                                                </a>
                                            @endif

                                                <button type="button" class="btn-prime"
                                                    data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-secondary">Aucun document joint</p>
                        @endforelse
                    @else
                        <p class="text-secondary">Aucun document joint</p>
                    @endif
                </div>

            </div>

        </div>

        <div class="col-12 col-lg-9">

            <div class="card">
                <div class="card-header bg-light">
                    <ul class="nav nav-pills  m-auto" style="width: 90%" id="pills-edit-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-sinistre-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-sinistre" type="button" role="tab"
                                aria-controls="pills-sinistre" aria-selected="true"><i class='bx bx-edit me-2'></i> Modifier
                                le detail du
                                sinistre</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-declarant-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-declarant" type="button" role="tab"
                                aria-controls="pills-declarant" aria-selected="false"><i class='bx bx-user me-2'></i>
                                Modifier le detail du
                                declarant</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-assurer-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-assurer" type="button" role="tab"
                                aria-controls="pills-assurer" aria-selected="false"><i class='bx bx-user-check me-2'></i>
                                Modifier le detail de l'assuré(e)</button>
                        </li>
                    </ul>
                </div>

                <div class="card-body">

                    <div class="tab-content" id="pills-edit-tabContent">
                        <div class="tab-pane fade show active" id="pills-sinistre" role="tabpanel"
                            aria-labelledby="pills-sinistre-tab">
                            <section id="info-sinistre" class="section-content">

                                <h5 class="text-center mb-5">Modifier les Détails du Sinistre</h5>

                                <form action="{{ route('sinistre.update', $sinistre->code) }}" method="post" class="submitForm" id="sinistreEditForm">
                                    @csrf

                                    <input type="hidden" class="form-control" id="CodeFiliatioAssure"
                                        name="CodeFiliatioAssure"
                                        value="{{ $contratActeurAssure['CodeFiliation'] ?? '' }}"
                                        placeholder="CodeFiliation">

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-4">
                                            <label for="nature" class="form-label">Nature du sinistre <span
                                                    class="star">*</span> </label> &nbsp;

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    {{ $sinistre->natureSinistre == 'Deces' ? 'checked' : '' }}
                                                    name="natureSinistre" id="natureDeces" value="Deces" readonly>
                                                <label class="form-check-label" for="natuDeces">Décès</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    {{ $sinistre->natureSinistre == 'Invalidite' ? 'checked' : '' }}
                                                    name="natureSinistre" id="natureInvalidite" value="Invalidite" readonly>
                                                <label class="form-check-label" for="natuInvalidite">Invalidité</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="typeDecesBlock">
                                            <label for="" class="form-label">Le décès est-il accidentel ? <span
                                                    class="star">*</span> </label> &nbsp;

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="decesAccidentel"
                                                    id="AccidentelOui" value="1"
                                                    {{ $sinistre->decesAccidentel == 1 ? 'checked' : '' }} readonly>
                                                <label class="form-check-label" for="AccidentelOu">Oui</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="decesAccidentel"
                                                    id="AccidentelNon" value="0"
                                                    {{ $sinistre->decesAccidentel == 0 ? 'checked' : '' }} readonly>
                                                <label class="form-check-label" for="AccidentelNo">Non</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="declarationTardiveBlock">
                                            <label for="nature" class="form-label">L'inhumation à t-il déjà eu lieu ?
                                                <span class="star">*</span> </label> &nbsp;

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="declarationTardive"
                                                    id="declarationTardiveOui" value="1"
                                                    {{ $sinistre->declarationTardive == 1 ? 'checked' : '' }} readonly>
                                                <label class="form-check-label" for="declarationTardiveOu">Oui</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="declarationTardive"
                                                    id="declarationTardiveNon" value="0"
                                                    {{ $sinistre->declarationTardive == 0 ? 'checked' : '' }} readonly>
                                                <label class="form-check-label" for="declarationTardiveNo">Non</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row g-3 mb-3" id="dateCauseSinistreBlock">
                                        <div class="col-md-6" id="dateSinistreBlock">
                                            <label for="dateSinistre" class="form-label">Date du sinistre <span
                                                    class="star">*</span> </label>
                                            <input type="date" class="form-control" max="{{ date('Y-m-d') }}"
                                                name="dateSinistre" value="{{ $sinistre->dateSinistre ?? '' }}"
                                                id="dateSinistre" placeholder="Veuillez saisir la date du sinistre">
                                            <small><i id="msgCarrenceError" class="text-danger"></i></small>
                                            <small><i id="msgCarrenceSuccess" class="text-success"></i></small>

                                        </div>
                                        <div class="col-md-6">
                                            <label for="causeSinistre" class="form-label">cause du sinistre <span
                                                    class="star">*</span> </label>
                                            <input class="form-control" name="causeSinistre" list="causeSinistreOptions"
                                                id="causeSinistre" value="{{ $sinistre->causeSinistre ?? '' }}"
                                                placeholder="Veuillez saisir la cause du sinistre">
                                            <datalist id="causeSinistreOptions">
                                                @foreach ($maladies as $cause)
                                                    <option value="{{ $cause['MonLibelle'] }}">
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6" id="lieuConservationBlock">
                                            <label for="lieuConservation" class="form-label">Lieu de conservation du corps
                                                <span class="star">*</span> </label>
                                            <input type="text" class="form-control" name="lieuConservation"
                                                id="lieuConservation" value="{{ $sinistre->lieuConservation ?? '' }}"
                                                list="lieuConservationOptions"
                                                placeholder="Veuillez saisir le lieu de conservation du corps">
                                            <datalist id="lieuConservationOptions">
                                                @foreach ($lieuConservation as $item)
                                                    <option value="{{ $item['localisation'] }}">
                                                @endforeach

                                            </datalist>

                                        </div>
                                        <div class="col-md-6" id="montantBONBlock">
                                            <label for="montantBON" class="form-label">Montant du BON </label>
                                            <input type="number" class="form-control" name="montantBON" id="montantBON"
                                                value="{{ $sinistre->montantBON ?? '' }}" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3" id="dateLieuLeveeBlock">
                                        <div class="col-md-6">
                                            <label for="dateLevee" class="form-label">Date de levée de corps <span
                                                    class="star">*</span> </label>
                                            <input type="date" class="form-control" name="dateLevee" id="dateLevee"
                                                value="{{ $sinistre->dateLevee ?? '' }}" placeholder="">

                                        </div>
                                        <div class="col-md-6">
                                            <label for="lieuLevee" class="form-label">Lieu de levée de corps <span
                                                    class="star">*</span> </label>
                                            <input type="text" class="form-control"
                                                value="{{ $sinistre->lieuLevee ?? '' }}" name="lieuLevee" id="lieuLevee"
                                                placeholder="Veuillez saisir le lieu de levée de corps ">
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3" id="dateLieuInhumationBlock">
                                        <div class="col-md-6">
                                            <label for="dateInhumation" class="form-label">Date de l'inhumation <span
                                                    class="star">*</span> </label>
                                            <input type="date" class="form-control"
                                                value="{{ $sinistre->dateInhumation ?? '' }}" name="dateInhumation"
                                                id="dateInhumation" placeholder="">

                                        </div>
                                        <div class="col-md-6">
                                            <label for="lieuInhumation" class="form-label">Lieu de l'inhumation <span
                                                    class="star">*</span> </label>
                                            <input type="text" class="form-control"
                                                value="{{ $sinistre->lieuInhumation ?? '' }}" name="lieuInhumation"
                                                id="lieuInhumation" placeholder="Veuillez saisir le lieu de l'inhumation">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-start gap-3">

                                        </div>
                                        <div class="col-6 d-flex justify-content-end gap-3">
                                            <button class="btn-prime p-3" type="submit" id="submitSinistre">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>

                            </section>
                        </div>
                        <div class="tab-pane fade" id="pills-declarant" role="tabpanel"
                            aria-labelledby="pills-declarant-tab">
                            <section id="edit-declarant" class="section-content">

                                <h5 class="text-center mb-5">Modifier les Détails du Déclarant</h5>

                                <form action="{{ route('sinistre.update', $sinistre->code) }}" method="post" class="submitForm">
                                    @csrf

                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="nomDecalarant" class="form-label">Quel est votre nom ? <span
                                                    class="star">*</span></label>
                                            <input type="text" class="form-control" id="nomDecalarant"
                                                name="nomDecalarant" placeholder="Votre Nom"
                                                value="{{ $sinistre->nomDecalarant ?? '' }}" required>


                                            <input type="hidden" name="typeprestation" value="Sinistre">
                                            <input type="hidden" name="idcontrat"
                                                value="{{ $sinistre->idcontrat ?? '' }}">
                                            <input type="hidden" name="saisiepar"
                                                value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->membre->idmembre : 'Déclarant en ligne' }}">
                                            {{-- <input type="hidden" name="idclient" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->membre->idmembre : 'Déclarant non connecté'}}"> --}}
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="prenomDecalarant" class="form-label">Quel est votre prénom ? <span
                                                    class="star">*</span></label>
                                            <input type="text" class="form-control" id="prenomDecalarant"
                                                name="prenomDecalarant" value="{{ $sinistre->prenomDecalarant ?? '' }}"
                                                placeholder="Votre Prénom" required>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="datenaissanceDecalarant" class="form-label">Quelle est votre date
                                                de
                                                naissance ? </label>
                                            <input type="date" class="form-control" id="datenaissanceDecalarant"
                                                name="datenaissanceDecalarant"
                                                value="{{ $sinistre->datenaissanceDecalarant ?? '' }}"
                                                placeholder="dd/mm/yyyy">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="lieunaissanceDecalarant" class="form-label">Où êtes-vous né(e)
                                                ?</label>
                                            <input type="text" class="form-control" id="lieunaissanceDecalarant"
                                                name="lieunaissanceDecalarant"
                                                value="{{ $sinistre->lieunaissanceDecalarant ?? '' }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="filiation" class="form-label">Qui êtes-vous pour l'assuré(e) ?
                                                <span class="star">*</span></label>
                                            <select class="form-select" name="filiation" id="single-select-field"
                                                data-placeholder="Filiation avec l'assuré(e)" required>
                                                <option></option>
                                                @foreach ($filiations as $item)
                                                    <option
                                                        value="{{ $item['CodeFiliation'] == 'LUIMM' ? 'Souscripteur' : $item['MonLibelle'] }}"
                                                        {{ $sinistre->filiation == $item['MonLibelle'] ? 'selected' : '' }}>
                                                        {{ $item['CodeFiliation'] == 'LUIMM' ? 'Souscripteur' : $item['MonLibelle'] }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <label for="lieuresidenceDecalarant" class="form-label">Où habitez-vous ?
                                                <span class="star">*</span> </label>
                                            <input type="text" class="form-control" id="lieuresidenceDecalarant"
                                                name="lieuresidenceDecalarant"
                                                value="{{ $sinistre->lieuresidenceDecalarant ?? '' }}"
                                                placeholder="Votre lieu de résidence" required>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="celDecalarant" class="form-label">Sur quelle N° de téléphone
                                                pouvons
                                                nous vous joindre ? <span class="star">*</span></label>
                                            <input type="number" class="form-control" id="celDecalarant"
                                                name="celDecalarant" value="{{ $sinistre->celDecalarant ?? '' }}"
                                                placeholder="Téléphone principal" required>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="emailDecalarant" class="form-label">Quelle est votre adresse email
                                                ? <span class="star">*</span></label>
                                            <input type="email" class="form-control" id="emailDecalarant"
                                                name="emailDecalarant" value="{{ $sinistre->emailDecalarant ?? '' }}"
                                                placeholder="Votre adresse email" required>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-start gap-3">

                                        </div>
                                        <div class="col-6 d-flex justify-content-end gap-3">
                                            <button class="btn-prime p-3" type="submit">Enregistrer</button>
                                        </div>
                                    </div>

                                </form>

                            </section>
                        </div>
                        <div class="tab-pane fade" id="pills-assurer" role="tabpanel"
                            aria-labelledby="pills-assurer-tab">
                            <section id="edit-assurer" class="section-content">

                                <h5 class="text-center mb-5">Modifier les Détails de l'Assuré(e)</h5>

                                <form action="{{ route('sinistre.update', $sinistre->code) }}" method="POST" class="submitForm">
                                    @csrf

                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label for="genreAssuree" class="form-label">Quel est le genre de l'assuré(e)
                                                ?</label> &nbsp;

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    {{ $sinistre->genreAssuree == 'M' ? 'checked' : '' }}
                                                    name="genreAssuree" id="genreAssureeM" value="M">
                                                <label class="form-check-label" for="genreAssureeM">Masculin</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    {{ $sinistre->genreAssuree == 'F' ? 'checked' : '' }}
                                                    name="genreAssuree" id="genreAssureeF" value="F">
                                                <label class="form-check-label" for="genreAssureeF">Feminin</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="nomAssuree" class="form-label">Quel est le nom de l'assuré(e)
                                                ?</label>
                                            <input type="text" class="form-control" id="nomAssuree" name="nomAssuree"
                                                placeholder="Nom de l'assuré(e)"
                                                value="{{ $sinistre->nomAssuree ?? '' }}" readonly>

                                        </div>
                                        <input type="hidden" name="codeAssuree"
                                            value="{{ $sinistre->codeAssuree ?? '' }}">
                                        <input type="hidden" name="codePersonneAssuree"
                                            value="{{ $contratActeurAssure['CodePersonne'] ?? '' }}">

                                        <div class="col-12 col-lg-6">
                                            <label for="prenomAssuree" class="form-label">Quel est le prénom de
                                                l'assuré(e) ?</label>
                                            <input type="text" class="form-control" id="prenomAssuree"
                                                name="prenomAssuree" value="{{ $sinistre->prenomAssuree ?? '' }}"
                                                placeholder="Prénom de l'assuré(e)" readonly>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="datenaissanceAssuree" class="form-label">Quelle est la date de
                                                naissance de l'assuré(e) ? </label>
                                            <input type="text" class="form-control datepicke"
                                                id="datenaissanceAssuree" name="datenaissanceAssuree"
                                                value="{{ $sinistre->datenaissanceAssuree ?? '' }}"
                                                placeholder="dd/mm/yyyy" readonly>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="lieunaissanceAssuree" class="form-label">Où l'assuré(e) est t-il
                                                né(e) ?</label>
                                            <input type="text" class="form-control" id="lieunaissanceAssuree"
                                                name="lieunaissanceAssuree"
                                                value="{{ $sinistre->lieunaissanceAssuree ?? '' }}" placeholder=""
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="professionAssuree" class="form-label">Quelle est la proféssion de
                                                l'assuré(e) ?</label>
                                            <input type="text" class="form-control" id="professionAssuree"
                                                name="professionAssuree" value="{{ $sinistre->professionAssuree ?? '' }}"
                                                placeholder="Profession de l'assuré(e)" readonly>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="lieuresidenceAssuree" class="form-label">Lieu de résidence de
                                                l'assuré(e) <span class="star">*</span> </label>
                                            <input type="text" class="form-control" id="lieuresidenceAssuree"
                                                name="lieuresidenceAssuree"
                                                value="{{ $sinistre->lieuresidenceAssuree ?? '' }}"
                                                placeholder="Lieu de résidence de l'assuré(e)" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-start gap-3">

                                        </div>
                                        <div class="col-6 d-flex justify-content-end gap-3">
                                            <button class="btn-prime p-3" type="submit">Enregistrer</button>
                                        </div>
                                    </div>

                                </form>

                            </section>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Leaflet Geocoding Plugin -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>


        function previewFilesPrest(event, previewAreaId) {
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
            // console.log('documents : ',documents)
            let form = document.getElementById("sinistreEditForm");
            // console.log('form : ',form)
            const docsListTable = form.querySelector('#docsListTable');
            const contratDetails = @json($details);
            const contratDetailsObj = contratDetails;
            {{-- console.log('contratDetailsObj : ',contratDetailsObj) --}}

            const msgCarrenceError = form.querySelector('#msgCarrenceError');
            const msgCarrenceSuccess = form.querySelector('#msgCarrenceSuccess');
            msgCarrenceError.textContent = "";
            msgCarrenceSuccess.textContent = "";

            // affichage des éléments en fonction de la nature du sinistre
            const natureSinistreDecesCheckbox = form.querySelector('#natureDeces');
            const dateSinistre = form.querySelector('#dateSinistre');
            const natureSinistreInvaliditeCheckbox = form.querySelector('#natureInvalidite');
            const CodeFiliatioAssure = form.querySelector('#CodeFiliatioAssure').value;
            const decesAccidentelRadios = form.querySelectorAll('input[name="decesAccidentel"]');
            const declarationTardiveRadios = form.querySelectorAll('input[name="declarationTardive"]');
            const natureSinistreRadios = form.querySelectorAll('input[name="natureSinistre"]');
            // IDs des éléments à afficher ou masquer
            const elementsDeces = ['typeDecesBlock', 'declarationTardiveBlock', 'lieuConservationBlock',
                'montantBONBlock', 'dateLieuLeveeBlock', 'dateLieuInhumationBlock'
            ];
            const elementsInvalidite = [];

            setRequired(['natureSinistre']);

            let DateEffetReel = new Date(contratDetailsObj.DateEffetReel);
            let DelaiCarrenceMois = parseInt(contratDetailsObj.DelaiCarrence);
            let typeContrat = contratDetailsObj.TypeContrat;
            // let CodeFiliation = contratDetailsObj.contratDetails.CodeFiliation;

            // Ajouter le delai de carrence en mois
            let DelaiCarrence = new Date(DateEffetReel);
            DelaiCarrence.setMonth(DelaiCarrence.getMonth() + DelaiCarrenceMois);

            // Affichage formaté
            let DateEffetReelFormat = DateEffetReel.toLocaleDateString('fr-FR');
            let DelaiCarrenceFormat = DelaiCarrence.toLocaleDateString('fr-FR');

            const codeProduitYAKO = ['YKE_2008', 'YKE_2018', 'YKS_2008', 'YKS_2018', 'YKF_2008', 'YKF_2018',
                'YKR_2021'
            ];
            dateSinistre.readOnly = true;

            function toggleElements() {
                const isDecesChecked = natureSinistreDecesCheckbox.checked;
                const isInvaliditeChecked = natureSinistreInvaliditeCheckbox.checked;

                if (isDecesChecked) {
                    showElements(elementsDeces);
                    hideElements(elementsInvalidite);

                    dateSinistre.readOnly = true;
                    setRequired(['decesAccidentel', 'declarationTardive', 'dateSinistre', 'causeSinistre',
                        'lieuConservation', 'dateLevee', 'lieuLevee', 'dateInhumation', 'lieuInhumation'
                    ]);
                    removeRequired([]);
                    elementsInvalidite.forEach(id => clearChamps('#info-sinistre',
                        `#${id} input, #${id} select, #${id} textarea`));
                    clearChamps('#info-sinistre', `#dateSinistreBlock input`)
                } else if (isInvaliditeChecked) {
                    showElements(elementsInvalidite);
                    hideElements(elementsDeces);

                    dateSinistre.readOnly = false;
                    setRequired(['dateSinistre', 'causeSinistre']);
                    removeRequired(['decesAccidentel', 'declarationTardive', 'lieuConservation', 'dateLevee',
                        'lieuLevee', 'dateInhumation', 'lieuInhumation'
                    ]);
                    elementsDeces.forEach(id => clearChamps('#info-sinistre',
                        `#${id} input, #${id} select, #${id} textarea`));
                    clearChamps('#info-sinistre', `#dateSinistreBlock input`)
                } else {
                    hideElements(elementsDeces.concat(elementsInvalidite));
                    removeRequired(['decesAccidentel', 'declarationTardive', 'dateSinistre', 'causeSinistre',
                        'lieuConservation', 'dateLevee', 'lieuLevee', 'dateInhumation', 'lieuInhumation'
                    ]);
                    elementsDeces.forEach(id => clearChamps('#info-sinistre',
                        `#${id} input, #${id} select, #${id} textarea`));
                    clearChamps('#info-sinistre', `#dateSinistreBlock input`)
                    elementsInvalidite.forEach(id => clearChamps('#info-sinistre',
                        `#${id} input, #${id} select, #${id} textarea`));
                }
            }

            // Validation unique sur la date du sinistre
            dateSinistre.addEventListener('input', function() {
                const selectedDate = new Date(this.value);

                if (isNaN(selectedDate)) {
                    msgCarrenceError.textContent = "Veuillez saisir une date.";
                    msgCarrenceSuccess.textContent = "";
                    return;
                }

                const isDecesChecked = natureSinistreDecesCheckbox.checked;
                let decesAccidentel = null;
                if (isDecesChecked) {
                    decesAccidentel = document.querySelector('input[name="decesAccidentel"]:checked')
                        ?.value;
                }
                let declarationTardive = null;
                if (isDecesChecked) {
                    declarationTardive = document.querySelector('input[name="declarationTardive"]:checked')
                        ?.value;
                }
                // Vérifie délai de carence uniquement pour décès non accidentel
                if (
                    selectedDate < DelaiCarrence &&
                    codeProduitYAKO.includes(contratDetailsObj.codeProduit) &&
                    isDecesChecked &&
                    decesAccidentel == 0
                ) {
                    const btnSubmitSinistre = document.getElementById("submitSinistre");
                    btnSubmitSinistre.disabled = true;
                    msgCarrenceError.textContent = 'Le sinistre est survenu dans le délai de carence.';
                    msgCarrenceSuccess.textContent = '';
                    msgCarrenceError.style.display = 'block';
                    msgCarrenceSuccess.style.display = 'none';
                } else {
                    const btnSubmitSinistre = document.getElementById("submitSinistre");
                    btnSubmitSinistre.disabled = false;
                    msgCarrenceError.textContent = '';
                    msgCarrenceSuccess.textContent = 'La déclaration du sinistre est recevable.';
                    msgCarrenceError.style.display = 'none';
                    msgCarrenceSuccess.style.display = 'block';
                }
            });

            // --- Définition des types de contrat ---
            // Contrats d'épargne (codes EPA et CAPI)
            const TypeContratEpagne = ['EPA', 'CAPI'];

            // Contrats obsèques (codes KDEC et KVIE)
            const TypeContratObseque = ['KDEC', 'KVIE'];

            {{-- function getToShowDocuments(natureSinistre, decesAccidentel, declarationTardive, typeContrat,
                CodeFiliation, PaiementMethod) {
                // Réinitialiser l'affichage
                docsListTable.innerHTML = '';
                let documentsToShow = [...documents]; // copie

                // --- CAS 1 : SINISTRE = DÉCÈS ---
                if (natureSinistre == 'Deces') {
                    documentsToShow = documentsToShow.filter(doc => doc.Deces);
                    // console.log("Après filtre Deces :", documentsToShow);

                    if (typeContrat == 'MIXTE') {
                        documentsToShow = documentsToShow.filter(doc => doc.Deces || doc.MIXTE);
                        // console.log("Après filtre MIXTE :", documentsToShow);
                    }

                    if (TypeContratEpagne.includes(typeContrat)) {
                        documentsToShow = documentsToShow.filter(doc => doc.EPARGNE || doc.Deces);
                        // console.log("Après filtre EPARGNE :", documentsToShow);
                    }

                    if (TypeContratObseque.includes(typeContrat)) {
                        documentsToShow = documentsToShow.filter(doc => doc.OBSEQUE || doc.Deces);
                        // console.log("Après filtre OBSEQUE :", documentsToShow);
                    }

                    if (decesAccidentel == 1) {
                        // garde les docs actuels ET ajoute ceux où Accidentel = true
                        documentsToShow = [
                            ...documentsToShow,
                            ...documents.filter(doc => doc.Accidentel)
                        ];
                        // supprime les doublons (même idfichier)
                        documentsToShow = documentsToShow.filter((doc, index, self) =>
                            index === self.findIndex(d => d.idfichier === doc.idfichier)
                        );
                        // console.log("Après filtre Accidentel = 1:", documentsToShow);
                    } else if (decesAccidentel == 0) {
                        // retire les documents où Accidentel = true
                        documentsToShow = documentsToShow.filter(doc => !doc.Accidentel);
                        // console.log("Après filtre Accidentel = 0:", documentsToShow);
                    }

                    if (declarationTardive == 1) {
                        // garde les docs actuels ET ajoute ceux où InhumationEuLieu = true
                        documentsToShow = [
                            ...documentsToShow,
                            ...documents.filter(doc => doc.InhumationEuLieu)
                        ];
                        documentsToShow = documentsToShow.filter((doc, index, self) =>
                            index === self.findIndex(d => d.idfichier === doc.idfichier)
                        );
                        // console.log("Après filtre InhumationEuLieu = 1:", documentsToShow);
                    } else if (declarationTardive == 0) {
                        // retire les documents où InhumationEuLieu = true
                        documentsToShow = documentsToShow.filter(doc => !doc.InhumationEuLieu);
                        // console.log("Après filtre InhumationEuLieu = 0:", documentsToShow);
                    }

                    if (PaiementMethod == 'Mobile_Money') {
                        // garde les docs actuels ET ajoute ceux où MobileMoney_Paiement = true
                        documentsToShow = [
                            ...documentsToShow,
                            ...documents.filter(doc => doc.MobileMoney_Paiement)
                        ];
                        // supprime les doublons (même idfichier)
                        documentsToShow = documentsToShow.filter((doc, index, self) =>
                            index === self.findIndex(d => d.idfichier === doc.idfichier)
                        );
                        // retire les documents où Virement_Bancaire = true
                        documentsToShow = documentsToShow.filter(doc => !doc.Virement_Bancaire);
                    } else if (PaiementMethod == 'Virement_Bancaire') {
                        // garde les docs actuels ET ajoute ceux où Virement_Bancaire = true
                        documentsToShow = [
                            ...documentsToShow,
                            ...documents.filter(doc => doc.Virement_Bancaire)
                        ];
                        // supprime les doublons (même idfichier)
                        documentsToShow = documentsToShow.filter((doc, index, self) =>
                            index === self.findIndex(d => d.idfichier === doc.idfichier)
                        );
                        // retire les documents où MobileMoney_Paiement = true
                        documentsToShow = documentsToShow.filter(doc => !doc.MobileMoney_Paiement);
                    }
                    // Cas combinés
                    if (decesAccidentel == 1 && declarationTardive == 1) {
                        // ajoute uniquement ceux qui ont Accidentel = true ET InhumationEuLieu = true
                        documentsToShow = [
                            ...documentsToShow,
                            ...documents.filter(doc => doc.Accidentel && doc.InhumationEuLieu)
                        ];
                        documentsToShow = documentsToShow.filter((doc, index, self) =>
                            index === self.findIndex(d => d.idfichier === doc.idfichier)
                        );
                        // console.log("Après filtre Accidentel = 1 ET InhumationEuLieu = 1:", documentsToShow);
                    }

                    if (decesAccidentel == 0 && declarationTardive == 1) {
                        // retire Accidentel mais ajoute InhumationEuLieu
                        documentsToShow = documentsToShow.filter(doc => !doc.Accidentel);
                        documentsToShow = [
                            ...documentsToShow,
                            ...documents.filter(doc => doc.InhumationEuLieu)
                        ];
                        documentsToShow = documentsToShow.filter((doc, index, self) =>
                            index === self.findIndex(d => d.idfichier === doc.idfichier)
                        );
                        // console.log("Après filtre Accidentel = 0 ET InhumationEuLieu = 1:", documentsToShow);
                    }

                    if (decesAccidentel == 1 && declarationTardive == 0) {
                        // ajoute Accidentel mais retire InhumationEuLieu
                        documentsToShow = [
                            ...documentsToShow,
                            ...documents.filter(doc => doc.Accidentel)
                        ];
                        documentsToShow = documentsToShow.filter(doc => !doc.InhumationEuLieu);
                        documentsToShow = documentsToShow.filter((doc, index, self) =>
                            index === self.findIndex(d => d.idfichier === doc.idfichier)
                        );
                        // console.log("Après filtre Accidentel = 1 ET InhumationEuLieu = 0:", documentsToShow);
                    }

                    if (decesAccidentel == 0 && declarationTardive == 0) {
                        // retire Accidentel et InhumationEuLieu
                        documentsToShow = documentsToShow.filter(doc => !doc.Accidentel && !doc.InhumationEuLieu);
                        // console.log("Après filtre Accidentel = 0 ET InhumationEuLieu = 0:", documentsToShow);
                    }
                }

                // --- CAS 2 : SINISTRE = INVALIDITÉ ---
                else if (natureSinistre == 'Invalidite') {
                    documentsToShow = documentsToShow.filter(doc => doc.Invalidite);
                    // console.log("Après filtre Invalidite :", documentsToShow);

                    if (PaiementMethod == 'Mobile_Money') {
                        // garde les docs actuels ET ajoute ceux où MobileMoney_Paiement = true
                        documentsToShow = [
                            ...documentsToShow,
                            ...documents.filter(doc => doc.MobileMoney_Paiement)
                        ];
                        // supprime les doublons (même idfichier)
                        documentsToShow = documentsToShow.filter((doc, index, self) =>
                            index === self.findIndex(d => d.idfichier === doc.idfichier)
                        );
                        // retire les documents où Virement_Bancaire = true
                        documentsToShow = documentsToShow.filter(doc => !doc.Virement_Bancaire);
                    } else if (PaiementMethod == 'Virement_Bancaire') {
                        // garde les docs actuels ET ajoute ceux où Virement_Bancaire = true
                        documentsToShow = [
                            ...documentsToShow,
                            ...documents.filter(doc => doc.Virement_Bancaire)
                        ];
                        // supprime les doublons (même idfichier)
                        documentsToShow = documentsToShow.filter((doc, index, self) =>
                            index === self.findIndex(d => d.idfichier === doc.idfichier)
                        );
                        // retire les documents où MobileMoney_Paiement = true
                        documentsToShow = documentsToShow.filter(doc => !doc.MobileMoney_Paiement);
                    }
                }

                if (documentsToShow.length > 0) {

                    // 1) Générer le HTML
                    documentsToShow.forEach((doc) => {
                        // Calcul du required selon ta logique
                        const requis = Array.isArray(doc.Requis) ? doc.Requis[0] : doc.Requis;
                        const isRequired = requis.Deces || requis.Invalidite || requis.Accidentel || requis
                            .InhumationEuLieu;

                        const row = `
                    <tr data-docid="${doc.idfichier}" data-row-required="${isRequired ? '1' : '0'}">
                        <!-- Colonne Libellé Fichier -->
                        <td class="align-middle">
                            <div class="text-wrap">${doc.libelleFichier} ${isRequired ? '<span class="star">*</span>' : ''}</div>
                        </td>

                        <!-- Colonne Radio -->
                        <td>
                            <ul class="list-grou">
                                ${doc.listDoc.length > 1
                                    ? `
                                                <label>Veuillez choisir le document en votre possession ${isRequired ? '<span class="star">*</span>' : ''}</label>
                                                ${doc.listDoc.map((d, i) => `
                                            <li class="list-group-ite">
                                                <input type="radio"
                                                    id="${d.codeDoc}"
                                                    name="docLibelle[${doc.idfichier}]"
                                                    value="${d.libelleDoc}"
                                                    class="doc-radio"
                                                    data-target="libelle-${doc.idfichier}"
                                                    >
                                                <label for="${d.codeDoc}">${d.libelleDoc}</label>
                                            </li>
                                        `).join('')}
                                            `
                                    : `
                                                <li class="list-group-ite">
                                                    <input type="radio"
                                                        id="${doc.listDoc[0].codeDoc}"
                                                        name="docLibelle[${doc.idfichier}]"
                                                        value="${doc.listDoc[0].libelleDoc}"
                                                        class="doc-radio"
                                                        data-target="libelle-${doc.idfichier}"
                                                        ${isRequired ? 'checked' : ''}>
                                                    <label for="${doc.listDoc[0].codeDoc}">${doc.listDoc[0].libelleDoc}</label>
                                                </li>
                                            `
                                }
                            </ul>
                        </td>
                        <td class="align-middle text-center">
                            <div class="file-input d-flex align-items-center justify-content-center">
                                <input type="hidden" id="libelle-${doc.idfichier}" name="libelle[]" value="">
                                <input type="file"
                                    id="file-${doc.idfichier}"
                                    name="docFile[]"
                                    accept=".pdf,.png,.jpg,.jpeg"
                                    hidden
                                    data-file-required="${isRequired ? '1' : '0'}">

                                <button type="button"
                                        class="btn-prime btn-prime-two p-2 addFileBtn"
                                        data-target="file-${doc.idfichier}">
                                    <i class='bx bx-plus-circle'></i>
                                </button>

                            </div>
                            <div class="file-preview-container mt-2 d-flex align-items-center justify-content-center">
                                <!-- Ici on injectera l’aperçu -->
                                <span class="file-preview ms-2 text-muted small"></span>
                            </div>
                        </td>
                    </tr>
                `;

                        // ${i === 0 ? 'checked' : ''}
                        docsListTable.innerHTML += row;
                    });

                    // 2) Ouvrir le file dialog quand on clique sur le bouton (une seule fois par bouton)
                    document.querySelectorAll(".addFileBtn").forEach(btn => {
                        const inputId = btn.getAttribute("data-target");
                        const fileInput = document.getElementById(inputId);
                        if (!fileInput) return;
                        // bouton ouvre la dialog
                        btn.addEventListener("click", () => fileInput.click());
                    });


                    // Créer le modal une seule fois dans le DOM
                    if (!document.getElementById("previewFileSinistreModal")) {
                        const modal = document.createElement("div");
                        modal.innerHTML = `
                    <div class="modal fade" id="previewFileSinistreModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <img id="previewImage" src="" class="img-fluid" alt="Aperçu">
                                    <iframe id="previewPDF" style="display:none;width:100%;height:500px;" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                        document.body.appendChild(modal);
                    }
                    // 3) Mettre à jour l'aperçu du fichier (attaché une seule fois par input)
                    document.querySelectorAll("input[type='file']").forEach(fileInput => {
                        fileInput.addEventListener("change", function() {
                            // récupérer la div preview qui est sœur
                            const previewWrapper = this.closest("td").querySelector(
                                ".file-preview-container");
                            const previewContainer = previewWrapper.querySelector(".file-preview");
                            previewContainer.innerHTML = ""; // reset

                            if (this.files && this.files.length > 0) {
                                const file = this.files[0];
                                const fileURL = URL.createObjectURL(file);

                                if (file.type.startsWith("image/")) {
                                    // Créer miniature image
                                    const img = document.createElement("img");
                                    img.src = fileURL;
                                    img.style.width = "100px";
                                    img.style.height = "100px";
                                    img.style.border = "1px solid #ccc";
                                    img.style.objectFit = "cover";
                                    img.style.cursor = "pointer";

                                    // clic pour ouvrir modal
                                    img.addEventListener("click", function() {
                                        document.getElementById("previewPDF").style
                                            .display = "none";
                                        document.getElementById("previewImage").style
                                            .display = "block";
                                        document.getElementById("previewImage").src =
                                            fileURL;
                                        new bootstrap.Modal(document.getElementById(
                                            "previewFileSinistreModal")).show();
                                    });

                                    previewContainer.appendChild(img);

                                } else if (file.type === "application/pdf") {
                                    // Miniature PDF (icône)
                                    const pdfIcon = document.createElement("div");
                                    pdfIcon.textContent = "📄 PDF";
                                    // pdfIcon.src = fileURL;
                                    pdfIcon.style.width = "100px";
                                    pdfIcon.style.height = "100px";
                                    pdfIcon.style.border = "1px solid #ccc";
                                    pdfIcon.style.display = "flex";
                                    pdfIcon.style.alignItems = "center";
                                    pdfIcon.style.justifyContent = "center";
                                    pdfIcon.style.cursor = "pointer";
                                    pdfIcon.style.background = "#f8f9fa";

                                    pdfIcon.addEventListener("click", function() {
                                        document.getElementById("previewImage").style
                                            .display = "none";
                                        document.getElementById("previewPDF").style
                                            .display = "block";
                                        document.getElementById("previewPDF").src = fileURL;
                                        new bootstrap.Modal(document.getElementById(
                                            "previewFileSinistreModal")).show();
                                    });

                                    previewContainer.appendChild(pdfIcon);
                                } else {
                                    previewContainer.textContent = file.name;
                                }
                            }
                        });
                    });

                    // 4) Synchroniser radio -> champ hidden libelle-...
                    document.addEventListener("change", function(e) {
                        if (e.target && e.target.classList && e.target.classList.contains("doc-radio")) {
                            const targetInputId = e.target.dataset.target;
                            const inputHidden = document.getElementById(targetInputId);
                            if (inputHidden) inputHidden.value = e.target.value;
                        }
                    });

                    // 5) Initialiser les hidden avec la radio cochée au chargement
                    document.querySelectorAll(".doc-radio").forEach(radio => {
                        if (radio.checked) {
                            const hid = document.getElementById(radio.dataset.target);
                            if (hid) hid.value = radio.value;
                        }
                    });

                    // 6) Validation personnalisée au submit (Swal)
                    // dans create.blade.php

                } else {
                    docsListTable.innerHTML = `
                <tr>
                    <td colspan="3" class="text-center">Aucun document requis</td>
                </tr>`;
                }
            } --}}


            function showElements(ids) {
                ids.forEach(id => {
                    const element = document.getElementById(id);
                    if (element) {
                        element.classList.remove('d-none');
                    }
                });
            }

            // Fonction pour masquer des éléments
            function hideElements(ids) {
                ids.forEach(id => {
                    const element = document.getElementById(id);
                    if (element) {
                        element.classList.add('d-none');
                    }
                });
            }

            // Fonctions pour gérer les champs requis
            function setRequired(fields) {
                fields.forEach(id => {
                    const field = document.getElementById(id) || document.querySelector(
                        `input[name="${id}"]`);
                    if (field) field.setAttribute('required', true);
                });
            }

            function removeRequired(fields) {
                fields.forEach(id => {
                    const field = document.getElementById(id) || document.querySelector(
                        `input[name="${id}"]`);
                    if (field) field.removeAttribute('required');
                });
            }

            // Fonction pour vérifier une étape
            {{-- function verifierEtape(etapeId) {
                const etape = document.querySelector(etapeId);
                if (!etape) return;

                const btnSuivant = etape.querySelector(".next-step-btn");
                const champsRequis = etape.querySelectorAll(
                    "input[required], select[required], textarea[required]");
                let valide = true;

                champsRequis.forEach(champ => {
                    if ((champ.type === "radio" || champ.type === "checkbox")) {
                        // Vérifie si au moins une option du groupe est cochée
                        const groupChecked = etape.querySelector(`input[name="${champ.name}"]:checked`);
                        if (!groupChecked) {
                            valide = false;
                        }
                    } else if (!champ.value.trim()) {
                        valide = false;
                    }
                });

                // Affiche ou cache le bouton
                if (valide) {
                    btnSuivant.classList.remove("d-none");
                } else {
                    btnSuivant.classList.add("d-none");
                }
            } --}}

            function clearChamps(etapeId, champsSelector) {
                const etape = document.querySelector(etapeId);
                if (!etape) return;
                const champs = etape.querySelectorAll(champsSelector);
                champs.forEach(champ => {
                    if (champ.type === "radio" || champ.type === "checkbox") {
                        champ.checked = false; // décoche systématiquement
                    } else {
                        champ.value = ""; // vide la valeur (input, textarea, select)
                    }
                });
            }
            // Vérifie en live sur tous les champs d'une étape
            {{-- function activerSurveillance(etapeId) {
                const etape = document.querySelector(etapeId);
                if (!etape) return;

                const champs = etape.querySelectorAll("input, select, textarea");
                champs.forEach(champ => {
                    champ.addEventListener("input", () => verifierEtape(etapeId));
                    champ.addEventListener("change", () => verifierEtape(etapeId));
                });
            } --}}

            function toggleDateSinistre() {
                // Vérifie si un radio est coché
                const checkedRadio = document.querySelector('input[name="decesAccidentel"]:checked');
                if (checkedRadio) {
                    dateSinistre.readOnly = false; // un choix est fait → champ activé
                } else {
                    dateSinistre.readOnly = true; // rien choisi → champ bloqué
                }
                dateSinistre.value = ''
                msgCarrenceError.textContent = "Veuillez saisir une date";
                msgCarrenceSuccess.textContent = "";
                msgCarrenceError.style.display = 'block';
                msgCarrenceSuccess.style.display = 'none';
            }

            function toggleDocuments() {
                const isDecesChecked = natureSinistreDecesCheckbox.checked;
                const isInvaliditeChecked = natureSinistreInvaliditeCheckbox.checked;
                const accidentelChecked = document.querySelector('input[name="decesAccidentel"]:checked')?.value ??
                    null;
                const declarationTardiveChecked = document.querySelector('input[name="declarationTardive"]:checked')
                    ?.value ?? null;
                if (isDecesChecked) {
                    getToShowDocuments("Deces", accidentelChecked, declarationTardiveChecked, typeContrat,
                        CodeFiliatioAssure);
                } else if (isInvaliditeChecked) {
                    getToShowDocuments("Invalidite", accidentelChecked, declarationTardiveChecked, typeContrat,
                        CodeFiliatioAssure);
                }

            }

            // Ajoute les écouteurs d'événements
            natureSinistreDecesCheckbox.addEventListener('change', () => {
                toggleElements();
                //toggleDocuments();
            });
            natureSinistreInvaliditeCheckbox.addEventListener('change', () => {
                toggleElements();
                //toggleDocuments();
            });

            decesAccidentelRadios.forEach(radio => {
                radio.addEventListener('change', toggleDateSinistre);
                //radio.addEventListener('change', toggleDocuments);
            });
            declarationTardiveRadios.forEach(radio => {
                //radio.addEventListener('change', toggleDocuments);
            });




            {{-- if (form) {
                const moyenPaiementInputs = form.querySelectorAll('input[name="moyenPaiement"]');
                const operateurSection = form.querySelector('#Operateur');
                // console.log('form : ',form)
                const ibanPaiementSection = form.querySelector('#IBANPaiement');
                const telPaiementSection = form.querySelector('#TelephonePaiement');
                const telPaiementField = form.querySelector('#TelPaiement');
                const ibanPaiementField = form.querySelector('#IBAN');
                const ibanField = form.querySelectorAll('.rib-input');
                const confirmTelPaiementField = form.querySelector('#ConfirmTelPaiement');
                const operateurInputs = form.querySelectorAll('input[name="Operateur"]');

                // jQuery messages (doivent exister dans le HTML)
                const ibanMsgError = form.querySelector('#ibanMsgError');
                const ibanMsgSuccess = form.querySelector('#ibanMsgSuccess');
                const telMsgError = form.querySelector('#telMsgError');
                const telMsgSuccess = form.querySelector('#telMsgSuccess');
                const telConfirmMsgError = form.querySelector('#telConfirmMsgError');
                const telConfirmMsgSuccess = form.querySelector('#telConfirmMsgSuccess');
                const nextStepBtn = form.querySelector('#nextStepBtn');

                // jQuery messages (doivent exister dans le HTML)
                // alert('form')

                function reinitIBAN() {
                    // reinitiaser tous les champs
                    ibanField.forEach(input => {
                        input.value = "";
                        input.classList.remove('is-invalid');
                        input.classList.remove('is-valid');
                    });
                    ibanPaiementField.value = "";
                    ibanMsgError.textContent = "";
                    ibanMsgError.style.display = "none";
                    ibanMsgSuccess.textContent = "";
                    ibanMsgSuccess.style.display = "none";
                    nextStepBtn.disabled = true;
                }

                function reinitTel() {
                    // reinitialiser tous les champs
                    telPaiementField.value = "";
                    telPaiementField.disabled = true;
                    telPaiementField.classList.remove('is-invalid');
                    telPaiementField.classList.remove('is-valid');
                    confirmTelPaiementField.value = "";
                    confirmTelPaiementField.disabled = true;
                    confirmTelPaiementField.classList.remove('is-invalid');
                    confirmTelPaiementField.classList.remove('is-valid');
                    telMsgError.textContent = "";
                    telMsgError.style.display = "none";
                    telMsgSuccess.textContent = "";
                    telMsgSuccess.style.display = "none";
                    telConfirmMsgError.textContent = "";
                    telConfirmMsgError.style.display = "none";
                    telConfirmMsgSuccess.textContent = "";
                    telConfirmMsgSuccess.style.display = "none";
                    operateurInputs.forEach(input => {
                        input.checked = false;
                    });
                }

                moyenPaiementInputs.forEach(input => {
                    input.required = true;
                    input.addEventListener('change', function() {
                        // alert('input change')
                        if (input.value === "Mobile_Money") {
                            // alert('Mobile_Money')
                            // Afficher les sections Mobile Money
                            operateurSection.classList.remove('d-none');
                            telPaiementSection.classList.remove('d-none');
                            ibanPaiementSection.classList.add('d-none'); // Cacher IBAN

                            // Ajouter les attributs requis
                            setRequired(['Operateur', 'TelPaiement', 'ConfirmTelPaiement']);
                            removeRequired(['IBAN']);
                            reinitIBAN();

                        } else if (input.value === "Virement_Bancaire") {
                            // alert('Virement_Bancaire')
                            // Afficher la section IBAN
                            ibanPaiementSection.classList.remove('d-none');
                            operateurSection.classList.add('d-none'); // Cacher opérateur
                            telPaiementSection.classList.add('d-none'); // Cacher téléphone

                            // Ajouter les attributs requis
                            setRequired(['IBAN']);
                            removeRequired(['Operateur', 'TelPaiement', 'ConfirmTelPaiement']);
                            reinitTel();
                        }
                    });
                });


            } --}}

            // Appelle la fonction une première fois pour gérer l'état initial
            toggleElements();
            toggleDateSinistre();
            {{-- toggleDocuments(); --}}
            //  updateIBAN();
            // Active la surveillance sur chaque étape
            {{-- activerSurveillance("#etapeSinistre1");
            activerSurveillance("#etapeSinistre2");
            activerSurveillance("#etapeSinistre3");
            activerSurveillance("#etapeSinistre4");
            activerSurveillance("#etapeSinistre5");

            // Vérifie au chargement
            verifierEtape("#etapeSinistre1");
            verifierEtape("#etapeSinistre2");
            verifierEtape("#etapeSinistre3");
            verifierEtape("#etapeSinistre4");
            verifierEtape("#etapeSinistre5"); --}}

        });
    </script>


    @include('users.sinistre.modals.addDoc')
    {{-- @include('users.espace_client.services.prestations.modals.signModal')
    @include('users.espace_client.services.prestations.modals.otpModal') --}}


    <script>
        const SIGN_API = "{{ config('services.sign_api') }}";
        const OTP_API = "{{ config('services.otp_api') }}";
    </script>



    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            let form = document.getElementById("sinistreForm");
            const changePhoneButton = document.getElementById('changePhoneButton');
            const changePhoneButtonForMobileMoney = document.getElementById('changePhoneButtonForMobileMoney');

            if (form) {
                const moyenPaiementInputs = form.querySelectorAll('input[name="moyenPaiement"]');
                const operateurSection = form.querySelector('#Operateur');
                const telPaiementField = form.querySelector('#TelPaiement');
                const ibanPaiementField = form.querySelector('#IBAN');
                const ibanField = form.querySelectorAll('.rib-input');
                const confirmTelPaiementField = form.querySelector('#ConfirmTelPaiement');
                const ibanPaiementSection = form.querySelector('#IBANPaiement');
                const telPaiementSection = form.querySelector('#TelephonePaiement');
                const operateurInputs = form.querySelectorAll('input[name="Operateur"]');

                const ibanMsgError = form.querySelector('#ibanMsgError');
                const ibanMsgSuccess = form.querySelector('#ibanMsgSuccess');
                const telMsgError = form.querySelector('#telMsgError');
                const telMsgSuccess = form.querySelector('#telMsgSuccess');
                const telConfirmMsgError = form.querySelector('#telConfirmMsgError');
                const telConfirmMsgSuccess = form.querySelector('#telConfirmMsgSuccess');
                const nextStepBtn = form.querySelector('#nextStepBtn');
                nextStepBtn.disabled = true;

                if (ibanPaiementSection && !ibanPaiementSection.classList.contains('d-none')) {
                    ibanMsgError.textContent = "";
                    ibanMsgError.style.display = "none";
                    ibanMsgSuccess.textContent = "";
                    ibanMsgSuccess.style.display = "none";

                    function updateIBAN() {
                        let ibanValue = "";
                        ibanField.forEach(input => {
                            ibanValue += input.value;

                            if (!input.value.trim()) {
                                input.classList.add('is-invalid');
                                input.classList.remove('is-valid');
                            } else {
                                input.classList.remove('is-invalid');
                                input.classList.add('is-valid');
                            }
                        });

                        ibanValue = ibanValue.replace(/[^a-zA-Z0-9]/g, '');
                        ibanPaiementField.value = ibanValue;

                        if (ibanValue.length !== 24) {
                            ibanMsgError.textContent = "Le RIB doit contenir exactement 24 caractères.";
                            ibanMsgError.style.display = "block";
                            ibanMsgSuccess.textContent = "";
                            ibanMsgSuccess.style.display = "none";
                            nextStepBtn.disabled = true;
                        } else {
                            ibanMsgSuccess.textContent = "Vous pouvez passer au suivant";
                            ibanMsgSuccess.style.display = "block";
                            ibanMsgError.textContent = "";
                            ibanMsgError.style.display = "none";
                            nextStepBtn.disabled = false;
                        }
                    }

                    ibanField.forEach(input => {
                        input.addEventListener("input", updateIBAN);
                    });
                }

                // --- Téléphone ---
                if (telPaiementSection && !telPaiementSection.classList.contains('d-none')) {
                    let prefix = "";

                    // Quand on change d'opérateur → on définit le bon préfixe
                    operateurInputs.forEach(input => {
                        //alert('operateurInputs')
                        input.addEventListener("change", function() {
                            //alert('operateurInputs change')
                            switch (this.value) {
                                case "Orange_money":
                                    prefix = "07";
                                    break;
                                case "MTN_money":
                                    prefix = "05";
                                    break;
                                case "Moov_money":
                                    prefix = "01";
                                    break;
                                default:
                                    prefix = "";
                            }
                        });
                    });

                    // Vérification du numéro principal
                    telPaiementField.addEventListener("input", function(e) {
                        //alert('telPaiementField input')
                        const telValue = e.target.value.trim();
                        const firstTwoDigits = telValue.substring(0, 2);

                        telMsgError.textContent = "";
                        telMsgError.style.display = "none";
                        telMsgSuccess.textContent = "";
                        telMsgSuccess.style.display = "none";

                        if (telValue.length !== 10 || (prefix && firstTwoDigits !== prefix)) {
                            telPaiementField.classList.add('is-invalid');
                            telPaiementField.classList.remove('is-valid');
                            telMsgError.textContent = "Le numéro doit avoir 10 chiffres et commencer par " +
                                prefix;
                            telMsgError.style.display = "block";
                            nextStepBtn.disabled = true;
                        } else {
                            telPaiementField.classList.remove('is-invalid');
                            telPaiementField.classList.add('is-valid');
                            telMsgSuccess.textContent = "Le numéro de téléphone est valide.";
                            telMsgSuccess.style.display = "block";
                            //verifierEtape("#etapeSinistre4");
                        }
                    });

                    // Vérification confirmation du numéro
                    confirmTelPaiementField.addEventListener("input", function(e) {
                        //alert('confirmTelPaiementField input')
                        const confirmTel = e.target.value.trim();
                        const telValue = telPaiementField.value.trim();

                        telConfirmMsgError.textContent = "";
                        telConfirmMsgError.style.display = "none";
                        telConfirmMsgSuccess.textContent = "";
                        telConfirmMsgSuccess.style.display = "none";

                        if (confirmTel !== telValue || confirmTel.length !== 10) {
                            confirmTelPaiementField.classList.add('is-invalid');
                            confirmTelPaiementField.classList.remove('is-valid');
                            telConfirmMsgError.textContent = "Le numéro de confirmation ne correspond pas.";
                            telConfirmMsgError.style.display = "block";
                            nextStepBtn.disabled = true;
                        } else {
                            confirmTelPaiementField.classList.remove('is-invalid');
                            confirmTelPaiementField.classList.add('is-valid');
                            telConfirmMsgSuccess.textContent = "Le numéro de confirmation est correct.";
                            telConfirmMsgSuccess.style.display = "block";
                            nextStepBtn.disabled = false;
                        }
                    });
                }
            } else {
                console.warn("Formulaire introuvable : vérifie que sinistreForm existe dans la page.");
            }
        });
    </script> --}}

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("sinistreForm");
            const btn = document.getElementById("btn-submit");

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

                axios.post('{{ route('sinistre.store') }}', formData)
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
    </script> --}}
@endsection
