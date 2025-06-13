<div class="modal fade" id="updatModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!--wrapper-->
                <div class="wrapper">
                    <div class="section-authentication-cove">
                        <div class="">
                            <div class="row g-0">

                                <div class="col-12 align-items-center justify-content-center">
                                    <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                                        <div class="card-body p-sm-5">
                                            <div class="">
                                                <div class="mb-3 text-center">
                                                    <img src="{{ asset('cust_assets/images/logo-icon.png')}}" width="150" alt="" />
                                                    
                                                </div>
                                                <div class="text-center mb-4">
                                                    <h5 class="">Espace Client</h5>
                                                    <p class="mb-0">Veuillez remplir les détails ci-dessous pour mettre à jour votre compte</p>
                                                    <small class="text-danger"><i style="font-weight: bold;"> (*) Champs obligatoires</i></small>
                                                </div>
                                                <div class="form-body">
                                                     
                                                    <form id="registerFormulaire" action="{{ route('customer.updateCompte')}}" method="POST" class="submitForm">
                                                        @csrf
                                                        <input type="hidden" id="update-login" name="update_login">
                                                        <div class="stepRegister" id="stepRegister1">
                                                            <div class="row g-3">
                                                                <div class="col-12">
                                                                    <label for="Nom" class="form-label">Nom</label>
                                                                    <input type="text" class="form-control" id="Nom"
                                                                        placeholder="Entrez votre nom" name="nom" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="Prenom" class="form-label">Prenom </label>
                                                                    <input type="text" class="form-control" id="Prenom"
                                                                        placeholder="Entrez votre prenom" name="prenom"readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="EmailAddress" class="form-label">Adresse email <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="email" class="form-control" id="EmailAddress"
                                                                        placeholder="example@user.com" name="email" required>
                                                                </div>
                                                                <div class="row g-3">
                                                                    <div class="col-12 col-lg-6">
                                                                        <label for="cel" class="form-label">Téléphone 1 <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="number" class="form-control" id="cel"
                                                                            placeholder="Entrez votre numero de telephone principal" name="cel" required>
                                                                    </div>
                                                                    <div class="col-12 col-lg-6">
                                                                        <label for="cel" class="form-label">Téléphone 2</label>
                                                                        <input type="number" class="form-control" id="tel"
                                                                            placeholder="Entrez votre numero de telephone secondaire" name="tel">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-12">
                                                                    <label for="lieuresidence" class="form-label">Lieu de residence<span class="text-danger">*</span></label>
                                                                    <select class="form-select" name="lieuresidence" id="lieuresidence" data-placeholder="" required>
                                                                        <option value="" selected> Veuillez sélectionner votre lieu de residence</option>
                                                                        @foreach ($villes as $ville)
                                                                            <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-6 d-flex justify-content-start">
                                                                    <button class="btn2 border-btn2 px-4" data-bs-dismiss="modal" type="button">fermer</button>
                                                                </div>
                                                                <div class="col-6 d-flex justify-content-end">
                                                                    <button class="btn-prime next-btn p-3" type="button"
                                                                        data-next="stepRegister2">
                                                                        Continuer <i class='bx bx-right-arrow-alt fs-4'></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="stepRegister d-none" id="stepRegister2">
                                                            <div class="row g-3">
                                                                <div class="col-12">
                                                                    <label for="EmailAddress" class="form-label">Votre genre<span
                                                                        class="text-danger">*</span></label>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="sexe" id="inlineRadio1" value="M" required>
                                                                        <label class="form-check-label" for="inlineRadio1">Homme</label>
                                                                      </div>
                                                                      <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="sexe" id="inlineRadio2" value="F">
                                                                        <label class="form-check-label" for="inlineRadio2">Femme</label>
                                                                      </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="EmailAddress" class="form-label">Votre date de naissance <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control" id="datenaissance" name="datenaissance" required>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="lieunaissance" class="form-label">Lieu de naissance</label>
                                                                    <select class="form-select" name="lieunaissance" id="lieunaissance" data-placeholder="">
                                                                        <option value="" selected> Veuillez sélectionner votre lieu de naissance</option>
                                                                        @foreach ($villes as $ville)
                                                                            <option value="{{ $ville->libelleVillle }}">{{ $ville->libelleVillle }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-6 d-flex justify-content-start">
                                                                    <button class="btn2 border-btn2 p-3 prev-btn"
                                                                        data-prev="stepRegister1" type="button"><i
                                                                            class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour
                                                                    </button>
                                                                </div>
                                                                <div class="col-6 d-flex justify-content-end">
                                                                    <button class="btn-prime next-btn p-3" type="button"
                                                                        data-next="stepRegister3">
                                                                        Continuer <i class='bx bx-right-arrow-alt fs-4'></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="stepRegister d-none" id="stepRegister3">
                                                            <label for="username" class="form-label">Nom d'utilisateur (Login)</label>
                                                            <input type="text" class="form-control mb-3" id="username" name="login" readonly>
            
                                                            <label for="password" class="form-label">Mot de
                                                                passe</label>
                                                            <div class="input-group mb-3" id="show_hide_password">
                                                                <input type="password" name="password"
                                                                    class="form-control" id="password"
                                                                    placeholder="Entrer nouveau nouveau mot de passe" value="123456" readonly/> 
                                                            </div>
            
                                                            <small class="text-danger"><strong>NB :</strong> Conserver bien votre <strong>nom d'utilisateur</strong> (login) pour pouvoir vous connecter plus tard à votre compte</small>
                                                            <div class="row mt-3">
                                                                <div class="col-6 d-flex justify-content-start">
                                                                    <button class="btn2 border-btn2 p-3 prev-btn"
                                                                        data-prev="stepRegister2" type="button"><i
                                                                            class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour
                                                                    </button>
                                                                </div>
                                                                <div class="col-6 d-flex justify-content-end">
                                                                    <button class="btn-prime next-btn p-3" type="button"
                                                                        data-next="stepRegister4">
                                                                        Continuer <i class='bx bx-right-arrow-alt fs-4'></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="stepRegister d-none" id="stepRegister4">
            
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-header text-center">
                                                                        <h5 class="mb-0">Resumer de vos saisies</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="my-3 d-flex align-items-center justify-content-center">
                                                                            <dl class="row m-auto" style="width: 90%;">
                                                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Nom :</dt>
                                                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="nomClient"></dd>
                                                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Prénom :</dt>
                                                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="prenomClient"></dd>
                                                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Teléphone 1 :</dt>
                                                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="celClient"></dd>
                                                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Teléphone 2 :</dt>
                                                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="telClient"></dd>
                                                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Email :</dt>
                                                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="emailClient"></dd>
                                                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Lieu de residence :</dt>
                                                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="lieuresidenceClient"></dd>
                                                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Date de naissance :</dt>
                                                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="datenaissanceClient"></dd>
                                                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Lieu de naissance :</dt>
                                                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="lieunaissanceClient"></dd>
                                                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Nom d'utilisateur :</dt>
                                                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7 " id="loginClient"></dd>
                                                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Mot de passe :</dt>
                                                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7" id="passwordClient">******</dd>
                                                                            </dl>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-6 d-flex justify-content-start">
                                                                    <button class="btn2 border-btn2 py-3 prev-btn"
                                                                        data-prev="stepRegister3" type="button"><i
                                                                            class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour
                                                                    </button>
                                                                </div>
                                                                <div class="col-6 d-flex justify-content-end">
                                                                    <button
                                                                        class="btn-prime btn-prime-two py-3">Soumettre</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
                <!--end wrapper-->

            </div>
        </div>
    </div>
</div>


