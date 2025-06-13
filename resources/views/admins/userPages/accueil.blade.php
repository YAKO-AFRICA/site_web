@extends('admins.layouts.main')
@section('content-admin')
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
                                <p>Assurer vos proches pour un avenir sérain</p>
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
        <div class="row px-0 mx-0 gap-lg-5 gap-md-2 gap-sm-2">
            @forelse($reseaux as $reseau)
            <div class="card-services-type-01 row col-lg-5 col-md-12 col-sm-12 p-0 mx-0">
                <div class="col-sm-12 col-md-6 px-0 mx-0 rounded-4" style="background-image: url('{{ asset('images/ReseauDist/'.$reseau->image)}}'); background-size:cover; background-position:center; background-repeat:no-repeat;">
                </div>
                <div class="col-sm-12 col-md-6 py-3">
                    <h2 class="title">{{$reseau->label ?? "N/A"}}</h2>
                    <p>{!! $reseau->description ?? "N/A" !!}</p>
                    <a href="" class="btn-prime">Découvrez</a>
                    
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</section>
 <!-- about-area -->
 <section class="about__area-eight" id="expertise">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 col-md-9 mb-40">
                <div class="about__img-wrap-seven about__img-wrap-home8">
                    <img src="{{ asset('assets/img/images/expertise1.jpg')}}" class="img-main" alt="expertise">
                    <div class="shape">
                        <img src="{{ asset('assets/img/home8/dot-square.png')}}" alt="" class="ribbonRotate">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-40">
                <div class="about__content-seven">
                    <div class="section-title mb-25">
                        <span class="sub-title">Nos expertises</span>
                        <h2 class="title wow"><span>Dans le domaine de l'assurance .</span></h2>
                    </div>
                    <p>YAKO AFRICA ASSURANCES VIE COTE D’IVOIRE c’est une expertise avérée dans le métier de l’assurance vie </p>
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
                    <a href="{{ route('home.about') }}#a_propos" class="btn btn-two">Plus d'infos</a>
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
                            <h2 class="title"><a href="">Notre Vision</a></h2>
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
                            <h2 class="title"><a href="">Notre Mission</a></h2>
                        </div>
                    </div>
                    <div class="services__content-three">
                        <p>Donner à la population les moyens, solutions innovantes et abouties afin de laur permettre de se reprendre et surmonter toute déconvenue.</p>
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
                            <h2 class="title"><a href="services-details">Nos Valeurs</a></h2>
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
<section class="testimonial__area-thre testimonial__bg" id="temoignage" data-background="assets/img/bg/h3_testimonial_bg.jpg">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-6">
                <div class="section-title text-center mb-50 tg-heading-subheading animation-style3">
                    <span class="sub-title">CEUX QUI NOUS FONT CINFIANCES</span>
                    <h2 class="title tg-element-title size_14">Temoignage de nos clients</h2>
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
                                    <p> {{$temoignage->contenu ?? "N/A"}} </p>
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

 <!-- brand-area -->
 @include('users.layouts.partners-slider')
@endsection