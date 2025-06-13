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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('cust_assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('cust_assets/css/icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>Customer Register || Yako Africa Assurances Vie</title>

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

</head>

<body class="">
    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="{{ asset('assets/img/logo/Logo_yako.png') }}" alt="Preloader"></div>
            </div>
        </div>
    </div>

    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">

                    {{-- <div
                        class="col-12 col-xl-6 col-xxl-7 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body">
                                <img src="{{ asset('cust_assets/images/login-images/register-cover.svg') }}"
                                    class="img-fluid auth-img-cover-login" width="550" alt="" />
                            </div>
                        </div>

                    </div> --}}
                    <div
                        class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex" height="65vh">

                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body">
                                <img src="{{ asset('cust_assets/images/login-images/login-cover.jpg') }}"
                                    class="img-fluid" width="85%" height="100%" alt="" />
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5 rounded">
                                <div class="">
                                    <div class="mb-3 text-center">
                                        <img src="{{ asset('cust_assets/images/logo-icon.png') }}" width="150"
                                            alt="" />
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5 class="">Espace Client</h5>
                                        <p class="mb-0">Veuillez remplir les détails ci-dessous pour créer votre
                                            compte</p>
                                            <small class="text-danger"><i style="font-weight: bold;"> (*) Champs obligatoires</i></small>
                                    </div>
                                    <div class="form-body">
                                        <form id="registerFormulaire" action="{{ route('customer.register')}}" method="POST" class="submitForm">
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
                                            <div class="stepRegister" id="stepRegister1">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label for="Nom" class="form-label">Nom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="Nom"
                                                            placeholder="Entrez votre nom" name="nom" required>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="Prenom" class="form-label">Prenom <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="Prenom"
                                                            placeholder="Entrez votre prenom" name="prenom" required>
                                                    </div>
                                                    {{-- <div class="col-12">
                                                        <label for="prepend-text-single-field" class="form-label">Lieu de residence<span class="text-danger">*</span></label>
                                                        <select class="form-select" name="lieuresidence" id="prepend-text-single-field" data-placeholder="Veuillez sélectionner votre lieu d'habitation" required>
                                                            <option></option>
                                                            @foreach ($villes as $ville)
                                                                <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div> --}}
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-6 d-flex justify-content-start">
                                                        {{-- <button class="btn2 border-btn2 px-4" id="next-stepper1" type="button"><i
                                                                class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour </button> --}}
                                                    </div>
                                                    <div class="col-6 d-flex justify-content-end">
                                                        <button class="btn-prime next-btn p-3" type="button"
                                                            data-next="stepRegister2">
                                                            Continuer <i class='bx bx-right-arrow-alt fs-4'></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stepRegister d-none" id="stepRegister2">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label for="EmailAddress" class="form-label">Adresse email<span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" id="EmailAddress"
                                                            placeholder="example@user.com" name="email" required>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="cel" class="form-label">Téléphone<span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" id="cel"
                                                            placeholder="Entrez votre numero de telephone" name="cel" required>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-6 d-flex justify-content-start">
                                                        <button class="btn2 border-btn2 p-3 prev-btn"
                                                            data-prev="stepRegister1" type="button"><i
                                                                class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour
                                                        </button>
                                                    </div>
                                                    <div class="col-6 d-flex justify-content-end">
                                                        <button class="btn-prime next-btn p-3" type="button"
                                                            data-next="stepRegister3">
                                                            Continuer <i class='bx bx-right-arrow-alt fs-4'></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stepRegister d-none" id="stepRegister3">
                                                <label for="username" class="form-label">Nom d'utilisateur (Login)</label>
                                                <input type="text" class="form-control mb-3" id="username" name="login" readonly>

                                                <label for="inputChoosePasswor" class="form-label">Mot de
                                                    passe <span class="text-danger">*</span></label>
                                                <div class="input-group mb-3" id="show_hide_password">
                                                    <input type="password" min="6" name="password"
                                                        class="form-control" id="inputChoosePassword"
                                                        placeholder="Entrer nouveau nouveau mot de passe" required/>
                                                    <a href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                     
                                                </div>
                                                <span class="text-danger" id="msgerror"></span><br>

                                                <label for="inputChoosePasswor" class="form-label">Confirmer
                                                    le mot de passe <span class="text-danger">*</span></label>
                                                <div class="input-group mb-3" id="show_hide_password">
                                                    <input type="password" name="confirmPassword"
                                                        class="form-control" id="inputChoosePasswor"
                                                        placeholder="cofirmer le nouveau mot de passe"
                                                        required />
                                                    <a href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>

                                                </div>
                                                <small class="text-danger"><strong>NB :</strong> Conserver bien votre <strong>nom d'utilisateur</strong> et votre <strong>mot de passe</strong> pour pouvoir vous connecter plus tard à compte</small>
                                                <div class="row mt-3">
                                                    <div class="col-6 d-flex justify-content-start">
                                                        <button class="btn2 border-btn2 p-3 prev-btn"
                                                            data-prev="stepRegister2" type="button"><i
                                                                class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour
                                                        </button>
                                                    </div>
                                                    <div class="col-6 d-flex justify-content-end">
                                                        <button class="btn-prime next-btn p-3" type="button"
                                                            data-next="stepRegister4">
                                                            Continuer <i class='bx bx-right-arrow-alt fs-4'></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stepRegister d-none" id="stepRegister4">

                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header text-center">
                                                            <h5 class="mb-0">Resumer de vos saisies</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="my-3 d-flex align-items-center justify-content-center">
                                                                <dl class="row m-auto" style="width: 90%;">
                                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Nom :</dt>
                                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="nomClient"></dd>
                                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Prénom :</dt>
                                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="prenomClient"></dd>
                                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Teléphone :</dt>
                                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="celClient"></dd>
                                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Email :</dt>
                                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="emailClient"></dd>
                                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Nom d'utilisateur :</dt>
                                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7 " id="loginClient"></dd>
                                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Mot de passe :</dt>
                                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="passwordClient">******</dd>
                                                                </dl>
                                                            </div>
                                                            <div class="form-check form-switch col-12 mb-2">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="flexSwitchCheckChecked" required>
                                                                <label class="form-check-label"
                                                                    for="flexSwitchCheckChecked">J'ai lu et j'accepte les
                                                                    <a href="{{ asset('cust_assets/images/termes/conditions-enov.pdf') }}"
                                                                        target="_blank" class=""><u>conditions générales de YNOV</u></a></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-6 d-flex justify-content-start">
                                                        <button class="btn2 border-btn2 py-3 prev-btn"
                                                            data-prev="stepRegister3" type="button"><i
                                                                class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour
                                                        </button>
                                                    </div>
                                                    <div class="col-6 d-flex justify-content-end">
                                                        <button
                                                            class="btn-prime btn-prime-two py-3">S'inscrire</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-5 text-center">
                                                Déja un compte ? <a href="{{ route('customer.loginForm') }}"
                                                    class="">Connectez-vous</a>
                                            </div>
                                        </form>
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
    <script src="{{ asset('cust_assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('cust_assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets_admin/js/script.js') }}"></script>
    <script src="cust_assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('cust_assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('cust_assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('cust_assets/plugins/select2/js/select2-custom.js') }}"></script>
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

                        if (data.status === 'found') {
                            // Client trouvé
                            if (data.customer.isFirstLog == 0 && data.customer.estajour == 1) {
                                document.getElementById('btn-modifier').classList.remove('d-none');
                                document.getElementById('btn-mettre-a-jour').classList.add('d-none');
                                document.getElementById('inputChoosePassword').classList.add('d-none');
                                document.getElementById('inputChoosePasswordDiv').classList.add('d-none');
                                document.getElementById('forgetPasswordDiv').classList.add('d-none');
                                document.getElementById('submitBtu').classList.add('d-none');
                                document.getElementById('message').textContent =
                                    "Pour plus de securité espace client, nous vous demandons de bien vouloir motifier votre mot de passe."; // Message ajouté

                            } else if (data.customer.estajour == 0) {
                                document.getElementById('btn-modifier').classList.add('d-none');
                                document.getElementById('btn-mettre-a-jour').classList.remove('d-none');
                                document.getElementById('inputChoosePassword').classList.add('d-none');
                                document.getElementById('inputChoosePasswordDiv').classList.add('d-none');
                                document.getElementById('forgetPasswordDiv').classList.add('d-none');
                                document.getElementById('submitBtu').classList.add('d-none');
                                document.getElementById('message').textContent =
                                    "Votre compte n'est pas à jour, veuillez faire la mise à jour du compte."; // Message ajouté

                            } else if (data.customer.isFirstLog == 1 && data.customer.estajour == 1) {
                                document.getElementById('btn-modifier').classList.add('d-none');
                                document.getElementById('btn-mettre-a-jour').classList.add('d-none');
                                document.getElementById('inputChoosePassword').disabled = false;
                                document.getElementById('inputChoosePassword').classList.remove('d-none');
                                document.getElementById('inputChoosePasswordDiv').classList.remove('d-none');
                                document.getElementById('forgetPasswordDiv').classList.remove('d-none');
                                document.getElementById('submitBtu').classList.remove('d-none');
                                document.getElementById('message').textContent =
                                    ""; // Réinitialiser le message s'il n'y a rien à signaler
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
                                "Vous n'avez pas encore de compte Ynov, veuillez une une de creation de compte."; // Message ajouté
                        }

                    })
                    .catch(error => console.error('Erreur:', error));
            }
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const formulaire = document.querySelector('#registerFormulaire');
        const passwordInput = formulaire.querySelector('input[name="password"]');
        const msgError = $('#msgerror');
        passwordInput.addEventListener('input', validatePassword);
    
        function validatePassword() {
            msgError.text("").hide();
            const password = passwordInput.value;
    
            if (password.length < 6 ) {
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
            let premierPrenom = prenom.split(' ')[0].normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/[^a-zA-Z]/g, "").toLowerCase();
            return nom + '.' + premierPrenom;
        }
    
        // Fonction pour mettre à jour le résumé utilisateur
        function mettreAJourResume() {
            try {
                const nom = formulaire.querySelector('[name="nom"]')?.value || '';
                const prenom = formulaire.querySelector('[name="prenom"]')?.value || '';
                const cel = formulaire.querySelector('[name="cel"]')?.value || '';
                const email = formulaire.querySelector('[name="email"]')?.value || '';
    
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
                document.getElementById('emailClient').textContent = email;
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
