@extends('users.layouts.main')
@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="breadcrumb__content">
                        <h2 class="title">Produit Retraite</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Produit</li>
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
    <!-- services-area -->
    <section class="services__area-six services__bg-six" id="service" style="background-color: #076835;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title white-title mb-40">
                        <span class="sub-title">Lorem ipsum dolor sit.</span>
                        <h2 class="title">Lorem, ipsum.
                            <br>Lorem ipsum dolor sit amet.</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- <div class="section-more-btn">
                        <a href="services" class="btn border-btn">See More Services</a>
                    </div> -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="services__tab-wrap">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" style="text-align: center;" role="presentation">
                                <a class="nav-link active" id="health-tab" data-bs-toggle="tab" data-bs-target="#health-tab-pane" type="button" role="tab" aria-controls="health-tab-pane" aria-selected="true">Cadence Retraite</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link border" style="text-align: left;" id="travel-tab" data-bs-toggle="tab" data-bs-target="#travel-tab-pane" type="button" role="tab" aria-controls="travel-tab-pane" aria-selected="false">Complémentaire</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="health-tab-pane" role="tabpanel" aria-labelledby="health-tab" tabindex="0">
                                <div class="services__item-four shine-animate-item">
                                    <div class="services__thumb-four shine-animate">
                                        <img src="{{ asset('assets/img/services/h3_services_img01.jpg')}}" alt="">
                                    </div>
                                    <div class="services__content-four">
                                        <h2 class="title"><a href="{{ route('home.formule_product.details') }}">Cadence Retraite</a></h2>
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore, sint iure veniam vel quod saepe optio ipsum...</p>
                                        <div class="about__list-box">
                                            <small>Uniquement pour les</small>
                                            <ul class="list-wrap">
                                                <li><i class="fas fa-check"></i>Particuliers</li>
                                            </ul>
                                        </div>
                                        <a href="{{ route('home.formule_product.details') }}" class="btn">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="travel-tab-pane" role="tabpanel" aria-labelledby="travel-tab" tabindex="0">
                                <div class="services__item-four shine-animate-item">
                                    <div class="services__thumb-four shine-animate">
                                        <img src="{{ asset('assets/img/services/h3_services_img02.jpg')}}" alt="">
                                    </div>
                                    <div class="services__content-four">
                                        <h2 class="title"><a href="services-details.html">Cadence Retraite Complémentaire</a></h2>
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore, sint iure veniam vel quod saepe optio ipsum...</p>
                                        <div class="about__list-box">
                                            <small>Uniquement pour les :</small>
                                            <ul class="list-wrap">
                                                <li><i class="fas fa-check"></i>Entreprises</li>
                                            </ul>
                                        </div>
                                        <a href="services-details.html" class="btn">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- services-area-end -->
    <!-- contact-area-end -->
     <!-- brand-area -->
     @include('users.layouts.partners-slider')
    <!-- call-back-area-end -->
@endsection