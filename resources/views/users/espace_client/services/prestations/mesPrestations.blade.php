@extends('users.espace_client.layouts.main')

@section('content')
    <style>
        .new-prestation {
            font-weight: 500;
        }

        .old-prestation {
            background-color: rgba(0, 0, 0, 0.02) !important;
            color: #666;
        }

        /* Liens désactivés */
        .disabled-link {
            opacity: 0.5;
            pointer-events: none;
            cursor: not-allowed;
        }

        /* Style DataTables personnalisé */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.1em !important;
            margin-left: 1px;
            /* border: 1px solid #dee2e6; */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #033f1f !important;
            color: white !important;
            border: 1px solid #033f1f !important;
        }
    </style>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Prestations</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Mes prestations demandés</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-header d-flex justify-content-center align-items-center ">
            <div class="w-100 mb-3">
                <form id="contractPrest-form" method="post">
                    @csrf
                    <label class="mb-3">Sélectionner un contrat pour voir ses prestations</label>
                    <select name="idcontratPrest" id="idcontratPrest" class="form-select">
                        <option selected>Veuillez sélectionner un contrat</option>
                        @foreach (Auth::guard('customer')->user()->membre->membreContrat as $contrat)
                            <option value="{{ $contrat->idcontrat }}">{{ $contrat->idcontrat }}</option>
                        @endforeach
                    </select>
                </form>
                <div id="spinner" style="display: none;">
                    <div class="spinner-border" style="color: #076633;" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body container-fluid">
            <div class="table-responsive">
                <table id="example3" class="table mes-prestations">
                    <thead class="table-light">
                        <tr>
                            <th>Code</th>
                            <th>#ID du contrat</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Date de demande</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tablePrestation">

                        {{-- Affichage des prestations demander en fonction du contrat selectionner ici --}}

                        <tr>
                            <td colspan="9" class="text-center">Veuillez sélectionner un contrat pour voir les
                                prestations.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
{{-- @include('users.espace_client.services.prestations.partials.listPrestation') --}}

{{-- <a href="" class="me-3"><i class='bx bxs-edit'></i></a> --}}

{{-- <a class="deleteConfirmation" data-uuid="{{ $contrat->id }}"
										data-type="confirmation_redirect" data-placement="top"
										data-token="{{ csrf_token() }}" data-url="{{ route('production.delete.contrat', $contrat->id) }}"
										data-title="Vous êtes sur le point de supprimer {{ $contrat->numbulletin }}"
										data-id="{{ $contrat->id }}" data-param="0"
										data-route="{{ route('production.delete.contrat', $contrat->id) }}">
										<button><i class='bx bxs-trash'></i></button>
									</a> --}}
