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
                    <li class="breadcrumb-item active" aria-current="page">Etat de cotisation</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Repeater Items -->
    <div class="items" data-group="test">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Voir mes documents contractuels</h5>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <form action="{{ route('customer.police.get') }}" id="contract-form" method="post">
                                    @csrf
                                    <label class="form-label">Sélectionner un contrat</label>
                                    <select name="contrat" id="contrat" class="form-select">
                                        <option value="" selected>Veuillez choisir un contrat</option>
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
                            </div>
                        </div>
                        <div id="documentBlock" style="display: none;">
                            <div class="row mb-3">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingPolice">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapsePolice" aria-expanded="true"
                                                aria-controls="collapsePolice">
                                                Police de mon contrat
                                            </button>
                                        </h2>
                                        <div id="collapsePolice" class="accordion-collapse collapse show"
                                            aria-labelledby="headingPolice" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="col-lg-12 col-md-12 col-sm-12 my-3">
                                                    <!-- Zone de prévisualisation du PDF -->
                                                    <div id="pdf-preview" style="margin-top: 20px;">
                                                        <p class="text-danger text-center">
                                                            Veuillez sélectionner un contrat pour voir les documents
                                                            contractuels
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                                    <p id="msgErreur" style="margin-top: 20px; display: none;"
                                                        class="text-danger text-center">
                                                    </p>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3 d-flex justify-content-end">
                                                    <!-- Bouton de téléchargement (caché au départ) -->
                                                    <a id="download-pdf" href="#"
                                                        style="display: none; margin-top: 10px;" class="btn-prime" download>
                                                        Télécharger la Police
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <div id="avenantsContainer">
                                        
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("contract-form");
            const selectContrat = document.getElementById("contrat");
            const spinner = document.getElementById("spinner");
            let documentBlock = document.getElementById("documentBlock");
            let avenantAccordion = document.getElementById("avenantsContainer");
            let previewContainer = document.getElementById("pdf-preview");
            let downloadButton = document.getElementById("download-pdf");
            const msgErreur = document.getElementById(
                "msgErreur"); // Assurez-vous que cet élément existe dans votre HTML

            selectContrat.addEventListener("change", function() {
                const idContrat = this.value;
                if (!idContrat) return; // Ne rien faire si aucun contrat n'est sélectionné

                // Réinitialiser le message d'erreur
                msgErreur.textContent = "";
                msgErreur.style.display = "none";
                spinner.style.display = "block"; // Afficher le spinner

                fetch(form.action, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                            "X-Requested-With": "XMLHttpRequest",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            contrat: idContrat
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.code == 404) {
                            // utilise SweetAlert pour afficher un message d'erreur
                            Swal.fire({
                                icon: 'warning',
                                title: 'Non disponible',
                                text: data.message,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#076633',
                                position: 'center',
                                timer: 8000,
                                timerProgressBar: true,
                            });
                            spinner.style.display = "none";
                            documentBlock.style.display = "none";
                            previewContainer.innerHTML = "";
                            downloadButton.style.display = "none";
                            return;
                        } else if (data.code == 400) {
                            // utilise SweetAlert pour afficher un message d'erreur
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: data.message,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#076633',
                                position: 'center',
                                timer: 8000,
                                timerProgressBar: true,
                            });
                            spinner.style.display = "none";
                            documentBlock.style.display = "none";
                            previewContainer.innerHTML = "";
                            downloadButton.style.display = "none";
                            return;
                        } else if (data.code == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: data.message,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#076633',
                                position: 'center',
                                timer: 8000,
                                timerProgressBar: true,
                            });
                            spinner.style.display = "none";
                            documentBlock.style.display = "none";
                            previewContainer.innerHTML = "";
                            downloadButton.style.display = "none";
                            return;
                        } else {

                            const pdfUrl = data.url;
                            previewContainer.innerHTML = `
                                <iframe src="${pdfUrl}" width="100%" height="600px" style="border: 1px solid #ddd;"></iframe>
                            `;
                            downloadButton.href = pdfUrl;
                            downloadButton.download = `CP_${idContrat}.pdf`;
                            downloadButton.style.display = "inline-block"; // Afficher le bouton
                            spinner.style.display = "none"; // Cacher le spinner
                            documentBlock.style.display = "block";

                            // 🔴 RESET AVENANTS
                            avenantsContainer.innerHTML = "";

                            // ====================
                            // AFFICHAGE DES AVENANTS
                            // ====================
                            if (data.avtFiles && data.avtFiles.length > 0) {

                                data.avtFiles.forEach((avtUrl, index) => {

                                    const avenantNumber = index + 1;

                                    avenantsContainer.innerHTML += `
                                        <div class="accordion my-3">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseAvenant${avenantNumber}">
                                                        Avenant de modification #${avenantNumber}
                                                    </button>
                                                </h2>

                                                <div id="collapseAvenant${avenantNumber}" class="accordion-collapse collapse">
                                                    <div class="accordion-body">

                                                        <iframe src="${avtUrl}" width="100%" height="500px"
                                                            style="border:1px solid #ddd;"></iframe>

                                                        <div class="text-end mt-3">
                                                            <a href="${avtUrl}" class="btn-prime" download>
                                                                Télécharger l’avenant
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                });

                            } else {
                                avenantsContainer.innerHTML = `
                                    <p class="alert alert-warning text-center mt-3">
                                        Aucun avenant de modification trouvé.
                                    </p>
                                `;
                            }
                        }

                    })

                    .catch(error => {

                        console.error(error);
                        Swal.fire({
                            icon: 'warning',
                            title: 'Non disponible',
                            text: "Désolé ! La police du contrat N° " + idContrat +
                                " n'est pas encore disponible ! ",
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#076633',
                            position: 'center',
                            timer: 8000,
                            timerProgressBar: true,
                            showCloseButton: true,
                        });
                        spinner.style.display = "none";
                        documentBlock.style.display = "none";
                        previewContainer.innerHTML = "";
                        downloadButton.style.display = "none";
                        return;

                    });
            });
        });
    </script>
@endsection
