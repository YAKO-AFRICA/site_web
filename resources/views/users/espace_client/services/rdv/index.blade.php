@extends('users.espace_client.layouts.main')

@section('content')

    <!--start stepper one-->
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Rendez-vous</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Prise de rendez-vous</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-header text-center">
            <h5 class="mb-0">Quelle action souhaitez-vous effectuer ?</h5>
            {{-- <p class="mb-0">Veuillez choisir une prestation</p> --}}
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 mb-3">
                  
                </div>
                <div class="prestation col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                    <a href="javascript:void(0);" class="demande" data-bs-toggle="modal" data-bs-target="#getContractModal">
                    {{-- <a href="{{ route('customer.rdv.selectPrestation') }}" class="demande"> --}}
                        <div class="card border rounded-4 py-5 text-center shadow-none border-success bg-outl-light-success">
                            <div class="card-body">
                                <p class="mb-0 fs-5 text-success"><i class='bx bx-plus-circle fs-1'></i> <br> <span>Prendre un nouveau RDV</span> </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="prestation col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                    <a href="{{ route('customer.rdv.mesRdv') }}" class="demande">
                        <div class="card border rounded-4 py-5 text-center shadow-none border-success bg-ligh-success">
                            <div class="card-body">
                                <p class="mb-0 fs-5 text-success"><i class='bx bx-history fs-1'></i> <br> <span>Mes RDV pris</span></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 mb-3">
                  
                </div>

            </div><!--end row-->
        </div>
    </div>
    @include('users.espace_client.services.rdv.modals.getContractModal')
@endsection
