<!doctype html>
<html class="no-js" lang="en">

<!-- Mirrored from apexa-html-demo.vercel.app/index-8 by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2024 17:43:42 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home || Yako Africa Assurances Vie</title>
    <meta name="description" content="Apexa - Business Consulting HTML Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/images/favicon_yako.png')}}">
    <!-- Place favicon.ico in the root directory -->
    <!-- CSS here -->

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css')}}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Leaflet CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/odometer.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/default.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <style>
        @media only screen and (min-width:820px) {
            .breadcrumb__bg {
                background-image: linear-gradient(to left, rgba(236, 240, 249, 0.1), rgba(191, 202, 208, 0.4)), url('{{ asset('assets/img/images/banner.jpg')}}')
            }
        }
        @media only screen and (max-width:819px) {
            .breadcrumb__bg {
                background-image: linear-gradient(to left, rgba(236, 240, 249, 0.2), rgba(191, 202, 208, 0.5)), url('{{ asset('assets/img/images/small_banner.jpg')}}')
            }
        }
    </style>
</head>
<body>
    <!--Preloader-->
    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="Preloader"></div>
            </div>
        </div>
    </div>
    <!--Preloader-end -->
    <!-- Scroll-top -->
    <button class="scroll__top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->
    <!-- header-area -->
    @include('users.layouts.header')
    <!-- header-area-end -->
    <!-- main-area -->
    <main class="fix wrapper">
        <form id="visitedForm" action="{{ route('admin.isVisited') }}" method="POST" style="display:none;">
            @csrf
            <input type="hidden" name="uuid_activity" value="">
            <input type="hidden" name="product_uuid" value="">
            <input type="hidden" name="reseau_uuid" value="">
            <input type="hidden" name="prodformule_uuid" value="">
            <input type="hidden" name="page_visited" value="">
        </form>
      @yield('content')
        <!-- brand-area -->

        <!-- Icône WhatsApp 0565871780 -->
<a href="https://wa.me/+2250565871780" title="Nous contactez sur WhatsApp" class="whatsapp_float" target="_blank">
    <i class="fab fa-whatsapp whatsapp-icon"></i>
</a>
<a href="https://yakoafricassur.com/e-services/download_apk.php" class="mt-3 app_float shadow" title="Télécharger notre application Mobile Ynov">
    <img src="{{ asset('assets/img/images/App_Ynov.png')}}" alt="" class="rounded app_float-icon" width="100px" height="100px">
</a>

{{-- <p class="whatsapp_float">
    <dotlottie-wc
        src="https://lottie.host/39407f99-c216-404b-a36e-eaf5b623e596/GO8dgE5GJ5.lottie"
        style="width: 300px;height: 300px"
        autoplay
        loop
    ></dotlottie-wc>
</p> --}}
{{-- <p class="happy_float1">
    <dotlottie-wc
        src="https://lottie.host/2344dcaa-4c80-4aa6-a6a0-e94e3ef62d54/IQs0Ou6dZ2.lottie"
        style="width: 300px;height: 300px"
        autoplay
        loop
    ></dotlottie-wc>
</p>
<p class="happy_float3">
    <dotlottie-wc
        src="https://lottie.host/2344dcaa-4c80-4aa6-a6a0-e94e3ef62d54/IQs0Ou6dZ2.lottie"
        style="width: 300px;height: 300px"
        autoplay
        loop
    ></dotlottie-wc>
</p> --}}
{{-- <p class="whatsapp_float">
    <dotlottie-wc
        src="https://lottie.host/cd1ea6d5-1f85-4cc8-a391-342db808bf3f/sUJgXocJ4d.lottie"
        style="width: 300px;height: 300px"
        autoplay
        loop
    ></dotlottie-wc>
</p>
<p class="whatsapp_float">
    <dotlottie-wc
        src="https://lottie.host/f24a45bb-7618-452a-82c6-ce22c9b79fbd/0bcIJQ6WYB.lottie"
        style="width: 300px;height: 300px"
        autoplay
        loop
    ></dotlottie-wc>
</p> --}}
</main>

<!-- footer-area -->
@include('users.layouts.footer')
<!-- footer-area-end -->

