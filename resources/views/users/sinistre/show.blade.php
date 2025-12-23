@extends('users.sinistre.layouts.main')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="fm-menu">
                        <div class="list-group list-group-flush">
                            <a href="javascript:;" class="list-group-item py-1" data-target="info-contrat">
                                <i class='bx bx-folder me-2'></i><span>Detail de la Déclaration</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="fm-menu">
                        <div class="list-group list-group-flush mb-3">
                            <span>Status de la Déclaration</span>
                        </div>
                        @if ($sinistre->etape == 0)
                            <span class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3">
                                <i class="bx bxs-circle me-1"></i>En attente de transmission
                            </span>
                        @elseif ($sinistre->etape == 1)
                            <span class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3">
                                <i class="bx bxs-circle me-1"></i>Transmise pour traitement
                            </span>
                        @elseif ($sinistre->etape == 2)
                            <span class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                <i class="bx bxs-circle me-1"></i>Acceptée et en cours de traitement
                            </span>
                        @elseif ($sinistre->etape == 3)
                            <span class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                <i class="bx bxs-circle me-1"></i>Déclaration rejetée
                            </span>
                        @else
                            --
                        @endif

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-0 text-primary font-weight-bold">Documents joint </h5>
                    </p>
                    <div class="mt-3"></div>
                    @if ($sinistre && $sinistre->docSinistre && $sinistre->docSinistre->where('idSinistre', $sinistre->id)->count() > 0)
                        @forelse ($sinistre->docSinistre->where('idSinistre', $sinistre->id) as $doc)
                            <div class="d-flex align-items-center mt-3">
                                <div class="fm-file-box text-success"><i class='bx bxs-file-doc'></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0" style="font-size: 10px">
                                        {{ $doc->libelle }}
                                    </h6>
                                    <p class="mb-0 text-secondary" style="font-size: 0.6em">
                                        {{ $doc->created_at ?? '' }}
                                    </p>
                                </div>
                                <h6 class="text-primary mb-0 text-center">
                                    <a class="btn-prime py-2 px-4" data-bs-target="#view-bulletin{{ $doc->id }}"
                                        data-bs-toggle="modal" title="Preview">
                                        <i class="bx bx-show"></i>
                                    </a>
                                </h6>
                                <div class="modal fade" id="view-bulletin{{ $doc->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ $doc->libelle }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="width: 100%; height: 80vh">
                                                <iframe style="width: 100%; height: 100%" src="{{ asset($doc->path) }}"
                                                    frameborder="0"></iframe>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn-prime btn-prime-two text-white">
                                                    <a class="text-white" href="{{ asset($doc->path) }}"
                                                        id="download-bulletin" title="Telecharger" download>Telecharger
                                                        <i class="bx bx-download"></i>
                                                    </a></button>

                                                <button type="button" class="btn-prime"
                                                    data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-secondary">Aucun document joint</p>
                        @endforelse
                    @else
                        <p class="text-secondary">Aucun document joint</p>
                    @endif


                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-body">
                    <section id="info-contrat" class="section-content">
                        {{-- @if ($sinistre && $sinistre->membre != null && $sinistre->membre->typ_membre !== 3)
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mt-4 row">
                                                <dl class="row col-md-6">
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Saisie par :</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                        {{ $prestation->membre->prenom ?? '' }}
                                                        {{ $prestation->membre->nom ?? '' }} </dd>
                                                </dl>
                                                <dl class="row col-md-6">

                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5>Informations du déclarant</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <dl class="row">
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Nom:</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->nomDecalarant ?? '' }} </dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Prénom:</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->prenomDecalarant ?? '' }} </dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Email:</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->emailDecalarant ?? '' }} </dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">N° de téléphone:</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->celDecalarant ?? '' }} </dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-6">
                                                <dl class="row">
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Date de naissance:
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->datenaissanceDecalarant ?? 'Non renseigné' }} </dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu de naissance:
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->lieunaissanceDecalarant ?? 'Non renseigné' }} </dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu de résidence:
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->lieuresidenceDecalarant ?? 'Non renseigné' }} </dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Filiation avec
                                                        l'assuré:</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->filiation ?? 'Non renseigné' }} </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5>Informations sur l'assuré(e)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <dl class="row">
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Nom:</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->nomAssuree ?? '' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Prénom:</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->prenomAssuree ?? '' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Date de naissance:
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->datenaissanceAssuree ?? '' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Genre:</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->genreAssuree == 'M' ? 'Masculin' : 'Feminin' }}</dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-6">
                                                <dl class="row">
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu de naissance:
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->lieunaissanceAssuree ?? '' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu de résidence:
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->lieuresidenceAssuree ?? '' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Profession:</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->professionAssuree ?? '' }}</dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5>Informations sur le sinistre</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <dl class="row">
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Nature du sinistre:
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->natureSinistre ?? '' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Date du sinistre:</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->dateSinistre ?? '' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Cause du sinistre:
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5 text-wrap">
                                                        {{ $sinistre->causeSinistre ?? '' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Décès accidentel:</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->decesAccidentel == '1' ? 'Oui' : ($sinistre->decesAccidentel == '0' ? 'Non' : '') }}
                                                    </dd>

                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Déclaration tardive:
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->declarationTardive == '1' ? 'Oui' : ($sinistre->declarationTardive == '0' ? 'Non' : '') }}
                                                    </dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Ville du sinistre:
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->villeSinistre ?? '' }}
                                                    </dd>
                                                </dl>
                                            </div>
                                            <div class="col-md-6">
                                                <dl class="row">
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu de conservation:
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5 text-wrap">
                                                        {{ $sinistre->lieuConservation ?? '' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Date de levée:</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->dateLevee ?? '' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu de levée:</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5 text-wrap">
                                                        {{ $sinistre->lieuLevee ?? '' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Date d'inhumation:
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $sinistre->dateInhumation ?? '' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu d'inhumation:
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5 text-wrap">
                                                        {{ $sinistre->lieuInhumation ?? '' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Lieu du sinistre:
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5 text-wrap">
                                                        {{ $sinistre->lieuSinistre ?? '' }}</dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5>Informations du mode de paiement</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <dl class="row">
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">ID Contrat :</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" >{{ $sinistre->idcontrat ?? '' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Moyen de paiement :
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" >{{ $sinistre->moyenPaiement == 'Virement_Bancaire' ? 'Virement Bancaire' : 'Mobile Money' ?? 'Non renseigné' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Opérateur :</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5" >{{ $sinistre->Operateur == 'Orange_money'
                                                                ? 'Orange Money'
                                                                : ($sinistre->Operateur == 'MTN_Money'
                                                                        ? 'MTN Money'
                                                                        : ($sinistre->Operateur == 'Moov_Money'
                                                                            ? 'Moov Money'
                                                                            : 'Non renseigné')) ?? 'Non renseigné' }}</dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Numéro de paiement :
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">{{ $sinistre->telPaiement ?? 'Non renseigné' }}</dd>

                                                    {{-- sinon si moyenPaiement = Virement_Bancaire affiche --}}
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Relevé d'identité
                                                        bancaire (RIB) :</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">{{ $sinistre->IBAN ?? 'Non renseigné' }}</dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
