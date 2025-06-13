@extends('admins.layouts.main')
@section('content-admin')
<!-- breadcrumb-area -->
<section class="breadcrumb__area breadcrumb__bg" style="background-image: linear-gradient(to left, rgba(236, 240, 249, 0.1), rgba(191, 202, 208, 0.4)), url('{{ asset('assets/img/images/banner.jpg')}}')">
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
<br>

    
<section style="background-color: #F5FBFB;" class="about__area-three about__bg-two py-5 modif-pencil" id="story">
    <a href="#" data-bs-toggle="modal" data-bs-target="#updateAboutSectionHist{{$aboutHist->uuid}}" class=""> 
        <i class="fa fa-pencil fs-6 pencil" style="float:right" aria-hidden="true"></i>
    
        
        <div class="container theme-control-toggle-label theme-control-toggle-light modif" title="" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Cette section est modifiable. Cliquer sur le stylo">
            <div class="row justify-content-center"> 
                <div class="col-lg-12">
                    @if($aboutHist->image)    
                    <img src="{{ asset('images/AboutPage/'.$aboutHist->image) }}" class="img-main img-fluid" alt="historique YAKO Africa">
                    @else  
                    <img src="{{ asset('assets/img/images/historique.png')}}" class="img-main img-fluid" alt="historique YAKO Africa">
                    @endif
                </div>
            </div>
            <div class="row justify-content-center">           
                <div class="col-lg-12">
                    <div class="about__content-seven">
                        <p style="text-align: justify;">{!! ($aboutHist->content) ?? "N/A" !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </a>
    
</section>
@include('admins.userPages.about.updateAboutSectionHistModal',["uuid" => $aboutHist->uuid])
<!-- about-area-end -->
<section class="about__area-four py-5 my-5 modif-pencil" id="mot_pca">
    <a href="" data-bs-toggle="modal" data-bs-target="#updateAboutMotPCA{{$aboutMotPCA->uuid}}" class="" > 
        <i class="fa fa-pencil fs-6 pencil" style="float:right" aria-hidden="true"></i>
        <div class="container theme-control-toggle-label theme-control-toggle-light modif" title="" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Cette section est modifiable. Cliquer sur le stylo">
            
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-9 col-sm-10 mb-30">
                        <div class="about__img-wrap-four about__img-wrap-home8">
                            @if($aboutMotPCA->image)    
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
                    <div class="about__content-four" style="text-align: justify;">
                        <div class="section-title mb-30">
                            <p class="sub-title">Mot du PCA</p>
                            <span class="title">{{$aboutMotPCA->nomPCA}}</span>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <p>{!! ($aboutMotPCA->content) ?? "N/A" !!}</p> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </a>
</section>
@include('admins.userPages.about.updateAboutSectionMotPCAModal',["uuid" => $aboutMotPCA->uuid])
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
        @include("admins.userPages.about.teams.addModal")
        <!-- Button trigger modal -->
        
        @if($PCA)
            
            @include('admins.userPages.about.teams.updatePCAModal',["uuid" => $PCA->uuid])
        @endif
        <a href="" data-bs-toggle="modal" data-bs-target="#addTeam" class="" > 
            <i class="fa fa-pencil fs-6 pencil" style="float:right" aria-hidden="true"></i>
        </a>
        <!-- Button trigger modal -->
        @if(($DGs || $PCA || $teams || $teams2) && $DGA)
            <div class="team-item-wrap modif-pencil "> 
                <!-- Modal PCA -->
                @if($PCA) 
                    {{-- PCA --}}
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
                                        <h4 class="title text-center">{{$PCA->team_name ?? 'N/A'}}</h4>
                                        <p class="text-center"><span>{{$PCA->team_fonction ?? 'N/A'}}</span></p> 
                                        <p class="border mb-0"></p>
                                        <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" class="img-fluid d-block m-auto" style="max-width: 100px !important;">
                                    </div>
                                </div>
                                <div class="col-md-7  p-2" style="text-align:justify;"> 
                                    {!! ($PCA->team_description) ?? "N/A" !!} 
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-prime" data-bs-toggle="modal" data-bs-target="#updatePCA{{$PCA->uuid}}">Modifier</button>
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

                {{-- DG --}}
                <div class="row justify-content-center">
                    @foreach($DGs as $DG)
                    @include('admins.userPages.about.teams.updateDGModal',["uuid" => $DG->uuid])
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
                                        <h4 class="title text-center">{{$DG->team_name ?? 'N/A'}}</h4>
                                        <p class="text-center"><span>{{$DG->team_fonction ?? 'N/A'}}</span></p> 
                                        <p class="border mb-0"></p>
                                        <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" class="img-fluid d-block m-auto" style="max-width: 100px !important;">
                                    </div>
                                </div>
                                <div class="col-md-7  p-2" style="text-align:justify;">
                                    
                                    {!! ($DG->team_description) ?? "N/A" !!}
                                    
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-prime" data-bs-toggle="modal" data-bs-target="#updateDG{{$DG->uuid}}">Modifier</button>
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
                                        <p class="border mb-0"></p>
                                        <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" class="img-fluid d-block m-auto" style="max-width: 100px !important;">
                                    </div>
                                </div>
                                <div class="col-md-7  p-2" style="text-align:justify;">
                                    
                                    {!! ($team->team_description) ?? "N/A" !!}
                                    
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn-prime" data-bs-toggle="modal" data-bs-target="#updateTeams{{$team->uuid}}">Modifier</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
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
                    @include('admins.userPages.about.teams.updateTeamsModal',["uuid" => $team->uuid])
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    @foreach($teams2 as $team2)
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
                                        <p class="border mb-0"></p>
                                        <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" class="img-fluid d-block m-auto" style="max-width: 100px !important;">
                                    </div>
                                </div>
                                <div class="col-md-7  p-2" style="text-align:justify;">
                                    
                                    {!! ($team2->team_description) ?? "N/A" !!}
                                    
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn-prime" data-bs-toggle="modal" data-bs-target="#updateTeam2{{$team2->uuid}}">Modifier</button>
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
                                <h4 class="title text-center"><a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$team2->uuid}}">{{$team2->team_name}}</a></h4>
                                <span class="text-center">{{$team2->team_fonction}}</span>
                            </div>
                        </div>
                    </div>
                    @include('admins.userPages.about.teams.updateTeam2Modal',["uuid" => $team2->uuid])
                    @endforeach
                </div>
            </div>
        @elseif($PCA || $teams1 || $teams2) 
        <div class="team-item-wrap modif-pencil "> 
            <!-- Modal PCA -->
            @if($PCA) 
                {{-- PCA --}}
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
                                    <h4 class="title text-center">{{$PCA->team_name ?? 'N/A'}}</h4>
                                    <p class="text-center"><span>{{$PCA->team_fonction ?? 'N/A'}}</span></p> 
                                    <p class="border mb-0"></p>
                                    <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" class="img-fluid d-block m-auto" style="max-width: 100px !important;">
                                </div>
                            </div>
                            <div class="col-md-7  p-2" style="text-align:justify;"> 
                                {!! ($PCA->team_description) ?? "N/A" !!} 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-prime" data-bs-toggle="modal" data-bs-target="#updatePCA{{$PCA->uuid}}">Modifier</button>
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
            <!-- Teams 1 -->
            <div class="row justify-content-center">
                @foreach($teams1 as $team1)
                @include('admins.userPages.about.teams.updateTeam1Modal',["uuid" => $team1->uuid])
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
                                    <h4 class="title text-center">{{$team1->team_name ?? 'N/A'}}</h4>
                                    <p class="text-center"><span>{{$team1->team_fonction ?? 'N/A'}}</span></p> 
                                    <p class="border mb-0"></p>
                                    <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" class="img-fluid d-block m-auto" style="max-width: 100px !important;">
                                </div>
                            </div>
                            <div class="col-md-7  p-2" style="text-align:justify;">
                                
                                {!! ($team1->team_description) ?? "N/A" !!}
                                
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-prime" data-bs-toggle="modal" data-bs-target="#updateTeam1{{$team1->uuid}}">Modifier</button>
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

            <!-- Teams 2 -->
            <div class="row justify-content-center">
                @foreach($teams2 as $team2)
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
                                    <p class="border mb-0"></p>
                                    <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" class="img-fluid d-block m-auto" style="max-width: 100px !important;">
                                </div>
                            </div>
                            <div class="col-md-7  p-2" style="text-align:justify;">
                                
                                {!! ($team2->team_description) ?? "N/A" !!}
                                
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn-prime" data-bs-toggle="modal" data-bs-target="#updateTeam2{{$team2->uuid}}">Modifier</button>
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
                            <h4 class="title text-center"><a  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$team2->uuid}}">{{$team2->team_name}}</a></h4>
                            <span class="text-center">{{$team2->team_fonction}}</span>
                        </div>
                    </div>
                </div>
                @include('admins.userPages.about.teams.updateTeam2Modal',["uuid" => $team2->uuid])
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
 <!-- brand-area -->
