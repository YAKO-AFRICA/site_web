@extends('users.layouts.main')
@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="breadcrumb__content">
                        <h2 class="title">Actualités</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Actualités</li>
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
     <!-- blog-area -->
     <section class="blog__area">
        <div class="container">
            <div class="blog__inner-wrap">
                <div class="row">
                    <div class="col-70">
                        <div class="blog-post-wrap">
                            <div class="row gutter-24" id="actualities-list">
                                <!-- Les actualités seront affichées ici par JavaScript -->
                            </div>
                            {{-- <form id="visitedForm" action="{{ route('admin.isVisited') }}" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="uuid_activity" value="">
                                <input type="hidden" name="product_uuid" value="">
                                <input type="hidden" name="reseau_uuid" value="">
                                <input type="hidden" name="prodformule_uuid" value="">
                            </form> --}}
                            
                        
                            <!-- Pagination -->
                            <div class="pagination-wrap mt-40">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination list-wrap" id="pagination">
                                        <!-- La pagination sera générée par JavaScript -->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-30">
                        <aside class="blog__sidebar">
                            <div class="sidebar__widget sidebar__widget-two">
                                <div class="sidebar__search">
                                    <form action="#">
                                        <input type="text" placeholder="Search . . .">
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none">
                                                <path d="M19.0002 19.0002L14.6572 14.6572M14.6572 14.6572C15.4001 13.9143 15.9894 13.0324 16.3914 12.0618C16.7935 11.0911 17.0004 10.0508 17.0004 9.00021C17.0004 7.9496 16.7935 6.90929 16.3914 5.93866C15.9894 4.96803 15.4001 4.08609 14.6572 3.34321C13.9143 2.60032 13.0324 2.01103 12.0618 1.60898C11.0911 1.20693 10.0508 1 9.00021 1C7.9496 1 6.90929 1.20693 5.93866 1.60898C4.96803 2.01103 4.08609 2.60032 3.34321 3.34321C1.84288 4.84354 1 6.87842 1 9.00021C1 11.122 1.84288 13.1569 3.34321 14.6572C4.84354 16.1575 6.87842 17.0004 9.00021 17.0004C11.122 17.0004 13.1569 16.1575 14.6572 14.6572Z" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="sidebar__widget">
                                <h4 class="sidebar__widget-title">Categories</h4>
                                <div class="sidebar__cat-list">
                                    <ul class="list-wrap">
                                        <li>
                                            <a href="{{ route('home.actuality') }}">
                                                <i class="flaticon-arrow-button"></i>
                                                Toutes les Categories
                                            </a>
                                        </li>
                                        @foreach($actualities->unique('product_uuid') as $actuality)
                                        @if($actuality && $actuality->product_uuid )   
                                        <li>
                                            <a href="{{ route('home.actuality.actualityByProduct', $actuality->product_uuid) }}">
                                                <i class="flaticon-arrow-button"></i>
                                                @if($actuality->product)
                                                    {{ $actuality->product->label ?? ' ' }}
                                                @else
                                                    {{ $actuality->product_uuid ?? ' ' }}
                                                @endif
                                                {{-- {{ $actuality->product->label ?? 'Institutionnelle' }} --}}
                                            </a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar__widget">
                                <h4 class="sidebar__widget-title">Posts recents</h4>
                                <div class="sidebar__post-list">
                                    @foreach($actualities as $actuality)
                                    <div class="sidebar__post-item">
                                        <div class="sidebar__post-thumb">
                                            <a href="javascript:void(0)" onclick="submitVisitedForm('{{$actuality->uuid}}', '{{ route('home.actuality.details', $actuality->uuid) }}')">
                                                {{-- <img src="{{ asset('images/Actualities/'.$actuality->image_url) }}" alt=""> --}}
                                                @foreach($actuality->postImage as $key => $image)
                                                    @if($loop->first)
                                                        <img src="{{ asset('images/Actualities/' . $image->image_url) }}" alt="">
                                                    @endif
                                                @endforeach
                                            </a>

                                        </div>
                                        <div class="sidebar__post-content">
                                            <h5 class="title"><a href="javascript:void(0)" onclick="submitVisitedForm('{{$actuality->uuid}}', '{{ route('home.actuality.details', $actuality->uuid) }}')">{{ Str::limit($actuality->title, 20, "...") ?? 'N/A' }}</a></h5>
                                            <span class="date"><i class="flaticon-time"></i>{{ $actuality->created_at->diffForHumans() ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    
                                    @endforeach
                                    
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog-area-end -->
    <!-- contact-area-end -->
     <!-- brand-area -->
     @include('users.layouts.partners-slider')
    <!-- call-back-area-end -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const actualities = @json($actualities); // Toutes les actualités envoyées par le backend
            const perPage = 4; // Nombre d'éléments par page
            let currentPage = 1;
    
            function displayActualities(page) {
                // Calculer l'index de départ et de fin pour les actualités à afficher
                const start = (page - 1) * perPage;
                const end = start + perPage;
    
                // Vider le conteneur actuel
                const actualitiesList = document.getElementById('actualities-list');
                actualitiesList.innerHTML = '';
                
                // Afficher les actualités pour la page actuelle
                const currentActualities = actualities.slice(start, end);
                currentActualities.forEach(actuality => {
                    console.log(actuality);
                    const limitedComment = actuality.comment ? actuality.comment.substring(0, 50) + '...' : 'N/A';
                    const limitedTitle = actuality.title ? actuality.title.substring(0, 45) + '...' : 'N/A';
            
                    const firstImage = actuality.post_image && actuality.post_image.length > 0
                    ? actuality.post_image[0].image_url
                    : '';  // Remplacez 'default-image.jpg' par votre image par défaut si nécessaire
                    const actualityHtml = `
                        <div class="col-md-6">
                            <div class="blog__post-two shine-animate-item" style="min-height: 500px; max-height: 500px">
                                <div class="blog__post-thumb-two">
                                    <a href="javascript:void(0)" class="shine-animate" onclick="submitVisitedForm('${actuality.uuid}', '{{ route('home.actuality.details', '') }}/${actuality.uuid}')">
                                        <img src="/images/Actualities/${firstImage}" alt="">
                                    </a>
                                </div>
                            
                                <div class="blog__post-content-two">
                                    <div class="blog-post-meta">
                                        <ul class="list-wrap">
                                            <li>
                                                <a href="javascript:void(0)" class="shine-animate" onclick="submitVisitedForm('${actuality.uuid}', '{{ route('home.actuality.details', '') }}/${actuality.uuid}')">
                                                    ${actuality.product ? actuality.product.label : actuality.product_uuid ?? ' '}
                                                </a>
                                                
                                            </li>
                                            <li><i class="fas fa-calendar-alt"></i>${new Date(actuality.created_at).toLocaleDateString()}</li>
                                        </ul>
                                    </div>
                                    <h2 class="title"><a href="javascript:void(0)" class="shine-animate" onclick="submitVisitedForm('${actuality.uuid}', '{{ route('home.actuality.details', '') }}/${actuality.uuid}')">${limitedTitle}</a></h2>
                                    <div class="blog-avatar">
                                        <div class="avatar-thumb">
                                            <img src="{{ asset('assets/img/images/user-default1.jpg')}}" alt="">
                                        </div>
                                        <div class="avatar-content">
                                            <p>By <a href="javascript:void(0)" class="shine-animate" onclick="submitVisitedForm('${actuality.uuid}', '{{ route('home.actuality.details', '') }}/${actuality.uuid}')">${actuality.user ? actuality.user.name : 'aucun user'}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    actualitiesList.insertAdjacentHTML('beforeend', actualityHtml);
                });
            }
    
            function setupPagination() {
                const totalPages = Math.ceil(actualities.length / perPage);
                const pagination = document.getElementById('pagination');
                pagination.innerHTML = '';
    
                // Ajouter le bouton "Précédente"
                const prevPageItem = `
                    <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" id="prev-page"><i class="fas fa-angle-double-left"></i></a>
                    </li>
                `;
                pagination.insertAdjacentHTML('beforeend', prevPageItem);
    
                // Créer les liens de pagination
                for (let i = 1; i <= totalPages; i++) {
                    const pageItem = `
                        <li class="page-item ${i === currentPage ? 'active' : ''}">
                            <a class="page-link" href="#">${i}</a>
                        </li>
                    `;
                    pagination.insertAdjacentHTML('beforeend', pageItem);
                }
    
                // Ajouter le bouton "Suivante"
                const nextPageItem = `
                    <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                        <a class="page-link" href="#" id="next-page"><i class="fas fa-angle-double-right"></i></a>
                    </li>
                `;
                pagination.insertAdjacentHTML('beforeend', nextPageItem);
    
                // Ajouter les événements de clic sur les liens de pagination
                document.querySelectorAll('#pagination .page-item a').forEach(item => {
                    item.addEventListener('click', function(event) {
                        event.preventDefault();
                        const page = parseInt(this.textContent);
    
                        // Changer de page uniquement si ce n'est pas un lien "disabled"
                        if (!this.closest('.page-item').classList.contains('disabled') && page) {
                            currentPage = page;
                            displayActualities(currentPage);
                            setupPagination();
                        }
                    });
                });
    
                // Gestion des boutons "Précédente" et "Suivante"
                document.getElementById('prev-page').addEventListener('click', function(event) {
                    event.preventDefault();
                    if (currentPage > 1) {
                        currentPage--;
                        displayActualities(currentPage);
                        setupPagination();
                    }
                });
    
                document.getElementById('next-page').addEventListener('click', function(event) {
                    event.preventDefault();
                    if (currentPage < totalPages) {
                        currentPage++;
                        displayActualities(currentPage);
                        setupPagination();
                    }
                });
            }
    
            // Initialiser l'affichage
            displayActualities(currentPage);
            setupPagination();

        });
    </script>
    <script>
        function submitVisitedForm(uuidActivity, redirectUrl) {
            // Récupérer le formulaire
            const form = document.getElementById('visitedForm');
    
            // Remplir le champ `uuid_activity` avec la valeur passée
            form.querySelector('input[name="uuid_activity"]').value = uuidActivity;
    
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