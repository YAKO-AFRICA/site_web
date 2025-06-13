@extends('users.layouts.main')
@section('content')
<!-- breadcrumb-area -->
<section class="breadcrumb__area breadcrumb__bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="breadcrumb__content">
                    <h2 class="title">Qui sommes nous</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Qui sommes nous</li>
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
<!-- breadcrumb-area-end -->
<section style="background-color: #F5FBFB;" class="about__area-three about__bg-two py-5" id="story">
    <div class="container">
        <div class="row justify-content-cente"> 
            <div class="col-lg-12">
                @if($aboutHist && $aboutHist->image)    
                <img src="{{ asset('images/AboutPage/'.$aboutHist->image) }}" class="img-main img-fluid" alt="historique YAKO Africa">
                @else  
                <img src="{{ asset('assets/img/images/historique.png')}}" class="img-main img-fluid" alt="historique YAKO Africa">
                @endif
                
            </div>
        </div>
        <div class="row justify-content-center">           
            <div class="col-lg-12">
                <div class="about__content-seven">
                    @if($aboutHist && $aboutHist->content)    
                    <p style="text-align: justify;">{!! ($aboutHist->content) ?? "N/A" !!}</p>
                @else  
                <p>Aucune disponible</p>
                @endif
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about-area-end -->
<section class="about__area-four py-5 my-5" id="mot_pca">
    <div class="container px-0">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-9 col-sm-10 mb-30">
                    <div class="about__img-wrap-four about__img-wrap-home8">
                        @if($aboutMotPCA && $aboutMotPCA->image)    
                    <img src="{{ asset('images/AboutPage/'.$aboutMotPCA->image) }}"  alt="PCA YAKO Africa">
                    @else  
                    <img src="{{ asset('assets/img/images/PCA.jpg')}}" alt="">
                    @endif
                    <div class="shape">
                        <img src="{{ asset('assets/img/home8/shape-circle.png')}}" alt="" class="alltuchtopdown">
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-30">
                <div class="about__content-four container">
                    <div class="section-title mb-30">
                        <p class="sub-title">Mot du PCA</p>
                        
                        @if($aboutMotPCA && $aboutMotPCA->nomPCA)    
                        <span class="title sub-titl" style="text-align: justify;">{{$aboutMotPCA->nomPCA}}</span>
                        @else  
                        <p>Non disponible</p>
                        @endif
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                @if($aboutMotPCA && $aboutMotPCA->content)    
                                    <p style="text-align: justify;">{!! ($aboutMotPCA->content) ?? "N/A" !!}</p>
                                @else  
                                <p>Aucune disponible</p>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- counter-area -->
