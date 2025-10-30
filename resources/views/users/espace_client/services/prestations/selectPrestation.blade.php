@extends('users.espace_client.layouts.main')

@section('content')
    <!--start stepper one-->
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Prestations</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Demande de prestation</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
   
    <div class="card">
        <div class="card-header text-center">
            <h5 class="mb-0">De quelle prestation avez-vous besoin ?</h5>
            <p class="mb-0">Veuillez choisir une prestation</p>
        </div>
        <div class="card-body">

            <div class="row">
                {{-- @dd( $NbrencConfirmer/12) --}}
                @if (Session::get('fail'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('fail') }}
                    </div>
                @endif
                @foreach($typePrestations as $typePrestation) 
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $typePrestation->id }}" class="prestation" disabled>
                            <div class="card border rounded-4 text-center shadow-none bg-light-success">
                                <div class="card-body">
                                    <p class="mb-0 fs-5 text-success">{{ $typePrestation->libelle ?? 'Non renseigné' }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                
                @include('users.espace_client.services.prestations.modals.descriptionModal', ['id' => $typePrestation->id])
                @endforeach
                {{-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                    <a href="{{ route('customer.prestation.autre', $typePrestationAutre->id) }}" class="prestation">
                        <div class="card border rounded-4 text-center shadow-none bg-light-success">
                            <div class="card-body">
                                <p class="mb-0 fs-5 text-success">{{ $typePrestationAutre->libelle ?? 'Autre' }}</p>
                            </div>
                        </div>
                    </a>
                </div> --}}

            </div>
            <!--end row-->
        </div>
    </div>
@endsection
