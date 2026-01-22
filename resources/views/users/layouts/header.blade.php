 <!-- header-area -->
 <header class="tg-header__style-five">
        <div class="tg-header__top">
            {{-- <div class="container-fluid banner-football d-flex align-items-center">
             
                <div class="div-banner-football">
                    
                    <div class="overflow-hidden">
                        <div class="banner-scroll-football">
                                <img src="{{ asset('assets/img/images/elephant.png') }}" 
                                alt="Logo Elephant" class="banner-elephant-football">
                                
                                <img src="{{ asset('assets/img/images/Text.png') }}" 
                                alt="Texte" class="banner-text-football">

                                <img src="{{ asset('assets/img/images/elephant.png') }}" 
                                alt="Logo Elephant" class="banner-elephant-football">

                                <img src="{{ asset('assets/img/images/Text.png') }}" 
                                alt="Texte" class="banner-text-football">

                                <img src="{{ asset('assets/img/images/elephant.png') }}" 
                                alt="Logo Elephant" class="banner-elephant-football">

                                <img src="{{ asset('assets/img/images/Text.png') }}" 
                                alt="Texte" class="banner-text-football">

                                <img src="{{ asset('assets/img/images/elephant.png') }}" 
                                alt="Logo Elephant" class="banner-elephant-football">

                                 <img src="{{ asset('assets/img/images/Text.png') }}" 
                                alt="Texte" class="banner-text-football">

                            <div class="div-confitit">                   
                                <p class="confitit-1">
                                    <dotlottie-wc
                                        src="https://lottie.host/39407f99-c216-404b-a36e-eaf5b623e596/GO8dgE5GJ5.lottie"
                                        style="width: 300px;height: 300px"
                                        autoplay
                                        loop
                                    ></dotlottie-wc>
                                </p>
                                <p class="confitit-2">
                                    <dotlottie-wc
                                        src="https://lottie.host/f24a45bb-7618-452a-82c6-ce22c9b79fbd/0bcIJQ6WYB.lottie"
                                        style="width: 300px;height: 300px"
                                        autoplay
                                        loop
                                    ></dotlottie-wc>
                                </p>
                            </div>
                               
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="container custom-container" >
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-9">
                        <ul class="tg-header__top-info left-side list-wrap">
                            <li style="width: 20%;"><i class="flaticon-phone-call"></i>
                                <a class="" href="tel:2720331500">+(225)27 20 33 15 00</a>
                            </li>
                                <li class="text-center"><i class="flaticon-pin"></i>Abidjan - Plateau, Rue de Commerce, Immeuble Pacifique en face de l'Immeuble du MALI</li>
                            <!-- <marquee behavior="100" direction="lelt">
                                <li><i class="flaticon-pin"></i><strong>SIEGE :</strong> Abidjan-Plateau, avenue Noguès immeuble Woodin, 4ème étage --  <strong>SERVICES CLIENTS :</strong> Abidjan - Plateau, Rue de Commerce, Immeuble Pacifique en face de l'Immeuble du MALI</li>
                            </marquee> -->
                        </ul>
                        
                    </div>
                    <div class="col-lg-3">
                        <ul class="tg-header__top-right list-wrap">
                            <li><i class="flaticon-envelope"></i><a href="mailto:infos@yakoafricassur.com">infos@yakoafricassur.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="sticky-header" class="tg-header__area tg-header__area-five">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 row justify-content-center m-0 p-0">
                        <div class="tgmenu__wrap column justify-content-center">
                            <nav class="tgmenu__nav">
                                <div class="logo">
                                    <a href="javascript:void(0)" onclick="pageVisitedForm('Accueil', '{{ route('index') }}')"><img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo" style="max-width: 300px !important;"></a>
                                </div>
                                
                                <center>
                                    <div class="tgmenu__action tgmenu__action-five tgmenu__action1 mt-4" style="margin-left: -17px !important;">
                                        <ul class="list-wrap">
                                            <li class="#">
                                                <a href="javascript:void(0)" onclick="pageVisitedForm('Payer ma prime', 'https://yakoafricassur.com/e-services/paiement/paiement-prime.php')" class="btn-prime btn-prime-two text-white">Payer ma prime</a>
                                            </li>
                                            <li class="header-btn-two">
                                                <a href="javascript:void(0)" title="Accéder à mon espace" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn border-btn py-3"> Mon espace </a>
                                            </li>
                                            {{-- <ul class="sub-menu">
                                                <li><a href="https://yakoafricassur.com/espace-client/login.php">Espace client</a></li>
                                                <li><a href="https://yakoafricassur.com/espace-agent/connexion.php">Espace agent</a></li> 
                                            </ul> --}}
                                            
                                            {{-- <li class="header-btn-two">
                                                <a href="javascript:void(0)" onclick="pageVisitedForm('Espace client', '{{ route('customer.loginForm') }}')" title="Accéder à mon espace" class="btn border-btn py-3">Espace client</a>
                                            </li> --}}
                                            <li class="header-btn d-md-none d-sm-block">
                                                <a href="javascript:void(0)" onclick="pageVisitedForm('Services assistantes', '{{ route('home.assistance') }}')" title="Services assistantes" class="btn"><i class="fa-solid fa-headset" style="font-size: 1.7em;"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </center>
                                <div class="mobile-nav-toggler mobile-nav-toggler-two">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" fill="none">
                                        <path d="M0 2C0 0.895431 0.895431 0 2 0C3.10457 0 4 0.895431 4 2C4 3.10457 3.10457 4 2 4C0.895431 4 0 3.10457 0 2Z" fill="currentcolor" />
                                        <path d="M0 9C0 7.89543 0.895431 7 2 7C3.10457 7 4 7.89543 4 9C4 10.1046 3.10457 11 2 11C0.895431 11 0 10.1046 0 9Z" fill="currentcolor" />
                                        <path d="M0 16C0 14.8954 0.895431 14 2 14C3.10457 14 4 14.8954 4 16C4 17.1046 3.10457 18 2 18C0.895431 18 0 17.1046 0 16Z" fill="currentcolor" />
                                        <path d="M7 2C7 0.895431 7.89543 0 9 0C10.1046 0 11 0.895431 11 2C11 3.10457 10.1046 4 9 4C7.89543 4 7 3.10457 7 2Z" fill="currentcolor" />
                                        <path d="M7 9C7 7.89543 7.89543 7 9 7C10.1046 7 11 7.89543 11 9C11 10.1046 10.1046 11 9 11C7.89543 11 7 10.1046 7 9Z" fill="currentcolor" />
                                        <path d="M7 16C7 14.8954 7.89543 14 9 14C10.1046 14 11 14.8954 11 16C11 17.1046 10.1046 18 9 18C7.89543 18 7 17.1046 7 16Z" fill="currentcolor" />
                                        <path d="M14 2C14 0.895431 14.8954 0 16 0C17.1046 0 18 0.895431 18 2C18 3.10457 17.1046 4 16 4C14.8954 4 14 3.10457 14 2Z" fill="currentcolor" />
                                        <path d="M14 9C14 7.89543 14.8954 7 16 7C17.1046 7 18 7.89543 18 9C18 10.1046 17.1046 11 16 11C14.8954 11 14 10.1046 14 9Z" fill="currentcolor" />
                                        <path d="M14 16C14 14.8954 14.8954 14 16 14C17.1046 14 18 14.8954 18 16C18 17.1046 17.1046 18 16 18C14.8954 18 14 17.1046 14 16Z" fill="currentcolor" />
                                    </svg>
                                </div>
                                @php
                                    $reseaux = App\Models\ReseauDistribution::where('etat', 'Actif')->take(2)->get();
                                @endphp
                                <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-lg-flex">
                                    <ul class="navigation">
                                        <li class="{{ request()->routeIs('index') ? 'active' : '' }}">
                                            <a href="javascript:void(0)" onclick="pageVisitedForm('Accueil', '{{ route('index') }}')">Accueil</a>
                                        </li>
                                        <li class="menu-item-has-children {{ request()->routeIs('home.about') ? 'active' : '' }}">
                                            <a href="javascript:void(0)" onclick="pageVisitedForm('Qui sommes nous', '{{ route('home.about') }}#a_propos')">Qui sommes nous</a>
                                            <ul class="sub-menu">
                                                <li><a href="javascript:void(0)" onclick="pageVisitedForm('Qui sommes nous', '{{ route('home.about') }}#story')">Notre Historique</a></li>
                                                <li><a href="javascript:void(0)" onclick="pageVisitedForm('Qui sommes nous', '{{ route('home.about') }}#mot_pca')">Mot du PCA</a></li>
                                                <li><a href="javascript:void(0)" onclick="pageVisitedForm('Qui sommes nous', '{{ route('home.about') }}#chiffre_cle')">Chiffre Clé</a></li>
                                                <li><a href="javascript:void(0)" onclick="pageVisitedForm('Qui sommes nous', '{{ route('home.about') }}#team')">L'équipe</a></li>
                                                <li><a href="javascript:void(0)" onclick="pageVisitedForm('Qui sommes nous', '{{ route('home.about') }}#contact')">Contact</a></li>
                                                <li><a href="javascript:void(0)" onclick="pageVisitedForm('Qui sommes nous', '{{ route('home.about') }}#partenaires')">Nos partenaires</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ request()->routeIs('home.reseau') ? 'active' : '' }}">
                                            <a href="javascript:void(0)" onclick="pageVisitedForm('Reseau', '{{ route('home.reseau') }}#reseau')">Reseau</a>
                                        </li>
                                        <li class="menu-item-has-children {{ request()->routeIs('home.reseaux.products', 'home.all_products', 'home.formule_product.details') ? 'active' : '' }}">
                                            <a href="javascript:void(0)" onclick="pageVisitedForm('Nos produits', '{{ route('home.all_products') }}')">Nos produits</a>
                                            <ul class="sub-menu">
                                                @foreach($reseaux as $reseau)
                                                    {{-- <li class="border-bottom"> --}}
                                                    <li class="border-bottom" onclick="pageVisitedForm('Nos produits', 'javascript:void(0)')">
                                                        <a href="javascript:void(0)" onclick="reseauVisitedForm('{{$reseau->uuid}}', '{{ route('home.reseaux.products', $reseau->uuid) }}')">{{$reseau->label ?? "N/A"}}</a>
                                                    </li>
                                                @endforeach
                                                <li class="{{ request()->routeIs('home.all_products') ? 'active' : '' }}"><a href="javascript:void(0)" onclick="pageVisitedForm('Nos produits', '{{ route('home.all_products') }}')">Tous nos produits</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ request()->routeIs('home.e-services') ? 'active' : '' }}">
                                            <a href="javascript:void(0)" onclick="pageVisitedForm('E-Services', 'https://yakoafricassur.com/e-services')">E-Services</a>
                                        </li>
                                        <li class="{{ request()->routeIs('home.actuality') ? 'active' : '' }}">
                                            <a href="javascript:void(0)" onclick="pageVisitedForm('Actualités', '{{ route('home.actuality') }}')">Actualités</a>
                                        </li>
                                    </ul>
                                    <div class="tgmenu__action p-0 border-top tgmenu__action-five tgmenu__action2 d-lg-none d-sm-block">
                                        <ul class="list-wrap">
                                            <li class="header-btn"><a href="javascript:void(0)" onclick="pageVisitedForm('Services assistantes', '{{ route('home.assistance') }}')" title="Services assistantes" class="btn"><i class="fa-solid fa-headset" style="font-size: 1.7em;"></i></a></li>
                                        </ul>
                                    </div>
                                </div> 
                                <center>
                                    <div class="tgmenu__action tgmenu__action-five p-0 m-0 tgmenu__action2 d-lg-flex justify-content-center align-items-center mt-4">
                                        <ul class="list-wrap p-0 m-0">
                                            <li class="#"><a href="javascript:void(0)" onclick="pageVisitedForm('Payer ma prime', 'https://yakoafricassur.com/e-services/paiement/paiement-prime.php')" class="btn-prime btn-prime-two text-white">Payer ma prime</a></li>
                                            {{-- <li class="header-btn-two"><a href="javascript:void(0)" onclick="pageVisitedForm('Espace client', '{{ route('customer.loginForm') }}')" title="Accéder à mon espace" class="btn border-btn py-3">Espace client</a></li> --}}
                                            
                                            <li class="header-btn-two"> <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#loginModal" title="Accéder à mon espace" class="btn border-btn py-3"> Mon espace </a></li>
                                            {{-- <li class="header-btn-two"><a href="https://yakoafricassur.com/espace-client/login.php" title="Accéder à mon espace" class="btn border-btn"><i class="fa-regular fa-user" style="font-size: 1.7em;"></i></a></li> --}}
                                            <li class="header-btn d-none d-sm-block"><a href="javascript:void(0)" onclick="pageVisitedForm('Services assistantes', '{{ route('home.assistance') }}')" title="Services assistantes" class="btn"><i class="fa-solid fa-headset" style="font-size: 1.7em;"></i></a></li>
                                        </ul>
                                    </div>
                                </center>
                            </nav>
                        </div>
                        <!-- Mobile Menu  -->
                        <div class="tgmobile__menu">
                            <nav class="tgmobile__menu-box">
                                <div class="close-btn"><i class="fas fa-times"></i></div>
                                <div class="nav-logo">
                                    <a href="javascript:void(0)" onclick="pageVisitedForm('Accueil', '{{ route('index') }}')"><img style="max-width: 500px !important;" src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Logo"></a>
                                </div>
                                {{-- <div class="tgmobile__search">
                                    <form action="#">
                                        <input type="text" placeholder="Search here...">
                                        <button><i class="fas fa-search"></i></button>
                                    </form>
                                </div> --}}
                                <div class="tgmobile__menu-outer">
                                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                                    
                                </div>
                                <div class="tgmobile__menu-bottom pt-0">
                                    <div class="contact-info">
                                        <ul class="list-wrap">
                                            <li><a href="mailto:infos@yakoafricassur.com">infos@yakoafricassur.com</a></li>
                                            <li><a class="" href="tel:2720331500">27 20 33 15 00</a></li>
                                        </ul>
                                    </div>
                                    <div class="social-links">
                                        <ul class="list-wrap">
                                            <li><a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="javascript:void(0)"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="javascript:void(0)"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li><a href="javascript:void(0)"><i class="fab fa-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <!-- <div class="tgmobile__menu-backdrop"></div> -->
                        <!-- End Mobile Menu -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="loginModalLabel">Accader à mon espace</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row g-3">
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-uppercase">Accès Espace Client</h5>
                        </div>
                        <div class="card-body">
                            {{-- <h5 class="card-title">Accès Espace Client</h5> --}}
                            <p class="card-text" style="align-items: justify">Connectez-vous à votre espace client pour consulter vos contrats, effectuer des paiements, et suivre vos réclamations.</p>
                            {{-- <a href="javascript:void(0)" onclick="pageVisitedForm('Espace client', '{{ route('customer.loginForm') }}')" class="btn-prime btn-prime-two">Espace Client</a> --}}
                        </div>
                        <div class="card-footer text-center border-0 bg-white">
                            <a href="javascript:void(0)" onclick="pageVisitedForm('Espace client', '{{ route('customer.loginForm') }}')" class="btn-prime btn-prime-two">Espace Client</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-uppercase">Accès Espace Agent</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text" style="align-items: justify">Accédez à votre espace professionnel pour gérer vos clients, consulter les demandes de souscription.</p>
                        </div>
                        <div class="card-footer text-center border-0 bg-white">
                            <a href="https://portail-agent.yakoafricassur.com" class="btn-prime btn-prime-two text-center">Espace Agent</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-prime" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
</header>
    <!-- header-area-end -->