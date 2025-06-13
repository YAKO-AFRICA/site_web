<style>
    .security::before {

        background: #F7A400;
        -webkit-transform-origin: right top;
        -ms-transform-origin: right top;
        transform-origin: right top;
        -webkit-transform: scale(0, 1);
        -ms-transform: scale(0, 1);
        transform: scale(0, 1);
        transition: transform 0.4s cubic-bezier(0.74, 0.72, 0.27, 0.24);
    }

    .security:hover {
        color: #F7A400;
    }

    .security:hover::before {
        -webkit-transform-origin: left top;
        -ms-transform-origin: left top;
        transform-origin: left top;
        -webkit-transform: scale(1, 1);
        -ms-transform: scale(1, 1);
        transform: scale(1, 1);
    }
</style>

<!-- footer-area -->
<footer class="wrapper">
    <div class="footer__area-two">
        <div class="footer__newsletter-two">
            <div class="container">
                <div class="footer__newsletter-inner">
                    <h2 class="title">Abonnez-vous à la newsletter pour les dernières mises à jour</h2>
                    <form action="{{ route('admin.newsletterStore.store') }}" method="POST" class="submitForm"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="email" name="email" placeholder="Votre e-mail ici. . ." autocomplete="off">
                        <button type="submit" class="btn">Soumettre</button>
                    </form>
                    <div class="footer__social-two">
                        <ul class="list-wrap">
                            <li><a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__top-two">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6">
                        <div class="footer-widget">
                            <div class="footer__content-two">
                                <div class="mb-25">
                                    <a href="{{ route('index') }}"><img style="max-width: 100px !important;"
                                            src="{{ asset('assets/img/logo/logo2_1.png') }}" alt=""></a>
                                </div>
                                <div class="footer-info-list footer-info-two">
                                    <ul class="list-wrap">
                                        <li>
                                            <div class="icon">
                                                <i class="flaticon-phone-call"></i>
                                            </div>
                                            <div class="content">
                                                <a href="tel:2720331500">+(225)27 20 33 15 00</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <i class="flaticon-envelope"></i>
                                            </div>
                                            <div class="content">
                                                <a href="mailto:infos@yakoafricassur.com">infos@yakoafricassur.com</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <i class="flaticon-pin"></i>
                                            </div>
                                            <div class="content">
                                                <p>Abidjan - Plateau, Rue de Commerce, Immeuble Pacifique en face de
                                                    l'Immeuble du MALI</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-sm-6">
                        <div class="footer-widget">
                            <h4 class="fw-title">Information</h4>
                            <div class="footer-link-list">
                                <ul class="list-wrap">
                                    <li><a href="{{ route('index') }}">Accueil</a></li>
                                    <li><a href="{{ route('home.about') }}">Qui sommes nous</a></li>
                                    <li><a href="{{ route('home.reseau') }}">Reseau</a></li>
                                    <li><a href="{{ route('home.all_products') }}">Nos Produits</a></li>
                                    <li><a href="https://yakoafricassur.com/e-services">E-services</a></li>
                                    <li><a href="{{ route('home.actuality') }}">Actualites</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-widget">
                            <h4 class="fw-title">Liens principaux</h4>
                            <div class="footer-link-list">
                                <ul class="list-wrap">
                                    <li><a href="{{ route('index') }}#expertise">Nos expertises</a></li>
                                    <!-- <li><a href="contact">Partners</a></li> -->
                                    <li><a href="{{ route('index') }}#temoignage">Temoignage</a></li>
                                    <li><a href="{{ route('home.about') }}#mot_dg">Mot du PCA</a></li>
                                    <li><a href="{{ route('home.about') }}#team">Notre equipe</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer-widget">
                            <h4 class="fw-title">Publications</h4>
                            <div class="footer-instagram">
                                <ul class="list-wrap">
                                    <li><a href="javascript:void(0)"><img
                                                src="{{ asset('assets/img/images/Part_assur.jpg') }}"
                                                alt=""></a></li>
                                    <li><a href="javascript:void(0)"><img
                                                src="{{ asset('assets/img/images/Tout_prevoir.jpg') }}"
                                                alt=""></a></li>
                                    <li><a href="javascript:void(0)"><img
                                                src="{{ asset('assets/img/images/Yako_solo.jpg') }}"
                                                alt=""></a></li>
                                    <li><a href="javascript:void(0)"><img
                                                src="{{ asset('assets/img/images/yako_eternite1.jpg') }}"
                                                alt=""></a></li>
                                    <li><a href="javascript:void(0)"><img
                                                src="{{ asset('assets/img/images/prev_ent.jpg') }}" alt=""></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><img
                                                src="{{ asset('assets/img/images/performa.jpg') }}" alt=""></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer__bottom-two">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="copyright-text-two text-white">
                            {{-- <ul class="list-wrap">
                                        <li><a href="javascript:void(0)">Politique de Confidentialité</a></li>
                                    </ul> --}}
                            <p class="text-white"><a href="javascript:void(0)" class="security" data-bs-toggle="modal"
                                    data-bs-target="#pcModal" style="color: #B6B8D8">Politique de confidentialité</a>
                            </p>
                            <!-- Modal -->
                            <div class="modal fade" id="pcModal" tabindex="-1" aria-labelledby="cguModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="https://yakoafricassur.com/politique/confident-site-web.html"
                                                style="width: 100%; height: 570px;"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-prime"
                                                data-bs-dismiss="modal">Fermer</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="copyright-text-two text-white">
                            <p class="text-white">Copyright © DSI 2024 | Tous droits réservés</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="copyright-text-two text-white">

                            <p class=""><a href="javascript:void(0)" class="security" data-bs-toggle="modal"
                                    data-bs-target="#cguModal" style="color: #B6B8D8">Conditions Générales
                                    d'Utilisation</a></p>

                            <!-- Modal -->
                            <div class="modal fade" id="cguModal" tabindex="-1" aria-labelledby="cguModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="https://yakoafricassur.com/politique/cgu-site-web.html"
                                                style="width: 100%; height: 570px;"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-prime"
                                                data-bs-dismiss="modal">Fermer</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer-area-end -->
