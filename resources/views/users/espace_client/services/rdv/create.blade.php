@extends('users.espace_client.layouts.main')

@section('content')
    <!--start stepper one-->
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Rendez-vous</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Prise de rendez-vous | {{ $typePrestation->libelle ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">

        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('customer.rdv.store') }}" method="POST" enctype="multipart/form-data"
                class="submitForm">
                @csrf
                
                <div class="card" style="background-color: #E7F0EB">
                    <div class="card-header text-center">
                        <h5 class="mb-1">Prise de Rendez-vous</h5>
                        <p class="mb-4">Veuillez remplir les informations ci-dessous pour fixer un rendez-vous à la date et au lieu de votre choix.</p>
                    </div>
                    <div class="card-body">
                        <div class="etaperdv" id="etaperdv1">
                            <div class="row g-3 mb-3">
                            
                                <div class="col-12 col-lg-6">
                                    <label for="single-select-field" class="form-label">Statut du demandeur <span class="star">*</span></label>
                                    <select class="form-select" name="titre" id="single-select-field" data-placeholder="Veuillez sélectionner le status du demandeur" required>
                                        <option></option>
                                            <option value="Souscripteur">Souscripteur</option>
                                            <option value="Assure">Assuré</option>
                                            <option value="Beneficiaire">Bénéficiaire</option>
                                            <option value="Autre">Autre</option>
                                    </select>
                                    <input type="hidden" name="motifrdv" value="{{ $typePrestation->libelle }}">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="single-select-clear-field" class="form-label">Pour quel Contrat voulez-vous prendre RDV ? <span class="star">*</span></label>
                                    <select class="form-select" name="police" id="single-select-clear-field" data-placeholder="Veuillez sélectionner l'ID du contrat" required>
                                        <option></option>
                                        @foreach(Auth::guard('customer')->user()->membre->membreContrat as $contrat)
                                        @if($contratDetails && $contratDetails['IdProposition'] == $contrat->idcontrat)
                                            <option value="{{ $contrat->idcontrat }}" selected>
                                                {{ $contrat->idcontrat }}
                                            </option>
                                        {{-- @else
                                            <option value="{{ $contrat->idcontrat }}">
                                                {{ $contrat->idcontrat }}
                                            </option> --}}
                                        @endif
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end gap-3">
                                    <button class="btn-prime next-btn" type="button" data-next="etaperdv2">Suivant <i
                                        class='bx bx-right-arrow-alt fs-4'></i></button>
                                </div>
                            </div>
                            
                        </div>
                        <div class="etaperdv d-none" id="etaperdv2">
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-lg-6">
                                    <label for="nomclient" class="form-label">Quel est votre nom ? <span class="star">*</span></label>
                                    <input type="text" class="form-control" id="nomclient" name="nomclient" 
                                           value="{{ Auth::guard('customer')->user()->membre->prenom ?? '' }} {{ Auth::guard('customer')->user()->membre->nom ?? '' }}" 
                                           placeholder="Votre Nom" required readonly>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="datenaissance" class="form-label">Quelle est votre date de naissance ?</label>
                                    <input type="text" class="form-control datepicker" id="datenaissance" name="datenaissance" 
                                           value="{{ Auth::guard('customer')->user()->membre->datenaissance ?? '' }}" 
                                           placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-lg-6">
                                    <label for="tel" class="form-label">Sur quelle N° de téléphone pouvons vous contacter ? <span class="star">*</span></label>
                                    <input type="number" class="form-control" id="tel" name="tel" 
                                           value="{{ Auth::guard('customer')->user()->membre->cel ?? '' }}" 
                                           placeholder="Votre numéro téléphone" required> 
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="email" class="form-label">Quelle est votre adresse email ? <span class="star">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ Auth::guard('customer')->user()->membre->email ?? '' }}" 
                                           placeholder="Votre adresse email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 d-flex justify-content-start gap-3">
                                    <button class="btn2 border-btn2 prev-btn" type="button" data-prev="etaperdv1"><i class='bx bx-left-arrow-alt fs-4'></i> Retour</button>
                                </div>
                                <div class="col-6 d-flex justify-content-end gap-3">
                                    <button class="btn-prime next-btn" type="button" data-next="etaperdv3">Suivant <i
                                        class='bx bx-right-arrow-alt fs-4'></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="etaperdv d-none" id="etaperdv3">
                            <div class="row g-3 mb-3">
                            
                                <div class="col-12 col-lg-6">
                                    <label for="prepend-text-single-field" class="form-label">Où habitez-vous ? <span class="star">*</span></label>
                                    <select class="form-select" name="lieuresidence" id="prepend-text-single-field" data-placeholder="Veuillez sélectionner votre lieu d'habitation" required>
                                        <option></option>
                                        <option value="{{Auth::guard('customer')->user()->membre->lieuresidence ?? ''}}" selected>{{Auth::guard('customer')->user()->membre->lieuresidence ?? ''}}</option>
                                        
                                        @foreach($villes as $ville)
                                            @if(Auth::guard('customer')->user()->membre->lieuresidence !== $ville->libelleVillle)
                                                <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="idTblBureau" class="form-label">Lieu de RDV souhaité <span class="star">*</span></label>
                                    <select class="form-select" name="idTblBureau" id="idTblBureau" data-placeholder="" required>
                                        <option selected value="">Veuillez sélectionner le lieu du RDV</option>
                                        @foreach($villeReseaux as $villeReseau)
                                            <option value="{{$villeReseau->idVilleBureau}}">{{$villeReseau->libelleVilleBureau}}</option>
                                        @endforeach
                                    </select>
                                    <div id="spinner" style="display: none;">
                                        <div class="spinner-border" style="color: #076633;" role="status">
                                            <span class="visually-hidden">Chargement...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12">
                                    <label for="daterdv" class="form-label">Date de RDV ? <span class="star">*</span></label>
                                    <input type="text" class="form-control date-format" id="daterdv" name="daterdv" placeholder="dd/mm/yyyy" required>
                                </div>
                                <p id="msgerror" class="text-danger"></p>
                                <p id="msgesucces" class="text-success"></p>
                                <div id="spinnerDaterdv" style="display: none;">
                                    <div class="spinner-border" style="color: #076633;" role="status">
                                        <span class="visually-hidden">Chargement...</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <h3 id="lieurdv">
                                    {{-- Affiche le lieu de rdv selectionner ici  --}}
                                </h3>
                                <p>Jour de rendez-vous</p>
                                <p id="jourRdv">
                                    {{-- Affiche les jours de rdv de la ville selectionner ici  --}}
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-6 d-flex justify-content-start gap-3">
                                    <button class="btn2 border-btn2 prev-btn" type="button" data-prev="etaperdv2"><i class='bx bx-left-arrow-alt fs-4'></i> Retour</button>
                                </div>
                                <div class="col-6 d-flex justify-content-end gap-3">
                                    <button type="submit" class="btn-prime btn-prime-two submitdrv-btn">Soumettre</button>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
