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

        @media (min-width: 992px) {

            /* lg breakpoint */
            .w-lg-20 {
                max-width: 20%;
            }

            .w-lg-15 {
                max-width: 25% !important;
            }
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
                        {{ $typePrestation->libelle ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div id="stepper1" class="bs-stepper">
        <div class="card">

            <div class="card-header">
                <div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
                    <div class="step" data-target="#test-l-1">
                        <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                            <div class="bs-stepper-circle">1</div>
                            <div class="">
                                <h5 class="mb-0 steper-title">Information personnelle</h5>
                                <p class="mb-0 steper-sub-title">Entrez vos coordonnées</p>
                            </div>
                        </div>
                    </div>
                    <div class="bs-stepper-line"></div>
                    <div class="step" data-target="#test-l-2">
                        <div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                            <div class="bs-stepper-circle">2</div>
                            <div class="">
                                <h5 class="mb-0 steper-title">Information sur prestation</h5>
                                <p class="mb-0 steper-sub-title">Informations liée à la prestation</p>
                            </div>
                        </div>
                    </div>
                    <div class="bs-stepper-line"></div>
                    <div class="step" data-target="#test-l-3">
                        <div class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                            <div class="bs-stepper-circle">3</div>
                            <div class="">
                                <h5 class="mb-0 steper-title">Finalisation de la demande</h5>
                                <p class="mb-0 steper-sub-title">Finaliser votre demande</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @include('users.espace_client.services.prestations.modals.infosMontantModal')
            <div class="card-body">

                <div class="bs-stepper-content">
                    {{-- <form action="{{ route('customer.prestation.store') }}" id="monFormulaire" method="POST"
                        enctype="multipart/form-data" class="submitForm"> --}}
                        <form id="monFormulaire" method="POST" enctype="multipart/form-data"
                        class="submitForm">
                        @csrf
                        @include('users.espace_client.components.prestations.infosPerso')
                        <input type="hidden" id="tokGenerate" name="tokGenerate" value="{{ $tok }}">
                        @include('users.espace_client.components.prestations.infosPrest')

                        @php
                            $keyUuid = $token['key_uuid'];
                            $operationType = $token['operation_type'];
                        @endphp
                        @include('users.espace_client.components.prestations.resumer')
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--end stepper one-->

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Leaflet Geocoding Plugin -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("monFormulaire");
            const btn = document.getElementById("submit-btnPrest");

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

                axios.post('{{ route('customer.prestation.store') }}', formData)
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

    <script>
        // Activer la géolocalisation de l'utilisateur uniquement si le site est sécurisé (HTTPS)
        if (location.protocol === 'https:') {
            map.locate({
                setView: true,
                maxZoom: 16
            });

            function onLocationFound(e) {
                var radius = e.accuracy / 2;

                L.marker(e.latlng).addTo(map)
                // .bindPopup("Vous êtes ici").openPopup();
                // .bindPopup("Vous êtes ici, à " + radius + " mètres près.").openPopup();

                L.circle(e.latlng, radius).addTo(map);
            }

            map.on('locationfound', onLocationFound);

            function onLocationError(e) {
                alert(e.message);
            }

            map.on('locationerror', onLocationError);
        } else {
            console.log("Géolocalisation désactivée en raison d'une origine non sécurisée (HTTP).");
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Récupérer les éléments nécessaires
            const typeFileSelect = document.getElementById('typeFile');
            const nextStepper3 = document.getElementById('next-stepper3');
            const FileUpload = document.getElementById('Police-file-uploa');
            const docNameInput = document.getElementById('DocName');
            const SingletypeInput = document.getElementById('Singletype');
            const docMsgerror = $('#docMsgerror'); // Vérifier l'ID exact dans le HTML
            const docMsgesucces = $('#docMsgesucces'); // Vérifier l'ID exact dans le HTML

            // Réinitialisation des messages
            docMsgerror.text("").hide();
            docMsgesucces.text("").hide();

            function updateDocName() {
                if (typeFileSelect.value === 'AttestationPerteContrat') {
                    typeFileSelect.classList.add('is-invalid');
                    typeFileSelect.classList.remove('is-valid');
                    // nextStepper3.classList.add('d-none');
                    // retirer le requirement de fichier
                    FileUpload.required = false;
                    docNameInput.value = '';
                    SingletypeInput.value = typeFileSelect.value;
                    docMsgerror.text(
                            "Vous êtes prié de bien vouloir charger le duplicata de votre police ou bulletin du contrat d'assurance ou rendez-vous dans une agence YAKO AFRICA pour obtenir le duplicata si vous n'en avez pas."
                        )
                        .show(); // Mettre à jour le texte de l'erreur.").show(); // Mettre à jour le texte de l'erreur.").show(); // Mettre à jour le texte de l'erreur.").show(); // Mettre à jour le texte de l'erreur.").show();
                } else {
                    typeFileSelect.classList.remove('is-invalid');
                    typeFileSelect.classList.add('is-valid');
                    // nextStepper3.classList.remove('d-none');
                    // ajouter le requirement de fichier
                    FileUpload.required = true;
                    docMsgerror.text("").hide();
                    docMsgesucces.text("").hide();
                    docNameInput.value = typeFileSelect.value; // Met à jour avec la valeur sélectionnée
                    SingletypeInput.value = typeFileSelect.value; // Met à jour avec la valeur sélectionnée
                    docMsgerror.text("").hide();
                    docMsgesucces.text("").hide();
                    docNameInput.value = typeFileSelect.value; // Met à jour avec la valeur sélectionnée
                }

            }

            // Ajouter un événement 'change' sur le select
            typeFileSelect.addEventListener('change', updateDocName);

            // Initialiser la valeur au chargement de la page
            updateDocName();
        });
    </script>

    <script>
        let TotalEncaissement = @json($TotalEncaissement);
        // alert(TotalEncaissement);
    </script>
    @include('users.espace_client.services.prestations.modals.detailContratModal')
    @include('users.espace_client.services.prestations.modals.signModal')

    <script>
        const SIGN_API = "{{ config('services.sign_api') }}";
    </script>

    <script>
        let pollingInterval;

        const qrCodeModal = document.getElementById('qrCodeModal');

        qrCodeModal.addEventListener('shown.bs.modal', function() {
            const keyUuid = "{{ $keyUuid }}"; // Variable Blade pour key_uuid
            const operationType = "{{ $operationType }}"; // Variable Blade pour operation_type

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
@endsection