@include('users.layouts.partners-slider')

<script>
    document.getElementById('add-more').addEventListener('click', function() {
        // Clone le modèle du formulaire
        let formContainer = document.getElementById('form-container');
        let formTemplate = document.getElementById('team-form-template');
        let newForm = formTemplate.cloneNode(true);

        // Effacer les valeurs des champs du formulaire cloné
        newForm.querySelectorAll('input, textarea').forEach(function(input) {
            input.value = ''; // Remet à zéro les champs de texte
        });

        // Ajoute un bouton "Supprimer" pour le formulaire cloné
        newForm.querySelector('.remove-form').addEventListener('click', function() {
            newForm.remove(); // Supprime cette section du formulaire
        });

        // Ajoute le formulaire cloné au container
        formContainer.appendChild(newForm);
    });

    // Ajouter la fonction de suppression sur le premier formulaire par défaut
    document.querySelector('.remove-form').addEventListener('click', function() {
        this.closest('.form-group').remove(); // Supprime cette section du formulaire
    });
</script>
<!-- call-back-area-end -->
<script>
    document.getElementById('fileInput').addEventListener('change', function(event) {
    var files = event.target.files;
    var previewContainer = document.getElementById('previewContainer');
    previewContainer.innerHTML = ''; // Effacer les anciennes prévisualisations

    for (var i = 0; i < files.length; i++) {
        var file = files[i];

        // Assurez-vous que le fichier est bien une image
        if (file.type.startsWith('image/')) {
            var imgElement = document.createElement('img');
            imgElement.classList.add('dz-image');
            imgElement.style.width = '140px';
            imgElement.style.height = '140px';
            imgElement.style.objectFit = 'cover';
            imgElement.style.marginRight = '10px';
            imgElement.style.borderRadius = '5px';

            // Créez une URL pour l'image chargée
            var imageUrl = URL.createObjectURL(file);
            imgElement.src = imageUrl;

            // Ajoutez l'image à la div de prévisualisation
            previewContainer.appendChild(imgElement);
        }
    }
});

</script>

@endsection