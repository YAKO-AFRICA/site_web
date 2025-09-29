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
    </style>


    <div class="card">

        <div class="card-header">
            <h1 class="card-title text-uppercase text-center">Pré-déclaration de sinistre</h1>
        </div>
        {{-- @include('users.espace_client.services.prestations.modals.infosMontantModal') --}}
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <!-- Formulaire -->
            <form id="checkContratForSinistre" method="POST" enctype="multipart/form-data" class="mb-3">
                @csrf
                <div class="row">
                    @if (Auth::guard('customer')->check())
                        <div class="col-md-12">
                            <label for="single-select" class="form-label">Sélectionnez le contrat <span
                                    class="star">*</span></label>
                            <select class="form-select" name="contratId" id="single-select" required>
                                <option selected value="">Veuillez sélectionner l'ID du contrat</option>
                                @foreach (Auth::guard('customer')->user()->membre->membreContrat as $contrat)
                                    <option value="{{ $contrat->idcontrat }}">
                                        {{ $contrat->idcontrat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class="col-md-6">
                            <label for="contratId" class="form-label">ID du contrat</label>
                            <input type="text" name="contratId" class="form-control"
                                placeholder="Veuillez entrer l'ID du contrat" id="contratId" required>
                        </div>
                        <div class="col-md-6">
                            <label for="datenaissanceSous" class="form-label">Date de naissance associée au contrat</label>
                            <input type="date" name="datenaissanceSous" class="form-control" id="datenaissanceSous"
                                required>
                            {{-- <p class="text-danger">*Veuillez entrer la date de naissance associée au contrat</p> --}}
                        </div>
                        
                    @endif
                </div>

                <!-- Spinner -->
                <div id="spinner" class="text-center d-none mt-3">
                    <div class="spinner-border" style="color: #076633;" role="status"></div>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    <button type="submit" class="btn-prime">Continuer</button>
                </div>
            </form>

            <!-- Tableau des assurés -->
            <div class="table-responsive assure-table d-none">
                <table id="example3" class="table">
                    <legend>
                        <h2>Liste des assurés</h2>
                    </legend>
                    <thead class="table-light">
                        <tr>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Prénoms</th>
                            <th>Date de naissance</th>
                            <th>Lieu de naissance</th>
                            <th>Personne assurée</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="assureTable">
                        <tr>
                            <td colspan="7" class="text-center">Veuillez saisir les informations du contrat pour voir les
                                assuré(e)s.</td>
                        </tr>
                    </tbody>
                </table>
            </div>



        </div>
    </div>



@endsection
