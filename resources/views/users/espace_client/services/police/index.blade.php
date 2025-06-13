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
                <h5 class="mb-0">Voir la Police de mon contrat</h5>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <form action="{{ route('customer.police.get') }}" id="contract-form" method="post">
                                    @csrf
                                    <label class="form-label">Sélectionner un contrat pour voir la Police</label>
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
                                    {{-- <button type="submit" class="btn-prime mt-3">Voir</button> --}}
                                </form>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <!-- Zone de prévisualisation du PDF -->
                                <div id="pdf-preview" style="margin-top: 20px;"></div>
                                <!-- Bouton de téléchargement (caché au départ) -->

                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                <!-- Zone de prévisualisation du PDF -->
                                <p id="msgErreur" style="margin-top: 20px; display: none;" class="text-danger text-center"></p>


                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-3 d-flex justify-content-end">
                                <!-- Bouton de téléchargement (caché au départ) -->
                                <a id="download-pdf" href="#" style="display: none; margin-top: 10px;"
                                    class="btn-prime" download>
                                    Télécharger la Police
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
            const form = document.getElementById("contract-form");
            const selectContrat = document.getElementById("contrat");
            const spinner = document.getElementById("spinner");
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
                        if (data.type !== "success") {
                            msgErreur.textContent = "Désolé ! La police du contrat N° " + idContrat + " n'est pas encore disponible !";
                            msgErreur.style.display = "block";
                            spinner.style.display = "none";
                            previewContainer.innerHTML = "";
                            downloadButton.style.display = "none";
                            return;
                        }

                        const pdfUrl = data.url;
                        

                        previewContainer.innerHTML = `
                <iframe src="${pdfUrl}" width="100%" height="600px" style="border: 1px solid #ddd;"></iframe>
            `;

                        downloadButton.href = pdfUrl;
                        downloadButton.download = `CP_${idContrat}.pdf`;
                        downloadButton.style.display = "inline-block"; // Afficher le bouton

                        spinner.style.display = "none"; // Cacher le spinner
                    })
                    .catch(error => {
                        console.error(error);
                        spinner.style.display = "none"; // Cacher le spinner
                        msgErreur.textContent = "Désolé ! La police de votre contrat N° " + idContrat + " n'est pas encore disponible !";
                        msgErreur.style.display = "block";
                        previewContainer.innerHTML = "";
                        downloadButton.style.display = "none";
                    });
            });
        });
    </script>
@endsection