<!-- JS here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script> --}}
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.11/dist/dotlottie-wc.js" type="module"></script>
    {{-- <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.min.js"></script>

    <script>
        $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: true,
        centerMode: true,
        focusOnSelect: true
        });
    </script>

    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.odometer.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.appear.js')}}"></script>
    <script src="{{ asset('assets/js/gsap.js')}}"></script>
    <script src="{{ asset('assets/js/ScrollTrigger.js')}}"></script>
    <script src="{{ asset('assets/js/SplitText.js')}}"></script>
    <script src="{{ asset('assets/js/gsap-animation.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.parallaxScroll.min.js')}}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.js')}}"></script>
    <script src="{{ asset('assets/js/ajax-form.js')}}"></script>
    <script src="{{ asset('assets/js/wow.min.js')}}"></script>
    <script src="{{ asset('assets/js/aos.js')}}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets_admin/js/script.js')}}"></script>
    <script>
        function rangeSlide(value) {
            document.getElementById('rangeValue').innerHTML = value;
        }
    </script>
    <script>
        function reseauVisitedForm(uuid, redirectUrl) {
        // Récupérer le formulaire
        const form = document.getElementById('visitedForm');

        // Remplir le champ `uuid_activity` avec la valeur passée
        // form.querySelector('input[name="page_visited"]').value = 'Nos produits';
        form.querySelector('input[name="reseau_uuid"]').value = uuid;

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

    <script>
        function pageVisitedForm(uuid, redirectUrl) {
        // Récupérer le formulaire
        const form = document.getElementById('visitedForm');

        // Remplir le champ `uuid_activity` avec la valeur passée
        form.querySelector('input[name="page_visited"]').value = uuid;
        form.querySelector('input[name="reseau_uuid"]').value = "";
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

    {{-- <script>
       document.addEventListener('DOMContentLoaded', () => {
            const banner = document.querySelector('.banner-scroll-football');
            const container = document.querySelector('.banner-football');

            let isPaused = false;
            let lastPauseTime = 0;

            function loop() {
                const now = Date.now();
                const bannerRect = banner.getBoundingClientRect();
                const containerRect = container.getBoundingClientRect();

                const bannerCenter = bannerRect.left + bannerRect.width / 2;
                const containerCenter = containerRect.left + containerRect.width / 2;

                // Évite pause multiple au même passage
                if (
                    !isPaused &&
                    Math.abs(bannerCenter - containerCenter) < 8 &&
                    now - lastPauseTime > 8000
                ) {
                    isPaused = true;
                    lastPauseTime = now;
                    banner.style.animationPlayState = 'paused';

                    setTimeout(() => {
                        banner.style.animationPlayState = 'running';
                        isPaused = false;
                    }, 3000);
                }

                requestAnimationFrame(loop);
            }

            requestAnimationFrame(loop);
        });
    </script>
     --}}
    {{-- <script>
document.addEventListener('DOMContentLoaded', () => {
    const football = document.querySelector('.banner-scroll-football');
    const text = document.querySelector('.banner-scroll-text');
    const container = document.querySelector('.banner-football');

    const PAUSE_TIME = 3000;
    let step = 0;

    function center(el) {
        const r = el.getBoundingClientRect();
        return r.left + r.width / 2;
    }

    function containerCenter() {
        const r = container.getBoundingClientRect();
        return r.left + r.width / 2;
    }

    function resetAnimation(el) {
        el.style.animation = 'none';
        el.offsetHeight;
        el.style.animation = '';
        el.style.animationPlayState = 'paused';
    }

    function loop() {
        const c = containerCenter();

        /* 1️⃣ football démarre */
        if (step === 0) {
            football.style.animationPlayState = 'running';
            step = 1;
        }

        /* 2️⃣ football arrive au centre → STOP */
        else if (step === 1 && Math.abs(center(football) - c) < 10) {
            football.style.animationPlayState = 'paused';
            text.style.animationPlayState = 'running';
            step = 2;
        }

        /* 3️⃣ text arrive au centre → STOP */
        else if (step === 2 && Math.abs(center(text) - c) < 10) {
            text.style.animationPlayState = 'paused';
            step = 3;

            /* 4️⃣ attendre 3s puis repartir ensemble */
            setTimeout(() => {
                football.style.animationPlayState = 'running';
                text.style.animationPlayState = 'running';
                step = 4;
            }, PAUSE_TIME);
        }

        /* 5️⃣ quand les deux sont sortis → reset */
        else if (
            step === 4 &&
            center(football) < 0 &&
            center(text) < 0
        ) {
            resetAnimation(football);
            resetAnimation(text);
            step = 0;
        }

        requestAnimationFrame(loop);
    }

    requestAnimationFrame(loop);
});
</script> --}}


    
</body>

<!-- Mirrored from apexa-html-demo.vercel.app/index-8 by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2024 17:43:47 GMT -->
</html>