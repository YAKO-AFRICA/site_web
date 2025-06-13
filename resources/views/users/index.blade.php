@extends('users.layouts.main')
@section('content')
<!-- slider-area -->
<section class="container-fluid border slider__area-home8 p-0 m-0">
    
    <div class="swiper-container slider_baner__active slider_baner_home8">
        <div class="swiper-wrapper">
            <div class="swiper-slide slider__single">
                <div class="slider__bg" data-background="{{ asset('assets/img/home8/slider01.jpg')}}"></div>
                <div class="container">
                    <div class="row m-auto text-center">
                        <div class="col-lg-12">
                            <div class="banner__content-three">
                                <h2 class="title">YAKO<span> c'est l'expression africaine de l'assurance</span></h2>
                                <p>Nous nous réinventons pour mieux vous servir</p>
                                <a href="{{ route('home.about') }}#contact" class="btn">nous contacter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide slider__single">
                <div class="slider__bg" data-background="{{ asset('assets/img/home8/slider02.jpg')}}"></div>
                <div class="container">
                    <div class="row m-auto text-center">
                        <div class="col-lg-12">
                            <div class="banner__content-three">
                                <h2 class="title">YAKO<span> c'est la solidarité</span></h2>
                                <p>Assurez vous et vos proches pour un avenir serein</p>
                                <a href="{{ route('home.about') }}#contact" class="btn">nous contacter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-button-slider-bottom">
        <div class="testimonial__nav-four">
            <div class="testimonial-two-button-prev button-swiper-prev"><i class="flaticon-right-arrow"></i></div>
            <div class="testimonial-two-button-next button-swiper-next"><i class="flaticon-right-arrow"></i></div>
        </div>
    </div>
</section>
<!-- slider-area-end -->
<section class="services__area-home8">
    <div class="container">
        {{-- <div class="row">
            <div class="col-lg-1"></div> --}}
            <div class="row px-0 mx-0 gap-lg-4 gap-md-2 gap-sm-2 justify-content-center align-item-center">
           
                @forelse($reseaux as $reseau)
                <div class="card-services-type-01 row col-lg-5 col-md-12 col-sm-12 p-0 mx-0">
                    <div class="col-sm-12 col-md-6 px-0 mx-0 rounded-4" style="background-image: url('{{ asset('images/ReseauDist/'.$reseau->image)}}'); background-size:cover; background-position:center; background-repeat:no-repeat;">
                    </div>
                    <div class="col-sm-12 col-md-6 py-3 text-center">
                        <h2 class="title">{{$reseau->label ?? "N/A"}}</h2>
                        <p>
                            {!! $reseau->description ?? "N/A" !!}
                        </p>
                        {{-- <a href="{{ route('home.reseaux.products', $reseau->uuid) }}" class="btn-prime">Découvrez</a> --}}
                        <a href="javascript:void(0)" onclick="reseauVisitedForm('{{$reseau->uuid}}', '{{ route('home.reseaux.products', $reseau->uuid) }}')" class="btn-prime">
                           Découvrez 
                        </a>
                    </div>
                </div>
                @endforeach
    
            {{-- </div>
            <div class="col-lg-1"></div> --}}
        </div>
        
    </div>
