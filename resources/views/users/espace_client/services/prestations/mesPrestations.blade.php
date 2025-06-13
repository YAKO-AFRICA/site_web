@extends('users.espace_client.layouts.main')

@section('content')

<style>
    .disabled-link {
        pointer-events: none;
        opacity: 0.6; /* Rendre visuellement inactif */
        cursor: not-allowed;
    }
</style>
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Prestations</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard')}}"><i class="bx bx-home-alt"></i></a>
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
                        @foreach(Auth::guard('customer')->user()->membre->membreContrat as $contrat)
                            <option value="{{$contrat->idcontrat}}">{{$contrat->idcontrat}}</option>
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
                            <th>Etape</th>
                            <th>Date de demande</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    {{-- <a href="/espace-client/prestation/edit/${prestation.code}" class="mx-3"><i class='bx bxs-edit'></i></a> --}}
                    <tbody id="tablePrestation">
                        
                        {{-- Affichage des prestations demander en fonction du contrat selectionner ici --}}
                        
                        <tr>
                            <td colspan="9" class="text-center">Veuillez sélectionner un contrat pour voir les prestations.</td>
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