<section class="counter-area py-5" id="chiffre_cle">
    <div class="container">
        <div class="row justify-content-center text-center mb-3">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="counter-item">
                    <div class="icon m-auto"> 
                        <img src="{{ asset('assets/img/icon/capital-risque.png')}}" width="85px" height="85px" alt="icon">
                        {{-- <i class="flaticon-trophy"></i> --}}
                    </div>
                </div>
                <div class="counter-item">
                    <div class="content w-100">
                        <h2 class="">Capital social</h2>
                        <p class="count text-center m-auto p-0" style="font-size: 1.2em; font-weight: normal; width:46%"><span class="odometer" data-count="3"></span>M+ FCFA</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="counter-item">
                    <div class="icon m-auto">
                        {{-- <i class="flaticon-happy"></i> --}}
                        <img src="{{ asset('assets/img/icon/equipe.png')}}" width="85px" height="85px" alt="icon">
                    </div>
                </div>
                <div class="counter-item">
                    <div class="content w-100">
                        <h2 class="">Collaborateurs</h2>
                        <p class="count  m-auto" style="font-size: 1.2em; font-weight: normal; width:46%"><span class="odometer text-center" data-count="312"></span> &nbsp; staffs</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="counter-item">
                    <div class="icon m-auto">
                        {{-- <i class="flaticon-time"></i> --}}
                        <img src="{{ asset('assets/img/icon/famille.png')}}" width="85px" height="85px" alt="icon">
                    </div>
                </div>
                <div class="counter-item">
                    <div class="content w-100">
                        <h2 class="">Familles assistées</h2>
                        <p class="count  m-auto" style="font-size: 1.2em; font-weight: normal; width:46%">+<span class="odometer" data-count="25"></span>K</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="counter-item">
                    <div class="icon m-auto">
                        {{-- <i class="flaticon-trophy"></i> --}}
                        <img src="{{ asset('assets/img/icon/prestations.png')}}" width="85px" height="85px" alt="icon">
                    </div>
                </div>
                <div class="counter-item m-auto">
                    <div class="content w-100">
                        <h2 class="">Prestations payées</h2>
                        <p class="count  m-auto" style="font-size: 1.2em; font-weight: normal; width:46%"><span class="odometer" data-count="51"></span>M+ FCFA</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="counter-item">
                    <div class="icon m-auto">
                        {{-- <i class="flaticon-happy"></i> --}}
                        <img src="{{ asset('assets/img/icon/argent.png')}}" width="85px" height="85px" alt="icon">
                    </div>
                </div>
                <div class="counter-item">
                    <div class="content w-100">
                        <h2 class="">Chiffre d'affaires</h2>
                        <p class="count  m-auto" style="font-size: 1.2em; font-weight: normal; width:46%">+<span class="odometer" data-count="10"></span> M+ FCFA</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="counter-item">
                    <div class="icon m-auto">
                        {{-- <i class="flaticon-china" width="85px" height="85px"></i> --}}
                        <img src="{{ asset('assets/img/icon/cote-divoire.png')}}" width="85px" height="85px" alt="icon">
                        
                    </div>
                </div>
                <div class="counter-item">
                    <div class="content w-100">
                        <h2 class="count  m-auto" style="width:46%"><span class="odometer" data-count="14"></span>+</h2>
                        <p>Nous sommes disponibles <br> partout sur le territoire ivoirien</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="counter-item">
                    <div class="icon m-auto">
                        {{-- <i class="flaticon-china"></i> --}}
                        <img src="{{ asset('assets/img/icon/preuves.png')}}" width="85px" height="85px" alt="icon">
                    </div>
                </div>
                <div class="counter-item">
                    <div class="content w-100">
                        <h2 class="">Preuve sociale</h2>
                        <p class="count  m-auto" style="font-size: 1.2em; font-weight: normal; width:46%">+<span class="odometer" data-count="400"></span> &nbsp;K</p>
                        <p>Souscriptions Particuliers et Entreprises</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="counter-item">
                    <div class="icon m-auto">
                        {{-- <i class="flaticon-time"></i> --}}
                        <img src="{{ asset('assets/img/icon/solvabilite.png')}}" width="85px" height="85px" alt="icon">
                    </div>
                </div>
                <div class="counter-item">
                    <div class="content w-100">
                        <h2 class="">Solvabilité</h2>
                        <p>Marge de Solvabilité</p>
                        <p class="count  m-auto mb-3" style="font-size: 1.2em; font-weight: normal; width:46%"><span class="odometer" data-count="5"></span>.5M+ FCFA</p>
                        <p>Couverture des Engagements</p>
                        <p class="count  m-auto mb-3" style="font-size: 1.2em; font-weight: normal; width:46%"><span class="odometer" data-count="127"></span>%</p>
                        <p>Total Bilan</p>
                        <p class="count  m-auto" style="font-size: 1.2em; font-weight: normal; width:46%"><span class="odometer" data-count="36"></span>.7M+ FCFA</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="counter-shape-wrap">
        <img src="{{ asset('assets/img/images/counter_shape01.png')}}" alt="" data-aos="fade-right" data-aos-delay="400">
        <img src="{{ asset('assets/img/images/counter_shape02.png')}}" alt="" data-parallax='{"x" : 100 , "y" : -100 }'>
        <img src="{{ asset('assets/img/images/counter_shape03.png')}}" alt="" data-aos="fade-left" data-aos-delay="400">
    </div>
</section>

