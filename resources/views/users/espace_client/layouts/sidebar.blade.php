<!--sidebar wrapper -->
<div class="sidebar-wrapper sidebar" data-simplebar="true">
    <div class="sidebar-header d-flex justify-content-center align-items-center">
        <div class="w-100 d-flex justify-content-center align-items-center" style="height: 90%">
            <div class="d-flex justify-content-center align-items-center" style="height: 100%; width:80%;">
                <a href="{{ route('customer.dashboard') }}">
                    <img src="{{ asset('cust_assets/images/logo-icon.png') }}" style="height: 100%; width:80%;"
                        class="logo-icon img-fluid" alt="logo icon">
                    {{-- <h4 class="logo-text">Ynov</h4> --}}
                </a>
            </div>
        </div>

        <div class="toggle-icon ms-auto text-warning"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('customer.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Tableau de bord</div>
            </a>
        </li>
        <li class="menu-label">Mes services</li>
        <li>
            <a href="{{ route('customer.police') }}">
                <div class="parent-icon"><i class="fadeIn animated bx bx-archive-out"></i>
                </div>
                <div class="menu-title">Documents contractuels</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#enMaintenanceModal">
            {{-- <a href="{{ route('sinistre.index') }}"> --}}
                <div class="parent-icon"><i class="fadeIn animated bx bx-archive-out"></i>
                </div>
                <div class="menu-title">Pré-déclaration de sinistre</div>
            </a>
        </li>
        <li>
            <a href="{{ route('customer.rdv') }}">
                <div class="parent-icon"><i class="fadeIn animated bx bx-clipboard"></i>
                </div>
                <div class="menu-title">Prendre un RDV</div>
            </a>
        </li>
        <li>
            <a href="{{ route('customer.etatCotisation') }}">
                <div class="parent-icon"><i class="bx bx-dollar-circle fs-5"></i>
                </div>
                <div class="menu-title">Etat de cotisation</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#paiementPrimeModal">
            {{-- <a href="https://yakoafricassur.com/e-services/paiement/paiement-prime.php" target="_blank"> --}}
                <div class="parent-icon"><i class="bx bx-dollar-circle fs-5"></i>
                </div>
                <div class="menu-title">Payer ma prime</div>
            </a>
        </li>
        <li>
            <a href="{{ route('customer.prestation') }}">
                <div class="parent-icon"><i class='bx bx-network-chart'></i>
                </div>
                <div class="menu-title">Prestations</div>
            </a>
        </li>
        <li class="menu-label">Extras</li>
        <li>
            <a href="{{ route('index') }}">
                <div class="parent-icon"><i class="fadeIn animated bx bx-archive-out"></i>
                </div>
                <div class="menu-title">Retour au site web</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
<!--start header -->
<header class="top-header">
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu"><i class='bx bx-menu text-white'></i>
            </div>


            <div class="top-menu ms-auto ">
                <ul class="navbar-nav align-items-center gap-1 d-none">

                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            data-bs-toggle="dropdown"><span class="alert-count">7</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notifications</p>
                                    <p class="msg-header-badge">8 New</p>
                                </div>
                            </a>
                            <div class="header-notifications-list header-message-list">
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="{{ asset('assets/images/avatars/avatar-1.png') }}"
                                                class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Daisy Anderson<span class="msg-time float-end">5 sec
                                                    ago</span></h6>
                                            <p class="msg-info">The standard chunk of lorem</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">
                                    <button class="btn btn-primary w-100">View All Notifications</button>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown px-3">
                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('assets/img/images/user-default1.jpg') }}" class="user-img" alt="user avatar">
                    <div class="user-info text-white">
                        <p class="user-name text-white mb-0">
                            @if (Auth::guard('customer')->check())
                                {{ Auth::guard('customer')->user()->membre->nom ?? '' }} |
                                {{ Auth::guard('customer')->user()->membre->prenom ?? '' }}
                            @endif
                        </p>
                        {{-- <p class="designattion mb-0">Web Designer</p> --}}
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                class="bx bx-user fs-5"></i><span>Profile</span></a>
                    </li>
                    {{-- <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-cog fs-5"></i><span>Settings</span></a>
                    </li> --}}
                    <li><a class="dropdown-item d-flex align-items-center"
                            href="{{ route('customer.dashboard') }}"><i
                                class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li>
                        <form id="logout-form" action="{{ route('customer.logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('customer.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-log-out-circle"></i>
                            <span>déconnexion</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="modal fade" id="paiementPrimeModal" tabindex="-1" aria-labelledby="paiementPrimeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paiementPrimeModalLabel">Payer ma prime</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <form action="{{ route('customer.paiement.prime') }}" method="post" id="paiementPrimeForm">
                @csrf
                <div class="modal-body">
                    <div class="card radius-10">
                        <div class="card-body bg-light-succes rounded">
                            <div class="">
                                <label for="single-select" class="form-label">Pour quel Contrat
                                    souhaitez-vous payer la prime ? <span class="star">*</span></label>
                                <select class="form-select" name="idcontratForPaiement" id="single-select"
                                    data-placeholder="" required>
                                    <option selected value="">Veuillez sélectionner l'ID du contrat</option>
                                    @foreach (Auth::guard('customer')->user()->membre->membreContrat as $contrat)
                                        <option value="{{ $contrat->idcontrat }}">
                                            {{ $contrat->idcontrat }}
                                        </option> 
                                    @endforeach
                                </select>
                                {{-- <input type="hidden" value="Prestation" name="type"> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-prime" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" id="submitBtn" class="btn-prime btn-prime-two">Continuer</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="card radius-10">
                        <div class="card-header">
                        </div>
                        <div class="card-body bg-light-success rounded">
                            <div class="align-items-center">
                                <div class="flex-grow-1 ms-3 my-4 text-dark" style="text-align: justify">
                                    Voulez-vous vraiment faire une pré-déclaration de sinistre ?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-prime" data-bs-dismiss="modal">Non</button>
                    <a href="{{ route('sinistre.index') }}" class="btn-prime btn-prime-two">Oui</a>
                    {{-- <a href="https://yakoafricassur.com/e-services/sinistre/declarationsinistre.php" class="btn-prime btn-prime-two">Oui</a> --}}
                    {{-- <a href="http://espace-client.test/_verifInfo.php" class="btn-prime btn-prime-two">Oui</a> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="enMaintenanceModal" tabindex="-1" aria-labelledby="enMaintenanceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enMaintenanceModalLabel">En cour de développement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="card radius-10">
                        <div class="card-header">
                        </div>
                        <div class="card-body bg-light-danger rounded">
                            <div class="align-items-center">
                                <div class="flex-grow-1 ms-3 my-4 text-dark" style="text-align: justify">
                                    Cette fonctionnalité est en cours de développement et sera disponible
                                    prochainement, Merci de contacter YAKO AFRICA Assurance Vie pour toute question
                                    <b>
                                        <a href="tel:2720331500" class="">
                                            <i class="flaticon-phone-call"></i>&nbsp; +225 27 20 33 15 00
                                        </a>
                                    </b>.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-prime" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
</header>
<!--end header -->