</section>
 <!-- about-area -->
 <section class="about__area-eight" id="expertise">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-5 col-md-9 mb-40">
                <div class="about__img-wrap-seven about__img-wrap-home8">
                    <img src="{{ asset('assets/img/images/experience.jpg')}}" class="img-main" alt="expertise">
                    <div class="card-number-star">
                        <div class="number">
                            <span class="text-stroke-2">21</span>
                            <div class="rates">
                                <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="../www.w3.org/2000/svg.html">
                                    <path d="M6.29986 10.0531L3.24609 11.8876C3.11118 11.9732 2.97014 12.0099 2.82297 11.9977C2.6758 11.9855 2.54703 11.9366 2.43665 11.8509C2.32628 11.7653 2.24043 11.6584 2.17911 11.5303C2.11779 11.4016 2.10552 11.2578 2.14231 11.0988L2.95175 7.63157L0.247503 5.30174C0.124861 5.19167 0.0483328 5.06619 0.0179177 4.9253C-0.0129879 4.7849 -0.00391252 4.64743 0.0451441 4.5129C0.0942007 4.37837 0.167786 4.2683 0.265899 4.18269C0.364012 4.09708 0.498918 4.04204 0.670616 4.01758L4.23948 3.70571L5.6192 0.440283C5.68052 0.293522 5.77569 0.183451 5.90471 0.110071C6.03324 0.0366903 6.16496 0 6.29986 0C6.43477 0 6.56673 0.0366903 6.69575 0.110071C6.82428 0.183451 6.9192 0.293522 6.98052 0.440283L8.36024 3.70571L11.9291 4.01758C12.1008 4.04204 12.2357 4.09708 12.3338 4.18269C12.4319 4.2683 12.5055 4.37837 12.5546 4.5129C12.6036 4.64743 12.613 4.7849 12.5825 4.9253C12.5516 5.06619 12.4749 5.19167 12.3522 5.30174L9.64797 7.63157L10.4574 11.0988C10.4942 11.2578 10.4819 11.4016 10.4206 11.5303C10.3593 11.6584 10.2734 11.7653 10.1631 11.8509C10.0527 11.9366 9.92392 11.9855 9.77675 11.9977C9.62958 12.0099 9.48854 11.9732 9.35363 11.8876L6.29986 10.0531Z" fill="#FFB930" />
                                </svg>
                                <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="../www.w3.org/2000/svg.html">
                                    <path d="M6.29986 10.0531L3.24609 11.8876C3.11118 11.9732 2.97014 12.0099 2.82297 11.9977C2.6758 11.9855 2.54703 11.9366 2.43665 11.8509C2.32628 11.7653 2.24043 11.6584 2.17911 11.5303C2.11779 11.4016 2.10552 11.2578 2.14231 11.0988L2.95175 7.63157L0.247503 5.30174C0.124861 5.19167 0.0483328 5.06619 0.0179177 4.9253C-0.0129879 4.7849 -0.00391252 4.64743 0.0451441 4.5129C0.0942007 4.37837 0.167786 4.2683 0.265899 4.18269C0.364012 4.09708 0.498918 4.04204 0.670616 4.01758L4.23948 3.70571L5.6192 0.440283C5.68052 0.293522 5.77569 0.183451 5.90471 0.110071C6.03324 0.0366903 6.16496 0 6.29986 0C6.43477 0 6.56673 0.0366903 6.69575 0.110071C6.82428 0.183451 6.9192 0.293522 6.98052 0.440283L8.36024 3.70571L11.9291 4.01758C12.1008 4.04204 12.2357 4.09708 12.3338 4.18269C12.4319 4.2683 12.5055 4.37837 12.5546 4.5129C12.6036 4.64743 12.613 4.7849 12.5825 4.9253C12.5516 5.06619 12.4749 5.19167 12.3522 5.30174L9.64797 7.63157L10.4574 11.0988C10.4942 11.2578 10.4819 11.4016 10.4206 11.5303C10.3593 11.6584 10.2734 11.7653 10.1631 11.8509C10.0527 11.9366 9.92392 11.9855 9.77675 11.9977C9.62958 12.0099 9.48854 11.9732 9.35363 11.8876L6.29986 10.0531Z" fill="#FFB930" />
                                </svg>
                                <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="../www.w3.org/2000/svg.html">
                                    <path d="M6.29986 10.0531L3.24609 11.8876C3.11118 11.9732 2.97014 12.0099 2.82297 11.9977C2.6758 11.9855 2.54703 11.9366 2.43665 11.8509C2.32628 11.7653 2.24043 11.6584 2.17911 11.5303C2.11779 11.4016 2.10552 11.2578 2.14231 11.0988L2.95175 7.63157L0.247503 5.30174C0.124861 5.19167 0.0483328 5.06619 0.0179177 4.9253C-0.0129879 4.7849 -0.00391252 4.64743 0.0451441 4.5129C0.0942007 4.37837 0.167786 4.2683 0.265899 4.18269C0.364012 4.09708 0.498918 4.04204 0.670616 4.01758L4.23948 3.70571L5.6192 0.440283C5.68052 0.293522 5.77569 0.183451 5.90471 0.110071C6.03324 0.0366903 6.16496 0 6.29986 0C6.43477 0 6.56673 0.0366903 6.69575 0.110071C6.82428 0.183451 6.9192 0.293522 6.98052 0.440283L8.36024 3.70571L11.9291 4.01758C12.1008 4.04204 12.2357 4.09708 12.3338 4.18269C12.4319 4.2683 12.5055 4.37837 12.5546 4.5129C12.6036 4.64743 12.613 4.7849 12.5825 4.9253C12.5516 5.06619 12.4749 5.19167 12.3522 5.30174L9.64797 7.63157L10.4574 11.0988C10.4942 11.2578 10.4819 11.4016 10.4206 11.5303C10.3593 11.6584 10.2734 11.7653 10.1631 11.8509C10.0527 11.9366 9.92392 11.9855 9.77675 11.9977C9.62958 12.0099 9.48854 11.9732 9.35363 11.8876L6.29986 10.0531Z" fill="#FFB930" />
                                </svg>
                                <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="../www.w3.org/2000/svg.html">
                                    <path d="M6.29986 10.0531L3.24609 11.8876C3.11118 11.9732 2.97014 12.0099 2.82297 11.9977C2.6758 11.9855 2.54703 11.9366 2.43665 11.8509C2.32628 11.7653 2.24043 11.6584 2.17911 11.5303C2.11779 11.4016 2.10552 11.2578 2.14231 11.0988L2.95175 7.63157L0.247503 5.30174C0.124861 5.19167 0.0483328 5.06619 0.0179177 4.9253C-0.0129879 4.7849 -0.00391252 4.64743 0.0451441 4.5129C0.0942007 4.37837 0.167786 4.2683 0.265899 4.18269C0.364012 4.09708 0.498918 4.04204 0.670616 4.01758L4.23948 3.70571L5.6192 0.440283C5.68052 0.293522 5.77569 0.183451 5.90471 0.110071C6.03324 0.0366903 6.16496 0 6.29986 0C6.43477 0 6.56673 0.0366903 6.69575 0.110071C6.82428 0.183451 6.9192 0.293522 6.98052 0.440283L8.36024 3.70571L11.9291 4.01758C12.1008 4.04204 12.2357 4.09708 12.3338 4.18269C12.4319 4.2683 12.5055 4.37837 12.5546 4.5129C12.6036 4.64743 12.613 4.7849 12.5825 4.9253C12.5516 5.06619 12.4749 5.19167 12.3522 5.30174L9.64797 7.63157L10.4574 11.0988C10.4942 11.2578 10.4819 11.4016 10.4206 11.5303C10.3593 11.6584 10.2734 11.7653 10.1631 11.8509C10.0527 11.9366 9.92392 11.9855 9.77675 11.9977C9.62958 12.0099 9.48854 11.9732 9.35363 11.8876L6.29986 10.0531Z" fill="#FFB930" />
                                </svg>
                                <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="../www.w3.org/2000/svg.html">
                                    <path d="M6.29986 10.0531L3.24609 11.8876C3.11118 11.9732 2.97014 12.0099 2.82297 11.9977C2.6758 11.9855 2.54703 11.9366 2.43665 11.8509C2.32628 11.7653 2.24043 11.6584 2.17911 11.5303C2.11779 11.4016 2.10552 11.2578 2.14231 11.0988L2.95175 7.63157L0.247503 5.30174C0.124861 5.19167 0.0483328 5.06619 0.0179177 4.9253C-0.0129879 4.7849 -0.00391252 4.64743 0.0451441 4.5129C0.0942007 4.37837 0.167786 4.2683 0.265899 4.18269C0.364012 4.09708 0.498918 4.04204 0.670616 4.01758L4.23948 3.70571L5.6192 0.440283C5.68052 0.293522 5.77569 0.183451 5.90471 0.110071C6.03324 0.0366903 6.16496 0 6.29986 0C6.43477 0 6.56673 0.0366903 6.69575 0.110071C6.82428 0.183451 6.9192 0.293522 6.98052 0.440283L8.36024 3.70571L11.9291 4.01758C12.1008 4.04204 12.2357 4.09708 12.3338 4.18269C12.4319 4.2683 12.5055 4.37837 12.5546 4.5129C12.6036 4.64743 12.613 4.7849 12.5825 4.9253C12.5516 5.06619 12.4749 5.19167 12.3522 5.30174L9.64797 7.63157L10.4574 11.0988C10.4942 11.2578 10.4819 11.4016 10.4206 11.5303C10.3593 11.6584 10.2734 11.7653 10.1631 11.8509C10.0527 11.9366 9.92392 11.9855 9.77675 11.9977C9.62958 12.0099 9.48854 11.9732 9.35363 11.8876L6.29986 10.0531Z" fill="#FFB930" />
                                </svg>
                            </div>
                        </div>
                        <div class="content ">
                            <h2 class="title">Années d'Experience</h2>
                            <p>ont servi à bâtir avec vous, une relation de confiance consolidée par l’innovation</p>
                        </div>
                    </div>
                    <div class="shape">
                        <img src="{{ asset('assets/img/home8/dot-square.png')}}" alt="" class="ribbonRotate">
                    </div>
                </div>
            </div>
            <div class="col-lg-7 mb-40">
                <div class="about__content-seven">
                    <div class="section-title mb-25">
                        <span class="sub-title">Nos expertises</span>
                        <h2 class="title wow"><span>Dans le domaine de l'assurance .</span></h2>
                    </div>
                    <p>YAKO AFRICA Assurances Vie c’est une expertise avérée dans le métier de l’assurance vie </p>
                    <div class="about__content-inner-five">
                       
                        <div class="about__list-box">
                            <ul class="list-wrap">
                                <div class="row" >
                                    @foreach($products as $product)
                                    <div class="col-6">
                                        <li><i class="flaticon-arrow-button mb-3"></i>{{$product->label ?? "N/A"}}</li>
                                    </div>
                                    @endforeach
                                </div>
                                
                            </ul>
                        </div>
                    </div>
                    <a href="javascript:void(0)" onclick="reseauVisitedForm('Qui sommes nous', '{{ route('home.about') }}#a_propos')" class="btn btn-two">Découvrir plus </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about-area-end -->
 <!-- services-area -->
