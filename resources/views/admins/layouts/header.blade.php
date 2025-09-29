<!-- ===============================================-->
    <nav class="navbar navbar-vertical navbar-expand-lg" style="display:none;">
      <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">
          <ul class="navbar-nav flex-column" id="navbarVerticalNav">
            <li class="nav-item">
              <!-- parent pages-->
              <div class="nav-item-wrapper">
                <a class="nav-link label-1" href="{{ route('index.dashboard') }}" role="button">
                  <div class="d-flex align-items-center">
                    <div class="dropdown-indicator-icon-wrapper">
                    </div>
                    <span class="nav-link-icon">
                        <span data-feather="pie-chart"></span>
                    </span>
                    <span class="nav-link-text">Dashboard</span>
                    <span class="fa-solid fa-circle text-info ms-1 new-page-indicator" style="font-size: 6px">  
                    </span>
                  </div>
                </a>
                
              </div>
            </li>
            @can('Voir les pages du site')
              <li class="nav-item">
                <!-- label-->
                <p class="navbar-vertical-label">Pages</p>
                <hr class="navbar-vertical-line" /><!-- parent pages-->
                <ul class="nav" id="nv-e-commerce">   
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('admin.accueil') }}" title="Accueil">
                              <div class="d-flex align-items-center">
                                  <span class="fa-solid fa-house"></span>
                                  <span class="nav-link-text">Accueil</span>
                              </div>
                          </a><!-- more inner pages-->
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('admin.about') }}">
                              <div class="d-flex align-items-center">
                                  <span class="fa-solid fa-address-card"></span>
                                  <span class="nav-link-text">Qui somme nous</span>
                              </div>
                          </a><!-- more inner pages-->
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('admin.reseau') }}">
                              <div class="d-flex align-items-center">
                                  <span class="fa-solid fa-network-wired"></span>
                                  <span class="nav-link-text">Reseau</span>
                              </div>
                          </a><!-- more inner pages-->
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('admin.assistance') }}">
                              <div class="d-flex align-items-center">
                                  <span class="fa-brands fa-product-hunt"></span>
                                  <span class="nav-link-text">Assistances</span>
                              </div>
                          </a><!-- more inner pages-->
                      </li>
                  </ul> 
              </li>
            @endcan
            
            @can('Voir gestion des contenues')
              <li class="nav-item">
                <!-- label-->
                <p class="navbar-vertical-label">Gestion de Contenue</p>
                <hr class="navbar-vertical-line" /><!-- parent pages-->
                <ul class="nav" id="nv-e-commerce">

                  @can('Peut gérer les produits')   
                    <li class="nav-item">
                        <div class="nav-item-wrapper">
                            <a class="nav-link dropdown-indicator label-1" href="#nv-home" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-home">
                              <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper">
                                  <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                                </div>
                                <span class="nav-link-icon">
                                  <span data-feather="pie-chart"></span>
                                </span><span class="nav-link-text">Produits</span>
                                <span class="fa-solid fa-circle text-info ms-1 new-page-indicator" style="font-size: 6px"></span>
                              </div>
                            </a>
                            <div class="parent-wrapper label-1">
                              <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-home">
                                <li class="collapsed-nav-item-title d-none">Produits</li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.product_list') }}">
                                    <div class="d-flex align-items-center"><span class="nav-link-text">Liste Produit</span></div>
                                  </a><!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.product_formul') }}">
                                    <div class="d-flex align-items-center"><span class="nav-link-text">Formule Produit</span></div>
                                  </a><!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.reseau_distribution') }}">
                                    <div class="d-flex align-items-center"><span class="nav-link-text">Reseau de distribution</span></div>
                                  </a><!-- more inner pages-->
                                </li>
                              </ul>
                            </div>
                          </div>
                    </li>
                  @endcan

                  @can('Peut gérer les actualités')
                    <li class="nav-item">
                        <div class="nav-item-wrapper">
                            <a class="nav-link dropdown-indicator label-1" href="#nv-homeActualites" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-homeActualites">
                              <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper">
                                  <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                                </div>
                                <span class="nav-link-icon">
                                  <span data-feather="pie-chart"></span>
                                </span><span class="nav-link-text">Actualites</span>
                                <span class="fa-solid fa-circle text-info ms-1 new-page-indicator" style="font-size: 6px"></span>
                              </div>
                            </a>
                            <div class="parent-wrapper label-1">
                              <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-homeActualites">
                                <li class="collapsed-nav-item-title d-none">Actualites</li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.actuality') }}">
                                    <div class="d-flex align-items-center"><span class="nav-link-text">Liste Actualités</span></div>
                                  </a><!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.actuality.comment_show') }}">
                                    <div class="d-flex align-items-center"><span class="nav-link-text">Commentaire</span></div>
                                  </a><!-- more inner pages-->
                                </li>
                              </ul>
                            </div>
                          </div>
                    </li>
                  @endcan

                  @can('Peut gérer les réseaux')
                    <li class="nav-item">
                        <div class="nav-item-wrapper">
                            <a class="nav-link dropdown-indicator label-1" href="#nv-homeInterne" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-homeInterne">
                              <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper">
                                  <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                                </div>
                                <span class="nav-link-icon">
                                  <span data-feather="pie-chart"></span>
                                </span><span class="nav-link-text">Reseau interne</span>
                                <span class="fa-solid fa-circle text-info ms-1 new-page-indicator" style="font-size: 6px"></span>
                              </div>
                            </a>
                            <div class="parent-wrapper label-1">
                              <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-homeInterne">
                                <li class="collapsed-nav-item-title d-none">Reseau interne</li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.reseau_interne') }}">
                                    <div class="d-flex align-items-center"><span class="nav-link-text">Liste</span></div>
                                  </a><!-- more inner pages-->
                                </li>
                              </ul>
                            </div>
                          </div>
                    </li>
                  @endcan
                </ul>
              </li>
            @endcan

            @can('Voir gestion des intéractions')
            <li class="nav-item">
              <!-- label-->
              <p class="navbar-vertical-label">Gestion des interactions</p>
              <hr class="navbar-vertical-line" /><!-- parent pages-->
              <ul class="nav" id="nv-e-commerce">   
                  <li class="nav-item">
                      <div class="nav-item-wrapper">
                          <a class="nav-link dropdown-indicator label-1" href="#nv-homecontact" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-homecontact">
                            <div class="d-flex align-items-center">
                              <div class="dropdown-indicator-icon-wrapper">
                                <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                              </div>
                              <span class="nav-link-icon">
                                <span data-feather="pie-chart"></span>
                              </span><span class="nav-link-text">Pré-souscription</span>
                              <span class="fa-solid fa-circle text-info ms-1 new-page-indicator" style="font-size: 6px"></span>
                            </div>
                          </a>
                          @php
                             $newPreSouscription = App\Models\Presouscription::where(['etat' => 'Actif', 'status' => 'En attente', 'type' => 'Pré-souscription'])->get();
                             $newContact = App\Models\Presouscription::where(['etat' => 'Actif', 'status' => 'En attente', 'type' => 'contact'])->get();
                          @endphp
                          <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-homecontact">
                              <li class="collapsed-nav-item-title d-none">Pré-souscription</li>
                              <li class="nav-item"><a class="nav-link" href="{{ route('admin.subscription') }}">
                                  <div class="d-flex align-items-center">
                                    @if (count($newPreSouscription) > 0 or count($newContact) > 0)
                                    <span class="nav-link-text">Liste ({{count($newPreSouscription). ' Pré non lu' ?? ''}} et {{count($newContact). ' contact non lu' ?? ''}})</span>
                                    @else
                                     <span class="nav-link-text">Liste</span>
                                     @endif
                                  </div>
                                </a><!-- more inner pages-->
                              </li>
                              <li class="nav-item"><a class="nav-link" href="{{ route('admin.newsletter') }}">
                                  <div class="d-flex align-items-center"><span class="nav-link-text">E-mail Newslatter</span></div>
                                </a><!-- more inner pages-->
                              </li>
                              <li class="nav-item"><a class="nav-link" href="{{ route('admin.temoignage') }}">
                                <div class="d-flex align-items-center"><span class="nav-link-text">Temoignages</span></div>
                                </a><!-- more inner pages-->
                              </li>
                            </ul>
                          </div>
                        </div>
                  </li>
              </ul>
            </li>
            @endcan
            
            @can('Voir les types de Prestation')
              <li class="nav-item">
                <!-- label-->
                <p class="navbar-vertical-label">Gestion des type de prestations</p>
                <hr class="navbar-vertical-line" /><!-- parent pages-->
                <ul class="nav" id="nv-e-commerce">
                    <li class="nav-item">
                      <div class="nav-item-wrapper">
                          <a class="nav-link dropdown-indicator label-1" href="#nv-homeAgents" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-homeAgents">
                            <div class="d-flex align-items-center">
                              <div class="dropdown-indicator-icon-wrapper">
                                <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                              </div>
                              <span class="nav-link-icon">
                                <span data-feather="pie-chart"></span>
                              </span><span class="nav-link-text">Type Prestation</span>
                              <span class="fa-solid fa-circle text-info ms-1 new-page-indicator" style="font-size: 6px"></span>
                            </div>
                          </a>
                          <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-homeAgents">
                              <li class="collapsed-nav-item-title d-none">Type Prestation</li>
                              <li class="nav-item"><a class="nav-link" href="{{ route('customer.typePrestation') }}">
                                  <div class="d-flex align-items-center"><span class="nav-link-text">Liste</span></div>
                                </a><!-- more inner pages-->
                              </li>
                            </ul>
                          </div>
                        </div>
                    </li>
                </ul> 
              </li>
            @endcan

            @can('Voir gestion des utilisateurs')
              <li class="nav-item">
                <!-- label-->
                <p class="navbar-vertical-label">Gestion des utilisateurs</p>
                <hr class="navbar-vertical-line" /><!-- parent pages-->
                <ul class="nav" id="nv-e-commerce">
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('setting.users') }}" title="Utilisateurs">
                              <div class="d-flex align-items-center">
                                  <span class="fa-solid fa-house"></span>
                                  <span class="nav-link-text">utilisateurs</span>
                              </div>
                          </a><!-- more inner pages-->
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('setting.role') }}">
                              <div class="d-flex align-items-center">
                                  <span class="fa-solid fa-address-card"></span>
                                  <span class="nav-link-text">Role</span>
                              </div>
                          </a><!-- more inner pages-->
                      </li>
                      {{-- <li class="nav-item">
                          <a class="nav-link" href="{{ route('admin.test') }}">
                              <div class="d-flex align-items-center">
                                  <span class="fa-solid fa-address-card"></span>
                                  <span class="nav-link-text">test</span>
                              </div>
                          </a><!-- more inner pages-->
                      </li> --}}
                </ul> 
              </li>
            @endcan
          </ul>
        </div>
      </div>
      <div class="navbar-vertical-footer">
            <button class="btn-prime navbar-vertical-toggle border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center"><span class="uil uil-left-arrow-to-left fs-8"></span>
                <span class="uil uil-arrow-from-right fs-8"></span>
            <span class="navbar-vertical-footer-text ms-2"> <i class="fa-solid fa-bars"></i> &nbsp; Vue réduite</span>
        </button>
        </div>
    </nav>
    <nav class="navbar navbar-top fixed-top navbar-expand" id="navbarDefault" style="display:none;">
      <div class="collapse navbar-collapse justify-content-between">
        <div class="navbar-logo">
          <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
          <a class="navbar-brand me-1 me-sm-3" href="index.html">
            <div class="d-flex align-items-center">
              <div class="d-flex align-items-center">
                {{-- <img src="{{ asset('assets/img/logo/Logo_yako.png')}}" alt="phoenix" width="27" /> --}}
                <h5 class="logo-text ms-2 d-none d-sm-block">YAKO Africa</h5>
              </div>
            </div>
          </a>
        </div>
        <ul class="navbar-nav navbar-nav-icons flex-row">
          <li class="nav-item">
            <div class="theme-control-toggle fa-icon-wait px-2">
              <input class="form-check-input ms-0 theme-control-toggle-input" type="checkbox" data-theme-control="phoenixTheme" value="dark" id="themeControlToggle" />
              <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Switch theme" style="height:32px;width:32px;"><span class="icon" data-feather="moon"></span></label><label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Switch theme" style="height:32px;width:32px;"><span class="icon" data-feather="sun"></span></label></div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" style="min-width: 2.25rem" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside"><span class="d-block" style="height:20px;width:20px;"><span data-feather="bell" style="height:20px;width:20px;"></span></span></a>
            <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border navbar-dropdown-caret" id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
              <div class="card position-relative border-0">
                <div class="card-header p-2">
                  <div class="d-flex justify-content-between">
                    <h5 class="text-body-emphasis mb-0">Notifications</h5><button class="btn btn-link p-0 fs-9 fw-normal" type="button">Mark all as read</button>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="scrollbar-overlay" style="height: 27rem;">
                    <div class="px-2 px-sm-3 py-3 notification-card position-relative read border-bottom">
                      <div class="d-flex align-items-center justify-content-between position-relative">
                        <div class="d-flex">
                          <div class="avatar avatar-m status-online me-3"><img class="rounded-circle" src="assets/img/team/40x40/30.webp" alt="" /></div>
                          <div class="flex-1 me-sm-3">
                            <h4 class="fs-9 text-body-emphasis">Jessie Samson</h4>
                            <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span class='me-1 fs-10'>💬</span>Mentioned you in a comment.<span class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10">10m</span></p>
                            <p class="text-body-secondary fs-9 mb-0"><span class="me-1 fas fa-clock"></span><span class="fw-bold">10:41 AM </span>August 7,2021</p>
                          </div>
                        </div>
                        <div class="dropdown notification-dropdown"><button class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                          <div class="dropdown-menu py-2"><a class="dropdown-item" href="#!">Mark as unread</a></div>
                        </div>
                      </div>
                    </div>
                    <div class="px-2 px-sm-3 py-3 notification-card position-relative unread border-bottom">
                      <div class="d-flex align-items-center justify-content-between position-relative">
                        <div class="d-flex">
                          <div class="avatar avatar-m status-online me-3">
                            <div class="avatar-name rounded-circle"><span>J</span></div>
                          </div>
                          <div class="flex-1 me-sm-3">
                            <h4 class="fs-9 text-body-emphasis">Jane Foster</h4>
                            <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span class='me-1 fs-10'>📅</span>Created an event.<span class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10">20m</span></p>
                            <p class="text-body-secondary fs-9 mb-0"><span class="me-1 fas fa-clock"></span><span class="fw-bold">10:20 AM </span>August 7,2021</p>
                          </div>
                        </div>
                        <div class="dropdown notification-dropdown"><button class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                          <div class="dropdown-menu py-2"><a class="dropdown-item" href="#!">Mark as unread</a></div>
                        </div>
                      </div>
                    </div>
                    <div class="px-2 px-sm-3 py-3 notification-card position-relative unread border-bottom">
                      <div class="d-flex align-items-center justify-content-between position-relative">
                        <div class="d-flex">
                          <div class="avatar avatar-m status-online me-3"><img class="rounded-circle avatar-placeholder" src="assets/img/team/40x40/avatar.webp" alt="" /></div>
                          <div class="flex-1 me-sm-3">
                            <h4 class="fs-9 text-body-emphasis">Jessie Samson</h4>
                            <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span class='me-1 fs-10'>👍</span>Liked your comment.<span class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10">1h</span></p>
                            <p class="text-body-secondary fs-9 mb-0"><span class="me-1 fas fa-clock"></span><span class="fw-bold">9:30 AM </span>August 7,2021</p>
                          </div>
                        </div>
                        <div class="dropdown notification-dropdown"><button class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                          <div class="dropdown-menu py-2"><a class="dropdown-item" href="#!">Mark as unread</a></div>
                        </div>
                      </div>
                    </div>
                    <div class="px-2 px-sm-3 py-3 notification-card position-relative unread border-bottom">
                      <div class="d-flex align-items-center justify-content-between position-relative">
                        <div class="d-flex">
                          <div class="avatar avatar-m status-online me-3"><img class="rounded-circle" src="assets/img/team/40x40/57.webp" alt="" /></div>
                          <div class="flex-1 me-sm-3">
                            <h4 class="fs-9 text-body-emphasis">Kiera Anderson</h4>
                            <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span class='me-1 fs-10'>💬</span>Mentioned you in a comment.<span class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10"></span></p>
                            <p class="text-body-secondary fs-9 mb-0"><span class="me-1 fas fa-clock"></span><span class="fw-bold">9:11 AM </span>August 7,2021</p>
                          </div>
                        </div>
                        <div class="dropdown notification-dropdown"><button class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                          <div class="dropdown-menu py-2"><a class="dropdown-item" href="#!">Mark as unread</a></div>
                        </div>
                      </div>
                    </div>
                    <div class="px-2 px-sm-3 py-3 notification-card position-relative unread border-bottom">
                      <div class="d-flex align-items-center justify-content-between position-relative">
                        <div class="d-flex">
                          <div class="avatar avatar-m status-online me-3"><img class="rounded-circle" src="assets/img/team/40x40/59.webp" alt="" /></div>
                          <div class="flex-1 me-sm-3">
                            <h4 class="fs-9 text-body-emphasis">Herman Carter</h4>
                            <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span class='me-1 fs-10'>👤</span>Tagged you in a comment.<span class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10"></span></p>
                            <p class="text-body-secondary fs-9 mb-0"><span class="me-1 fas fa-clock"></span><span class="fw-bold">10:58 PM </span>August 7,2021</p>
                          </div>
                        </div>
                        <div class="dropdown notification-dropdown"><button class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                          <div class="dropdown-menu py-2"><a class="dropdown-item" href="#!">Mark as unread</a></div>
                        </div>
                      </div>
                    </div>
                    <div class="px-2 px-sm-3 py-3 notification-card position-relative read ">
                      <div class="d-flex align-items-center justify-content-between position-relative">
                        <div class="d-flex">
                          <div class="avatar avatar-m status-online me-3"><img class="rounded-circle" src="assets/img/team/40x40/58.webp" alt="" /></div>
                          <div class="flex-1 me-sm-3">
                            <h4 class="fs-9 text-body-emphasis">Benjamin Button</h4>
                            <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span class='me-1 fs-10'>👍</span>Liked your comment.<span class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10"></span></p>
                            <p class="text-body-secondary fs-9 mb-0"><span class="me-1 fas fa-clock"></span><span class="fw-bold">10:18 AM </span>August 7,2021</p>
                          </div>
                        </div>
                        <div class="dropdown notification-dropdown"><button class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                          <div class="dropdown-menu py-2"><a class="dropdown-item" href="#!">Mark as unread</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer p-0 border-top border-translucent border-0">
                  <div class="my-2 text-center fw-bold fs-10 text-body-tertiary text-opactity-85"><a class="fw-bolder" href="pages/notifications.html">Notification history</a></div>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
              <div class="avatar avatar-l ">
                <img class="rounded-circle " src="{{ asset('assets/img/images/user-default1.jpg')}}" alt="" />
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border" aria-labelledby="navbarDropdownUser">
              <div class="card position-relative border-0">
                <div class="card-body p-0">
                  <div class="text-center pt-4 pb-3">
                    <div class="avatar avatar-xl ">
                      <img class="rounded-circle " src="{{ asset('assets/img/images/user-default1.jpg')}}" alt="" />
                    </div>
                    <h6 class="mt-2 text-body-emphasis">
                      <span class="text-body-emphasis fw-bold">{{ Auth::guard('web')->user()->firstname }}{{ Auth::guard('web')->user()->name }}</span>
                    </h6>
                  </div>
                </div>
                <div class="overflow-auto scrollbar" style="height: 10rem;">
                  <ul class="nav d-flex flex-column mb-2 pb-1">
                    <li class="nav-item"><a class="nav-link px-3 d-block" href="#!"> <span class="me-2 text-body align-bottom" data-feather="user"></span><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link px-3 d-block" href="#!"><span class="me-2 text-body align-bottom" data-feather="pie-chart"></span>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link px-3 d-block" href="https://yakoafricassur.com/gestion-demande-compte/index.php"> <span class="me-2 text-body align-bottom" data-feather="lock"></span>Gestion de compte client</a></li>
                    {{-- <li class="nav-item"><a class="nav-link px-3 d-block" href="#!"> <span class="me-2 text-body align-bottom" data-feather="settings"></span>Settings &amp; Privacy </a></li>
                    <li class="nav-item"><a class="nav-link px-3 d-block" href="#!"> <span class="me-2 text-body align-bottom" data-feather="help-circle"></span>Help Center</a></li>
                    <li class="nav-item"><a class="nav-link px-3 d-block" href="#!"> <span class="me-2 text-body align-bottom" data-feather="globe"></span>Language</a></li> --}}
                  </ul>
                </div>
                <div class="card-footer p-0 border-top border-translucent">
                  <ul class="nav d-flex flex-column my-3">
                    <li class="nav-item"><a class="nav-link px-3 d-block" href="{{ route('register') }}"> <span class="me-2 text-body align-bottom" data-feather="user-plus"></span>Ajouter un autre compte</a></li>
                  </ul>
                  <hr />
                  <div class="px-3"> 
                    <a class="btn-prime btn-phoenix-secondary d-flex flex-center w-100" href="{{ route('Admin.logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                 <span class="me-2" data-feather="log-out"> </span>déconnexion</a>
             

             <form id="logout-form" action="{{ route('Admin.logout') }}" method="POST" class="d-none">
                 @csrf
             </form>
                  <div class="my-2 text-center fw-bold fs-10 text-body-quaternary">
                    <a class="text-body-quaternary me-1" href="#!"></a></div>
                  {{-- <div class="my-2 text-center fw-bold fs-10 text-body-quaternary"><a class="text-body-quaternary me-1" href="#!">Privacy policy</a>&bull;<a class="text-body-quaternary mx-1" href="#!">Terms</a>&bull;<a class="text-body-quaternary ms-1" href="#!">Cookies</a></div> --}}
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item">
            
            
          </li>
        </ul>
      </div>
    </nav>