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
                        {{-- <div class="blog-post-wrap">
                            <div class="row gutter-24">
                                @foreach($actualityByProducts as $actualityByProduct)
                                <div class="col-md-6">
                                    <div class="blog__post-two shine-animate-item" style="min-height: 500px; max-height: 500px">
                                        <div class="blog__post-thumb-two">
                                            <a href="{{ route('home.actuality.details', $actualityByProduct->uuid) }}" class="shine-animate"><img src="{{ asset('images/Actualities/'.$actualityByProduct->image_url) }}" alt=""></a>
                                        </div>
                                        <div class="blog__post-content-two">
                                            <div class="blog-post-meta">
                                                <ul class="list-wrap">
                                                    <li>
                                                        <a href="{{ route('home.actuality.actualityByProduct', $actualityByProduct->product_uuid) }}" class="blog__post-tag-two">{{ $actualityByProduct->product->label ?? 'Produit non trouvé' }}</a>
                                                    </li>
                                                    <li><i class="fas fa-calendar-alt"></i>{{ $actualityByProduct->created_at->diffForHumans() ?? 'N/A' }}</li>
                                                </ul>
                                            </div>
                                            <h2 class="title"><a href="{{ route('home.actuality.details', $actualityByProduct->uuid) }}">{{ Str::limit($actualityByProduct->title, 20, "...") ?? 'N/A' }}</a></h2>
                                            <p>{!! nl2br(e(Str::limit($actualityByProduct->comment, 50, "...") ?? "N/A")) !!}</p>
                                            <div class="blog-avatar">
                                                <div class="avatar-thumb">
                                                    <img src="{{ asset('assets/img/blog/blog_avatar01.png')}}" alt="">
                                                </div>
                                                <div class="avatar-content">
                                                    <p>By <a href="{{ route('home.actuality.details', $actualityByProduct->uuid) }}">{{ $actualityByProduct->user->name ?? 'aucun user' }}</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="pagination-wrap mt-40">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination list-wrap">
                                        <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-double-left"></i></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item next-page"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div> --}}
                        <div class="blog-post-wrap">
                            <div class="row gutter-24" id="actualitie-list">
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
                                    <ul class="pagination list-wrap" id="paginations">
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
                                    @foreach($actualityByProducts as $actualityByProduct)
                                    <div class="sidebar__post-item">
                                        <div class="sidebar__post-thumb">
                                            <a href="javascript:void(0)" onclick="submitVisitedForm('{{$actualityByProduct->uuid}}', '{{ route('home.actuality.details', $actualityByProduct->uuid) }}')">
                                                {{-- <img src="{{ asset('images/Actualities/'.$actualityByProduct->image_url) }}" alt=""> --}}
                                                @foreach($actualityByProduct->postImage as $key => $image)
                                                    @if($loop->first)
                                                        <img src="{{ asset('images/Actualities/' . $image->image_url) }}" alt="">
                                                    @endif
                                                @endforeach
                                            </a>
                                        </div>
                                        <div class="sidebar__post-content">
                                            <h5 class="title"><a href="javascript:void(0)" onclick="submitVisitedForm('{{$actualityByProduct->uuid}}', '{{ route('home.actuality.details', $actualityByProduct->uuid) }}')">{{ Str::limit($actualityByProduct->title, 20, "...") ?? 'N/A' }}</a></h5>
                                            <span class="date"><i class="flaticon-time"></i>{{ $actualityByProduct->created_at->diffForHumans() ?? 'N/A' }}</span>
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
            const actualityByProducts = @json($actualityByProducts); // Toutes les actualités envoyées par le backend
            const perPages = 4; // Nombre d'éléments par page
            let currentPages = 1;
    
            function displayActualityByProducts(pages) {
                const starts = (pages - 1) * perPages;
                const ends = starts + perPages;
                const actualityByProductsList = document.getElementById('actualitie-list');
                actualityByProductsList.innerHTML = '';
    
                const currentActualityByProducts = actualityByProducts.slice(starts, ends);
                currentActualityByProducts.forEach(actualitie => {
                    const limitedComments = actualitie.comment ? actualitie.comment.substring(0, 50) + '...' : 'N/A';
                    const limitedTitles = actualitie.title ? actualitie.title.substring(0, 45) + '...' : 'N/A';

                    const firstImage = actualitie.post_image && actualitie.post_image.length > 0
                    ? actualitie.post_image[0].image_url
                    : '';  // Remplacez 'default-image.jpg' par votre image par défaut si nécessaire

                    const actualitieHtml = `
                        <div class="col-md-6">
                            <div class="blog__post-two shine-animate-item" style="min-height: 500px; max-height: 500px">
                                <div class="blog__post-thumb-two">
                                    <a href="javascript:void(0)" class="shine-animate" onclick="submitVisitedForm('${actualitie.uuid}', '{{ route('home.actuality.details', '') }}/${actualitie.uuid}')" class="shine-animate">
                                        <img src="/images/Actualities/${firstImage}" alt="">
                                    </a>
                                </div>
                                <div class="blog__post-content-two">
                                    <div class="blog-post-meta">
                                        <ul class="list-wrap">
                                            <li>
                                                <a href="/actuality/product/${actualitie.product_uuid}" class="blog__post-tag-two">
                                                    ${actualitie.product ? actualitie.product.label : actualitie.product_uuid ?? ' '}
                                                </a>
                                            </li>
                                            <li><i class="fas fa-calendar-alt"></i>${new Date(actualitie.created_at).toLocaleDateString()}</li>
                                        </ul>
                                    </div>
                                    <h2 class="title"><a href="javascript:void(0)" class="shine-animate" onclick="submitVisitedForm('${actualitie.uuid}', '{{ route('home.actuality.details', '') }}/${actualitie.uuid}')">${limitedTitles}</a></h2>
                                    <div class="blog-avatar">
                                        <div class="avatar-thumb">
                                            <img src="{{ asset('assets/img/images/user-default1.jpg')}}" alt="">
                                        </div>
                                        <div class="avatar-content">
                                            <p>By <a href="javascript:void(0)" class="shine-animate" onclick="submitVisitedForm('${actualitie.uuid}', '{{ route('home.actuality.details', '') }}/${actualitie.uuid}')">${actualitie.user ? actualitie.user.name : 'aucun user'}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    actualityByProductsList.insertAdjacentHTML('beforeend', actualitieHtml);
                });
            }
    
            function setupPaginations() {
                const totalPage = Math.ceil(actualityByProducts.length / perPages);
                const paginations = document.getElementById('paginations');
                paginations.innerHTML = '';
    
                const prevPagesItem = `
                    <li class="page-item ${currentPages === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" id="prev-pages"><i class="fas fa-angle-double-left"></i></a>
                    </li>
                `;
                paginations.insertAdjacentHTML('beforeend', prevPagesItem);
    
                for (let j = 1; j <= totalPage; j++) {
                    const pagesItem = `
                        <li class="page-item ${j === currentPages ? 'active' : ''}">
                            <a class="page-link" href="#">${j}</a>
                        </li>
                    `;
                    paginations.insertAdjacentHTML('beforeend', pagesItem);
                }
    
                const nextPagesItem = `
                    <li class="page-item ${currentPages === totalPage ? 'disabled' : ''}">
                        <a class="page-link" href="#" id="next-pages"><i class="fas fa-angle-double-right"></i></a>
                    </li>
                `;
                paginations.insertAdjacentHTML('beforeend', nextPagesItem);
    
                // Événements de clic pour les pages numérotées
                document.querySelectorAll('#paginations .page-item a').forEach(item => {
                    item.addEventListener('click', function(event) {
                        event.preventDefault();
                        const pages = parseInt(this.textContent);
    
                        if (!this.closest('.page-item').classList.contains('disabled') && pages) {
                            currentPages = pages;
                            displayActualityByProducts(currentPages);
                            setupPaginations();
                        }
                    });
                });
    
                // Événements pour "Précédente" et "Suivante"
                document.getElementById('prev-pages').addEventListener('click', function(event) {
                    event.preventDefault();
                    if (currentPages > 1) {
                        currentPages--;
                        displayActualityByProducts(currentPages);
                        setupPaginations();
                    }
                });
    
                document.getElementById('next-pages').addEventListener('click', function(event) {
                    event.preventDefault();
                    if (currentPages < totalPage) {
                        currentPages++;
                        displayActualityByProducts(currentPages);
                        setupPaginations();
                    }
                });
            }
    
            // Initialiser l'affichage
            displayActualityByProducts(currentPages);
            setupPaginations();
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