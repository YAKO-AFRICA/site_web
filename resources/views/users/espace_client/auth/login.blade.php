<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/img/images/favicon_yako.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('cust_assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="cust_assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('cust_assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    {{-- <!-- loader-->
	<link href="cust_assets/css/pace.min.css" rel="stylesheet" />
	<script src="cust_assets/js/pace.min.js"></script> --}}
    <!-- Bootstrap CSS -->
    <link href="{{ asset('cust_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('cust_assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('cust_assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('cust_assets/css/icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>Customer Login || Yako Africa Assurances Vie</title>

    <style>
        /* Conteneur des champs de saisie pour placer l'icône */
        /* Applique le style aux éléments en lecture seule */
        input[readonly],
        textarea[readonly],
        select[readonly] {
            background-color: #f0f0f0;
            /* Couleur de fond gris pour les champs en readonly */
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

</head>

<body class="">
    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="{{ asset('assets/img/logo/Logo_yako.png') }}" alt="Preloader"></div>
            </div>
        </div>
    </div>
    @include('users.espace_client.auth.reset-passFirstLog')
    @include('users.espace_client.auth.reset-passSendMail')
    @include('users.espace_client.auth.updateCompte')
    <!--wrapper-->
    <div class="wrapper" style="height: 80vh">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">

                    <div
                        class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body">
                                <img src="{{ asset('cust_assets/images/login-images/login-cover.jpg') }}"
                                    class="img-fluid" width="100%" alt="" />
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5 rounded">
                                <div class="">
                                    <div class="mb-3 text-center">
                                        <img src="{{ asset('cust_assets/images/logo-icon.png') }}" width="150"
                                            alt="">
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5 class="">Espace Client</h5>
                                        <p class="mb-0">Veuillez vous connecter à votre compte <strong>YNOV</strong>
                                        </p>
                                    </div>
                                    <div class="form-body">
                                        <form id="customerForm" action="{{ route('customer.login') }}" method="POST">

                                            @if (Session::get('fail'))

                                                <div class="alert alert-danger alert-dismissible fade show"

                                                    role="alert">

                                                    {{ Session::get('fail') }}

                                                </div>

                                            @endif

                                            @if (Session::get('success'))

                                                <div class="alert alert-success alert-dismissible fade show"

                                                    role="alert">

                                                    {{ Session::get('success') }}

                                                </div>

                                            @endif

                                            @csrf

                                            <div class="row g-3">

                                                <div class="col-12">

                                                    <label for="login" class="form-label">Login</label>

                                                    <input type="text" class="form-control" id="login"

                                                        name="login" placeholder="Veuillez entrer votre login"

                                                        autocomplete="off">

                                                        <small class="text-info">NB: Login, Il s'agit du numéro de téléphone renseigné lors de la création ou de la mise à jour de votre compte</small>

                                                    @error('login')

                                                        <span class="text-danger">Veuillez entrer votre nom

                                                            d'utilisateur</span>

                                                    @enderror

                                                    <p class="text-danger" style="font-weight: bold; font-style:italic;"

                                                        id="message"></p>

                                                </div>

                                                <div class="col-12" id="inputChoosePasswordDiv">

                                                    <label for="inputChoosePassword" class="form-label">Mot de

                                                        passe</label>

                                                    <div class="input-group" id="show_hide_password">

                                                        <input type="password" class="form-control border-end-0"

                                                            id="inputChoosePassword" name="password" disabled>

                                                        <a href="javascript:;"

                                                            class="input-group-text bg-transparent"><i

                                                                class="bx bx-hide"></i></a>



                                                        <input type="text" id="rien" name="type"

                                                            value="Rien" hidden>

                                                    </div>

                                                    @error('password')

                                                        <span class="text-danger">Veuillez entrer votre mot de passe</span>

                                                    @enderror

                                                </div>

                                                <div class="col-md-12 mb-3 text-end" id="forgetPasswordDiv">

                                                    <a href="javascript:;" class="text-end" data-bs-toggle="modal"

                                                        data-bs-target="#resetSendMailModal">

                                                        Mot de passe oublié ?

                                                    </a>

                                                    {{-- <a href="authentication-forgot-password.html" class="">Mot de passe oublié ?</a> --}}

                                                </div>



                                            </div>



                                            {{-- si Aucune des options ci-dessous, desactiver le champ password  --}}

                                            <div class="row mb-3" id="submitBtu">

                                                <div class="col-md-12  text-center">

                                                    <button class="btn-prime btn-prime-two d-block w-100">Se

                                                        connecter</button>

                                                </div>

                                            </div>

                                            <div class="col-md-12 mb-5 text-start">

                                                Pas de compte ? <a href="{{ route('customer.registerForm') }}"

                                                    class="">Créer votre compte</a>

                                            </div>



                                            <div id="options" class="text-center my-3">

                                                <a href="{{ route('customer.registerForm') }}" id="btn-inscrire"

                                                    class="btn-prime btn-prime-two d-block d-none">Créer mon compte

                                                    YNOV</a>

                                                <a href="javascript:;" id="btn-modifier"

                                                    class="btn-prime btn-prime-two d-block d-none"

                                                    data-bs-toggle="modal"

                                                    data-bs-target="#ModifierModal">Modifier</a>

                                                <a href="javascript:;" id="btn-mettre-a-jour"

                                                    class="btn-prime btn-prime-two d-block d-none"

                                                    data-bs-toggle="modal" data-bs-target="#updatModal">Mettre à

                                                    jour</a>

                                            </div>



                                            {{-- ce bouton doit etre toujour visible --}}

                                            <div class="col-md-12 mt-3 text-center">

                                                <a href="{{ route('index') }}" class="btn-prime d-block">Retour au

                                                    site</a>

                                            </div>

                                        </form>
                                        <br><br>

                                        {{-- formulaire pour charger un fichier excel pour alimenter ma table customer  --}}
                                        {{-- <form action="{{ route('customer.import')}}" method="post" enctype="multipart/form-data">
											@csrf
											<input type="file" class="form-control" name="file" id="">

											<div class="row mt-3">
                                                <div class="col-md-12  text-center">
													<button class="btn-prime btn-prime-two d-block w-100">Valider</button>
                                                </div>
                                            </div>
										</form> --}}

                                        {{-- <div class="table-responsive" style="margin: 20px 0; height: 200px; overflow-y: scroll;">
                                            @if(session('import_results.details'))
                                                <div class="mt-3">
                                                    <h5>Détails de l'import :</h5>
                                                    <ul>
                                                        @foreach(session('import_results.details') as $type => $messages)
                                                            @if(is_array($messages) && !empty($messages))
                                                                <li><strong>{{ ucfirst($type) }}:</strong>
                                                                    <ul>
                                                                        @foreach($messages as $msg)
                                                                            <li>{{ $msg }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>

                                        <form action="{{ route('customer.import.cp') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" class="form-control" name="file[]" id=""
                                                multiple required>

                                            <div class="row mt-3">
                                                <div class="col-md-12  text-center">
                                                    <button
                                                        class="btn-prime btn-prime-two d-block w-100">importer</button>
                                                </div>
                                            </div>
                                        </form> --}}


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" defer></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            let isJobRunning = false;

            function executeCronJob() {
                if (!isJobRunning) {
                    isJobRunning = true;
                    axios.post("{{ route('customer.destroyToken') }}", {}, {
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}" // Ajout du token CSRF pour éviter les erreurs 419
                            }
                        })
                        .then(response => {
                            console.log("Token détruit :", response.data.message);
                            // Si besoin, on peut recharger la page après la suppression du token
                            // window.location.reload();
                        })
                        .catch(error => {
                            console.error("Erreur lors de l'exécution du cron :", error);
                        })
                        .finally(() => {
                            isJobRunning = false;
                        });
                } else {
                    console.log("La tâche cron est déjà en cours.");
                }
            }

            // Exécuter toutes les 60 secondes (1 minute)
            setInterval(executeCronJob, 60000);
        });
    </script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            let isJobRunning = false;
    
            function executeCronJob() {
                if (!isJobRunning) {
                    isJobRunning = true;
                    axios.post("{{ route('customer.auto.import.cp') }}", {}, {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        })
                        .then(response => {
                            console.log(' ');
                            console.log(response.data.message);
                            
                        })
                        .catch(error => {
                            console.error("Erreur lors de l'exécution du cron :", error);
                        })
                        .finally(() => {
                            isJobRunning = false;
                        });
                } else {
                    console.log("La tâche cron est déjà en cours.");
                }
            }
    
            // Exécuter toutes les 60 secondes (1 minute)
            setInterval(executeCronJob, 60000);
        });
    </script>



    <script src="{{ asset('cust_assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('cust_assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets_admin/js/script.js') }}"></script>
    <script src="cust_assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('cust_assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('cust_assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <!--Password show & hide js -->


    <script>
        document.getElementById('login').addEventListener('change', function() {
            let login = this.value;

            if (login) {
                fetch("{{ route('customer.getcustomer') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            login
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Réinitialiser les options
                        document.getElementById('inputChoosePassword').disabled = true;
                        document.getElementById('btn-inscrire').classList.add('d-none');
                        document.getElementById('btn-modifier').classList.add('d-none');
                        document.getElementById('btn-mettre-a-jour').classList.add('d-none');
                        // alert(data.prospere);
                        // alert(data.customer);

                        if (data.status === 'found') {
                            let customer = data.customer;
                            let prospere = data.prospere;
                            if (customer) {

                                // Client trouvé
                                if (customer.isFirstLog == 0 && customer.estajour == 1) {
                                    document.getElementById('btn-modifier').classList.remove('d-none');
                                    document.getElementById('btn-mettre-a-jour').classList.add('d-none');
                                    document.getElementById('inputChoosePassword').classList.add('d-none');
                                    document.getElementById('inputChoosePasswordDiv').classList.add('d-none');
                                    document.getElementById('forgetPasswordDiv').classList.add('d-none');
                                    document.getElementById('submitBtu').classList.add('d-none');
                                    document.getElementById('message').textContent =
                                        "En application à notre politique de sécurité, nous vous demandons de bien vouloir procéder à la modification de votre mot de passe."; // Message ajouté

                                } else if (customer.estajour == 0) {
                                    document.getElementById('btn-modifier').classList.add('d-none');
                                    document.getElementById('btn-mettre-a-jour').classList.remove('d-none');
                                    document.getElementById('inputChoosePassword').classList.add('d-none');
                                    document.getElementById('inputChoosePasswordDiv').classList.add('d-none');
                                    document.getElementById('forgetPasswordDiv').classList.add('d-none');
                                    document.getElementById('submitBtu').classList.add('d-none');
                                    document.getElementById('Nom').value = customer.membre.nom;
                                    document.getElementById('Prenom').value = customer.membre.prenom;
                                    document.getElementById('EmailAddress').value = customer.membre.email;
                                    document.getElementById('cel').value = customer.membre.cel;
                                    document.getElementById('tel').value = customer.membre.tel;
                                    document.getElementById('datenaissance').value = customer.membre
                                        .datenaissance.slice(0, 10);
                                    // =========================
                                    // Adresse
                                    // =========================
                                    document.getElementById('lieuresidence').value =
                                        customer.membre?.lieuresidence ?? '';

                                    // =========================
                                    // Lieu de naissance
                                    // =========================
                                    document.getElementById('lieunaissance').value =
                                        customer.membre?.lieunaissance ?? '';

                                    // =========================
                                    // Genre / Sexe
                                    // =========================
                                    const sexe = customer.membre?.sexe ?? '';

                                    if (sexe === 'M' || sexe === 'F') {
                                        const radioSexe = document.querySelector(
                                            `input[name="sexe"][value="${sexe}"]`
                                        );

                                        if (radioSexe) {
                                            radioSexe.checked = true;
                                        }
                                    }
                                    
                                    document.getElementById('message').textContent =
                                        "En application à notre politique de sécurité, nous vous demandons de bien vouloir procéder à la mise à jour votre compte Ynov."; // Message ajouté
                                    // document.getElementById('message').textContent =
                                    //     "Votre compte n'est pas à jour, veuillez faire la mise à jour du compte."; // Message ajouté

                                } else if (customer.isFirstLog == 1 && customer.estajour == 1) {
                                    document.getElementById('btn-modifier').classList.add('d-none');
                                    document.getElementById('btn-mettre-a-jour').classList.add('d-none');
                                    document.getElementById('inputChoosePassword').disabled = false;
                                    document.getElementById('inputChoosePassword').classList.remove('d-none');
                                    document.getElementById('inputChoosePasswordDiv').classList.remove(
                                        'd-none');
                                    document.getElementById('forgetPasswordDiv').classList.remove('d-none');
                                    document.getElementById('submitBtu').classList.remove('d-none');
                                    document.getElementById('message').textContent =
                                        ""; // Réinitialiser le message s'il n'y a rien à signaler

                                }
                            } else {
                                // Client non trouvé
                                if (prospere.estClient == 0) {
                                    document.getElementById('btn-modifier').classList.add('d-none');
                                    document.getElementById('btn-mettre-a-jour').classList.add('d-none');
                                    document.getElementById('inputChoosePassword').disabled = false;
                                    document.getElementById('inputChoosePassword').classList.remove('d-none');
                                    document.getElementById('inputChoosePasswordDiv').classList.remove(
                                        'd-none');
                                    document.getElementById('forgetPasswordDiv').classList.remove('d-none');
                                    document.getElementById('submitBtu').classList.remove('d-none');
                                    document.getElementById('message').textContent =
                                        ""; // Réinitialiser le message s'il n'y a rien à signaler

                                }
                            }
                        } else {
                            // Client non trouvé
                            document.getElementById('btn-modifier').classList.add('d-none');
                            document.getElementById('btn-mettre-a-jour').classList.add('d-none');
                            document.getElementById('inputChoosePassword').classList.add('d-none');
                            document.getElementById('inputChoosePasswordDiv').classList.add('d-none');
                            document.getElementById('forgetPasswordDiv').classList.add('d-none');
                            document.getElementById('submitBtu').classList.add('d-none');
                            document.getElementById('btn-inscrire').classList.remove('d-none');
                            document.getElementById('message').textContent =
                                "Vous n’avez pas encore de compte Ynov ? Créez votre compte en quelques clics et profitez de tous nos avantages !"; // Message ajouté
                        }

                    })
                    .catch(error => console.error('Erreur:', error));
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formulaire = document.querySelector('#registerFormulaire');
            const resetFirstLogForm = document.querySelector('#resetFirstLogForm');
            const passwordInput = resetFirstLogForm.querySelector('input[name="password"]');
            const msgError = $('#resetFirstLogMsgerror');
            passwordInput.addEventListener('input', validatePassword);

            function validatePassword() {
                msgError.text("").hide();
                const password = passwordInput.value;

                if (password.length < 6) {
                    msgError.text("Le mot de passe doit contenir au moins 6 caractères.").show();
                } else {
                    msgError.text("").hide();
                }
            }
            if (!formulaire) {
                console.error("Le formulaire avec l'ID 'registerFormulaire' est introuvable.");
                return;
            }

            // Fonction pour formater le login
            function formatUsername(nom, prenom) {
                // Nettoyage des caractères spéciaux et mise en minuscule
                nom = nom.normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/[^a-zA-Z]/g, "").toLowerCase();
                let premierPrenom = prenom.split(' ')[0].normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(
                    /[^a-zA-Z]/g, "").toLowerCase();
                return nom + '.' + premierPrenom;
            }

            // Fonction pour mettre à jour le résumé utilisateur
            function mettreAJourResume() {
                try {
                    const nom = formulaire.querySelector('[name="nom"]')?.value || '';
                    const prenom = formulaire.querySelector('[name="prenom"]')?.value || '';
                    const cel = formulaire.querySelector('[name="cel"]')?.value || '';
                    const email = formulaire.querySelector('[name="email"]')?.value || '';
                    const tel = formulaire.querySelector('[name="tel"]')?.value || '';
                    const datenaissance = formulaire.querySelector('[name="datenaissance"]')?.value || '';
                    const lieuresidence = formulaire.querySelector('[name="lieuresidence"]')?.value || '';
                    const lieunaissance = formulaire.querySelector('[name="lieunaissance"]')?.value || '';

                    // Mise à jour du login automatiquement
                    const loginField = formulaire.querySelector('[name="login"]');
                    // if (nom && prenom) {
                    //     loginField.value = formatUsername(nom, prenom);
                    // }
                    loginField.value = cel;
                    // loginField.value = email;

                    // Mise à jour de l'affichage
                    document.getElementById('nomClient').textContent = nom;
                    document.getElementById('prenomClient').textContent = prenom;
                    document.getElementById('celClient').textContent = cel;
                    document.getElementById('telClient').textContent = tel;
                    document.getElementById('emailClient').textContent = email;
                    document.getElementById('lieuresidenceClient').textContent = lieuresidence;
                    document.getElementById('lieunaissanceClient').textContent = lieunaissance;
                    document.getElementById('datenaissanceClient').textContent = datenaissance;
                    document.getElementById('loginClient').textContent = loginField.value;
                } catch (error) {
                    console.error("Erreur lors de la mise à jour du résumé :", error);
                }
            }

            // Écouteurs d'événements pour mettre à jour dynamiquement le résumé
            formulaire.addEventListener('input', mettreAJourResume);
            formulaire.addEventListener('change', mettreAJourResume);

            // Initialisation au chargement
            mettreAJourResume();
        });
    </script>

    <script src="{{ asset('cust_assets/js/script.js') }}"></script>


    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="{{ asset('cust_assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
