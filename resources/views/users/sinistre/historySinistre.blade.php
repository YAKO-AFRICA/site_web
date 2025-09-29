@extends('users.sinistre.layouts.main')

@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Sinistre</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Mes Pré-déclarations</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">

        <div class="card-header">
            <h4 class="card-title text-uppercase text-center">Consulter mes Pré-déclarations de sinistre</h4>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <!-- Formulaire -->
            <form id="getSinistre" method="POST" class="mb-3">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="" class="form-label">Consulter à partir de : <span
                                class="star">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" value="contrat" id="contrat"
                                checked>
                            <label class="form-check-label" for="contrat">
                                L'ID du contrat
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" value="code" id="code">
                            <label class="form-check-label" for="code">
                                Le code de la pré-déclaration
                            </label>
                        </div>
                    </div>
                </div>
                @if (Auth::guard('customer')->check())
                    <div class="row">
                        <div class="col-md-12" id="searchContrat">
                            <label for="single-select" class="form-label">Sélectionnez le contrat <span
                                    class="star">*</span></label>
                            <select class="form-select" name="contratId" id="single-select">
                                <option selected value="">Veuillez sélectionner l'ID du contrat</option>
                                @foreach (Auth::guard('customer')->user()->membre->membreContrat as $contrat)
                                    <option value="{{ $contrat->idcontrat }}">
                                        {{ $contrat->idcontrat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 d-none" id="searchCode">
                            <label for="codeInput" class="form-label">Veuillez entrer le code de la pré-déclaration du
                                sinistre <span class="star">*</span></label>
                            <input type="text" name="code" class="form-control"
                                placeholder="Veuillez entrer le code de la pré-déclaration du sinistre Ex: SIN-SHZZNS"
                                id="codeInput">
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-12" id="searchContrat">
                            <label for="contratIdInput" class="form-label">ID du contrat</label>
                            <input type="text" name="contratId" class="form-control"
                                placeholder="Veuillez entrer l'ID du contrat" id="contratIdInput">
                        </div>
                        <div class="col-12 d-none" id="searchCode">
                            <label for="codeInput" class="form-label">Veuillez entrer le code de la pré-déclaration
                                du sinistre
                                <span class="star">*</span></label>
                            <input type="text" name="code" class="form-control"
                                placeholder="Veuillez entrer le code de la pré-déclaration du sinistre Ex: SIN-SHZZNS"
                                id="codeInput">
                        </div>
                    </div>
                @endif

                <!-- Spinner -->
                <div id="spinner" class="text-center d-none mt-3">
                    <div class="spinner-border" style="color: #076633;" role="status"></div>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    <button type="submit" class="btn-prime btn-prime-two">Consulter</button>
                </div>
            </form>

            <!-- Tableau des assurés -->
            <div class="card-body container-fluid">
                <div class="table-responsive">
                    <table id="example3" class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Code</th>
                                <th>#ID du contrat</th>
                                <th>Assuré(e)</th>
                                <th>Nature du sinistre</th>
                                <th>Date pré-déclaration</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableSinistre">

                            {{-- Affichage des sinistres en fonction du contrat selectionner ici --}}

                            <tr>
                                <td colspan="7" class="text-center">Aucune sinistre trouvée</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>



        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const radioContrat = document.getElementById("contrat");
            const radioCode = document.getElementById("code");
            const contratIdInput = document.getElementById("contratIdInput");
            const codeInput = document.getElementById("codeInput");

            const searchContrat = document.getElementById("searchContrat");
            const searchCode = document.getElementById("searchCode");

            // Fonction pour mettre à jour l'affichage
            function toggleFields() {
                if (radioContrat.checked) {
                    searchContrat.classList.remove("d-none");
                    searchCode.classList.add("d-none");
                    contratIdInput.required = true;
                    codeInput.required = false;
                    codeInput.value = "";
                } else if (radioCode.checked) {
                    searchContrat.classList.add("d-none");
                    searchCode.classList.remove("d-none");
                    contratIdInput.required = false;
                    codeInput.required = true;
                    contratIdInput.value = "";
                }
            }

            // Écoute le changement des radios
            radioContrat.addEventListener("change", toggleFields);
            radioCode.addEventListener("change", toggleFields);

            // Initialisation au chargement
            toggleFields();
        });
    </script>
@endsection
