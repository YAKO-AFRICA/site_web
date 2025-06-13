@extends('users.layouts.main')
@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg">
        {{-- <form id="visitedForm" action="{{ route('admin.isVisited') }}" method="POST" style="display:none;">
            @csrf
            <input type="hidden" name="uuid_activity" value="">
            <input type="hidden" name="product_uuid" value="">
            <input type="hidden" name="reseau_uuid" value="">
            <input type="hidden" name="prodformule_uuid" value="">
        </form> --}}
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="breadcrumb__content">
                        <h2 class="title">Nos Produits</h2>
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
            <img src="{{ asset('assets/img/images/breadcrumb_shape01.png') }}" alt="">
            <img src="{{ asset('assets/img/images/breadcrumb_shape02.png') }}" alt="" class="rightToLeft">
            <img src="{{ asset('assets/img/images/breadcrumb_shape03.png') }}" alt="">
            <img src="{{ asset('assets/img/images/breadcrumb_shape04.png') }}" alt="">
            <img src="{{ asset('assets/img/images/breadcrumb_shape05.png') }}" alt="" class="alltuchtopdown">
        </div>
    </section>
    <!-- breadcrumb-area-end -->
    <!-- services-area -->
    <section class="services__area-six services__bg-six" id="service" style="background-color: #FFFBF3;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title white-title mb-40">
                        <span class="sub-title">NOS SOLUTIONS</span>
                        <h2 class="">Nous sommes là pour vous <br>satisfaire !</h2>
                    </div>
                </div>
                {{-- <div class="col-lg-6">
                    <div class="section-more-btn">
                        <a href="services" class="btn border-btn">See More Services</a>
                    </div>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="services__tab-wrap">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach ($products as $index => $product)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                        id="tab-product-{{ $product->uuid }}" onclick="productVisitedForm('{{$product->uuid}}')" data-bs-toggle="tab"
                                        data-bs-target="#tab-product-formul-{{ $product->uuid }}" type="button"
                                        role="tab" aria-controls="tab-product-formul-{{ $product->uuid }}"
                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">{{ $product->label }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            @foreach ($products as $index => $product)
                                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                                    id="tab-product-formul-{{ $product->uuid }}" role="tabpanel"
                                    aria-labelledby="tab-product-{{ $product->uuid }}" tabindex="0">
                                    <div class="services__item-four shine-animate-item">
                                        <div class="container">
                                            <div class="blog__inner-wrap">
                                                <p style="text-align: justify">{!! $product->description !!}</p>
                                                <div class="row">
                                                    <div class="col-100">
                                                        <div class="blog-post-wrap">
                                                            <div class="row gutter-24" id="formule-{{ $product->uuid }}">
                                                                <!-- Les réseaux et formules seront ajoutés dynamiquement ici -->

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

    <script>
        function productVisitedForm(uuid) {
            // Récupérer le formulaire
            const form = document.getElementById('visitedForm');
    
            // Remplir le champ `uuid_activity` avec la valeur passée
            form.querySelector('input[name="product_uuid"]').value = uuid;
            
    
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
                form.querySelector('input[name="product_uuid"]').value = null;
            })
            .catch(error => {
                console.error('Erreur lors de la soumission du formulaire:', error);
                alert('Une erreur est survenue. Veuillez réessayer.');
            });
        }
        function formuleVisitedForm(uuid, redirectUrl) {
            // Récupérer le formulaire
            const form = document.getElementById('visitedForm');
    
            // Remplir le champ `uuid_activity` avec la valeur passée
            form.querySelector('input[name="prodformule_uuid"]').value = uuid;
    
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
        // document.addEventListener('DOMContentLoaded', () => {
        //     const formulesByProduct = @json($formulesByProduct);
        //     const reseauByProduct = @json($reseauByProduct);

        //     // Fonction pour mettre à jour les formules dans l'onglet actif
        //     function updateFormules(productUuid) {
        //         const formulesContainer = document.getElementById(`formules-${productUuid}`);
        //         if (formulesContainer) {
        //             formulesContainer.innerHTML = ''; // Vider le conteneur

        //             const reseaux = reseauByProduct[productUuid] || [];
        //             const formules = formulesByProduct[$reseauByProduct->uuid] || [];
        //             if (formules.length > 0) {
        //                 formules.forEach(formule => {
        //                     const formulaHtml = ` 
    //                         <div class="col-lg-6 col-md-6">
    //                             <div class="blog__post-two shine-animate-item">
    //                                 <div class="blog__post-thumb-two">
    //                                     <a href="{{ route('home.formule_product.details', '') }}/${formule.uuid}" class="shine-animate">
    //                                         <img src="{{ asset('images/FormuleProducts') }}/${formule.formul_image}" alt="">
    //                                     </a>
    //                                 </div>
    //                                 <div class="blog__post-content-two">
    //                                     <h2 class="title text-center">
    //                                         <a href="{{ route('home.formule_product.details', '') }}/${formule.uuid}">${formule.label}</a>
    //                                     </h2>
    //                                     <div class="card-footer m-auto" style="width: 50%;">
    //                                         <a href="{{ route('home.formule_product.details', '') }}/${formule.uuid}" class="btn">Voir Plus</a>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     `;
        //                     formulesContainer.insertAdjacentHTML('beforeend', formulaHtml);
        //                 });
        //             } else {
        //                 formulesContainer.innerHTML = '<p>Aucune formule disponible pour ce produit.</p>';
        //             }
        //         }
        //     }

        //     // Fonction pour initialiser l'affichage des formules pour le premier produit
        //     function initializeFirstTab() {
        //         const firstTabLink = document.querySelector('.nav-link.active');
        //         if (firstTabLink) {
        //             const productUuid = firstTabLink.getAttribute('id').replace('tab-product-', '');
        //             updateFormules(productUuid);
        //         }
        //     }


        //     // Événement pour gérer le changement d'onglet
        //     document.querySelectorAll('.nav-link').forEach(link => {
        //         link.addEventListener('shown.bs.tab', (event) => {
        //             const targetId = event.target.getAttribute('data-bs-target').substring(1);
        //             const productUuid = targetId.replace('tab-product-formul-', '');
        //             updateFormules(productUuid);
        //         });
        //     });

        //     // Initialiser les formules du premier produit lors du chargement de la page
        //     initializeFirstTab();
        // });

        document.addEventListener('DOMContentLoaded', () => {
            const formulesByProduct = @json($formulesByProduct);
            const reseauByProduct = @json($reseauByProduct);

            // Fonction pour mettre à jour les réseaux et formules dans l'onglet actif
            function updateFormules(productUuid) {
                const formulesContainer = document.getElementById(`formule-${productUuid}`);
                if (formulesContainer) {
                    formulesContainer.innerHTML = ''; // Vider le conteneur

                    const reseaux = reseauByProduct[productUuid] || [];

                    if (reseaux.length > 0) {
                        // Parcourir les réseaux pour afficher leurs formules associées
                        reseaux.forEach(reseau => {
                            const reseauHtml = `
                        <div class="reseau-container">
                            <h3 class="reseau-title">${reseau.label}</h3> <!-- Affiche le nom du réseau -->
                            <div class="row formules-row" id="reseau-${reseau.uuid}-${productUuid}"></div> <!-- Conteneur pour les formules associées -->
                        </div>
                    `;
                            formulesContainer.insertAdjacentHTML('beforeend', reseauHtml);

                            // Maintenant, insérer les formules associées à ce réseau
                            const formules = formulesByProduct[productUuid][reseau.uuid] || [];
                            const formulesRow = document.getElementById(
                                `reseau-${reseau.uuid}-${productUuid}`);

                            if (formules.length > 0) {
                                formules.forEach(formule => {
                                    const formulaHtml = `
                            

                                <div class="col-lg-6 col-md-6">
                                    <div class="blog__post-two shine-animate-item">
                                        <div class="blog__post-thumb-two">
                                            <center> 
                                                <a href="javascript:void(0)" class="shine-animate" onclick="formuleVisitedForm('${formule.uuid}', '{{ route('home.formule_product.details', '') }}/${formule.uuid}')">
                                                    <img src="{{ asset('images/FormuleProducts') }}/${formule.formul_image}" alt="" class="img-fluid">
                                                </a>
                                            </center>
                                        </div>
                                        <div class="blog__post-content-two">
                                            <h2 class="title text-center">
                                                <a href="javascript:void(0)" onclick="formuleVisitedForm('${formule.uuid}', '{{ route('home.formule_product.details', '') }}/${formule.uuid}')">${formule.label}</a>
                                            </h2>                                                                
                                            <div class="card-footer m-auto" style="width: 50%;">
                                                <a href="javascript:void(0)" onclick="formuleVisitedForm('${formule.uuid}', '{{ route('home.formule_product.details', '') }}/${formule.uuid}')" class="btn">Voir Plus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                                    formulesRow.insertAdjacentHTML('beforeend', formulaHtml);
                                });
                            } else {
                                formulesRow.innerHTML = '<p>Aucune formule disponible pour ce réseau.</p>';
                            }
                        });
                    } else {
                        formulesContainer.innerHTML =
                            '<p>Aucun réseau de distribution disponible pour ce produit.</p>';
                    }
                }
            }

            // Fonction pour initialiser l'affichage des formules pour le premier produit
            function initializeFirstTab() {
                const firstTabLink = document.querySelector('.nav-link.active');
                if (firstTabLink) {
                    const productUuid = firstTabLink.getAttribute('id').replace('tab-product-', '');
                    updateFormules(productUuid);
                }
            }

            // Événement pour gérer le changement d'onglet
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('shown.bs.tab', (event) => {
                    const targetId = event.target.getAttribute('data-bs-target').substring(1);
                    const productUuid = targetId.replace('tab-product-formul-', '');
                    updateFormules(
                    productUuid); // Mettre à jour les formules pour le produit sélectionné
                });
            });

            // Initialiser les formules du premier produit lors du chargement de la page
            initializeFirstTab();
        });
    </script>

    <!-- call-back-area-end -->
@endsection
