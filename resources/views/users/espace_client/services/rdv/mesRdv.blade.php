@extends('users.espace_client.layouts.main')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Rendez-vous</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Mes rendez-vous pris</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
	<div class="card">
        <div class="card-header d-flex justify-content-center align-items-center ">
            <div class="w-75 mb-3">
                <form id="contractPrest-form" method="post">
                    @csrf
                    <label class="mb-3">Sélectionner un contrat pour voir la liste des RDV pris</label>
                    <select name="idcontratPrest" id="idcontratRdv" class="form-select">
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
                <table id="example3" class="table mes-prestations table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Code du rdv</th>
                            <th>Status du preneur</th>
                            <th>#ID du contrat</th>
                            <th>Motif du rendez-vous</th>
                            <th>Lieu du rendez-vous</th>
                            <th>Date du rendez-vous</th>
                            <th>Telephone associé</th>
                            <th>Email associé</th>
                            <th>Statut du rendez-vous</th>
                            <th>Date de création</th>
                        </tr>
                    </thead>
                    <tbody id="tableRdv">
                        
                        {{-- Affichage des prestations demander en fonction du contrat selectionner ici --}}
                        <tr>
                            <td colspan="9" class="text-center">Veuillez sélectionner un contrat pour voir la liste des RDV pris.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
		</div>
	</div>

    
@endsection