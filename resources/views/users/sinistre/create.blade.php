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
    </style>

    <div class="card">

        <div class="card-header">
            <h1 class="card-title text-uppercase text-center">Déclaration de sinistre</h1>
            <p class="text-center">Remplissez le formulaire ci-dessous pour déclarer votre sinistre. Veuillez remplir tous
                les champs obligatoires (<span class="star">*</span>).</p>
        </div>
        <div class="card-body">

            <form id="sinistreForm" method="POST" enctype="multipart/form-data" class="submitForm">
                @csrf
                <div class="">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item etapeSinistre" id="etapeSinistre1">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button">
                                    <h5 class="text-uppercase">Identification du declarant</h5>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="nomDecalarant" class="form-label">Quel est votre nom ? <span
                                                    class="star">*</span></label>
                                            <input type="text" class="form-control" id="nomDecalarant"
                                                name="nomDecalarant" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->membre->nom : ''}}" placeholder="Votre Nom" {{ Auth::guard('customer')->check() ? 'readonly' : ''}} required>


                                            <input type="hidden" name="typeprestation" value="Sinistre">
                                            <input type="hidden" name="idcontrat" value="{{$details['IdProposition'] ?? ''}}">
                                            <input type="hidden" name="saisiepar" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->membre->idmembre : 'Déclarant en ligne'}}">
                                            {{-- <input type="hidden" name="idclient" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->membre->idmembre : 'Déclarant non connecté'}}"> --}}
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="prenomDecalarant" class="form-label">Quel est votre prénom ? <span
                                                    class="star">*</span></label>
                                            <input type="text" class="form-control" id="prenomDecalarant"
                                                name="prenomDecalarant" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->membre->prenom : ''}}" placeholder="Votre Prénom" {{ Auth::guard('customer')->check() ? 'readonly' : ''}} required>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="datenaissanceDecalarant" class="form-label">Quelle est votre date de
                                                naissance ? </label>
                                            <input type="date" class="form-control" id="datenaissanceDecalarant"
                                                name="datenaissanceDecalarant" value="{{ Auth::guard('customer')->check() ? \Carbon\Carbon::parse(Auth::guard('customer')->user()->membre->datenaissance)->format('Y-m-d') : '' }}" placeholder="dd/mm/yyyy" {{ Auth::guard('customer')->check() ? 'readonly' : ''}}>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="lieunaissanceDecalarant" class="form-label">Où êtes-vous né(e)
                                                ?</label>
                                            <input type="text" class="form-control" id="lieunaissanceDecalarant"
                                                name="lieunaissanceDecalarant" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->membre->lieunaissance : '' }}" placeholder="" {{ Auth::guard('customer')->check() ? 'readonly' : ''}}>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="filiation" class="form-label">Qui êtes-vous pour l'assuré(e) ? <span
                                                    class="star">*</span></label>
                                            <select class="form-select" name="filiation" id="singl-select-field"
                                                data-placeholder="" required>
                                                <option value="" selected disabled>choisir une filiation</option>
                                                @foreach ($filiations as $item)
                                                    <option
                                                        value="{{ $item['CodeFiliation'] == 'LUIMM' ? 'Souscripteur' : $item['MonLibelle'] }}">
                                                        {{ $item['CodeFiliation'] == 'LUIMM' ? 'Souscripteur' : $item['MonLibelle'] }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <label for="lieuresidenceDecalarant" class="form-label">Où habitez-vous ? <span
                                                    class="star">*</span> </label>
                                            <input type="text" class="form-control" id="lieuresidenceDecalarant"
                                                name="lieuresidenceDecalarant" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->membre->lieuresidence : '' }}"
                                                placeholder="Votre lieu de résidence" required>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="celDecalarant" class="form-label">Sur quelle N° de téléphone pouvons
                                                nous vous joindre ? <span class="star">*</span></label>
                                            <input type="number" class="form-control" id="celDecalarant"
                                                name="celDecalarant" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->membre->cel : '' }}" placeholder="Téléphone principal"
                                                required>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="emailDecalarant" class="form-label">Quelle est votre adresse email
                                                ?</label>
                                            <input type="email" class="form-control" id="emailDecalarant"
                                                name="emailDecalarant" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->membre->email : '' }}" placeholder="Votre adresse email">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end gap-3">
                                            <button type="button" class="collapsed btn-prime p-2 next-step-btn d-none"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">Suivant <i
                                                    class='bx bx-right-arrow-alt fs-4'></i></button>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="accordion-item etapeSinistre" id="etapeSinistre2">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button">
                                    <h5 class="text-uppercase">Identification de l'assuré(e)</h5>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row g-3 mb-3">
                                        <div class="col-12">
                                            <label for="genreAssuree" class="form-label">Quel est le genre de l'assuré(e)
                                                ?</label> &nbsp;

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="genreAssuree"
                                                    id="genreAssureeM" value="M">
                                                <label class="form-check-label" for="genreAssureeM">Masculin</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="genreAssuree"
                                                    id="genreAssureeF" value="F">
                                                <label class="form-check-label" for="genreAssureeF">Feminin</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="nomAssuree" class="form-label">Quel est le nom de l'assuré(e)
                                                ?</label>
                                            <input type="text" class="form-control" id="nomAssuree" name="nomAssuree"
                                                placeholder="Nom de l'assuré(e)" value="{{ $assuree['nomAssu'] ?? '' }}"
                                                readonly>

                                        </div>
                                        <input type="hidden" name="codeAssuree"
                                            value="{{ $assuree['IdPropositionPartenaires'] ?? '' }}">
                                        <input type="hidden" name="codePersonneAssuree"
                                            value="{{ $assuree['CodePersonne'] ?? '' }}">
                                        <div class="col-12 col-lg-6">
                                            <label for="prenomAssuree" class="form-label">Quel est le prénom de
                                                l'assuré(e) ?</label>
                                            <input type="text" class="form-control" id="prenomAssuree"
                                                name="prenomAssuree" value="{{ $assuree['PrenomAssu'] ?? '' }}"
                                                placeholder="Prénom de l'assuré(e)" readonly>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="datenaissanceAssuree" class="form-label">Quelle est la date de
                                                naissance de l'assuré(e) ? </label>
                                            <input type="text" class="form-control datepicke"
                                                id="datenaissanceAssuree" name="datenaissanceAssuree"
                                                value="{{ $assuree['DateNaissanceAssu'] ?? '' }}" placeholder="dd/mm/yyyy"
                                                readonly>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="lieunaissanceAssuree" class="form-label">Où l'assuré(e) est t-il
                                                né(e) ?</label>
                                            <input type="text" class="form-control" id="lieunaissanceAssuree"
                                                name="lieunaissanceAssuree"
                                                value="{{ $assuree['LieuNaissanceAssu'] ?? '' }}" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="professionAssuree" class="form-label">Quelle est la proféssion de
                                                l'assuré(e) ?</label>
                                            <input type="text" class="form-control" id="professionAssuree" name="professionAssuree"
                                                value="{{ $assuree['ProfessionAssu'] ?? '' }}"
                                                placeholder="Profession de l'assuré(e)" readonly>
                                            <input type="hidden" class="form-control" id="CodeFiliatioAssure"
                                                name="CodeFiliatioAssure" value="{{ $assuree['CodeFiliation'] ?? '' }}"
                                                placeholder="CodeFiliation">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="lieuresidenceAssuree" class="form-label">Lieu de résidence de
                                                l'assuré(e) <span class="star">*</span> </label>
                                            <input type="text" class="form-control" id="lieuresidenceAssuree"
                                                name="lieuresidenceAssuree" value=""
                                                placeholder="Lieu de résidence de l'assuré(e)" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-start gap-3">
                                            <button class="btn2 border-btn2 p-2" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne"><i
                                                    class='bx bx-left-arrow-alt fs-4'></i>Retour </button>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end gap-3">
                                            <button class="btn-prime p-2 next-step-btn d-none" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">Suivant <i
                                                    class='bx bx-right-arrow-alt fs-4'></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item etapeSinistre" id="etapeSinistre3">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button">
                                    <h5 class="text-uppercase">Description du sinistre</h5>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row g-3 mb-3 justify-content-center align-items-center">
                                        <div class="col-md-4">
                                            <label for="nature" class="form-label">Nature du sinistre <span
                                                    class="star">*</span> </label> &nbsp;

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="natureSinistre"
                                                    id="natureDeces" value="Deces">
                                                <label class="form-check-label" for="natureDeces">Décès</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="natureSinistre"
                                                    id="natureInvalidite" value="Invalidite">
                                                <label class="form-check-label" for="natureInvalidite">Invalidité</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="villeSinistreBlock">
                                            <label for="villeSinistre" class="form-label">Dans quelle ville a eu lieu le sinistre ? <span
                                                    class="star">*</span> </label>
                                            <input type="text" name="villeSinistre" id="villeSinistre" list="villeSinistreOptions" placeholder="Veuillez saisir la ville" class="form-control" required>
                                            <datalist id="villeSinistreOptions">
                                                @foreach ($villes as $ville)
                                                    <option value="{{ $ville->libelleVillle}}">
                                                @endforeach
                                            </datalist>
                                        </div>
                                        <div class="col-md-4" id="typeDecesBlock">
                                            <label for="" class="form-label">Le décès est-il accidentel ? <span
                                                    class="star">*</span> </label> &nbsp;

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="decesAccidentel"
                                                    id="AccidentelOui" value="1">
                                                <label class="form-check-label" for="AccidentelOui">Oui</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="decesAccidentel"
                                                    id="AccidentelNon" value="0">
                                                <label class="form-check-label" for="AccidentelNon">Non</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3 justify-content-center align-items-center mb-3" id="sinistreCentreHospitalierBlock">
                                        <div class="col-md-6" id="">
                                            <label for="" class="form-label">Le sinistre est survenue dans un centre hospitalier ? <span
                                                    class="star">*</span> </label> &nbsp;

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sinistreCentreHospitalier"
                                                    id="sinistreCentreHospitalierOui" value="1">
                                                <label class="form-check-label" for="sinistreCentreHospitalierOui">Oui</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sinistreCentreHospitalier"
                                                    id="sinistreCentreHospitalierNon" value="0">
                                                <label class="form-check-label" for="sinistreCentreHospitalierNon">Non</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="centresMedicauxBlock">
                                            <label for="centresMedicaux" class="form-label">Précisez le lieu s'il vous plaît !
                                                <span class="star">*</span></label>

                                            <input type="text" class="form-control" name="centresMedicaux"
                                                id="centresMedicaux" list="centresMedicauxOptions"
                                                placeholder="Veuillez saisir le lieu svp !" required>
                                            <datalist id="centresMedicauxOptions">
                                                @foreach ($centresMedicaux as $item)
                                                    <option value="{{ $item['MonLibelle'] }}">
                                                @endforeach
                                                <option value="Sur place">
                                                <option value="Dans l'ambulance">
                                            </datalist>
                                        </div>

                                    </div>

                                    <div class="row g-3 justify-content-center align-items-center mb-3">
                                        <div class="col-md-6" id="corpsConserveBlock">
                                            <label for="" class="form-label">Le corps a t-il été conservé ? <span
                                                    class="star">*</span> </label> &nbsp;

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="corpsConserve"
                                                    id="corpsConserveOui" value="1">
                                                <label class="form-check-label" for="corpsConserveOui">Oui</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="corpsConserve"
                                                    id="corpsConserveNon" value="0">
                                                <label class="form-check-label" for="corpsConserveNon">Non</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="declarationTardiveBlock">
                                            <label for="nature" class="form-label">L'inhumation a t-elle déjà eu lieu ?
                                                <span class="star">*</span> </label> &nbsp;

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="declarationTardive"
                                                    id="declarationTardiveOui" value="1">
                                                <label class="form-check-label" for="declarationTardiveOui">Oui</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="declarationTardive"
                                                    id="declarationTardiveNon" value="0">
                                                <label class="form-check-label" for="declarationTardiveNon">Non</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row g-3 mb-3" id="dateCauseSinistreBlock">
                                        <div class="col-md-6" id="dateSinistreBlock">
                                            <label for="dateSinistre" class="form-label">Date du sinistre <span
                                                    class="star">*</span> </label>
                                            <input type="date" class="form-control" max="{{ date('Y-m-d') }}"
                                                name="dateSinistre" id="dateSinistre"
                                                placeholder="Veuillez saisir la date du sinistre">
                                            <small><i id="msgCarrenceError" class="text-danger"></i></small>
                                            <small><i id="msgCarrenceSuccess" class="text-success"></i></small>

                                        </div>
                                        <div class="col-md-6">
                                            <label for="causeSinistre" class="form-label">cause du sinistre <span
                                                    class="star">*</span> </label>
                                            <input class="form-control" name="causeSinistre" list="causeSinistreOptions"
                                                id="causeSinistre" placeholder="Veuillez saisir la cause du sinistre">
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
                                                id="lieuConservation" list="lieuConservationOptions"
                                                placeholder="Veuillez saisir le lieu de conservation du corps">
                                            <datalist id="lieuConservationOptions">
                                                @foreach ($lieuConservation as $item)
                                                    <option value="{{ $item['designation'] . ' (' . $item['commune'] . ' - ' . $item['localisation'] . ')' }}">
                                                @endforeach

                                            </datalist>

                                        </div>
                                        <div class="col-md-6" id="montantBONBlock">
                                            <label for="montantBON" class="form-label">Montant du BON </label>
                                            <input type="number" class="form-control" name="montantBON" id="montantBON"
                                                placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3" id="dateLieuLeveeBlock">
                                        <div class="col-md-6">
                                            <label for="dateLevee" class="form-label">Date de levée de corps <span
                                                    class="star">*</span> </label>
                                            <input type="date" class="form-control" name="dateLevee" id="dateLevee"
                                                placeholder="">

                                        </div>
                                        <div class="col-md-6">
                                            <label for="lieuLevee" class="form-label">Lieu de levée de corps <span
                                                    class="star">*</span> </label>
                                            <input type="text" class="form-control" name="lieuLevee"
                                                id="lieuLevee" list="lieuLeveeOptions"
                                                placeholder="Veuillez saisir le lieu de levée de corps">
                                            <datalist id="lieuLeveeOptions">
                                                @foreach ($villes as $ville)
                                                    <option value="{{ $ville->libelleVillle}}">
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3" id="dateLieuInhumationBlock">
                                        <div class="col-md-6">
                                            <label for="dateInhumation" class="form-label">Date de l'inhumation <span
                                                    class="star">*</span> </label>
                                            <input type="date" class="form-control" name="dateInhumation"
                                                id="dateInhumation" placeholder="">

                                        </div>
                                        <div class="col-md-6">
                                            <label for="lieuInhumation" class="form-label">Lieu de l'inhumation <span
                                                    class="star">*</span> </label>
                                            <input type="text" class="form-control" name="lieuInhumation"
                                                id="lieuInhumation" list="lieuInhumationOptions"
                                                placeholder="Veuillez saisir le lieu de l'inhumation">
                                            <datalist id="lieuInhumationOptions">
                                                @foreach ($villes as $ville)
                                                    <option value="{{ $ville->libelleVillle}}">
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-start gap-3">
                                            <button class="btn2 border-btn2 p-2" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseTwo" aria-expanded="true"
                                                aria-controls="collapseTwo"><i
                                                    class='bx bx-left-arrow-alt fs-4'></i>Retour </button>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end gap-3">
                                            <button class="btn-prime p-2 next-step-btn d-none" id="next-PaiementStep"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                aria-expanded="false" aria-controls="collapseFour">Suivant <i
                                                    class='bx bx-right-arrow-alt fs-4'></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item etapeSinistre" id="etapeSinistre4">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button">
                                    <h5 class="text-uppercase">Bénéficiaire au contrat</h5>
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row table-responsive g-3 mb-3">
                                        <table class="table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Prénoms</th>
                                                    <th>Date de naissance</th>
                                                    <th>Lieu de naissance</th>
                                                    <th>Profession</th>
                                                    <th>Filiation avec le souscriteur</th>
                                                    <th>Maturité</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allBeneficiaire as $beneficiaire)
                                                    <tr>
                                                        <td>{{ $beneficiaire['nomAssu'] ?? '' }}</td>
                                                        <td>{{ $beneficiaire['PrenomAssu'] ?? '' }}</td>
                                                        <td>{{ $beneficiaire['DateNaissanceAssu'] ?? '' }}</td>
                                                        <td>{{ $beneficiaire['LieuNaissanceAssu'] ?? '' }}</td>
                                                        <td>{{ $beneficiaire['ProfessionAssu'] ?? '' }}</td>
                                                        <td>{{ $beneficiaire['CodeFiliation'] == "LUIMM" ? 'Souscriteur lui même' : $beneficiaire['MonLibelle'] ?? '' }}</td>
                                                        <td>{{ $beneficiaire['estMajeur'] ? 'Majeur' : 'Mineur' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-start gap-3">
                                            <button class="btn2 border-btn2 p-2" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseThree" aria-expanded="true"
                                                aria-controls="collapseThree"><i
                                                    class='bx bx-left-arrow-alt fs-4'></i>Retour </button>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end gap-3">
                                            <button class="btn-prime p-2 next-step-btn d-none" id="nextStepBt"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                aria-expanded="false" aria-controls="collapseFive">Suivant <i
                                                    class='bx bx-right-arrow-alt fs-4'></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            // Sécurisation : convertir en Collection si ce n’est pas déjà le cas
                            $allBeneficiaire = collect($allBeneficiaire);

                            // Souscripteur (CodeFiliation = LUIMM)
                            $souscripteur = $allBeneficiaire->firstWhere('CodeFiliation', 'LUIMM');

                            $benefConserne = "";
                        @endphp
                        <div class="accordion-item etapeSinistre" id="etapeSinistre5">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button">
                                    <h5 class="text-uppercase">Moyen de paiement (Bénéficiaire)</h5>
                                </button>

                                <p class="text-danger px-3">
                                    Veuillez fournir les informations de paiement

                                    {{-- ===== CAS : 1 SEUL BÉNÉFICIAIRE ===== --}}
                                    @if ($allBeneficiaire->count() === 1)

                                        @php
                                            $benef = $allBeneficiaire->first();
                                            
                                        @endphp

                                        @if (!$benef['estMajeur'])
                                            du tuteur(trice) légal(e) du mineur
                                            <strong>{{ $benef['nomAssu'] }} {{ $benef['PrenomAssu'] }}</strong>
                                            @php
                                                $benefConserne = "du tuteur(trice) légal(e) du mineur";
                                            @endphp
                                        @elseif ($benef['estMajeur'] && $benef['CodeFiliation'] === 'LUIMM')
                                            du souscripteur
                                            <strong>{{ $benef['nomAssu'] }} {{ $benef['PrenomAssu'] }}</strong>
                                            @php
                                                $benefConserne = 'de '.$benef['nomAssu'].' '.$benef['PrenomAssu'];
                                            @endphp
                                        @else
                                            de
                                            <strong>{{ $benef['nomAssu'] }} {{ $benef['PrenomAssu'] }}</strong>
                                            @php
                                                $benefConserne = 'de '.$benef['nomAssu'].' '.$benef['PrenomAssu'];
                                            @endphp
                                        @endif


                                    {{-- ===== CAS : PLUSIEURS BÉNÉFICIAIRES ===== --}}
                                    @elseif ($allBeneficiaire->count() > 1)

                                        {{-- S’il existe un souscripteur majeur --}}
                                        @if ($souscripteur && $souscripteur['estMajeur'])
                                            du souscripteur
                                            <strong>{{ $souscripteur['nomAssu'] }} {{ $souscripteur['PrenomAssu'] }}</strong>
                                            @php
                                                $benefConserne = 'de '.$souscripteur['nomAssu'].' '.$souscripteur['PrenomAssu'];
                                            @endphp

                                        {{-- Sinon, lister les bénéficiaires --}}
                                        @else
                                            @foreach ($allBeneficiaire as $benef)
                                                @if (!$benef['estMajeur'])
                                                    du tuteur(trice) légal(e) du mineur
                                                    <strong>{{ $benef['nomAssu'] }} {{ $benef['PrenomAssu'] }}</strong>@if(!$loop->last) ou @endif
                                                @else
                                                    de
                                                    <strong>{{ $benef['nomAssu'] }} {{ $benef['PrenomAssu'] }}</strong>@if(!$loop->last) ou @endif
                                                @endif
                                            @endforeach
                                            @php
                                                $benefConserne = "fournir plus au haut";
                                            @endphp
                                        @endif


                                    {{-- ===== CAS PAR DÉFAUT ===== --}}
                                    @else
                                        des ayants droit du souscripteur
                                        @php
                                            $benefConserne = "des ayants droit du souscripteur";
                                        @endphp
                                    @endif
                                </p>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row g-3 mb-3 text-center">
                                        <span class="form-label">Veuillez choisir le moyen de paiement ?
                                            <span class="star">*</span></span>
                                        <div class="row d-flex justify-content-center align-items-center mt-3 gap-3">
                                            <div class="moyenPaiement-option col-lg-3 col-md-4 col-sm-12">
                                                <input type="radio" name="moyenPaiement" value="Mobile_Money"
                                                    id="mobileMoney" class="moyenPaiement-input">
                                                <label for="mobileMoney"
                                                    class="moyenPaiement-label d-flex flex-column align-items-center justify-content-center">
                                                    <span class="moyenPaiement-icon"><i class='bx bx-money'></i></span>
                                                    <span class="moyenPaiement-text">Mobile Money</span>
                                                </label>
                                            </div>
                                            <div class="moyenPaiement-option col-lg-3 col-md-4 col-sm-12">
                                                <input type="radio" name="moyenPaiement" value="Virement_Bancaire"
                                                    id="virementBancaire" class="moyenPaiement-input">
                                                <label for="virementBancaire"
                                                    class="moyenPaiement-label d-flex flex-column align-items-center justify-content-center">
                                                    <span class="moyenPaiement-icon"><i class='bx bxs-bank'></i></span>
                                                    <span class="moyenPaiement-text">Virement Bancaire</span>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row g-3 mb-3 text-center" id="Operateur">
                                        <span class="form-label">Veuillez choisir l'opérateur ?</span>

                                        <div class="row d-flex justify-content-center align-items-center mt-3 gap-3">
                                            <div class="Operateur-option col-lg-3 col-md-4 col-sm-12">
                                                <input type="radio" name="Operateur" value="Orange_money"
                                                    id="Orange" class="Operateur-input">
                                                <label for="Orange"
                                                    class="Operateur-label d-flex flex-column align-items-center justify-content-center">
                                                    <span class="Operateur-icon">
                                                        <img src="https://seeklogo.com/images/O/orange-money-logo-8F2AED308D-seeklogo.com.png"
                                                            alt="Orange Money">
                                                    </span>
                                                    <span class="Operateur-text">Orange Money</span>
                                                </label>
                                            </div>
                                            <div class="Operateur-option col-lg-3 col-md-4 col-sm-12">
                                                <input type="radio" name="Operateur" value="MTN_money" id="MTN"
                                                    class="Operateur-input">
                                                <label for="MTN"
                                                    class="Operateur-label d-flex flex-column align-items-center justify-content-center">
                                                    <span class="Operateur-icon">
                                                        <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ8NDQ0NFREWFhURFRUYHDQgGh0nGxUVITIhKCowOi4uFx8zPTQtNygtMTcBCgoKDQ0OFQ8PFS4fHR0tLSstKy0vLSsrLSsrKystLS0tLSsvKy0rKysrLS0rKy0tKy0rLSsrLS0tLS0tLS0rLf/AABEIALgBEgMBEQACEQEDEQH/xAAbAAEBAQADAQEAAAAAAAAAAAABAAIFBgcEA//EAEQQAAICAgACBwQGBgUNAAAAAAABAgMEEQUGBxITITFBUTJhcYEUIkKRocEjNHKCkrEVFjNSohc1Q0RUYnSEsrPR0uH/xAAbAQEBAAMBAQEAAAAAAAAAAAAAAQIEBQMGB//EADkRAQACAQIDBAcECQUAAAAAAAABAgMEEQUhMQYSMlETFCJBcZGhYYHR8BUWIzNSorHB4SQ0QkNT/9oADAMBAAIRAxEAPwDtJ+ZO8gEBIJBTogdECkBrRApBWkgHRBpIitJECQaIqAgIAKjLRQNAZaKjLRQNFGWggaKDQBoAKDRUBQAQEBAIDom4UibqUgFIg0kQKQVrQDogUibjWibqUgEgSKQECAAACKjLQBooGi7ozooGgBooy0EDRRnQAXcDKAqACAQFECkRSkQaSINJBWkgHRjuFIbjWibqdAJAgRFICBAQEAAQAVAAaKBobgaLuBoboy0XcDRRloDLRUBRlooGBBCkFaRApEGkiK0kBrRApE3GtEU6ASBAiKQIBAgICAgIAAgIAKgANFBoA0UZaKgaKMtAZaKjJQFGQjSIrSRBpIg0kFaSINaMVa0A6ASCIpAgECAgICAgICAgICAAIAKg0ANFABlooy0VGWijLRUZZQAaRBpIg2kRWkhI0kYqUiBAUFOgEggICAgICAgICAgICAgICAAIAKg0Blooy0UDRUYaKMtFRkDaINJBWkiSNoxVpIgQJEUgIEBAQEBAQEBAQEBAQEBAQEBAQAAADKjLKMtFgZaKjLRRkI2kFaSJI2kYq0kQIERSgECAgICAgICAgJAQRDYRBFVAQEBAQEBAAAANFRlooy0WEZaKM6A/RIBRNxpGKtAJFIEBAQEBAQEE3cRxbmfh2FtZOXTCS/0al2lv8Eds38HDNVn50pO3n0eV8+OvWXVM/pb4fW2qKMm9+Umo0wf3vf4HVxdm81o3veI+rXtraR0hw8ulvKsesfhsH6bsstf+GKNyOzunr48k/SHn65eelWZdIPMEvY4ZFL3YeTP8zP8AQ3D465P5oT1rN5CPSBzDH2+GRa9+FlR/Mfobh09Mn80HrWbybXSzmVfrHDYL9+2l/wCJMwns7preDJP0PXLx1q5XA6XcGbSvxsij1cXC6C/k/wADUy9m8sfu7xPxelddX3w7Vwnm3hmZpUZlLm/Cub7Kx/uy02crPwrV4edqcvOObYpqMdukubNDbbq9t0QQVAQEBAQAABA0UZaKMsu6Au40kTcaSIpIEgQpAkBAQEBBN3XObOcsPhUerY3bkNbhjVtdfXk5P7K+J1dBwnNqufSvn+DwzaiuP4vP/wCkOYuYG/o6eLhttbhJ0Ua9HZ7U/l9x9FGLh3DY9ud7fOWl3s2bpyhzfCOiTFhqWbkWZEvFwq/Q1/f7T/A0NR2jv0w02jznm9qaKOt5du4fyjwvG12WDjprwlOHaz/intnHy8V1eXxZJ+7k2a6fHXpDmK64xWoxjFekUor8DStlvbraXpFYjpDezHeV2WxvJszOCl3SSkvSSTRlXJevS0p3Y8nEcQ5W4Zk77bBxpN/aVarn/FHTNzFxPV4/Dkn+rztgx26w6lxfolwrE3iXW40vKM/09X4/W/E62n7SZY29NXf4dWtfRVnwy4Cb5j5e75N5WHHxbcsjHUfn9av8F8TpxHDeIxtHK3yn/Lw/b4OfWHeuUOesPimq/wBXytd+PY0+v3d7rl9r4ePuOBxDg2XS+3HtV825h1NcnLpLtRxmygqAgICAgAAZUDAy0UGgEDRAogQpAgICAgIDq3SDzUuFYqdenlX9aFEX3qCXtWteaW13erR2eD8O9ayd63hr1aupzdyu0dZdV5F5EeTrifFutbK59rXRY23Zvv7S3135R9PH0OtxTi8Yf9PpusdZ8vg19Pp5tPfu9ShBRSjFKMYpKMUkkl6JHyVrzad7TvLoxERyhxXM/H6uGY30m+Fk4dpCvq1KLluW9PvaXkbeg0NtXfuVnblu8suWMcby3y7x3H4ljRycZvqtuM4T0rK5r7Mkvk/mNbocmkydy/z9y4ssZI3hxXHOe8LCzIYM43W3SdcZdkoOFcptdWMm346afzNzS8FzZ8Ppt4iPteV9VStu6+LjXSXg4WVdi2UZUrKJuEpQjU4N633blvzPfD2ezZKReLxzY21lYnbZ8P8Ald4d/s2b/BT/AO56/q1m/wDSE9cr5S5PinSLg4k8aF1eSlk49GVGcYQca6rN6631t7WnvWzXxcBzZa2mto9mZj74ZW1dazEOzZefXVjWZW+0qhTK/dbT69aj1tx8ntHKx6a9s0YekzO3N7zkju95x3KfM9HFqrLqK7a41WKuSuUVJy6qfd1W/U2eIcOvo7Vi1onfyYYc0ZY3hzbW+5+D7mvJo58Wms7xL2mN3mvPnR7FqWdwyLpyK/0s6KvqqbXf16tezNeOl4/E+p4XxmbTGHUc4nlE/wBpaGfTf8qOV6NObpcSolTkNPMxlHrS8O3q8FZr133P5PzNTjfDY09oy4/DP0emlzd+O7PWHdTgNxAQEBAQABABUZYAAlCQKIpQCBICAgICCPIudq1mcz4eLd/Yr6JX1X7Lg25yWvfvR9rwyfQ8NtenXnLl5/azxEvXV7u5eS9D4u0zaZmfe6kRsiK6N0x/5p/5qj+Uj6Ds5/uZ+DT1vgec8v8AGM7gMq8hQU6M/GdkINtVz1tRlvXtRl4r0fvTPptVpcGtr6O3Ws/n5tHHe2LnHvfFdhZNeXgZGW27c6yvL+t7bjK/SlL463r0aPat8c0vTH0ry+jGYneJn3vZub+AYEsTiOTLDx5ZH0XJs7Z1RdnaKuTUutre+5Hxug12o9Yx4+/Pd3223dLLhp3JttzdQ6IeC4WVh5M8nFovnHJUYytrjNxj2cXpN+86/H9XmwWpGO013a2kx1vE96HFdKWAp8ZwsSlQrU8XEx6klqFads4RWl4JdxtcFyzOktkvO/OZlhqa/tIrHkuA8x3YGNxHgvENw6uPk147m/7K3qP9Fv8Auy8Yv3+8yz6HHny4tXh90xM/bCVyzStsdnY+hD9Sy/8Ail/24nK7S/vMfwbGh6Wejny7fIiZjnCTDx/ArWHzhKqj6tdts1KK8OrbR2ko/BS7/kj7bLb0/Ce9frt/SdnMj2dRtHm9fPiXUQEBAQEBAAAwgZQABRpECRSAgQEBAQEEeW9LvC7qcjF4xj+NTrrtet9nZCfWqm/c96+S9T67gGprkxW0t/zEudq6TW0Xh3vlbmCjieLDIqaUtKN9W/rU2674v3ej80cDiGhvpMs1npPSW3hyxkrv73Lmg93TulXBvyeGdnj02X2fSaZdSqDnLqpS29I7nAMtMeomb22jZq6us2rG0Po5a4DTdwjh9GfiRnKmvfZXwalXPrS8n3ruJrtdkxavJbBflPkYsUTjrFo6Os9JPCMq/ivDrMfFutqrhSpzqqlKENXt6bS0u46fBtTjrpb+kvETMz1+DX1OO03rtDv3MtUrMDOhCLnOeJkxhCK3KUnXJJJebPntFeK6vHaZ2iLN3JHsS6p0QcNycXDyYZNFtE5ZKlGN1cq3KPZxW0n5HW7RZseS+OaWido9zW0dLVid4cZz1wjLu5g4ffTjX2UVrC69sKpSrh1ciTluSWlpd5ucK1GKnD7UtaIn2uX3MM+O85omI8nMdJfJ39I0/SceK+m0R7kv9YqX2P2l5fcaPBuKRgv6HLPsz9HpqcHejvV6vx6IOHZGLiZUcmi2iUslSjG6uVcpR7NLaTMu0ObHkvj7lonaPcukrasW3h30+cbjj+PcZo4fjWZORLUIL6sVrr2z8oRXm3/9NvRaTJqcsUpHx+x5ZckUrvLzbozwruI8UyeM5EdRjKzqejvmtdWPujDu+aPp+M5qabS10tOs7fKPxaOmrN8k5JesnxrpoCAgICAAAAZUDKAATA0gFECQIUgSAgIBA/HKx67q51WwjZXZFwnCS3GUX4pnpiy2xXi9J2mGNqxaJiXkvGeVOI8DyJZ3CZ2WY/jKCXaWVw3twsh9uHv/AJeJ9jpuI6biGP0OoiIt+ecObkw3wz3qdHYeWulDCyVGGYvod3h1nuWNN+6XjH5/ec3Wdn8tN7YJ70eXv/y9sWrrPK3J3ui6FkVOucbIPvU4SU4v4NHAvivjna0TDci0WjeGzz5qgICG4i8xEGbLIwi5TkoxXe5SajFL3tmdcd8k7ViZSZiHSuY+kvh+IpQx39NvXclW9URf+9Z4P5bO7o+AZssxOX2Y+rVy6utfDzl1Lh3AeK8x3xy+ITlRhr2Pq9RdX+7RB/8AU/xOxn1ek4bj9Hhje356y1qY8me29uj1vh2BTi014+PBV01R6sILyXq35t+LfmfHajUXz3nJkneZdKlIpG0PpPBmgICAgIAACoGwMsoNgZTMkaTIrSZBogSKgECAgICAixOyOs8w8icN4g5TnV2Fz73fj6rk36yXsy+aOtpONanT7V370eUtfJpqX+yXSrejri+BJz4ZndZb31Y2SxbH6bjvqy+bO5Tjej1EbZ6bfGN4as6XJTwSz/WjmnB0snDlfFeMrMVzTX7dXcZTw/heo50tEfCdvpKRmz06w/arpfti+rfw6Kfn1b5Qf3Sj+Z427N4rc6ZfoyjW2jrD7IdMOL9rCyF8La5HhPZq/uyfRl69H8Jl0wYnlhZD+NlaH6tX9+X6Hr0fwviu6YJyeqeHLfl18hyf3Rh+Z7V7NY48eX6JOttPhq/H+t/M+duOLhOlS8JV4su79+z6p6xw3heDnktE/Gf7QwnNnv4YUOQeOcRanxPN7OL0+pZbLIkvhXF9RfeW3GNBpo2wU3+HL6kabLfxS7jy/wBHnDMFxm63lXLTVmRqSi/WMPZX4nF1XHNTm5Vnux9n4trHpaV5zzdsOLM785bPwQVAQFsAAQAACBsoyyjLZdkGxsMpmQ0QaTMZVpMg0AkVAIEBAQEBAQRCJ26D87ceuft1wn+3CMv5nrXPlr4bT82M0rPufJPgeDL2sLEfxx6n+R6xrtTHTJPzT0VPIQ4FgR9nCxF8Mar/AMFnX6mf+yfmeip5PrqxaoexXXD9iEY/yR421GW3W8/Ne5Xyfsee8stgQQVAQEBAQEAAAQMoyyjLZYRlsyGdgCYRpMK0mQbRjKlMg0QKCoBAgICAgICAgICAgICAgICAgACCIAACjLZRlsoy2VGWyjIQJlGkyK0mBtMg1sxUpgaIIilAQCBAQEBAQEBAQEBAQEAAQEAMqIAbAzsoy2UZbMkZbAy2VGdgCKNJkGkyK0mBpMg0mRWtkDsgQIgQqAQICAgICAgICAgACAALZUGxANlGWwBsyRlsoy2BlsqMsoABMoSDSZBpMitJgaTIHZNla2QOwHZBAOwEioBAgICAgIAAgDYRbKBsbA2UGwBsoy2VGWwMtlA2VGWyjLKLYQFCmRSibBTINJgaTIrSYCmQKZNlOxsHZA7AdkCAkVAIEBAAAEGyi2AbKBsA2XYZ2VA2UZbAGwjLZRnZQFAERQAICmRTsmwdgKZBpMKUyDSYCmTYOybBTCnZA7INARFIFsCACoGwBsozsA2XZBsuwNgGyjOwMtlQbGwGy7A2XYAQFEBAQEA7IpAdkDsB2Qa2QKYCmRWkwFMg0RSmBogiCCoIGyjLZQNlRlsozsA2UGwgbAy2UGyi2ANlAVABAQH/2Q=="
                                                            alt="MTN Money">
                                                    </span>
                                                    <span class="Operateur-text">MTN Money</span>
                                                </label>
                                            </div>
                                            <div class="Operateur-option col-lg-3 col-md-4 col-sm-12">
                                                <input type="radio" name="Operateur" value="Moov_money" id="Moov"
                                                    class="Operateur-input">
                                                <label for="Moov"
                                                    class="Operateur-label d-flex flex-column align-items-center justify-content-center">
                                                    <span class="Operateur-icon">
                                                        <img src="https://play-lh.googleusercontent.com/P0fu0Qo5Y7JjS6duZRTa8Z5KJCbNDiHo1W714pz9qN9IoX8ufR0L7SE_FkDUWpZZRi_x=w240-h480-rw"
                                                            alt="Moov Money">
                                                    </span>
                                                    <span class="Operateur-text">Moov Money</span>
                                                </label>
                                            </div>

                                        </div>
                                        <div class="col-12 d-flex justify-content-center mt-4">
                                            <span id="clearChoise" class="">Supprimer mon choix</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3" id="IBANPaiement">
                                        <div class="col-12 px-0">
                                            <label for="IBAN" class="form-label text-center">Veuillez entrer le RIB du compte sur lequel le beneficiaire recevra le paiement <span class="star">*</span></label>
                                            <div class="rib-container row">
                                                <div class="col-lg-3 col-12 mb-3 w-lg-20 text-center">
                                                    <label for="codebanque" class="form-label">Code Banque</label><br>
                                                    <input type="text" class="rib-input" value="C" name="rib_1" maxlength="1" readonly>
                                                    <input type="text" class="rib-input" value="I" name="rib_2" maxlength="1" readonly>
                                                    <input type="text" class="rib-input" name="rib_3"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_4"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_5"
                                                        maxlength="1">
                                                </div>
                                                <div class="col-lg-3 col-12 mb-3 w-lg-20 text-center">
                                                    <label for="codeagence" class="form-label">Code Agence</label><br>
                                                    <input type="text" class="rib-input" name="rib_6"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_7"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_8"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_9"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_10"
                                                        maxlength="1">
                                                </div>
                                                <div class="col-lg-5 col-12 mb-3 text-center">
                                                    <label for="numcompte" class="form-label">N° de Compte</label><br>
                                                    <input type="text" class="rib-input" name="rib_11"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_12"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_13"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_14"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_15"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_16"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_17"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_18"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_19"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_20"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_21"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_22"
                                                        maxlength="1">
                                                </div>
                                                <div class="col-lg-1 col-12 mb-3 w-lg-15 text-center">
                                                    <label for="clerib" class="form-label">Clé RIB</label><br>
                                                    <input type="text" class="rib-input" name="rib_23"
                                                        maxlength="1">
                                                    <input type="text" class="rib-input" name="rib_24"
                                                        maxlength="1">
                                                </div>
                                                <span class="text-center"><i id="ibanMsgError"
                                                        class="text-danger"></i></span>
                                                <span class="text-center"><i id="ibanMsgSuccess"
                                                        class="text-success"></i></span>
                                            </div>
                                            <input type="hidden" class="form-control" name="IBAN" id="IBAN">

                                            {{-- <input type="hidden" name="TelOtp" value="" id="TelOtp"> --}}
                                        </div>

                                        <small class="text-center"><span class="form-label star"><i>Veuillez saisir le RIB
                                                    de votre compte
                                                    courant </i></span></small>
                                    </div>
                                    <div class="row g-3 mb-3" id="TelephonePaiement">
                                        <div class="col-12 col-lg-6">
                                            <label for="TelPaiement" class="form-label">N° de téléphone sur lequel le beneficiaire
                                                 recevra le paiement <span class="star">*</span></label>
                                            <input type="number" class="form-control no-copy no-cut no-paste" name="TelPaiement"
                                                id="TelPaiement"
                                                placeholder="Veuillez saisir le N° de téléphone sur lequel le beneficiaire recevra le paiement">
                                            <small><i id="telMsgError" class="text-danger"></i></small>
                                            <small><i id="telMsgSuccess" class="text-success"></i></small>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="ConfirmTelPaiement" class="form-label">Confirmer le N° de
                                                téléphone <span class="star">*</span></label>
                                            <input type="number" class="form-control no-copy no-cut no-paste" name="ConfirmTelPaiement"
                                                id="ConfirmTelPaiement"
                                                placeholder="Veuillez resaisir le N° de téléphone sur lequel vous souhaitez recevoir le paiement">
                                            <small><i id="telConfirmMsgError" class="text-danger"></i></small>
                                            <small><i id="telConfirmMsgSuccess" class="text-success"></i></small>
                                        </div>
                                        <small><span class="form-label star"><i>N° de Telephone sans l'indicatif (ex:
                                                    <strong>0100128271</strong>) </i></span></small>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-start gap-3">
                                            <button class="btn2 border-btn2 p-2" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseFour" aria-expanded="true"
                                                aria-controls="collapseFour"><i
                                                    class='bx bx-left-arrow-alt fs-4'></i>Retour </button>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end gap-3">
                                            <button class="btn-prime p-2 next-step-btn d-none" id="nextStepBtn"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                aria-expanded="false" aria-controls="collapseSix">Suivant <i
                                                    class='bx bx-right-arrow-alt fs-4'></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item etapeSinistre" id="etapeSinistre6">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button">
                                    <h5 class="text-uppercase">Document requis</h5>
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @include('users.sinistre.components.stepsCreate.docs')

                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-start gap-3">
                                            <button class="btn2 border-btn2 p-2" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseFive" aria-expanded="false"
                                                aria-controls="collapseFive"><i
                                                    class='bx bx-left-arrow-alt fs-4'></i>Retour </button>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end gap-3">
                                            <button class="btn-prime p-2" id="nextStepResume" type="button">
                                                Suivant <i class='bx bx-right-arrow-alt fs-4'></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="accordion-item etapeSinistre" id="etapeSinistre7">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button">
                                    <h5 class="text-uppercase">Resumé, Signature et Soumission</h5>
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div id="resumeSinistre">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h5>Informations du déclarant</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <dl class="row">
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Nom:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="NomDeclar"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Prénom:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="PrenomDeclar"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Email:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="EmailDeclar"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">N° de téléphone:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="TelDeclar"></dd>
                                                        </dl>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <dl class="row">
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Date de naissance:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="DateNaissanceDeclar"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu de naissance:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="LieuNaissanceDeclar"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu de résidence:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="LieuResidenceDeclar"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Filiation avec l'assuré:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="FiliationDeclar"></dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h5>Informations sur l'assuré(e)</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <dl class="row">
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Nom:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="NomAssure"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Prénom:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="PrenomAssure"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Date de naissance:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="DateNaissanceAssure"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Genre:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="GenreAssure"></dd>
                                                        </dl>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <dl class="row">
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu de naissance:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="LieuNaissanceAssure"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu de résidence:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="LieuResidenceAssure"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Profession:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="ProfessionAssure"></dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h5>Informations sur le sinistre</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <dl class="row">
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Nature du sinistre:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="NatureSin"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Date du sinistre:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="DateSin"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Cause du sinistre:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5 text-wrap" id="CauseSin"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Décès accidentel:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="DecesAccident"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Déclaration tardive:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="DeclarationTard"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Ville du sinistre: </dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="villeSin"></dd>
                                                        </dl>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <dl class="row">
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu de conservation:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5 text-wrap" id="LieuConservationCorps"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Date de levée:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="DateLeveeCorps"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu de levée:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5 text-wrap" id="LieuLeveeCorps"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Date d'inhumation:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="DateInhumationCorps"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu d'inhumation:</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5 text-wrap" id="LieuInhumationCorps"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu du sinistre: </dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5 text-wrap" id="lieuSinistre"></dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h5>Informations du mode de paiement</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <dl class="row">
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">ID Contrat :</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="Contrat"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Moyen de paiement :</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="moyenPmt"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Opérateur :</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="Operat"></dd>
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Numéro de paiement :</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="TelPaie"></dd>

                                                            {{-- sinon si moyenPaiement = Virement_Bancaire affiche --}}
                                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Relevé d'identité bancaire (RIB) :</dt>
                                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" id="NRIB"></dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-start gap-3">
                                            <button class="btn2 border-btn2 p-2" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseSix" aria-expanded="false"
                                                aria-controls="collapseSix"><i
                                                    class='bx bx-left-arrow-alt fs-4'></i>Retour </button>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end gap-3">
                                            <button class="btn-prime p-2" type="button" data-bs-toggle="modal"
                                                data-bs-target="#otpModal" id="btn-signature">
                                                Signer
                                            </button>
                                            <button class="btn-prime btn-prime-two p-2 d-none" id="btn-submit"
                                                type="submit">
                                                Soumettre
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                    <input type="hidden" id="tokGenerate" name="tokGenerate" value="{{ $tok }}">
                    @php
                        $keyUuid = $token['key_uuid'];
                        $operationType = $token['operation_type'];
                    @endphp
                </div>

            </form>
        </div>
    </div>
    <!--end stepper one-->


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Leaflet Geocoding Plugin -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>



    @include('users.espace_client.services.prestations.modals.signModal')
    @include('users.espace_client.services.prestations.modals.otpModal')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countries = @json($detailCountries);
            const phoneInput = document.getElementById('phoneInput');
            const countryPrefixSelect = document.getElementById('countryPrefix');
            const phoneInputGroup = document.getElementById('phoneInputGroup');

            // Création du message de statut
            const statusDiv = document.createElement('div');
            statusDiv.id = 'prefix-status';
            statusDiv.style.fontSize = '0.9em';
            statusDiv.style.marginTop = '4px';
            phoneInputGroup.insertAdjacentElement('afterend', statusDiv);

            function detectCountryFromPhone(value) {
                const cleanedValue = value.replace(/\s+/g, '').replace(/^00/, '+');
                if (!cleanedValue.startsWith('+') && countryPrefixSelect.value == '') {
                    statusDiv.innerHTML =
                        `ℹ Entrez un numéro commençant par l'indicatif précédé de <code>+</code> ou <code>00</code>`;
                    statusDiv.style.color = '#6c757d'; // gris
                    // countryPrefixSelect.value = '';
                    return;
                }

                const country = countries.find(c => cleanedValue.startsWith('+' + c.phone_international_prefix));

                if (country) {
                    const prefix = '+' + country.phone_international_prefix;
                    phoneInput.value = cleanedValue.replace(prefix, '');
                    countryPrefixSelect.value = country.phone_international_prefix;
                    statusDiv.innerHTML = `✅ <strong>${country.name}</strong> détecté (<code>${prefix}</code>)`;
                    statusDiv.style.color = '#198754'; // vert
                } else if (!country && countryPrefixSelect.value == '') {
                    statusDiv.innerHTML = `❌ Aucun pays trouvé pour cet indicatif`;
                    statusDiv.style.color = '#dc3545'; // rouge
                    countryPrefixSelect.value = '';
                }
            }

            phoneInput.addEventListener('input', function() {
                detectCountryFromPhone(phoneInput.value);
            });


        });
    </script>

    <script>
        const SIGN_API = "{{ config('services.sign_api') }}";
        const OTP_API = "{{ config('services.otp_api') }}";
        var assuree = @json($assuree);
        var beneficiaires = @json($allBeneficiaire ?? []);
        beneficiaires = Object.values(beneficiaires);
        var benefConserne = @json($benefConserne);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sendOTPForm = document.getElementById('sendOTPForm');
            // const otpModal = document.getElementById('otpModal');
            const OTPSendID = document.getElementById('OTPSendID');
            const OTPVerifyID = document.getElementById('OTPVerifyID');
            const verifyOTPForm = document.getElementById('verifyOTPForm');
            const sendOTPButton = document.getElementById('sendOTPButton');


            const otpInputs = document.querySelectorAll('.otp-input');

            // Envoi de l’OTP
            sendOTPButton.addEventListener('click', function(e) {
                e.preventDefault();

                const indicatif = document.getElementById('countryPrefix').value;
                const telephone = document.getElementById('phoneInput').value;
                const operation_type = document.getElementById('operation_type').value;
                const csrfToken = document.querySelector('input[name="_token"]').value;

                fetch(`${OTP_API}api/send-otp`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            telIndicatif: indicatif,
                            telephone: telephone,
                            operation_type: operation_type
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status == 200) {
                            // Masquer sendOTPForm, afficher verifyOTPForm
                            OTPSendID.classList.add('d-none');
                            OTPVerifyID.classList.remove('d-none');

                            // Stocker les valeurs pour la vérification
                            document.getElementById('hiddenTelephone').value = telephone;
                            document.getElementById('hiddenIndicatif').value = indicatif;

                            // Afficher un message
                            const lastTwo = telephone.slice(-4);
                            const firstTwo = telephone.slice(0, 2);
                            //utilise sweetalert
                            Swal.fire({
                                icon: 'success',
                                title: 'Un code de confirmation a été envoyé par SMS au numéro +' +
                                    indicatif + firstTwo + '**' + lastTwo,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                position: 'center',
                                timerProgressBar: true,
                                timer: 5000
                            });
                            //alert('Un code de confirmation a été envoyé par SMS au numéro +' + indicatif + firstTwo + '**' + lastTwo);

                            startOtpTimer();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: data.message || 'Erreur lors de l’envoi de l’OTP.',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                position: 'center',
                                timerProgressBar: true,
                                timer: 5000
                            });
                            //alert(data.message || 'Erreur lors de l’envoi de l’OTP.');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur réseau ou serveur.',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            position: 'center',
                            timerProgressBar: true,
                            timer: 5000
                        });
                        //alert('Erreur réseau ou serveur.');
                    });
            });


            // Autofocus entre les champs OTP
            otpInputs.forEach((input, index) => {
                input.addEventListener("input", function() {
                    if (this.value.length === this.maxLength) {
                        if (index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                    } else if (this.value.length === 0 && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });

                input.addEventListener("keydown", function(e) {
                    if (e.key === "Backspace" && input.value === "" && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });
            });

            const verifyOtpButton = document.getElementById('verifyOtpButton');
            const changePhoneButton = document.getElementById('changePhoneButton');
            const changePhoneButtonForMobileMoney = document.getElementById('changePhoneButtonForMobileMoney');
            const otpContainer = document.getElementById('OTP');
            const btnSignature = document.getElementById('btn-signature');
            const btnSubmit = document.getElementById('btn-submit');
            const resendOtpButton = document.querySelector(".resend-otp-btn");
            const otpTimer = document.createElement("div"); // Timer pour afficher le compte à rebours
            // initialisation pour le hide modal bootstrap
            const qrCodeModal = new bootstrap.Modal(document.getElementById('qrCodeModal'));
            const myModal = new bootstrap.Modal(document.getElementById('otpModal'));
            verifyOtpButton.addEventListener('click', function() {
                const telephone = document.getElementById('hiddenTelephone').value;
                const indicatif = document.getElementById('hiddenIndicatif').value;
                const phoneNumber = indicatif + telephone;
                const csrfToken = document.querySelector('input[name="_token"]').value;

                let otp = '';
                otpInputs.forEach(input => {
                    otp += input.value;
                });

                if (otp.length !== 6) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Veuillez saisir les 6 chiffres du code.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        position: 'center',
                        timerProgressBar: true,
                        timer: 5000
                    });
                    otpInputs.forEach(input => {
                        input.classList.remove("is-valid");
                        input.classList.add("is-invalid");
                    });
                    return;
                }


                fetch(`${OTP_API}api/verify-otp`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            telephone: phoneNumber,
                            otp: otp
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Votre numéro de téléphone a été vérifié avec succès.',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                position: 'center',
                                timerProgressBar: true,
                                timer: 5000
                            });
                            otpInputs.forEach(input => {
                                input.classList.remove("is-invalid");
                                input.classList.add("is-valid");
                            });

                            // Masquer btnSignature, afficher btnSubmit et ouvrir la modale qrCodeModal avec un delay de 5 secondes
                            setTimeout(() => {
                                //btnSignature.classList.add('d-none');
                                //btnSubmit.classList.remove('d-none');
                                myModal.hide();
                                qrCodeModal.show()
                            }, 5000);

                            ;
                        } else if (data.status == 400) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Le code de confirmation saisi est incorrect.',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                position: 'center',
                                timerProgressBar: true,
                                timer: 5000
                            });
                            otpInputs.forEach(input => {
                                input.classList.remove("is-valid");
                                input.classList.add("is-invalid");
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Le code de confirmation a expiré.',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                position: 'center',
                                timerProgressBar: true,
                                timer: 5000
                            });
                            otpInputs.forEach(input => {
                                input.classList.remove("is-valid");
                                input.classList.add("is-invalid");
                            });
                        }
                    })
                    .catch(err => {
                        console.error(err);
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
            });

            // Fonction pour démarrer le compte à rebours pour l'expiration de l'OTP
            let otpExpirationTime = 3 * 60; // 3 minutes en secondes
            let otpInterval;

            function startOtpTimer() {
                otpTimer.classList.add("otp-expi-timer");
                otpContainer.appendChild(otpTimer); // Ajouter le timer à l'interface
                updateOtpTimer();

                otpInterval = setInterval(() => {
                    otpExpirationTime--;
                    updateOtpTimer();

                    if (otpExpirationTime <= 0) {
                        clearInterval(otpInterval);
                        otpTimer.textContent = "Le code de confirmation a expiré.";
                        resendOtpButton.classList.remove("d-none"); // Afficher le lien pour renvoyer l'OTP
                        changePhoneButton.disabled = false; // Afficher le lien pour renvoyer l'OTP
                        changePhoneButtonForMobileMoney.disabled = false; // Afficher le lien pour renvoyer l'OTP
                    }
                }, 1000); // Met à jour chaque seconde
            }

            function updateOtpTimer() {
                const minutes = Math.floor(otpExpirationTime / 60);
                const seconds = otpExpirationTime % 60;
                otpTimer.textContent = `Temps restant: ${minutes}:${
                seconds < 10 ? "0" : ""
                }${seconds}`;
            }

            // Fonction pour renvoyer l'OTP
            resendOtpButton.addEventListener("click", async function() {
                otpExpirationTime = 3 * 60; // Réinitialiser le temps d'expiration
                clearInterval(otpInterval); // Arrêter l'ancien intervalle
                resendOtpButton.classList.add("d-none"); // Cacher le lien pendant l'envoi de l'OTP
                const telephone = document.getElementById('hiddenTelephone').value;
                const indicatif = document.getElementById('hiddenIndicatif').value;
                const phoneNumber = indicatif + telephone;
                const csrfToken = document.querySelector('input[name="_token"]').value;


                try {

                    const response = await fetch(`${OTP_API}api/send-otp`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        body: JSON.stringify({
                            telephone: phoneNumber,
                        }),
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();
                    if (data.status === 200) {
                        // Afficher un message
                        const lastTwo = telephone.slice(-4);
                        const firstTwo = telephone.slice(0, 2);
                        Swal.fire({
                            icon: 'success',
                            title: 'Le code de confirmation a été réenvoyé par SMS au numéro +' +
                                indicatif +
                                firstTwo + '**' + lastTwo,
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            position: 'center',
                            timerProgressBar: true,
                            timer: 5000
                        });
                        startOtpTimer();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Une erreur s’est produite lors de l’envoi de l’OTP.',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            position: 'center',
                            timerProgressBar: true,
                            timer: 5000
                        });
                    }
                } catch (err) {
                    console.error(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Une erreur s’est produite lors de l’envoi de l’OTP.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        position: 'center',
                        timerProgressBar: true,
                        timer: 5000
                    });
                }
            });

            changePhoneButton.addEventListener('click', function() {
                // Masquer OTPVerifyID, afficher OTPSendID
                OTPSendID.classList.remove('d-none');
                OTPVerifyID.classList.add('d-none');
                {{-- this.disabled = true; --}}
            })
            changePhoneButtonForMobileMoney.addEventListener('click', function() {
                // Masquer le modal otp et afficher le collapse
                myModal.hide();
                const collapseFive = document.querySelector("#collapseFive");
                const bsCollapse = new bootstrap.Collapse(collapseFive, {
                    toggle: true
                });
            })
        });
    </script>

    <script>
        let pollingInterval;

        const qrCodeModal = document.getElementById('qrCodeModal');
        const btnSignature = document.getElementById('btn-signature');
        const btnSubmit = document.getElementById('btn-submit');

        qrCodeModal.addEventListener('shown.bs.modal', function() {
            const keyUuid = "{{ $keyUuid }}"; // Variable Blade pour key_uuid
            const operationType = "{{ $operationType }}"; // Variable Blade pour operation_type

            // Polling toutes les 3 secondes pour vérifier l'état de la signature
            pollingInterval = setInterval(() => {
                fetch(
                        `${SIGN_API}api/check-signature-status/${keyUuid}/${operationType}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status == 'completed') {
                            clearInterval(pollingInterval);

                            // Masquer la modale si la signature est terminée
                            const modal = bootstrap.Modal.getInstance(qrCodeModal);

                            btnSignature.classList.add('d-none');
                            btnSubmit.classList.remove('d-none');
                            modal.hide();

                            // Afficher un message indiquant que la signature est terminée utilise sweetalert
                            Swal.fire({
                                icon: 'success',
                                title: 'Signature terminée avec succès !',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Erreur de polling :", error);
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
     document.addEventListener('DOMContentLoaded', function () {
        let form = document.getElementById("sinistreForm");
        const changePhoneButton = document.getElementById('changePhoneButton');
        const changePhoneButtonForMobileMoney = document.getElementById('changePhoneButtonForMobileMoney');

        if (form) {
            const nextStepResumeBtn = form.querySelector("#nextStepResume");

            if (nextStepResumeBtn) {
                nextStepResumeBtn.addEventListener("click", function(e) {
                    const errors = [];

                    // Vérifier les radios requis
                    document.querySelectorAll("tr[data-row-required='1']").forEach(row => {
                        const docId = row.getAttribute("data-docid");
                        const groupName = `docLibelle[${docId}]`;
                        const radios = document.querySelectorAll(`input[name="${groupName}"]`);
                        const checked = [...radios].some(r => r.checked);
                        const label = row.querySelector("td .text-wrap") ?
                            row.querySelector("td .text-wrap").textContent.trim() :
                            `Doc ${docId}`;
                        if (!checked) {
                            errors.push(
                                `Le document "<b>${label}</b>" : Veuillez choisir le type de document en votre possession.`
                            );
                        }
                    });

                    // Vérifier les fichiers requis
                    document.querySelectorAll("input[type='file'][data-file-required='1']").forEach(fi => {
                        const row = fi.closest("tr");
                        const label = row && row.querySelector("td .text-wrap") ?
                            row.querySelector("td .text-wrap").textContent.trim() :
                            "Document requis";
                        if (!fi.files || fi.files.length === 0) {
                            errors.push(
                                `Le document "<b>${label}</b>" : fichier manquant. Veuillez joindre le fichier.`
                            );
                        }
                    });

                    if (errors.length > 0) {
                        // 🚫 Bloque progression
                        Swal.fire({
                            icon: "warning",
                            title: "Documents manquants ou incomplets",
                            html: errors.map(msg =>
                                `<div style="text-align:left;margin:4px 0">• ${msg}</div>`).join(""),
                            confirmButtonText: "OK"
                        });
                    } else {
                        // ✅ Ouvrir manuellement le collapse #collapseSeven
                        const collapseSeven = document.querySelector("#collapseSeven");
                        const bsCollapse = new bootstrap.Collapse(collapseSeven, {
                            toggle: true
                        });
                    }
                });
            }
            const moyenPaiementInputs = form.querySelectorAll('input[name="moyenPaiement"]');
            const operateurSection = form.querySelector('#Operateur');
            const telPaiementField = form.querySelector('#TelPaiement');
            const ibanPaiementField = form.querySelector('#IBAN');
            const ibanField = form.querySelectorAll('.rib-input');
            const confirmTelPaiementField = form.querySelector('#ConfirmTelPaiement');
            const ibanPaiementSection = form.querySelector('#IBANPaiement');
            const telPaiementSection = form.querySelector('#TelephonePaiement');
            const operateurInputs = form.querySelectorAll('input[name="Operateur"]');
            // jQuery messages (doivent exister dans le HTML)
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
                        telMsgError.textContent = "Le numéro doit avoir 10 chiffres et commencer par " + prefix;
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
            if (!form) {
                console.error("Le formulaire avec l'ID 'formSinistre' est introuvable.");
                return;
            }
            form.addEventListener('input', mettreAJourResume);
            form.addEventListener('change', mettreAJourResume);
            // helper pour éviter l'erreur
            function formatDateFR(value) {
                if (!value) return "";
                const d = new Date(value);
                return isNaN(d.getTime()) ? value : d.toLocaleDateString("fr-FR");
            }
            function mettreAJourResume() {
                try {
                    // Récupération des informations de paiement
                    const idContrat = form.querySelector('[name="idcontrat"]') ?.value || '';
                    const moyenPaiement = form.querySelector('[name="moyenPaiement"]:checked') ?.value || '';
                    const operateur = form.querySelector('[name="Operateur"]:checked') ?.value || '';
                    const telPaiement = form.querySelector('[name="TelPaiement"]') ?.value || '';
                    const iban = form.querySelector('[name="IBAN"]') ?.value || '';

                    // Récupération des informations du déclarant
                    const nomDecalarant = form.querySelector('[name="nomDecalarant"]') ?.value || '';
                    const prenomDecalarant = form.querySelector('[name="prenomDecalarant"]') ?.value || '';
                    const dateNaissanceDecalarant = form.querySelector('[name="datenaissanceDecalarant"]') ?.value || '';
                    const lieunaissanceDecalarant = form.querySelector('[name="lieunaissanceDecalarant"]') ?.value || '';
                    const celDecalarant = form.querySelector('[name="celDecalarant"]') ?.value || '';
                    const emailDecalarant = form.querySelector('[name="emailDecalarant"]') ?.value || '';
                    const filiation = form.querySelector('[name="filiation"]') ?.value || '';
                    const lieuresidenceDecalarant = form.querySelector('[name="lieuresidenceDecalarant"]') ?.value || '';

                    // Récupération des informations de l'assuré
                    const nomAssuree = form.querySelector('[name="nomAssuree"]') ?.value || '';
                    const prenomAssuree = form.querySelector('[name="prenomAssuree"]') ?.value || '';
                    const datenaissanceAssuree = form.querySelector('[name="datenaissanceAssuree"]') ?.value || '';
                    const lieunaissanceAssuree = form.querySelector('[name="lieunaissanceAssuree"]') ?.value || '';
                    const professionAssuree = form.querySelector('[name="professionAssuree"]') ?.value || '';
                    const lieuresidenceAssuree = form.querySelector('[name="lieuresidenceAssuree"]') ?.value || '';
                    const genreAssuree = form.querySelector('[name="genreAssuree"]:checked') ?.value || '';

                    // Récupération des informations du sinistre
                    const natureSinistre = form.querySelector('[name="natureSinistre"]:checked') ?.value || '';
                    const decesAccidentel = form.querySelector('[name="decesAccidentel"]:checked') ?.value || '';
                    const declarationTardive = form.querySelector('[name="declarationTardive"]:checked') ?.value || '';
                    const dateSinistre = form.querySelector('[name="dateSinistre"]') ?.value || '';
                    const causeSinistre = form.querySelector('[name="causeSinistre"]') ?.value || '';
                    const lieuConservation = form.querySelector('[name="lieuConservation"]') ?.value || '';
                    const dateLevee = form.querySelector('[name="dateLevee"]') ?.value || '';
                    const lieuLevee = form.querySelector('[name="lieuLevee"]') ?.value || '';
                    const dateInhumation = form.querySelector('[name="dateInhumation"]') ?.value || '';
                    const lieuInhumation = form.querySelector('[name="lieuInhumation"]') ?.value || '';
                    const villeSinistre = form.querySelector('[name="villeSinistre"]') ?.value || '';
                    const lieuSinistre = form.querySelector('[name="centresMedicaux"]') ?.value || '';

                    // Mise à jour du champ du Numéro de téléphone pour la confirmation via OTP du numéro de paiement
                    phoneInput = document.getElementById('phoneInput');
                    phoneInput.value = telPaiement;
                    
                    // Mise à jour du résumé des informations du déclarant
                    document.getElementById('NomDeclar').textContent = nomDecalarant;
                    document.getElementById('PrenomDeclar').textContent = prenomDecalarant;
                    document.getElementById('EmailDeclar').textContent = emailDecalarant;
                    document.getElementById('TelDeclar').textContent = celDecalarant;
                    document.getElementById('DateNaissanceDeclar').textContent = formatDateFR(dateNaissanceDecalarant);
                    document.getElementById('LieuNaissanceDeclar').textContent = lieunaissanceDecalarant;
                    document.getElementById('LieuResidenceDeclar').textContent = lieuresidenceDecalarant;
                    document.getElementById('FiliationDeclar').textContent = filiation;
                    
                    // Mise à jour du résumé des informations de l'assuré
                    const genreAssureeText = genreAssuree === 'M' ? 'Masculin' : genreAssuree === 'F' ? 'Feminin' : '';
                    document.getElementById('NomAssure').textContent = nomAssuree;
                    document.getElementById('PrenomAssure').textContent = prenomAssuree;
                    document.getElementById('DateNaissanceAssure').textContent = datenaissanceAssuree;
                    document.getElementById('GenreAssure').textContent = genreAssureeText;
                    document.getElementById('LieuNaissanceAssure').textContent = lieunaissanceAssuree;
                    document.getElementById('ProfessionAssure').textContent = professionAssuree;
                    document.getElementById('LieuResidenceAssure').textContent = lieuresidenceAssuree;

                    // Mise à jour du résumé des informations du Sinistre
                    const decesAccidentelText = decesAccidentel == '1' ? 'Oui': decesAccidentel == '0' ? 'Non' : '';
                    const declarationTardiveText = declarationTardive == '1' ? 'Oui': declarationTardive == '0' ? 'Non' : '';
                    document.getElementById('NatureSin').textContent = natureSinistre;
                    document.getElementById('DecesAccident').textContent = decesAccidentelText;
                    document.getElementById('DeclarationTard').textContent = declarationTardiveText;
                    document.getElementById('DateSin').textContent = formatDateFR(dateSinistre);
                    document.getElementById('CauseSin').textContent = causeSinistre;
                    document.getElementById('LieuConservationCorps').textContent = lieuConservation;
                    document.getElementById('DateLeveeCorps').textContent = formatDateFR(dateLevee);
                    document.getElementById('LieuLeveeCorps').textContent = lieuLevee;
                    document.getElementById('DateInhumationCorps').textContent = formatDateFR(dateInhumation);
                    document.getElementById('LieuInhumationCorps').textContent = lieuInhumation;

                    document.getElementById('villeSin').textContent = villeSinistre;
                    document.getElementById('lieuSinistre').textContent = lieuSinistre;

                    // Mise à jour du résumé des informations du contrat et du moyen de paiement
                    const moyenPaiementText = moyenPaiement === 'Virement_Bancaire' ? 'Virement Bancaire' : moyenPaiement === 'Mobile_Money' ? 'Mobile Money' : '';
                    document.getElementById('Contrat').textContent = idContrat;
                    document.getElementById('moyenPmt').textContent = moyenPaiementText;
                    
                    // Mise à jour du résumé pour le moyen de paiement Mobile Money
                    //const telPaiementSection = document.getElementById('TelephonePaiement');
                    //const ibanPaiementSection = document.getElementById('IBANPaiement');

                    if (moyenPaiement == 'Mobile_Money') {
                        changePhoneButton.classList.add('d-none');
                        changePhoneButtonForMobileMoney.classList.remove('d-none');
                        const operateurText = operateur == 'Orange_money' ? 'Orange Money' :
                            operateur == 'MTN_money' ? 'MTN Money' :
                            operateur == 'Moov_money' ? 'Moov Money' : '';
                            console.log('operateurText : ',operateurText)
                            console.log('telPaiement : ',telPaiement)
                        form.querySelector('#Operat').textContent = operateurText;
                        form.querySelector('#TelPaie').textContent = telPaiement;
                        form.querySelector('#NRIB').textContent = '';
                        phoneInput.readOnly = true;
                    } else if (moyenPaiement == 'Virement_Bancaire') {
                        changePhoneButton.classList.remove('d-none');
                        changePhoneButtonForMobileMoney.classList.add('d-none');
                        form.querySelector('#NRIB').textContent = iban;
                        form.querySelector('#Operat').textContent = '';
                        form.querySelector('#TelPaie').textContent = '';
                        phoneInput.readOnly = false;


                    }

                } catch (error) {
                    console.error("Erreur lors de la mise à jour du résumé :", error);
                }
            }


        } else {
            console.warn("Formulaire introuvable : vérifie que sinistreForm existe dans la page.");
        }
        });
    </script>

    <script>
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
    </script>
@endsection
