@extends('users.layouts.main')
@section('content')

<!-- breadcrumb-area -->
<section class="breadcrumb__area breadcrumb__bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="breadcrumb__content">
                    <h2 class="title">Détails actualité</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Détails actualité</li>
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
<!-- blog-details-area -->
<section class="blog__details-area">
    <div class="container">
        <div class="blog__inner-wrap">
            <div class="row">
                <div class="col-70">
                    <div class="blog__details-wrap">
                        <div class="blog__details-thumb slider-for m-auto mb-3" style="position: relative">
                            @foreach($actuality->postImage as $image)
                            <div class="shadow" style="height: 80vh !important; width: 100%; background-image: url({{ asset('images/Actualities/'.$image->image_url) }}); background-size: contain; background-position: center center; background-repeat: no-repeat" >

                                {{-- <img src="{{ asset('images/Actualities/'.$image->image_url) }}" class="img-flu" style="max-height: 100%;" alt=""> --}}
                            </div>
                            @endforeach
                        </div>
                        <div class="slider-nav " style="position: relative">
                            @if (count($actuality->postImage) > 1)
                                @foreach($actuality->postImage as $image)
                                        <div class="m-1" style="max-width: 100px !important; height: 100px;">
                                            <img src="{{ asset('images/Actualities/' . $image->image_url) }}" alt="Image" class="m-1 img-fluid" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;">
                                        </div>
                                @endforeach
                            @endif
                        </div>
                        
                        
                        <div class="blog__details-content">
                            <h2 class="titl">{{$actuality->title ?? 'N/A' }}</h2>
                            <div class="blog-post-meta">
                                <ul class="list-wrap">
                                    <li>
                                        <a href="#" class="blog__post-tag-two">
                                            @if($actuality->product)
                                                {{ $actuality->product->label ?? ' ' }}
                                            @else
                                                {{ $actuality->product_uuid ?? ' ' }}
                                            @endif
                                        </a>
                                    </li>
                                    <li>
                                        <div class="blog-avatar">
                                            <div class="avatar-thumb">
                                                <img src="{{ asset('assets/img/images/user-default1.jpg')}}" alt="">
                                            </div>
                                            <div class="avatar-content">
                                                <p>By <a href="#">{{ $actuality->user->name ?? 'aucun user' }}</a></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li><i class="fas fa-calendar-alt"></i>{{ $actuality->created_at->diffForHumans() ?? 'N/A' }}</li>
                                    <li><i class="far fa-comment"></i><a href="#comment">0{{count($comments)}} commentaire(s)</a></li>
                                </ul>
                            </div>
                            <p style="text-align: justify">{!! $actuality->comment ?? "N/A" !!}</p>
                            @if($actuality && $actuality->video_url)
                            
                                <div class="blog__details-inner">
                                    <div class="row align-items-center">
                                        <div class="col-md-7 order-0 order-lg-2">
                                            <div class="blog__details-inner-thumb">
                                                @foreach($actuality->postImage as $key => $image)
                                                    @if($loop->first)
                                                        <img src="{{ asset('images/Actualities/' . $image->image_url) }}"  alt="">
                                                    @endif
                                                @endforeach
                                                <a href="{{ $actuality->video_url}}" class="play-btn popup-video"><i class="fas fa-play"></i></a>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            @endif
                            <blockquote>
                                    <p>
                                        {!! nl2br(e($actuality->citation) ?? "N/A") !!}
                                    </p>
                               
                            </blockquote>
                            
                            {{-- <div class="col-md-5 order-2 order-lg-0">
                                <div class="blog__details-inner-content">
                                    
                                   
                                </div>
                            </div> --}}

                            <div class="blog__details-bottom">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <div class="post-tags">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="post-share">
                                            <h5 class="title">Share:</h5>
                                            <ul class="list-wrap">
                                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comments-wrap" id="comment">
                            <h3 class="comments-wrap-title">0{{count($comments)}} commentaire(s)</h3>
                            <div class="latest-comments">
                                <ul class="list-wrap">
                                    @forelse($comments as  $com)
                                    <li>
                                        <div class="comments-box">
                                            <div class="comments-avatar">
                                                <img src="{{ asset('assets/img/images/user-default1.jpg')}}" alt="img" class="img-fluid">
                                            </div>
                                            <div class="comments-text">
                                                <div class="avatar-name">
                                                    <h6 class="name">{{ $com->customer_name }}</h6> &nbsp; &nbsp;
                                                    <span class="date">{{ $com->created_at->diffForHumans() ?? 'N/A' }}</span>
                                                </div>
                                                <p>{!! nl2br(e($com->comment) ?? "N/A") !!}</p>               
                                                <a href="" class="collapsed reply-btn" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" id="flush-headingOne">Repondre</a>
                                            
                                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                                    <div class="">
                                                        
                                                      <div id="flush-collapseOne" class="collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="background-color: rgb(236,246,250);">
                                                        <div class="accordion-body">
                                                            <form action="#" class="comment-form">
                                                                <div class="form-grp">
                                                                    <textarea name="comment" rows="2" placeholder="entrer votre reponse ici"></textarea>
                                                                </div>
                                                                <button type="submit" class="btn">Soumettre</button>
                                                            </form>
                                                        </div>
                                                      </div>
                                                    </div>                  
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <ul class="children">
                                            <li>
                                                <div class="comments-box">
                                                    <div class="comments-avatar">
                                                        <img src="{{ asset('assets/img/blog/comment02.png')}}" alt="img">
                                                    </div>
                                                    <div class="comments-text">
                                                        <div class="avatar-name">
                                                            <h6 class="name">Parker Willy</h6>
                                                            <span class="date">December 28, 2024</span>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum voluptatem alias ratione aspernatur, saepe molestias.</p>
                                                        <a href="#" class="reply-btn">Repondre</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul> --}}
                                    </li> 
                                    @empty
                                     <div class="comments-box">
                                        <p>Aucun commentaire pour le moment.</p>
                                    </div>
                                    
                                    @endforelse()

                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-30">
                    <aside class="blog__sidebar">
                        <div class="sidebar__widget">
                            <h4 class="sidebar__widget-title">Posts recents</h4>
                            <div class="sidebar__post-list">
                                @forelse($actualities as $actuality)
                                    <div class="sidebar__post-item">
                                        <div class="sidebar__post-thumb">
                                            <a href="{{ route('home.actuality.details', $actuality->uuid) }}"><img src="{{ asset('images/Actualities/'.$actuality->image_url) }}" alt=""></a>
                                        </div>
                                        <div class="sidebar__post-content">
                                            <h5 class="title"><a href="{{ route('home.actuality.details', $actuality->uuid) }}">{{ Str::limit($actuality->title, 20, "...") ?? 'N/A' }}</a></h5>
                                            <span class="date"><i class="flaticon-time"></i>{{ $actuality->created_at->diffForHumans() ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                @empty
                                <div class="sidebar__post-item">
                                    <p>Aucun article recent pour le moment.</p>
                                    </div>   
                                @endforelse()
                            </div>
                        </div>
                        <!--  -->
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <div class="comment-respond" style="width: 70%; margin: auto;">
        <h3 class="comment-reply-title">Poster un commentaire</h3>
        <form class="comment-form submitForm" action="{{ route('home.actuality.comment_store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <p class="comment-notes">Votre adresse email ne sera pas publiée. Les champs obligatoires sont marqués *</p>
            <div class="row"> 
                <div class="col-md-6">
                    <div class="form-grp">
                        <input type="text" name="customer_name" placeholder="Votre nom" required autocomplete="off">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-grp">
                        <input type="number" name="customer_phone" placeholder="telephone" required autocomplete="off">
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
                        <input type="url" name="customer_website" placeholder="Website" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="form-grp">
                <input type="hidden" name="actuality_uuid" value="{{$actuality->uuid}}">
            </div>
            <div class="form-grp">
                <textarea name="comment" placeholder="Votre commentaire" autocomplete="off"></textarea>
            </div>
            <button type="submit" class="btn">Soumettre</button>
        </form>
    </div>
</section>
<!-- blog-details-area-end -->
<!-- brand-area -->
@include('users.layouts.partners-slider')
<!-- call-back-area-end -->
@endsection