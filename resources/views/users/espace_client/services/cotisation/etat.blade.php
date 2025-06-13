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
                <h5 class="mb-0">Verifier l'Etat de cotisation de mon contrat</h5>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <form action="{{ route('customer.cotisation.etat') }}" id="contractEtat-form"
                                    method="post">
                                    @csrf
                                    <label class="form-label">Sélectionner un contrat pour voir son Etat de
                                        cotisation</label>
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
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <!-- Zone de prévisualisation du PDF -->
                                <div id="pdf-preview" style="margin-top: 20px;"></div>
                                <!-- Bouton de téléchargement (caché au départ) -->
                                
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3 d-flex justify-content-end">
                                <!-- Bouton de téléchargement (caché au départ) -->
                                <a id="download-pdf" href="#" style="display: none; margin-top: 10px;"
                                    class="btn-prime" download>
                                    Télécharger l'Etat de cotisation 
                                </a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("contractEtat-form");
            const selectContrat = document.getElementById("contrat");
            const spinner = document.getElementById("spinner");

            selectContrat.addEventListener("change", function() {
                const idContrat = this.value;
                if (!idContrat) return; // Ne rien faire si aucun contrat n'est sélectionné

                spinner.style.display = "block"; // Afficher le spinner

                fetch(form.action, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                            "X-Requested-With": "XMLHttpRequest",
                        },
                        body: new URLSearchParams({
                            contrat: idContrat
                        }),
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Erreur lors de la récupération du PDF.");
                        }
                        return response.blob();
                    })
                    .then(blob => {
                        const pdfUrl = URL.createObjectURL(blob);
                        let previewContainer = document.getElementById("pdf-preview");
                        let downloadButton = document.getElementById("download-pdf");

                        if (!previewContainer) {
                            previewContainer = document.createElement("div");
                            previewContainer.id = "pdf-preview";
                            previewContainer.style = "margin-top: 20px;";
                            form.insertAdjacentElement("afterend", previewContainer);
                        }

                        if (!downloadButton) {
                            downloadButton = document.createElement("a");
                            downloadButton.id = "download-pdf";
                            downloadButton.className = "btn btn-success mt-2"; // Bootstrap button style
                            downloadButton.innerText = "Télécharger le PDF";
                            downloadButton.style.display = "block";
                            previewContainer.insertAdjacentElement("afterend", downloadButton);
                        }

                        previewContainer.innerHTML = `
                <iframe src="${pdfUrl}" width="100%" height="600px" style="border: 1px solid #ddd;"></iframe>
            `;

                        // Configurer le bouton de téléchargement
                        const now = new Date();
                        const formattedDate = `${now.getDate().toString().padStart(2, '0')}-${(now.getMonth() + 1).toString().padStart(2, '0')}-${now.getFullYear()}_${now.getHours().toString().padStart(2, '0')}-${now.getMinutes().toString().padStart(2, '0')}-${now.getSeconds().toString().padStart(2, '0')}`;

                        downloadButton.href = pdfUrl;
                        downloadButton.download = `etat_cotisation_${idContrat}_${formattedDate}.pdf`;
                        downloadButton.style.display = "inline-block"; // Afficher le bouton

                        spinner.style.display = "none"; // Cacher le spinner
                    })
                    .catch(error => {
                        console.error(error);
                        spinner.style.display = "none"; // Cacher le spinner
                        alert("Impossible de charger l'état de cotisation. Veuillez réessayer.");
                    });
            });
        });
    </script>
@endsection
