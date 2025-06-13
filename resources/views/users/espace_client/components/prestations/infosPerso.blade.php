<div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
    <div class="card" style="background-color: #E7F0EB">
        <div class="card-header text-center">
            <h5 class="mb-1">Vos informations personnelles</h5>
            <p class="mb-4">Nous avons besoin de connaitre l'identité du demandeur afin de pouvoir traiter votre demande</p>
            <p class="mb-4"><small>Pour toutes modifications de vos informations personnelles, veuillez Cliquez <i><a href="{{ route('customer.prestation.autre', $typePrestationAutre->id) }}" class="text-danger underline text-decoration-none fw-bold">ici</a></i> pour faire la demande</small></span></p>
        </div>
        <div class="card-body">
            <!-- Étape 1 -->
            <div class="etape" id="etape1">
                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6">
                        <label for="nom" class="form-label">Quel est votre nom ?</label>
                        <input type="text" class="form-control" id="nom" name="nom" 
                               value="{{ Auth::guard('customer')->user()->membre->nom ?? '' }}" 
                               placeholder="Votre Nom" readonly>
                               
                               
                               <input type="hidden" name="typeprestation" value="{{ $typePrestation->libelle ?? '' }}">
                               <input type="hidden" name="idclient" value="{{ Auth::guard('customer')->user()->membre->idmembre ?? '' }}">
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="prenom" class="form-label">Quel est votre prénom ?</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" 
                               value="{{ Auth::guard('customer')->user()->membre->prenom ?? '' }}" 
                               placeholder="Votre Prénom" readonly>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6">
                        <label for="datenaissance" class="form-label">Quelle est votre date de naissance ?</label>
                        <input type="text" class="form-control datepicke" id="datenaissance" name="datenaissance" 
                               value="{{ \Carbon\Carbon::parse(Auth::guard('customer')->user()->membre->datenaissance)->format('d/m/Y') ?? '' }}" 
                               placeholder="dd/mm/yyyy" readonly>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="lieunaissance" class="form-label">Où êtes-vous né(e) ?</label>
                        <input type="text" class="form-control" id="lieunaissance" name="lieunaissance" 
                               value="{{ Auth::guard('customer')->user()->membre->lieunaissance ?? $prestation->lieunaissance ?? '' }}" 
                               placeholder="" readonly>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6">
                        <label for="cel" class="form-label">N° de téléphone principal</label>
                        <input type="number" class="form-control" id="cel" name="celPrincipal" 
                               value="{{ Auth::guard('customer')->user()->membre->cel ?? '' }}" 
                               placeholder="Téléphone principal" readonly> 
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="cel" class="form-label">Sur quelle N° de téléphone pouvons nous vous contacter ? <span class="star">*</span></label>
                        <input type="number" class="form-control" id="cel" name="cel" 
                               value="{{ Auth::guard('customer')->user()->membre->cel ?? '' }}" 
                               placeholder="Téléphone principal" required> 
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6">
                        <label for="email" class="form-label">Quelle est votre adresse email ? <span class="star">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ Auth::guard('customer')->user()->membre->email ?? $prestation->email ?? '' }}" 
                               placeholder="Votre adresse email" required>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="lieuresidence" class="form-label">Où habitez-vous ? <span class="star">*</span> </label>
                        <input type="text" class="form-control" id="lieuresidence" name="lieuresidence" 
                               value="{{ Auth::guard('customer')->user()->membre->lieuresidence ?? $prestation->lieuresidence ?? '' }}" 
                               placeholder="Votre lieu de résidence" required>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-6">
                        <label for="tel" class="form-label">Votre N° de téléphone WhatsApp</label>
                        <input type="number" class="form-control" id="tel" name="tel" 
                               value="{{ Auth::guard('customer')->user()->membre->tel ?? '' }}" 
                               placeholder="Téléphone WhatsApp">
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="genre" class="form-label">Quel est votre genre ?</label>
                        <select name="sexe" id="genre" class="form-control" readonly>
                            <option value=""></option>
                            <option value="M" {{ Auth::guard('customer')->user()->membre->sexe === 'M' ? 'selected' : '' }}>Masculin</option>
                            <option value="F" {{ Auth::guard('customer')->user()->membre->sexe === 'F' ? 'selected' : '' }}>Feminin</option>
                        </select>
                    </div>
                </div>
                <p class="text-center"><small class="text-danger"><i>Les champs obligatoires sont marqués par (<strong>*</strong>) </i></small></p>
                {{-- <div class="row g-3 mb-3 text-center">
                    <span class="form-label">Quel est votre sexe ?</span>
                    @php
                        $sexe = Auth::guard('customer')->user()->membre->sexe ?? '';
                    @endphp
                    <div class="row d-flex justify-content-center align-items-center mt-3 gap-3">
                        <div class="gender-option col-lg-3 col-md-3 col-sm-12">
                            <input type="radio" name="sexe" {{ $sexe === 'M' ? 'checked' : '' }} value="M"
                                id="male" class="gender-input">
                            <label for="male" class="gender-label d-flex align-items-center">
                                <span class="gender-icon">♂</span> Masculin
                            </label>
                        </div>
                        <div class="gender-option col-lg-3 col-md-3 col-sm-12">
                            <input type="radio" name="sexe" {{ $sexe === 'F' ? 'checked' : '' }} value="F"
                                id="female" class="gender-input">
                            <label for="female" class="gender-label d-flex align-items-center">
                                <span class="gender-icon">♀</span> Féminin
                            </label>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-12 d-flex justify-content-end gap-3">
                        <button class="btn-prime btn-prime-two next-step-btn" type="button">Suivant <i
                            class='bx bx-right-arrow-alt fs-4 ms-2'></i></button>
                    </div>
                </div>
                
            </div>
        
            <!-- Étape 2 -->
            {{-- <div class="etape d-none" id="etape2">
               
                <button class="btn2 border-btn2 prev-btn" type="button" data-prev="etape1"><i class='bx bx-left-arrow-alt fs-4'></i></button>
                <button class="btn-prime next-btn" type="button" data-next="etape3"><i
                    class='bx bx-right-arrow-alt fs-4'></i></button>
            </div> --}}
        
            <!-- Étape 4 -->
            {{-- <div class="etape d-none" id="etape2">
                
                <div class="row">
                    <div class="col-6 d-flex justify-content-start gap-3">
                        <button class="btn2 border-btn2 prev-btn" type="button" data-prev="etape1"><i
                            class='bx bx-left-arrow-alt fs-4'></i> Retour</button>
                    </div>
                    <div class="col-6 d-flex justify-content-end gap-3">
                        
                    </div>
                </div>
            </div> --}}
            
        </div>
    </div>
        {{-- <button class="btn-prime btn-prime-two next-step-btn" type="button" onclick="stepper1.next()" data-bs-toggle="modal" data-bs-target="#exampleModal">Étape 2 <i --}}

</div>