<!-- team-area -->
<section class="team-area py-5 pb-90" id="team">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-7 col-lg-6">
                <div class="section-title mb-50 tg-heading-subheading animation-style3">
                    <span class="sub-title">RENCONTREZ NOTRE ÉQUIPE</span>
                    <h2 class="title tg-element-title">Une expertise en assurance à laquelle vous pouvez faire <br>confiance</h2>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6">
                <div class="section-content">
                    <p style="text-align: justify">Notre équipe d'experts met à votre disposition une vaste expérience dans le domaine de l'assurance. Que ce soit pour protéger vos biens ou garantir votre avenir, nous vous offrons des solutions fiables, adaptées à vos besoins spécifiques, ainsi qu'un accompagnement de confiance à chaque étape de votre vie.</p>
                </div>
            </div>
        </div>
            <!-- Button trigger modal -->
            @if(($DGs || $PCA || $teams || $teams2) && $DGA)
            <div class="team-item-wrap">
                @if($PCA)
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$PCA->uuid}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-md-5 p-3" style="border-right:#C1C1C1 solid 1px">
                                
                                    <img src="{{ asset('images/Teams/'.$PCA->team_image) }}" alt="" class="img-fluid">
                                
                                <div class="team-content">
                                    <h4 class="title text-center">{{$PCA->team_name}}</h4>
                                    <p class="text-center"><span>{{$PCA->team_fonction}}</span></p> 
                                    
                                </div>
                            </div>
                            <div class="col-md-7  p-2" style="text-align:justify;">
                                
                                {!! ($PCA->team_description) ?? "N/A" !!}
                                <br><br>
                                <p class="border mb-0"></p>
                                    <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" class="img-fluid d-block m-auto" style="max-width: 200px !important;">
                            </div>
                        </div>
                        <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                        <div class="team-item team-yako">
                            <div class="team-thumb">
                                <a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$PCA->uuid}}">
                                    <img src="{{ asset('images/Teams/'.$PCA->team_image) }}" alt="">
                                </a>
                                
                            </div>
                            <div class="team-content">
                                <h4 class="title text-center">
                                    <a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$PCA->uuid}}">{{$PCA->team_name}}</a></h4>
                                <span class="text-center">{{$PCA->team_fonction}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif 

                <div class="row justify-content-center">
                    @foreach($DGs as $DG)
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$DG->uuid}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-md-5 p-3" style="border-right:#C1C1C1 solid 1px">
                                    
                                        <img src="{{ asset('images/Teams/'.$DG->team_image) }}" alt="" class="img-fluid">
                                    
                                    <div class="team-content">
                                        <h4 class="title text-center">{{$DG->team_name}}</h4>
                                        <p class="text-center"><span>{{$DG->team_fonction}}</span></p> 
                                        
                                    </div>
                                </div>
                                <div class="col-md-7  p-2" style="text-align:justify;">
                                    
                                    {!! ($DG->team_description) ?? "N/A" !!}
                                    <br><br>
                                    <p class="border mb-0"></p>
                                        <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" class="img-fluid d-block m-auto" style="max-width: 200px !important;">
                                </div>
                            </div>
                            <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                            </div>
                        </div>
                        </div>
                    </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                            <div class="team-item team-yako">
                                <div class="team-thumb">
                                    <a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$DG->uuid}}">
                                        <img src="{{ asset('images/Teams/'.$DG->team_image) }}" alt="">
                                    </a>
                                    
                                </div>
                                <div class="team-content">
                                    <h4 class="title text-center">
                                        <a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$DG->uuid}}">{{$DG->team_name}}</a></h4>
                                    <span class="text-center">{{$DG->team_fonction}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach 
                </div>
                <div class="row justify-content-center">
                    @foreach($teams as $team)
                    <div class="modal fade" id="exampleModal{{$team->uuid}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-md-5 p-3" style="border-right:#C1C1C1 solid 1px">
                                    
                                        <img src="{{ asset('images/Teams/'.$team->team_image) }}" alt="" class="img-fluid">
                                    
                                    <div class="team-content">
                                        <h4 class="title text-center">{{$team->team_name}}</h4>
                                        <p class="text-center"><span>{{$team->team_fonction}}</span></p> 
                                    </div>
                                </div>
                                <div class="col-md-7  p-2" style="text-align:justify;">
                                    
                                    {!! ($team->team_description) ?? "N/A" !!}
                                    
                                    <br><br>
                                    <p class="border mb-0"></p>
                                        <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" class="img-fluid d-block m-auto" style="max-width: 200px !important;">
                                </div>
                            </div>
                            <div class="modal-footer">
                            {{-- <button type="button" class="btn-prime">Modifier</button> --}}
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-8">
                        <div class="team-item team-yako">
                            <div class="team-thumb">
                                <a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$team->uuid}}">
                                    <img src="{{ asset('images/Teams/'.$team->team_image) }}" alt="">
                                </a>
                            </div>
                            <div class="team-content">
                                <h4 class="title text-center"><a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$team->uuid}}">{{$team->team_name}}</a></h4>
                                <span class="text-center">{{$team->team_fonction}}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    @foreach($teams2 as $team2)
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$team2->uuid}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-md-5 p-3" style="border-right:#C1C1C1 solid 1px">
                                    
                                        <img src="{{ asset('images/Teams/'.$team2->team_image) }}" alt="" class="img-fluid">
                                    
                                    <div class="team-content">
                                        <h4 class="title text-center">{{$team2->team_name}}</h4>
                                        <p class="text-center"><span>{{$team2->team_fonction}}</span></p> 
                                        
                                    </div>
                                </div>
                                <div class="col-md-7  p-2" style="text-align:justify;">
                                    
                                    {!! ($team2->team_description) ?? "N/A" !!}
                                    <br><br>
                                    <p class="border mb-0"></p>
                                        <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" class="img-fluid d-block m-auto" style="max-width: 200px !important;">
                                </div>
                            </div>
                            <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                        <div class="team-item team-yako">
                            <div class="team-thumb">
                                <a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$team2->uuid}}">
                                    <img src="{{ asset('images/Teams/'.$team2->team_image) }}" alt="">
                                </a>
                                
                            </div>
                            <div class="team-content">
                                <h4 class="title text-center">
                                    <a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$team2->uuid}}">{{$team2->team_name}}</a></h4>
                                <span class="text-center">{{$team2->team_fonction}}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach 
                </div> 
            </div>
            @elseif($PCA || $teams1 || $teams2)
                
            <div class="team-item-wrap">
                @if($PCA)
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$PCA->uuid}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-md-5 p-3" style="border-right:#C1C1C1 solid 1px">
                                
                                    <img src="{{ asset('images/Teams/'.$PCA->team_image) }}" alt="" class="img-fluid">
                                
                                <div class="team-content">
                                    <h4 class="title text-center">{{$PCA->team_name}}</h4>
                                    <p class="text-center"><span>{{$PCA->team_fonction}}</span></p> 
                                    
                                </div>
                            </div>
                            <div class="col-md-7  p-2" style="text-align:justify;">
                                
                                {!! ($PCA->team_description) ?? "N/A" !!}
                                <br><br>
                                <p class="border mb-0"></p>
                                    <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" class="img-fluid d-block m-auto" style="max-width: 200px !important;">
                            </div>
                        </div>
                        <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                        <div class="team-item team-yako">
                            <div class="team-thumb">
                                <a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$PCA->uuid}}">
                                    <img src="{{ asset('images/Teams/'.$PCA->team_image) }}" alt="">
                                </a>
                                
                            </div>
                            <div class="team-content">
                                <h4 class="title text-center">
                                    <a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$PCA->uuid}}">{{$PCA->team_name}}</a></h4>
                                <span class="text-center">{{$PCA->team_fonction}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif 

                <div class="row justify-content-center">
                    @foreach($teams1 as $team1)
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$team1->uuid}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-md-5 p-3" style="border-right:#C1C1C1 solid 1px">
                                    
                                        <img src="{{ asset('images/Teams/'.$team1->team_image) }}" alt="" class="img-fluid">
                                    
                                    <div class="team-content">
                                        <h4 class="title text-center">{{$team1->team_name}}</h4>
                                        <p class="text-center"><span>{{$team1->team_fonction}}</span></p> 
                                        
                                    </div>
                                </div>
                                <div class="col-md-7  p-2" style="text-align:justify;">
                                    
                                    {!! ($team1->team_description) ?? "N/A" !!}
                                    <br><br>
                                    <p class="border mb-0"></p>
                                        <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" class="img-fluid d-block m-auto" style="max-width: 200px !important;">
                                </div>
                            </div>
                            <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                        <div class="team-item team-yako">
                            <div class="team-thumb">
                                <a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$team1->uuid}}">
                                    <img src="{{ asset('images/Teams/'.$team1->team_image) }}" alt="">
                                </a>
                                
                            </div>
                            <div class="team-content">
                                <h4 class="title text-center">
                                    <a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$team1->uuid}}">{{$team1->team_name}}</a></h4>
                                <span class="text-center">{{$team1->team_fonction}}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach 
                </div>
                <div class="row justify-content-center">
                    @foreach($teams2 as $team2)
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$team2->uuid}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-md-5 p-3" style="border-right:#C1C1C1 solid 1px">
                                    
                                        <img src="{{ asset('images/Teams/'.$team2->team_image) }}" alt="" class="img-fluid">
                                    
                                    <div class="team-content">
                                        <h4 class="title text-center">{{$team2->team_name}}</h4>
                                        <p class="text-center"><span>{{$team2->team_fonction}}</span></p> 
                                        
                                    </div>
                                </div>
                                <div class="col-md-7  p-2" style="text-align:justify;">
                                    
                                    {!! ($team2->team_description) ?? "N/A" !!}
                                    <br><br>
                                    <p class="border mb-0"></p>
                                        <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" class="img-fluid d-block m-auto" style="max-width: 200px !important;">
                                </div>
                            </div>
                            <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                        <div class="team-item team-yako">
                            <div class="team-thumb">
                                <a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$team2->uuid}}">
                                    <img src="{{ asset('images/Teams/'.$team2->team_image) }}" alt="">
                                </a>
                                
                            </div>
                            <div class="team-content">
                                <h4 class="title text-center">
                                    <a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$team2->uuid}}">{{$team2->team_name}}</a></h4>
                                <span class="text-center">{{$team2->team_fonction}}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach 
                </div> 
            </div>
            @else
                <div class="container">
                    <div class="text-center">
                        <h2>Aucun équipe ou département disponible pour le moment.</h2>
                    </div>
                </div>
            @endif
    </div>
