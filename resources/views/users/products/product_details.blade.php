@extends('users.layouts.main')
@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="breadcrumb__content">
                        <h2 class="title">Détails Produit</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Produits</li>
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

    <!-- services-details-area -->
    <section class="services__details-area">
        <div class="container">
            <div class="services__details-wrap">
                <div class="row">
                    <div class="col-lg-8 order-0 order-lg-2">
                        <div class="services__details-thumb">
                            <img src="{{ asset('images/FormuleProducts/'.$formulproduct->formul_image)}}" class="img-fluid" alt="">
                        </div>
                        <div class="services__details-content" style="text-align: justify">
                            <h2 class="title" > {{ $formulproduct->label ?? 'N/A' }} </h2>
                            <p>{!! ($formulproduct->description) !!}</p>
                            
                        </div>
                        @if($formulproduct && $formulproduct->video_url)
                            
                        <div class="blog__details-inner">
                            <div class="row align-items-center">
                                <div class="col-md-9 order-0 order-lg-2">
                                    <div class="blog__details-inner-thumb">
                                        <img src="{{ asset('images/FormuleProducts/'.$formulproduct->formul_image)}}" alt="" class="img-fluid">
                                        <a href="{{ $formulproduct->video_url}}" class="play-btn popup-video"><i class="fas fa-play"></i></a>
                                    </div>
                                </div>
                                {{-- <div class="col-54">
                                    <div class="blog__details-inner-content">
                                        <h4 class="title">Conduct replied off whether arrived adapted</h4>
                                        <p>when an unknown printer took a galley type remaining essentially unchan galley of type and scrambled it to make a type specimen book.</p>
                                        <div class="about__list-box">
                                            <ul class="list-wrap">
                                                <li><i class="flaticon-arrow-button"></i>Medicare Advantage Plans</li>
                                                <li><i class="flaticon-arrow-button"></i>Analysis & Research</li>
                                                <li><i class="flaticon-arrow-button"></i>100% Secure Money Back</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        @endif
                       

                        <div class="modal fade" id="souscrire{{ $formulproduct->uuid }}" tabindex="-1" aria-labelledby="souscrireModalLabel{{ $formulproduct->uuid }}" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="souscrireModalLabel{{ $formulproduct->uuid }}">{{ $formulproduct->label ?? 'N/A' }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <section class="contact__area py-4" id="contact">
                                        <div class="container">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4">
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
                                                <div class="col-lg-8">
                                                    <div class="contact__form-wrap">
                                                        <h2 class="title">Demande de cotation</h2>
                                                        <p>Votre adresse email ne sera pas publiée. Les champs obligatoires sont marqués *</p>
                                                        <form action="{{ route('admin.subscription.store') }}" method="POST" class="submitForm" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-12">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="customer_civility" id="inlineRadio1" value="Monsieur" required autocomplete="off">
                                                                            <label class="form-check-label" for="inlineRadio1">Monsieur</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="customer_civility" id="inlineRadio2" value="Madame" required autocomplete="off">
                                                                            <label class="form-check-label" for="inlineRadio2">Madame</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="customer_civility" id="inlineRadio3" value="Mademoiselle" required autocomplete="off">
                                                                            <label class="form-check-label" for="inlineRadio3">Mademoiselle</label>
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <div class="form-grp">
                                                                            <input type="text" name="customer_firstname" placeholder="Nom" required autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-grp">
                                                                            <input type="text" name="customer_lastname" placeholder="Prenoms" required autocomplete="off">
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <div class="form-grp">
                                                                            <input type="text" name="customer_job" placeholder="Profession" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-grp">
                                                                            <input type="text" name="customer_residence" placeholder="Lieu de residence" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <div class="form-grp">
                                                                            <input type="number" name="customer_phone" placeholder="Téléphone principal" required autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-grp">
                                                                            <input type="number" name="customer_whatsapp" placeholder="Téléphone WhatsApp" required autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-md-12">
                                                                        <label class="form-check-label">Qui voulez-vous assurer ?</label><br>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="customer_assure" id="inline1" value="Moi même" required autocomplete="off">
                                                                            <label class="form-check-label" for="inline1">Moi même</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="customer_assure" id="inline2" value="Un proche" required autocomplete="off">
                                                                            <label class="form-check-label" for="inline2">Un proche</label>
                                                                        </div> 
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="customer_assure" id="inline3" value="Moi et un proche" required autocomplete="off">
                                                                            <label class="form-check-label" for="inline3">Moi et un proche</label>
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                                <div class="row d-flex mb-2" id="content_assur">
                                                                    <!-- Afficher ce champ si l'utilisateur coche "Moi-même" -->
                                                                    <div class="col-md-6" id="Moi_meme">
                                                                        <div class="form-grp">
                                                                            <label class="form-label" for="customer_birthday">Votre date de naissance</label>
                                                                            <input type="date" class="form-control" name="customer_birthday" id="customer_birthday" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <!-- Afficher ce champ si l'utilisateur coche "Un proche" ou "Moi et un proche" -->
                                                                    <div class="col-md-6" id="Un_proche">
                                                                        <div class="form-grp">
                                                                            <label class="form-label" for="assure_birthday">Date de naissance de votre proche</label>
                                                                            <input type="date" class="form-control" name="assure_birthday" id="assure_birthday" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                
                                                                <div class="row mb-2">
                                                                    <div class="col-md-12">
                                                                        <div class="form-grp">
                                                                            <input type="email" name="customer_email" placeholder="Votre adresse email" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="object" value="Pré-souscription" required autocomplete="off">
                                                                </div>
                                                                <div class="form-grp">
                                                                    <textarea name="content" placeholder="Message" autocomplete="off"></textarea>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="type" value="Pré-souscription" required autocomplete="off">
                                                            <input type="hidden" name="product_uuid" value="{{ $formulproduct->uuid }}" required autocomplete="off">
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn-prime">Soumettre</button>
                                                            </div>
                                                        </form>
                                                        {{-- <p class="ajax-response mb-0"></p> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <aside class="services__sidebar"> 
                            <div class="sidebar__widget">
                                <h4 class="sidebar__widget-title">Brochure</h4>
                                <div class="sidebar__brochure">
                                    @if($formulproduct && $formulproduct->brochure)
                                    <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="far fa-file-alt"></i>Télécharger la brochure</a>
                                    @else
                                    <p><i>Aucune Brochure</i></p>
                                    @endif
                                    
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content" style="min-height: 90vh;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Brochure {{ $formulproduct->label ?? 'N/A' }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <iframe src="{{ asset('images/FormuleProducts/Brochure/'.$formulproduct->brochure)}}" frameborder="0" class="border border-danger" style="min-height: 100%; height: 600px; width: 100%;"></iframe>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn-prime" data-bs-dismiss="modal">Fermer</button>
                                                <a href="{{ asset('images/FormuleProducts/Brochure/'.$formulproduct->brochure)}}" download>Télécharger</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar__widget sidebar__widget-two mb-4">
                                <div class="sidebar__contact">
                                    <h2 class="title"><i>Vous avez une 
                                        question ou une préoccupation ?
                                        Nous sommes à 
                                        votre écoute !
                                        </i></h2>
                                    <a href="tel:2720331500" class="btn"><i class="flaticon-phone-call"></i>+(225)27 20 33 15 00</a>
                                </div>
                            </div>
                        </aside>
                        <div class="sidebar__widget">
                            <h4 class="sidebar__widget-title">Êtes-vous intéressé ?</h4>
                            <button type="button" class="btn-prime btn-prime-two mt-2" data-bs-toggle="modal" data-bs-target="#souscrire{{ $formulproduct->uuid }}" data-bs-whatever="@getbootstrap">Demander une cotation</button>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- services-details-area-end -->
    <!-- contact-area-end -->
     <!-- brand-area -->
     @include('users.layouts.partners-slider')
    <!-- call-back-area-end -->

    <script>
       document.addEventListener('DOMContentLoaded', function() {
    const moiMemeField = document.getElementById('Moi_meme');
    const unProcheField = document.getElementById('Un_proche');
    const contentAssur = document.getElementById('content_assur');

    // Masquer tous les champs au début
    moiMemeField.style.display = 'none';
    unProcheField.style.display = 'none';
    contentAssur.style.display = 'none';

    function toggleFields() {
        const selectedOption = document.querySelector('input[name="customer_assure"]:checked').value;

        if (selectedOption === "Moi même") {
            moiMemeField.style.display = 'block';
            unProcheField.style.display = 'none';
            contentAssur.style.display = 'block';
            contentAssur.classList.remove('inline-fields'); // Retirer l'alignement côte à côte
        } else if (selectedOption === "Un proche") {
            moiMemeField.style.display = 'none';
            unProcheField.style.display = 'block';
            contentAssur.style.display = 'block';
            contentAssur.classList.remove('inline-fields');
        } else if (selectedOption === "Moi et un proche") {
            moiMemeField.style.display = 'block';
            unProcheField.style.display = 'block';
            contentAssur.style.display = 'block';
            contentAssur.classList.add('inline-fields'); // Ajouter l'alignement côte à côte
        }
    }

    const radioButtons = document.querySelectorAll('input[name="customer_assure"]');
    radioButtons.forEach(radio => {
        radio.addEventListener('change', toggleFields);
    });
});

    </script>
@endsection