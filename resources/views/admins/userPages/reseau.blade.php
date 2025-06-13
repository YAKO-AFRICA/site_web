@extends('admins.layouts.main')
@section('content-admin')
<style>
    /* Inclure le CSS personnalisé ici */
    .leaflet-control-geocoder {
        background-color: white;
        border-radius: 5px;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.2);
        padding: 5px;
    }
    .leaflet-control-geocoder-form input {
        border: 1px solid #ccc;
        border-radius: 3px;
        padding: 5px;
        width: 200px;
        font-size: 14px;
    }
    .leaflet-control-geocoder-icon {
        width: 25px;
        height: 25px;
        background-color: #007bff;
        border-radius: 3px;
        display: inline-block;
        background-size: 15px;
        background-position: center;
        background-repeat: no-repeat;
        margin-right: 5px;
    }
    .leaflet-control-geocoder-alternatives {
        font-size: 12px;
        color: #ff0000;
    }
</style>
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg" style="background-image: linear-gradient(to left, rgba(236, 240, 249, 0.1), rgba(191, 202, 208, 0.4)), url('{{ asset('assets/img/images/banner.jpg')}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="breadcrumb__content">
                        <h2 class="title">Notre Réseau</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Reseau</li>
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
    <section class="about__area-three about__bg-two py-5" style="background-color: #F5FBFB;">
        <div class="container" style="text-align: justify">
            <h3>Encore plus proche de vous grâce à notre vaste réseau de distribution couvrant le territoire national mais aussi la diaspora.</h3>
            <p>Nous nous appuyons sur nos espaces clientèle particuliers et entreprises présents dans plusieurs villes de la cote d’ivoire mais aussi sur nos partenaires banques, sociétés de courtage de premier rang et institutions financières afin de desservir une grande partie de la population.</p>
        </div>
    </section>
    <section class="contact__area border py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="accordion accordion-flush overflow-auto overflow-scroll" id="accordionFlushExample" style="max-height: 500px">
                        
                        @if($Siege || $EspaceClient) 
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{ $Siege->uuid ?? 'N/A'}}" aria-expanded="false" aria-controls="flush-collapseOne{{ $Siege->uuid ?? 'N/A'}}">
                              <h3> {{ $Siege->ville ?? 'N/A' }} </h3>
                            </button>
                          </h2>
                          <div id="flush-collapseOne{{ $Siege->uuid ?? 'N/A'}}" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="contact__info">
                                    <ul class="list-wrap">
                                        <li>
                                            <div class="icon">
                                                <i class="flaticon-pin"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title text-uppercase">{{ $Siege->label ?? 'N/A' }}</h4>
                                                <p> {{ $Siege->description ?? 'N/A' }}</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <i class="flaticon-pin"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title text-uppercase">{{ $EspaceClient->label ?? 'N/A' }}</h4>
                                                <p>{{ $EspaceClient->description ?? 'N/A' }}</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <i class="flaticon-phone-call"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">Téléphone</h4>
                                                <a href="tel:{{ $EspaceClient->telephone1 ?? 'N/A' }}">{{ $EspaceClient->telephone1 ?? 'N/A' }}</a><br>
                                                @if($EspaceClient && $EspaceClient->telephone2 )   
                                                <a href="tel:{{ $EspaceClient->telephone2 ?? 'N/A' }}">{{ $EspaceClient->telephone2 ?? 'N/A' }}</a>
                                                @endif
                                                
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <i class="flaticon-mail"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">E-mail</h4>
                                                <a href="mailto:{{ $EspaceClient->email ?? 'N/A' }}">{{ $EspaceClient->email ?? 'N/A' }}</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                          </div>
                        </div>
                        @endif 
                        @foreach($Autres as $Autre)     
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo{{$Autre->uuid ?? 'N/A'}}" aria-expanded="false" aria-controls="flush-collapseTwo{{$Autre->uuid ?? 'N/A'}}">
                                <h3>{{$Autre->ville ?? 'N/A'}}</h3>
                            </button>
                          </h2>
                          <div id="flush-collapseTwo{{$Autre->uuid ?? 'N/A'}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="contact__info">
                                    <ul class="list-wrap">
                                        <li>
                                            <div class="icon">
                                                <i class="flaticon-pin"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title text-uppercase">{{ $Autre->label ?? 'N/A' }}</h4>
                                                <p> {{ $Autre->description ?? 'N/A' }}</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <i class="flaticon-phone-call"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">Téléphone</h4>
                                                <a href="tel:{{ $Autre->telephone1 ?? 'N/A' }}">{{ $Autre->telephone1 ?? 'N/A' }}</a><br>
                                                @if($Autre->telephone2 )   
                                                <a href="tel:{{ $Autre->telephone2 ?? 'N/A' }}">{{ $Autre->telephone2 ?? 'N/A' }}</a>
                                                @endif
                                                    
                                            </div>
                                        </li>
                                        @if($Autre->email)   
                                        <li>
                                            <div class="icon">
                                                <i class="flaticon-mail"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title">E-mail</h4>
                                                <a href="mailto:{{ $Autre->email ?? 'N/A' }}">{{ $Autre->email ?? 'N/A' }}</a>
                                            </div>
                                        </li>    
                                        @endif
                                    </ul>
                                </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
                <div class="col-lg-7" style="z-index: 0 !important;">
                    <div class="contact-map">
                        <div id="map" style="height: 100%; width: 100%; border-radius:10px"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="services__area-six services__bg-six" id="service" style="background-color: #076835;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title white-title mb-40">
                        <span class="sub-title">Ils nous font confiance</span>
                        <h2 class="title">Devenez partenaire de YAKO AFRICA Assurances Vie.</h2>
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
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="health-tab" data-bs-toggle="tab" data-bs-target="#health-tab-pane" type="button" role="tab" aria-controls="health-tab-pane" aria-selected="true">Bancassurance</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="travel-tab" data-bs-toggle="tab" data-bs-target="#travel-tab-pane" type="button" role="tab" aria-controls="travel-tab-pane" aria-selected="false">Courtage</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="health-tab-pane" role="tabpanel" aria-labelledby="health-tab" tabindex="0">
                                <div class="services__item-four shine-animate-item">
                                    <div class="services__thumb-four shine-animate">
                                        <img src="{{ asset('assets/img/images/Part_assur.jpg')}}" alt="">
                                    </div>
                                    <div class="services__content-four">
                                        <h2 class="title text-uppercase"><a href="services-details.html">Bancassurance</a></h2>
                                        <p style="text-align: justify;">YAKO AFRICA Assurances Vie, développe à travers des partenariats d’envergure, des solutions d’Assurances vie pour les banques et institutions de microfinance.

                                            Il s’agit d’offres pour la couverture et la fidélisation de leur clientèle.
                                            
                                            Des collaborations gagnant-gagnant sur le long terme pour stimuler leurs activités.</p>
                                            <a href="#" class="btn">nous contacter</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="travel-tab-pane" role="tabpanel" aria-labelledby="travel-tab" tabindex="0">
                                <div class="services__item-four shine-animate-item">
                                    <div class="services__thumb-four shine-animate">
                                        <img src="{{ asset('assets/img/images/Part_assur.jpg')}}" alt="">
                                    </div>
                                    <div class="services__content-four">
                                        <h2 class="title text-uppercase"><a href="services-details.html">Courtage</a></h2>
                                        <p style="text-align: justify;">Afin de répondre aux besoins des différentes populations qui sont de bénéficier des solutions de YAKO AFRICA Assurances vie, nous avons décidé de travailler avec plusieurs intermédiaires dont les courtiers qui sont à même de proposer aux clients des solutions sur mesure en fonction de leur besoins.</p>
                                        <a href="#" class="btn">nous contacter</a>
                                    </div>
                                </div>
                            </div>
                            
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->
     <!-- brand-area -->
     @include('users.layouts.partners-slider')
    <!-- call-back-area-end -->
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Leaflet Geocoding Plugin -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
        // Définir les limites géographiques pour la Côte d'Ivoire
        var coteDIvoireBounds = [
            [4.333, -8.599], // Sud-Ouest
            [10.726, -2.504] // Nord-Est
        ];
    
        // Initialiser la carte centrée sur la Côte d'Ivoire
        var map = L.map('map').setView([7.539989, -5.547080], 7).setMaxBounds(coteDIvoireBounds);
    
        // Couche OpenStreetMap (vue par défaut)
        var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });
    
        // Couche Satellite de Google
        var googleSatLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; <a href="https://www.google.com/maps">Google Maps</a>'
        });
    
        // Couche de trafic de Google
        var googleTrafficLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=m,traffic&x={x}&y={y}&z={z}', {
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; <a href="https://www.google.com/maps">Google Maps</a>'
        });
    
        // Ajouter la couche OpenStreetMap par défaut
        osmLayer.addTo(map);
    
        // Ajouter un contrôle de couches pour permettre le changement entre OpenStreetMap, Satellite, et Trafic
        var baseLayers = {
            "OpenStreetMap": osmLayer,
            "Satellite": googleSatLayer,
            "Trafic": googleTrafficLayer
        };
    
        L.control.layers(baseLayers).addTo(map);
    
        // Fonction pour ajouter des marqueurs dynamiquement
        function addMarker(lat, lon, label, description) {
            L.marker([lat, lon]).addTo(map)
                .bindPopup("<b>" + label + "</b><br>" + description);
        }
    
        // Récupérer les lieux via AJAX
        fetch('/get-reseaux')  // Route Laravel pour obtenir les réseaux
            .then(response => response.json())
            .then(data => {
                data.forEach(function(reseau) {
                    addMarker(reseau.latitude, reseau.longitude, reseau.label, reseau.description);
                });
            })
            .catch(error => {
                console.error('Erreur lors du chargement des données:', error);
            });
    
        // Optionnel : Activer la géolocalisation de l'utilisateur uniquement si le site est sécurisé (HTTPS)
        if (location.protocol === 'https:') {
            map.locate({setView: true, maxZoom: 16});
    
            function onLocationFound(e) {
                var radius = e.accuracy / 2;
    
                L.marker(e.latlng).addTo(map)
                    .bindPopup("Vous êtes ici").openPopup();
                    // .bindPopup("Vous êtes ici, à " + radius + " mètres près.").openPopup();
    
                L.circle(e.latlng, radius).addTo(map);
            }
    
            map.on('locationfound', onLocationFound);
    
            function onLocationError(e) {
                alert(e.message);
            }
    
            map.on('locationerror', onLocationError);
        } else {
            console.log("Géolocalisation désactivée en raison d'une origine non sécurisée (HTTP).");
        }
    </script>
@endsection