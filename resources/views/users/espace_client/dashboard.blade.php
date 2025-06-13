@extends('users.espace_client.layouts.main')

@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:;">
                            <i class="bx bx-home-alt fs-5"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tableau de bord</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="" id="repeater">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-lg-7 col-md-7 col-sm-12 mb-3 mb-xs-3">
                        <h5 class="mb-0">Ajouter un autre contrat</h5>
                    </div>
                    <form action="{{ route('customer.dashboard.addContrat') }}" method="post"
                        class="col-lg-5 col-md-5 col-sm-12 submitForm">
                        @csrf
                        <div class="row d-flex align-items-center justify-content-center">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="contrat" class="form-label">ID du contrat</label>
                                <input type="number" name="contrat" id="contrat" class="form-control py-3"
                                    placeholder="ID du contrat" value="{{ old('contrat') }}" required autocomplete="on">
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="datenaissance" class="form-label">Date de naissance</label>
                                <input type="date" name="datenaissance" id="datenaissance" class="form-control py-3"
                                    placeholder="Date de naissance" value="{{ old('datenaissance') }}" required autocomplete="on">
                            </div>
                            <small class="text-danger"> <strong>NB :</strong>
                                La date de naissance doit correspondre à celle indiquée sur le bulletin de souscription ou
                                la police du contrat.
                            </small>
                            <p id="errorCounter" style="color: red; font-weight: bold;"></p>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <input type="submit" class="btn-prime repeater-add-btn text-center w-100"
                                    id="addContra" value="Ajouter">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Repeater Items -->
    <div class="items" data-group="test">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informations contrats</h5>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <form id="contract-form" method="post">
                                    @csrf
                                    <label class="mb-0">Sélectionner un contrat</label>
                                    <select name="idcontrat" id="idcontrat" class="form-select">
                                        @foreach (Auth::guard('customer')->user()->membre->membreContrat as $contrat)
                                            <option value="{{ $contrat->idcontrat }}">{{ $contrat->idcontrat }}</option>
                                        @endforeach
                                    </select>
                                    <div id="spinner" style="display: none; margin-top: 10px;">
                                        <div class="spinner-border" style="color: #076633;" role="status">
                                            <span class="visually-hidden">Chargement...</span>
                                        </div>
                                    </div>
                                </form>
                                {{-- <a href="{{ route('customer.printFichePrestation')}}" target="_blank" class="btn-prime mt-3">print</a> --}}
                                {{-- <input type="hidden" id="Capital" name="Capital" value="">                               --}}
                            </div>
                            <div class="col-sm-12 border rounded shadow mb-3">
                                <div class="card-header">
                                    <h5 class="mb-0 text-center">Détail du contrat</h5>
                                </div>
                                <div class="row py-3">
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <dl class="row">
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Adherent:</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="adherent"></dd>
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">ID du contrat:</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="idProposition"></dd>
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">N° Proposition:</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="CodeProposition"></dd>
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">N° Bulletin:</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="CodepropositionForm"></dd>
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Conseiller:</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="CodeConseiller"></dd>
                                        </dl>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb">
                                        <dl class="row">
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Produit:</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="produit"></dd>
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Prime:</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="totalPrime"></dd>
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Date d'effet:</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="DateEffetReel"></dd>
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Date de fin:</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="FinAdhesion"></dd>
                                            <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Statut:</dt>
                                            <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="status"></dd>
                                        </dl>
                                    </div>


                                </div>
                                <div class="row mt-0 border-top">
                                    <div class="col-sm-12 mb-3 d-flex justify-content-end">
                                        <form action="{{ route('customer.fetch.contract.Details')}}" method="post" class="submitForm">
                                            @csrf
                                            <input type="hidden" name="MonContrat" id="MonContrat">
                                            {{-- <input type="hidden" name="MonCodeProduit" id="MonCodeProduit"> --}}
                                            <input type="hidden" value="Prestation" name="type">
                                            <button type="submit" class="btn-prime mt-3" id="btn-demandePrest">Demander une prestation</button>
                                        </form>
                                        {{-- <a href="" target="_blank" class="btn-prime mt-3">Demander une prestation</a> --}}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="card radius-10">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <div class="widgets-icons bg-light-success text-success mx-auto mb-3"><i
                                                        class="bx bxs-wallet"></i>
                                                </div>
                                                <h5 class="my-1">Capital souscrit/Durée</h5>
                                                <p class="mb-0 text-secondary"><span id="CapitalSouscrit"></span>/<span
                                                        id="DureeCotisationAns"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="card radius-10">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <div
                                                    class="widgets-icons rounded-circle mx-auto bg-light-info text-info mb-3">
                                                    <i class='bx bx-dollar'></i>
                                                </div>
                                                <h5 class="my-1">Prime / Périodicité</h5>
                                                <p class="mb-0 text-secondary"><span id="TotalPrime"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="card radius-10">
                                        <div class="card-body">
                                            <div class="text-center">

                                                <div
                                                    class="widgets-icons rounded-circle mx-auto bg-light-warning text-warning mb-3">
                                                    <i class='fadeIn animated bx bx-check-circle'></i>
                                                </div>
                                                <h5 class="my-1">Nombre de cotisation</h5>
                                                <p class="mb-0 text-secondary" id="NbreEncaissment"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="card radius-10">
                                        <div class="card-body">
                                            <div class="text-center">

                                                <div
                                                    class="widgets-icons rounded-circle mx-auto bg-light-danger text-danger mb-3">
                                                    <i class='fadeIn animated bx bx-x-circle'></i>
                                                </div>
                                                <h5 class="my-1">Nombre d'impayés</h5>
                                                <p class="mb-0 text-secondary" id="NbreImpayes"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
            document.addEventListener("DOMContentLoaded", function() {
                let errorCounter = 0;
                const messageDatenaissanceElement = document.getElementById("messageDatenaissance");
                const contratInput = document.getElementById("contrat");
                const datenaissanceInput = document.getElementById("datenaissance");
                const errorMessage = document.getElementById(
                "errorCounter"); // Vérifier que cet élément existe dans le HTML

                if (!messageDatenaissanceElement || !errorMessage) {
                    console.error("Les éléments nécessaires ne sont pas présents dans le DOM.");
                    return;
                }

                const messageDatenaissance = messageDatenaissanceElement.value
            .trim(); // Utilisation de textContent au lieu de value

                function showError(message) {
                    errorCounter++;
                    errorMessage.innerHTML = `⚠️ ${message} <br> (Nombre d'essais : ${errorCounter})`;

                    if (errorCounter === 2) {
                        contratInput.disabled = true;
                        datenaissanceInput.disabled = true;
                        errorMessage.innerHTML = `⚠️ Vous avez atteint le nombre maximum d'essais ${errorCounter}. <br> Veuillez contacter YAKO AFRICA.`;
                    } else {
                        contratInput.disabled = false;
                        datenaissanceInput.disabled = false;
                        errorMessage.innerHTML = '';
                    }
                }

                if (messageDatenaissance ===
                    "La date de naissance saisie ne correspond pas à celle enregistrée dans le contrat.") {
                    const form = document.querySelector(".submitForm");
                        
                    if (form) {
                        form.addEventListener("submit", function(e) {
                            e.preventDefault(); // Empêche le rechargement de la page
                            showError(messageDatenaissance);
                        });
                    } else {
                        console.error("Le formulaire avec la classe .submitForm n'a pas été trouvé.");
                    }
                }
            });
    </script> --}}

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            let errorCounter = 0;
            const maxAttempts = 2;
            const messageDatenaissanceElement = document.getElementById("messageDatenaissance");
            const message = document.querySelector('input[name="messageDatenaissance"]');
            const contratInput = document.getElementById("contrat");
            const datenaissanceInput = document.getElementById("datenaissance");
            const errorMessage = document.getElementById("errorCounter");
            const form = document.querySelector(".submitForm");
    
            if (!messageDatenaissanceElement || !errorMessage || !form || !contratInput || !datenaissanceInput) {
                console.error("Les éléments nécessaires ne sont pas présents dans le DOM.");
                return;
            }
    
            const messageDatenaissance = messageDatenaissanceElement.value.trim();
    
            function showError(message) {
                errorCounter++;
                errorMessage.innerHTML = `⚠️ ${message} <br> (Nombre d'essais : ${errorCounter}/${maxAttempts})`;
    
                message.value = '';
                if (errorCounter >= maxAttempts) {
                    contratInput.disabled = true;
                    datenaissanceInput.disabled = true;
                    errorMessage.innerHTML = `⚠️ Vous avez atteint le nombre maximum d'essais (${maxAttempts}). <br> Veuillez contacter YAKO AFRICA.`;
                }
            }
    
            if (messageDatenaissance === "La date de naissance saisie ne correspond pas à celle enregistrée dans le contrat.") {
                form.addEventListener("submit", function (e) {
                    e.preventDefault();
                    showError(messageDatenaissance);
                    
                });
            }
        });
    </script> --}}

    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     let errorCount = {{ $errorCount }};
        //     let errorCountClick = 0;
        //     const errorCounterElement = document.getElementById('errorCounter');
        //     const addContratElement = document.getElementById('addContrat');

        //     addContratElement.addEventListener('click', function() {
        //         errorCountClick++;
        //         if (errorCountClick == 3) {
        //             if (errorCount == errorCountClick) {
        //             document.getElementById('contrat').disabled = true;
        //             document.getElementById('datenaissance').disabled = true;
        //             errorCounterElement.textContent =
        //                 "Les champs sont désactivés car vous avez atteint le nombre d'erreurs maximum.";
        //             } else {
        //                 errorCounterElement.textContent = "Vous avez encore " + (errorCountClick) + " essais.";
        //             }
        //         }

        //     });


        // });

        // document.addEventListener('DOMContentLoaded', function() {
        //     // Initialisation du compteur d'erreurs avec la valeur venant du backend
        //     let errorCount = {{ $errorCount }};
        //     let errorCountClick = 0; // Nombre d'essais côté frontend
        //     const errorCounterElement = document.getElementById('errorCounter');
        //     const addContratElement = document.getElementById('addContrat');
        //     const contratElement = document.getElementById('contrat');
        //     const datenaissanceElement = document.getElementById('datenaissance');

        //     // Mettre à jour le message d'erreur
        //     function updateErrorMessage() {
        //         if (errorCountClick >= 3) {
        //             // Désactiver les champs lorsque l'utilisateur atteint le nombre maximum d'erreurs
        //             contratElement.disabled = true;
        //             datenaissanceElement.disabled = true;
        //             errorCounterElement.textContent =
        //                 "Les champs sont désactivés car vous avez atteint le nombre d'erreurs maximum.";
        //         } else {
        //             // Afficher combien d'essais restants
        //             errorCounterElement.textContent = "Il vous reste " + (3 - errorCountClick) + " essais.";
        //         }
        //     }

        //     // Lorsque l'utilisateur clique sur le bouton "Ajouter", vérifier les erreurs
        //     addContratElement.addEventListener('click', function() {
        //         errorCountClick++;
        //         if (errorCountClick <= 3) {
        //             updateErrorMessage();
        //         }

        //         // Si le nombre d'erreurs atteint 3, désactiver les champs
        //         if (errorCountClick >= 3) {
        //             contratElement.disabled = true;
        //             datenaissanceElement.disabled = true;
        //             errorCounterElement.textContent =
        //                 "Les champs sont désactivés car vous avez atteint le nombre d'erreurs maximum.";
        //         }
        //     });

        //     // Si erreur côté backend (via session), mettre à jour le compteur
        //     if (errorCount >= 3) {
        //         contratElement.disabled = true;
        //         datenaissanceElement.disabled = true;
        //         errorCounterElement.textContent =
        //             "Les champs sont désactivés car vous avez atteint le nombre d'erreurs maximum.";
        //     }
        // });

        // document.addEventListener('DOMContentLoaded', function() {
        //     let errorCount = {{ $errorCount }};
        //     let errorCountClick = 1;
        //     const errorCounterElement = document.getElementById('errorCounter');
        //     const addContratElement = document.getElementById('addContrat');

        //     addContratElement.addEventListener('click', function() {
        //         errorCountClick++;
        //         if (errorCountClick == 4) {
        //             errorCountClick = 0;
        //             if (errorCount == errorCountClick) {
        //                 document.getElementById('contrat').disabled = true;
        //                 document.getElementById('datenaissance').disabled = true;
        //                 errorCounterElement.textContent =
        //                     "Les champs sont désactivés car vous avez atteint le nombre d'erreurs maximum.";
        //             } else {
        //                 // errorCounterElement.textContent = "Vous avez encore " + (3 -
        //                 //     errorCountClick) + " essais.";
        //                 errorCounterElement.textContent = "Vous avez encore " + (errorCount) + " "+ (errorCountClick) +" essais.";
        //             }
        //         }
        //     });
        // });
        // document.addEventListener('DOMContentLoaded', function() {
        //     let errorCount = 0; // Récupère le compteur d'erreurs PHP
        //     // let errorCount = {{ $errorCount }}; // Récupère le compteur d'erreurs PHP
        //     let errorCountClick = sessionStorage.getItem('errorCountClick') ? parseInt(sessionStorage.getItem(
        //         'errorCountClick')) : 0;
        //     const errorCounterElement = document.getElementById('errorCounter');
        //     const addContratElement = document.getElementById('addContrat');

        //     addContratElement.addEventListener('click', function() {
        //         errorCountClick++;
        //         sessionStorage.setItem('errorCountClick', errorCountClick); // Stocke la valeur en session

        //         if (errorCountClick == 3) {
        //             errorCountClick = 0;
        //             sessionStorage.setItem('errorCountClick', errorCountClick);

        //             if (errorCount == errorCountClick) {
        //                 document.getElementById('contrat').disabled = true;
        //                 document.getElementById('datenaissance').disabled = true;
        //                 errorCounterElement.textContent =
        //                     "Les champs sont désactivés car vous avez atteint le nombre d'erreurs maximum.";
        //             } else {
        //                 errorCounterElement.textContent = "Vous avez encore " + errorCount + " " +
        //                     errorCountClick + " essais restants.";
        //             }
        //         }
        //     });
        // });
    </script>
@endsection
