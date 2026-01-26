@extends('users.layouts.main')
@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="breadcrumb__content">
                        <h2 class="title">Services Assistances</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Assistances</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__shape">
            <img src="{{ asset('assets/img/images/breadcrumb_shape01.png') }}" alt="">
            <img src="{{ asset('assets/img/images/breadcrumb_shape02.png') }}" alt="" class="rightToLeft">
            <img src="{{ asset('assets/img/images/breadcrumb_shape03.png') }}" alt="">
            <img src="{{ asset('assets/img/images/breadcrumb_shape04.png') }}" alt="">
            <img src="{{ asset('assets/img/images/breadcrumb_shape05.png') }}" alt="" class="alltuchtopdown">
        </div>
    </section>
    <!-- request-area -->
    <section class="request__area-two">
        <div class="request__bg-two" data-background="{{ asset('assets/img/home8/slider01.jpg') }}"></div>
        <div class="container">
            <div class="row">
                <div class="mb-3 col-lg-4">
                    <div class="request__content-two p-5" style="min-height: 420px; max-height: 420px">
                        <h2 class="title" style="font-size: 1.4em">J'ai une urgence en cours</h2>
                        <div class="request__phone">
                            <div class="conten">
                                <p class="text-white " style="text-align: justify">
                                    Vous avez besoin d'un
                                    document contractuel pour votre dossier bancaire, vous avez besoin d'une attestation...
                                </p>
                                <p class="text-white" style="text-align: justify">
                                    notre service d'assistance est là pour vous aider en cas de pépin.
                                </p>
                            </div>
                        </div>
                        <div class="icon"><a href="tel:2720331500" class="btn">
                                <i class="flaticon-phone-call"></i>&nbsp; +225 27 20 33 15 00
                            </a></div>
                    </div>
                </div>
                <div class="mb-3 col-lg-4">
                    <div class="request__content-two p-5" style="min-height: 420px; max-height: 420px">
                        <h2 class="title" style="font-size: 1.4em">J'ai un sinistre à déclarer</h2>
                        <div class="request__phone">
                            <div class="conten">
                                <p class="text-white" style="text-align: justify">
                                    Vous venez de perdre un parent, vous avez enterré votre parent sans prévenir
                                    l'assistance, vous avez perdu le contrat d'assurance avec le sinistre...
                                </p>
                                <p class="text-white" style="text-align: justify">
                                    Déclarez votre sinistre en ligne
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('sinistre.index') }}" class="btn">Déclarer un sinistre</a>
                        {{-- <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#enMaintenanceModal"
                            class="btn">Prédéclarer un sinistre</a> --}}
                    </div>
                </div>
                <div class="mb-3 col-lg-4">
                    <div class="request__content-two p-5" style="min-height: 420px; max-height: 420px">
                        <h2 class="title" style="font-size: 1.4em">J'ai une autre demande</h2>
                        <div class="request__phone">
                            <div class="contet">
                                <p class="text-white " style="text-align: justify">
                                    Consultation et gestion de vos contrats, téléchargement d’une attestation, échanges avec
                                    YAKO AFRICA ASSURANCES VIE...
                                </p>
                                <p class="text-white" style="text-align: justify">
                                    Vous avez la main.
                                </p>
                            </div>
                        </div>
                        <div class="icon"><a href="tel:2720331500" class="btn">
                                <i class="flaticon-phone-call"></i>&nbsp; +225 27 20 33 15 00
                            </a></div>
                    </div>
                </div>
            </div>


            <br><br>
            {{-- <div class="row">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Modèles de courrier PDF
                    </button>
                  </h2>
                  <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <table class="table table-striped  table-hover">
                            <thead class="text-center">
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Courrier</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($courriers as $courrier)
                                    <tr>
                                        <th scope="row"> {{$courrier->id ?? 'N/A'}} </th>
                                        <td>{{$courrier->label ?? 'N/A'}}</td>
                                        <td>
                                            <a href="{{ asset('ModelCourriers/' . $courrier->file) }}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
                                        </td>   
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                  </div>
                </div>
              </div>
        </div> --}}
        </div>
    </section>

    <div class="modal fade" id="enMaintenanceModal" tabindex="-1" aria-labelledby="enMaintenanceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enMaintenanceModalLabel">En cour de développement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="card radius-10">
                        <div class="card-body rounded" style="background-color:rgba(255, 2, 27, 0.36)">
                            <div class="align-items-center">
                                <div class="flex-grow-1 ms-3 my-4 text-white" style="text-align: justify">
                                    Cette fonctionnalité est en cours de développement et sera disponible
                                    prochainement, Merci de contacter YAKO AFRICA Assurance Vie pour toute question
                                    <b>
                                        <a href="tel:2720331500" class="text-dark">
                                            <i class="flaticon-phone-call"></i>&nbsp; +225 27 20 33 15 00
                                        </a>
                                    </b>.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-prime" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- request-area-end -->

    <!-- brand-area -->
    @include('users.layouts.partners-slider')
    <!-- call-back-area-end -->
@endsection
