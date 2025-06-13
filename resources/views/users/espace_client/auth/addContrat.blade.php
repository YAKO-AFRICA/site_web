@extends('users.espace_client.layouts.main')

@section('content')
<style>
    /* Conteneur des champs de saisie pour placer l'icône */
   /* Applique le style aux éléments en lecture seule */
   input[readonly], textarea[readonly], select[readonly] {
       background-color: #f0f0f0;  /* Couleur de fond gris pour les champs en readonly */
       border: 1px solid #ccc;     /* Bordure gris clair */
       /* cursor: not-allowed;        Curseur indiquant que l'action est interdite */
       cursor: no-drop;
       pointer-events: none;       /* Empêche toute interaction avec ces éléments */
   }
   
   /* Remplacer le curseur par l'emoji 🚫 lors du survol des champs readonly */
   input[readonly]:hover, textarea[readonly]:hover, select[readonly]:hover {
       cursor: no-drop;
       /* cursor: wait; */
   }
   </style>
    <!--start breadcrumb-->
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
                            <div class="col-lg-3 col-md-3 col-sm-12 mb-3">
                                <form id="contract-fo" method="post">
                                    @csrf
                                    <label class="mb-0">Sélectionner un contrat</label>
                                    <select name="idcontra" id="idcontrt" class="form-select">
                                        <option value="" selected>Sélectionner un contrat</option>
                                    </select>
                                </form>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 border rounded shadow mb-3">
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
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
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


    {{-- <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Launch static backdrop modal
    </button> --}}

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalContent1">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel1">Ajouter au moins un contrats pour finaliser la
                        création de votre compte</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <div id="form1">
                        <form action="{{ route('customer.register.addContrat') }}" method="post" class="submitForm">

                            @csrf
                            {{-- <div class="stepRegisterAddContrat" id="stepRegisterAddContrat"> --}}
                            <div class="row d-flex align-items-center justify-content-center">
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="idcontrat" class="form-label">ID du contrat</label>
                                    <input type="number" name="contrat" id="contrat" class="form-control py-3"
                                        placeholder="N° du contrat" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="datenaissance" class="form-label">Date de naissance</label>
                                    <input type="date" name="datenaissance" id="datenaissance"
                                        class="form-control py-3" required>
                                    <input type="hidden" name="messageDatenaissance" id="messageDatenaissance"
                                        value="La date de naissance saisie ne correspond pas à celle enregistrée dans le contrat."
                                        class="form-control py-3">
                                </div>
                                <small class="text-danger"> <strong>NB :</strong><br>
                                    - Si vous avez plusieurs contrats, ajoutez-en au moins un. Vous pourrez ajouter les
                                    autres une fois connecté à votre espace client.<br>
                                    - La date de naissance doit correspondre à celle indiquée sur le bulletin de
                                    souscription ou la police du contrat.

                                </small>
                                <p id="errorCounter" style="color: red; font-weight: bold;"></p>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route('customer.registerForm') }}" class="btn border-btn">Retour</a>

                                {{-- <button class="btn-prime next-btn" type="button"
                                    data-next="stepRegisterOtp">
                                    Suivant <i class='bx bx-right-arrow-alt'></i> --}}
                                <button type="submit"
                                    class="btn-prime btn-prime-two px-4 addContrat">Ajouter</button>
                                </button>
                            </div>
                            {{-- </div> --}}

                        </form>
                    </div>
                    <div class="d-none" id="form2">
                        <form action="{{ route('customer.register.demandeCompte') }}" method="post" class="submitForm">
                            @csrf
                            <div class="row d-flex align-items-center justify-content-center">
                                <small class="text-danger"> 
                                    Après plusieurs essais incorrects, nous vous invitons à télécharger votre pièce d'identité afin de valider votre identité et finaliser la création de votre compte.
                                </small>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="ID" class="form-label">ID du contrat</label>
                                    <input type="number" name="idcontrat" id="ID" class="form-control py-3"
                                        placeholder="N° du contrat"readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <label for="datenais" class="form-label">Date de naissance</label>
                                    <input type="date" name="datenais" id="datenais" class="form-control py-3"
                                        readonly>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="mb-0">Pièces d'identité</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <label class="form-label">Joindre votre CNI
                                                            <strong><small>(Recto)</small></strong> </label>
                                                    </div>
                                                    <div class="card-body">
                                                        <input id="CNIrecto-file-uploa" class="form-control"
                                                            type="file" name="libelle[]"
                                                            accept=".jpg, .png, image/jpeg, image/png" required>
                                                        <input type="hidden" name="type[]" value="CNIrecto">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <label class="form-label">Joindre le CNI
                                                            <strong><small>(Verso)</small></strong> </label>
                                                    </div>
                                                    <div class="card-body">
                                                        <input id="CNIverso-file-uploa" class="form-control"
                                                            type="file" name="libelle[]"
                                                            accept=".jpg, .png, image/jpeg, image/png" required>
                                                        <input type="hidden" name="type[]" value="CNIverso">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <a href="{{ route('customer.registerForm') }}" class="btn border-btn">Retour</a>
                                <button type="submit" class="btn-prime btn-prime-two px-4">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- <div class="stepRegisterAddContrat d-none" id="stepRegisterOtp">
                    <div class="row g-3 mb-3 text-center">
                        <span class="form-label">Un code de confirmation a été envoyé pas SMS, veuillez le
                            rentrer ci-dessous</span>
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div class="otp-container">
                                <input type="text" class="otp-input" name="otp_1" maxlength="1">
                                <input type="text" class="otp-input" name="otp_2" maxlength="1">
                                <input type="text" class="otp-input" name="otp_3" maxlength="1">
                                <input type="text" class="otp-input" name="otp_4" maxlength="1">
                                <input type="text" class="otp-input" name="otp_5" maxlength="1">
                                <input type="text" class="otp-input" name="otp_6" maxlength="1">
                            </div>
                        </div>
    
    
                        <div class="otp-timer" id="otp-timer">
                        </div>
                        <a href="javascript:void(0);" class="d-none resend-otp-link">Renvoyer l'OTP</a>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-prime btn-prime-two px-4">Ajouter</button>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Déclencher automatiquement le modal au chargement de la page
            var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {});
            myModal.show();
        });
    </script>

    <script>
        // document.addEventListener("DOMContentLoaded", function () {
        //     let errorCounter = 0;
        //     const messageDatenaissance = document.getElementById("messageDatenaissance").value;

        //     function showError(message) {
        //         const errorMessage = document.getElementById("errorCounter");
        //         errorCounter++;
        //         errorMessage.innerHTML = `⚠️ ${message} <br> (Nombre d'essais : ${errorCounter})`;
        //         if (errorCounter == 3) {
        //                 // errorMessage.innerHTML = `⚠️ Nombre de tentatives atteintes : ${errorCounter} <br> Veuillez patienter un instant...`;
        //                 // setTimeout(() => {
        //                 // fermer Modal staticBackdrop1;
        //                 const myModal = new bootstrap.Modal(document.getElementById('staticBackdrop1'), {});
        //                 myModal.hide();

        //                 // ouvrir Modal staticBackdrop2;
        //                 const myModal = new bootstrap.Modal(document.getElementById('staticBackdrop2'), {});
        //                 myModal.show();
        //             // }, 4000);

        //             }
        //     }
        //     if (messageDatenaissance == "La date de naissance saisie ne correspond pas à celle enregistrée dans le contrat.") {
        //         document.querySelector(".submitForm").addEventListener("submit", function (e) {
        //             e.preventDefault(); // Empêche le rechargement de la page
        //             showError(messageDatenaissance)


        //             // const form = this;
        //             // const formData = new FormData(form);

        //             // fetch(form.action, {
        //             //     method: "POST",
        //             //     body: formData,
        //             //     headers: {
        //             //         "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        //             //     }
        //             // })
        //             // .then(response => response.json())
        //         //     .then(data => {
        //         //         if (data.code === 400 && data.count_error) {
        //         //             showError(data.message);
        //         //         }else if (data.code === 200) {
        //         //             window.location.href = data.urlback; // Redirection en cas de succès
        //         //         }
        //         //     })
        //         //     .catch(error => console.error("Erreur :", error));
        //         });
        //     }
        // });

        document.addEventListener("DOMContentLoaded", function() {
            let errorCounter = 0;
            const messageDatenaissanceElement = document.getElementById("messageDatenaissance");
            const form1 = document.getElementById("form1");
            const form2 = document.getElementById("form2");
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
                errorMessage.innerHTML = `⚠️ Saisie incorrecte <br> (Nombre d'essais : ${errorCounter}/3)`;

                if (errorCounter === 3) {
                    form1.classList.add("d-none");
                    form2.classList.remove("d-none");
                } else {
                    form1.classList.remove("d-none");
                    form2.classList.add("d-none");
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


        // document.addEventListener("DOMContentLoaded", function () {
        //     let errorCounter = 0;

        //     function showErrorCount() {
        //         const errorMessage = document.getElementById("errorCounter");
        //         errorCounter++;
        //         errorMessage.innerHTML = `⚠️ Nombre de tentatives : ${errorCounter}`;
        //     }

        //     document.querySelector(".addContrat").addEventListener("click", function (e) {
        //         e.preventDefault(); // Empêche la soumission du formulaire
        //         showErrorCount(); // Incrémente et affiche le compteur
        //     });
        // });


        document.addEventListener("DOMContentLoaded", function () {
            // Sélection des champs du haut
            const contratInput = document.getElementById("contrat");
            const datenaissanceInput = document.getElementById("datenaissance");

            // Sélection des champs du bas
            const idContratInput = document.getElementById("ID");
            const dateNaisInput = document.getElementById("datenais");

            // Événement pour copier l'ID du contrat
            contratInput.addEventListener("input", function () {
                idContratInput.value = contratInput.value;
            });

            // Événement pour copier la date de naissance
            datenaissanceInput.addEventListener("input", function () {
                dateNaisInput.value = datenaissanceInput.value;
            });
        });

    </script>
@endsection