<section class="services__area-four services__bg-four" data-background="assets/img/bg/inner_services_bg.jpg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center mb-50">
                    <span class="sub-title">Notre ADN </span>
                    <h2 class="" style="font-size: 22px">Assureur de métier, solidaire de nature</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center gutter-24">
            <div class="col-lg-4 col-md-6">
                <div class="services__item-three" style="min-height: 300px">
                    <div class="services__item-top">
                        <div class="services__icon-three">
                            <i class="flaticon-profit"></i>
                        </div>
                        <div class="services__item-top-title">
                            <h2 class="title">Notre Vision</h2>
                        </div>
                    </div>
                    <div class="services__content-three">
                        <p>Donner à la population les possibilités de surmonter les imprévus et les moments dificiles.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="services__item-three" style="min-height: 300px">
                    <div class="services__item-top">
                        <div class="services__icon-three">
                            <i class="flaticon-target"></i>
                        </div>
                        <div class="services__top-title">
                            <h2 class="title">Notre Mission</h2>
                        </div>
                    </div>
                    <div class="services__content-three">
                        <p>Donner à la population les moyens, solutions innovantes et abouties afin de leur permettre de se reprendre et surmonter toute déconvenue.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="services__item-three" style="min-height: 300px">
                    <div class="services__item-top">
                        <div class="services__icon-three">
                            <i class="flaticon-financial-profit"></i>
                        </div>
                        <div class="services__top-title">
                            <h2 class="title">Nos Valeurs</h2>
                        </div>
                    </div>
                    <div class="services__content-three">
                        <div class="about__list-box row">
                            <ul class="list-wrap col">
                                <li><i class="fas fa-check"></i>La Confiance</li>
                                <li><i class="fas fa-check"></i>La Loyauté</li>
                                <li><i class="fas fa-check"></i>La Proximité</li>
                            </ul>
                            <ul class="list-wrap col">
                                <li><i class="fas fa-check"></i>L'Innovation</li> 
                                <li><i class="fas fa-check"></i>Le Partage</li> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="services__shape-wrap-two">
        <img src="assets/img/services/inner_services_shape01.png" alt="" data-aos="fade-right" data-aos-delay="400">
        <img src="assets/img/services/inner_services_shape02.png" alt="" data-aos="fade-left" data-aos-delay="400">
    </div>