</section>
<section class="contact__area py-4" id="contact">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="contact__content">
                    <div class="section-title mb-35">
                        <h2 class="" style="font-size: 28px">Comment pouvons-nous vous aider ?</h2>
                    </div>
                    <div class="contact__info">
                        <ul class="list-wrap">
                            <li>
                                <div class="icon">
                                    <i class="flaticon-pin"></i>
                                </div>
                                <div class="content">
                                    <h4 class="title">Adresse</h4>
                                    <p>Abidjan - Plateau, Rue de Commerce, Immeuble Pacifique en face de l'Immeuble du MALI</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="flaticon-phone-call"></i>
                                </div>
                                <div class="content">
                                    <h4 class="title">Téléphone</h4>
                                    <a href="tel:2720331500">+(225)27 20 33 15 00</a>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="flaticon-mail"></i>
                                </div>
                                <div class="content">
                                    <h4 class="title">E-mail</h4>
                                    <a href="mailto:infos@yakoafricassur.com">infos@yakoafricassur.com</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="contact__form-wrap">
                    <h2 class="title">Envoyez-nous un message</h2>
                    <p>N’hésitez pas à nous contacter pour plus d’information.</p>
                    
                    <form id="" action="{{ route('admin.subscription.store') }}" method="POST" class="submitForm" enctype="multipart/form-data">
                        @csrf
                                                            
                        <div class="row">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-grp">
                                        <input type="text" name="customer_firstname" placeholder="Nom" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-grp">
                                        <input type="number" name="customer_phone" placeholder="Téléphone" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-grp">
                                        <input type="email" name="customer_email" placeholder="Email" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-grp">
                                        <input type="text" name="object" placeholder="Objet" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-grp">
                                <textarea name="content" placeholder="Message" required autocomplete="off"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="type" value="contact" required autocomplete="off">
                        
                            <button type="submit" class="btn btn-primary">Soumettre</button>
                        
                    </form>
                    {{-- <p class="ajax-response mb-0"></p> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact-area-end -->
 <!-- brand-area -->
@include('users.layouts.partners-slider')
<!-- call-back-area-end -->
@endsection