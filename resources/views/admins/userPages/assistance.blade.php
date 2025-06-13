@extends('admins.layouts.main')
@section('content-admin')
<!-- breadcrumb-area -->
<section class="breadcrumb__area breadcrumb__bg" style="background-image: linear-gradient(to left, rgba(236, 240, 249, 0.1), rgba(191, 202, 208, 0.4)), url('{{ asset('assets/img/images/banner.jpg')}}')">
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
        <img src="{{ asset('assets/img/images/breadcrumb_shape01.png')}}" alt="">
        <img src="{{ asset('assets/img/images/breadcrumb_shape02.png')}}" alt="" class="rightToLeft">
        <img src="{{ asset('assets/img/images/breadcrumb_shape03.png')}}" alt="">
        <img src="{{ asset('assets/img/images/breadcrumb_shape04.png')}}" alt="">
        <img src="{{ asset('assets/img/images/breadcrumb_shape05.png')}}" alt="" class="alltuchtopdown">
    </div>
</section>
<!-- request-area -->
@include('admins.userPages.addFileModal')
<section class="request__area-two">
    <div class="request__bg-two" data-background="{{ asset('assets/img/home8/slider01.jpg')}}"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="request__content-two p-5" style="min-height: 400px; max-height: 400px">
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
                    <div class="icon">
                        <a href="tel:0123456789" class="btn">
                            <i class="flaticon-phone-call"></i>&nbsp; +225 27 20 33 15 00
                        </a>
                    </div> 
                </div>
            </div>
            <div class="col-lg-4">
                <div class="request__content-two p-5" style="min-height: 400px; max-height: 400px">
                    <h2 class="title" style="font-size: 1.4em">J'ai un sinistre à déclarer</h2>
                    <div class="request__phone">
                        <div class="conten">
                            <p class="text-white" style="text-align: justify">
                                Vous venez de perdre un parent, vous avez enterré votre parent sans prévenir l'assistance, vous avez perdu le contrat d'assurance avec le sinistre...
                            </p>
                            <p class="text-white" style="text-align: justify">
                                Déclarez votre sinistre en ligne
                            </p>
                        </div>
                    </div>
                    <a href="" class="btn">Declarer un sinitre</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="request__content-two p-5" style="min-height: 400px; max-height: 400px">
                    <h2 class="title" style="font-size: 1.4em">J'ai une autre demande</h2>
                    <div class="request__phone">
                        <div class="conten">
                            <p class="text-white " style="text-align: justify">
                                Consultation et gestion de vos contrats, téléchargement d’une attestation, échanges avec YAKO AFRICA ASSURANCES VIE...
                            </p>
                            <p class="text-white" style="text-align: justify">
                                Vous avez la main.
                            </p>
                        </div>
                    </div>
                    <div class="icon"><a href="tel:0123456789" class="btn">
                        <i class="flaticon-phone-call"></i>&nbsp; +225 27 20 33 15 00
                    </a></div> 
                </div>
            </div>
        </div>
        <br><br>
        
        <div class="row modif-pencil">
            
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <a href="#" data-bs-toggle="modal" data-bs-target="#addFile" class="d-block"> 
                    <i class="fa fa-pencil fs-6 pencil" style="float:right" aria-hidden="true"></i>
                </a>
                <div class="accordion-item bg-white modif">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Modèles de courrier PDF
                    </button>
                  </h2>
                  <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <a href="{{ asset('assets/img/images/courrier/courrier1.pdf')}}" target="_blank">
                                    <img src="{{ asset('assets/img/images/courrier/courrier1.jpg')}}" alt="courrier1" class="img-fluid">
                                    <p>Courrier 1</p>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ asset('assets/img/images/courrier/courrier2.pdf')}}" target="_blank">
                                    <img src="{{ asset('assets/img/images/courrier/courrier2.jpg')}}" alt="courrier2" class="img-fluid">
                                    <p>Courrier 2</p>
                                </a>
                            </div>
                        </div> --}} 
                        <table class="table table-striped  table-hover">
                            <thead class="text-center">
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Courrier</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($courriers as $courrier)
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
        </div>
    </div>
</section>
@endsection