</section>
<!-- services-area-end -->
<!-- testimonial-area -->
<section class="testimonial__area-three testimonial__bg" id="temoignage" data-background="assets/img/bg/h3_testimonial_bg.jpg">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-6">
                <div class="section-title text-center mb-50 tg-heading-subheading animation-style3">
                    <span class="sub-title">CEUX QUI NOUS FONT CONFIANCE</span>
                    <h2 class="title tg-element-title size_14">Témoignages de nos clients</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="testimonial__img-wrap-two">
                    <img src="{{ asset('assets/img/images/feature.png')}}" style="border-radius: 50%; height:400px; width:400px; object-fit: cover;" alt="">
                    <div class="testimonial__img-shape-two">
                        <img src="assets/img/images/h3_testimonial_shape01.png" alt="" class="alltuchtopdown">
                        <img src="assets/img/images/h3_testimonial_shape02.png" alt="" class="rotateme">
                        <img src="assets/img/images/h3_testimonial_shape03.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="testimonial__item-wrap">
                    <div class="swiper-container testimonial-active-two">
                        <div class="swiper-wrapper">
                            @foreach($temoignages as $temoignage)
                                
                            <div class="swiper-slide">
                                <div class="testimonial__item-three">
                                    <div class="testimonial__rating testimonial__rating-two">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p style="text-align: justify"> {!! $temoignage->contenu ?? "N/A" !!} </p>
                                    <div class="testimonial__bottom">
                                        <div class="testimonial__info-three">
                                            <h4 class="title">{{$temoignage->nom ?? "N/A"}}</h4>
                                            <span>{{$temoignage->fonction ?? "N/A"}}</span>
                                        </div>
                                        <div class="testimonial__icon">
                                            <img src="assets/img/icon/quote02.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <div class="testimonial__nav-two">
                            <div class="testimonial-button-prev"><i class="flaticon-right-arrow"></i></div>
                            <div class="testimonial-button-next"><i class="flaticon-right-arrow"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- testimonial-area-end -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Actualitiés</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-inner">
                        
                        @foreach($actualities as $actuality)
                        <h5 class="mb-3">{!! Str::words($actuality->title,10,"...") ?? "N/A" !!}</h5>
                            @foreach($actuality->postImage as $key => $image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="max-height: 50vh">
                            <a href="javascript:void(0)" onclick="submitVisitedForm('{{$actuality->uuid}}', '{{ route('home.actuality.details', $actuality->uuid) }}')"> 
                            {{-- <a href="{{ route('home.actuality.details', $actuality->uuid) }}">  --}}
                                    {{-- @if($loop->first) --}}
                                    {{-- <img src="http://yakoafrica_live.test/images/Actualities/10caecb3-3b50-4d23-b421-b1add9540216.jpg" style="min-height: 100%" class="d-block w-100" alt="..."> --}}
                                    <img src="{{ asset('/images/Actualities/'.$image->image_url)}}" style="max-height: 60vh" class="d-block w-100" alt="...">
                                    {{-- @endif --}}
                                </a>
                            </div>
                            @endforeach
                                            
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                @foreach($actualities as $actuality)
                <div class="p-3" style="background-color: #f4f4f4e7 !important; border-radius:10px">
                    {{-- <h5 class="text-white">{{Str::limit($actuality->title,40,"...") ?? "N/A"}}</h5> --}}
                    {{-- <div class=""> --}}
                        {{-- {!! (Str::limit($actuality->comment,65,"...") ?? "N/A") !!} --}}
                        <p style="color: #fff !important" class="text-white">{!! Str::words($actuality->comment, 20, "...") ?? "N/A" !!}</p>
                    {{-- </div> --}}
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-prime btn-prime-two" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

  
 <!-- brand-area -->
 @include('users.layouts.partners-slider')
<!-- brand-area -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Déclencher automatiquement le modal au chargement de la page
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {});
        myModal.show();
    });
</script>
<script>
    function submitVisitedForm(uuid, redirectUrl) {
        // Récupérer le formulaire
        const form = document.getElementById('visitedForm');

        // Remplir le champ `uuid_activity` avec la valeur passée
        form.querySelector('input[name="uuid_activity"]').value = uuid;

        // Créer un objet FormData à partir du formulaire
        const formData = new FormData(form);

        // Soumettre le formulaire via AJAX
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // Indique que c'est une requête AJAX
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Une erreur s\'est produite lors de l\'envoi du formulaire.');
            }
            return response.json();
        })
        .then(data => {
            console.log('Formulaire soumis avec succès:', data);

            // Rediriger l'utilisateur vers l'URL de détails
            window.location.href = redirectUrl;
        })
        .catch(error => {
            console.error('Erreur lors de la soumission du formulaire:', error);
            alert('Une erreur est survenue. Veuillez réessayer.');
        });
    }
</script>
@endsection