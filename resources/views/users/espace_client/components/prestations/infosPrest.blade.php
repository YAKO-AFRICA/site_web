<div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">

    <div class="card" style="background-color: #E7F0EB !important;">
        <div class="card-header text-center">
            <h5 class="mb-1">Informations liée à la prestation</h5>
            <p class="mb-4">Veuillez renseigner les informations relatives à la prestation</p>
            <p class="mb-4"><span class="form-label star"><small><i>YAKO AFRICA décline toute responsabilité si les
                            informations communiquées sont incorrectes </i></small></span></p>
        </div>
        <div class="card-body">
            <div class="etapePrest" id="etapePrest1">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button">
                                <h5>ID Contrat et montant souhaité</h5>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-lg-6">

                                        <label for="single-select-field" class="form-label">Pour quel Contrat
                                            demandez-vous la prestation ? <span class="star">*</span></label>
                                        <select class="form-select" name="idcontrat" id="single-select-field"
                                            data-placeholder="Veuillez sélectionner l'ID du contrat" required readonly>
                                            <option></option>
                                            @foreach (Auth::guard('customer')->user()->membre->membreContrat as $contrat)
                                                @if ($monContrat && $monContrat == $contrat->idcontrat)
                                                    <option value="{{ $contrat->idcontrat }}" selected>
                                                        {{ $contrat->idcontrat }}
                                                    </option>
                                                @elseif($prestation && $prestation->idcontrat == $contrat->idcontrat)
                                                    <option value="{{ $contrat->idcontrat }}" selected>
                                                        {{ $contrat->idcontrat }}
                                                    </option>
                                                @elseif($contratDetails && $contratDetails['IdProposition'] == $contrat->idcontrat)
                                                    <option value="{{ $contrat->idcontrat }}" selected>
                                                        {{ $contrat->idcontrat }}
                                                    </option>
                                                @endif
                                                
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="Capital" name="Capital" value="">
                                        <input type="hidden" id="TotalEncaissement" name="TotalEncaissement" value="{{ $TotalEncaissement ?? '' }}">
                                        <div id="spinner" style="display: none;">
                                            <div class="spinner-border" style="color: #076633;" role="status">
                                                <span class="visually-hidden">Chargement...</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            {{-- <h5 id="CapitalTotal" class="mt-2 col-lg-6 col-md-6 col-12 text-start"></h5> --}}
                                            <h5 id="Produit" class="mt-2 col-lg-6 col-md-6 col-12 text-start"></h5>
                                            <p class="col-lg-6 col-md-6 col-12 text-end mt-2"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#detailContratModal" title="Voir plus de détails" class="" id="DetailContratBtn"><i class='bx bxs-show py-1 px-2 fs-5 border border-secondary rounded bg-light'></i></a></p>
                                        </div>
                                        
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="montant" class="form-label">Quel est le montant que vous souhaitez
                                            demander ? <span class="star">*</span></label>
                                        <input type="text" class="form-control" min="0" name="montantSouhaite"
                                            id="montantSouhaite" placeholder="Saisir le montant souhaité" required
                                            disabled>
                                        <small><i id="msgerror" class="text-danger"></i></small>
                                        <small><i id="msgesucces" class="text-success"></i></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 d-flex justify-content-start gap-3">
                                        <button class="btn2 border-btn2 px-4" type="button"
                                            onclick="stepper1.previous()"><i
                                                class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour </button>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end gap-3">
                                        <button type="button" class="collapsed btn-prime" type="button"
                                            data-bs-toggle="collapse" id="btnContratSuivant" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">Suivant <i
                                                class='bx bx-right-arrow-alt fs-4'></i></button>
                                
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button">
                                <h5>Moyen de paiement</h5>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row g-3 mb-3 text-center">
                                    <span class="form-label">Par quel moyen de paiement souhaitez-vous être payé ? <span
                                            class="star">*</span></span>
                                    <div class="row d-flex justify-content-center align-items-center mt-3 gap-3">
                                        <div class="moyenPaiement-option col-lg-3 col-md-4 col-sm-12">
                                            <input type="radio" name="moyenPaiement" value="Mobile_Money"
                                                id="mobileMoney" class="moyenPaiement-input">
                                            <label for="mobileMoney"
                                                class="moyenPaiement-label d-flex flex-column align-items-center justify-content-center">
                                                <span class="moyenPaiement-icon"><i class='bx bx-money'></i></span>
                                                <span class="moyenPaiement-text">Mobile Money</span>
                                            </label>
                                        </div>
                                        <div class="moyenPaiement-option col-lg-3 col-md-4 col-sm-12">
                                            <input type="radio" name="moyenPaiement" value="Virement_Bancaire"
                                                id="virementBancaire" class="moyenPaiement-input">
                                            <label for="virementBancaire"
                                                class="moyenPaiement-label d-flex flex-column align-items-center justify-content-center">
                                                <span class="moyenPaiement-icon"><i class='bx bxs-bank'></i></span>
                                                <span class="moyenPaiement-text">Virement Bancaire</span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-3 mb-3 text-center" id="Operateur">
                                    <span class="form-label">Quel opérateur souhaitez-vous utiliser ?</span>

                                    <div class="row d-flex justify-content-center align-items-center mt-3 gap-3">
                                        <div class="Operateur-option col-lg-3 col-md-4 col-sm-12">
                                            <input type="radio" name="Operateur" value="Orange_money"
                                                id="Orange" class="Operateur-input">
                                            <label for="Orange"
                                                class="Operateur-label d-flex flex-column align-items-center justify-content-center">
                                                <span class="Operateur-icon">
                                                    <img src="https://seeklogo.com/images/O/orange-money-logo-8F2AED308D-seeklogo.com.png"
                                                        alt="Orange Money">
                                                </span>
                                                <span class="Operateur-text">Orange Money</span>
                                            </label>
                                        </div>
                                        <div class="Operateur-option col-lg-3 col-md-4 col-sm-12">
                                            <input type="radio" name="Operateur" value="MTN_money" id="MTN"
                                                class="Operateur-input">
                                            <label for="MTN"
                                                class="Operateur-label d-flex flex-column align-items-center justify-content-center">
                                                <span class="Operateur-icon">
                                                    <img src="data:image/jpeg;base64,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"
                                                        alt="MTN Money">
                                                </span>
                                                <span class="Operateur-text">MTN Money</span>
                                            </label>
                                        </div>
                                        <div class="Operateur-option col-lg-3 col-md-4 col-sm-12">
                                            <input type="radio" name="Operateur" value="Moov_money" id="Moov"
                                                class="Operateur-input">
                                            <label for="Moov"
                                                class="Operateur-label d-flex flex-column align-items-center justify-content-center">
                                                <span class="Operateur-icon">
                                                    <img src="https://play-lh.googleusercontent.com/P0fu0Qo5Y7JjS6duZRTa8Z5KJCbNDiHo1W714pz9qN9IoX8ufR0L7SE_FkDUWpZZRi_x=w240-h480-rw"
                                                        alt="Moov Money">
                                                </span>
                                                <span class="Operateur-text">Moov Money</span>
                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-12 d-flex justify-content-center mt-4">
                                        <span id="clearChoise" class="">Supprimer mon choix</span>
                                    </div>
                                </div>
                                <div class="row mb-3" id="IBANPaiement">
                                    <div class="col-12 px-0">
                                        <label for="IBAN" class="form-label">Quel est votre RIB sur lequel vous souhaitez
                                            recevoir le paiement <span class="star">*</span></label>
                                        <div class="rib-container row">
                                            <div class="col-lg-3 col-12 mb-3 w-lg-20 text-center">
                                                <label for="codebanque" class="form-label">Code Banque</label><br>
                                                <input type="text" class="rib-input" name="rib_1" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_2" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_3" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_4" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_5" maxlength="1">
                                            </div>
                                            <div class="col-lg-3 col-12 mb-3 w-lg-20 text-center">
                                                <label for="codeagence" class="form-label">Code Agence</label><br>
                                                <input type="text" class="rib-input" name="rib_6" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_7" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_8" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_9" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_10" maxlength="1">
                                            </div>
                                            <div class="col-lg-5 col-12 mb-3 text-center">
                                                <label for="numcompte" class="form-label">N° de Compte</label><br>
                                                <input type="text" class="rib-input" name="rib_11" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_12" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_13" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_14" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_15" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_16" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_17" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_18" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_19" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_20" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_21" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_22" maxlength="1">
                                            </div>
                                            <div class="col-lg-1 col-12 mb-3 w-lg-15 text-center">
                                                <label for="clerib" class="form-label">Clé RIB</label><br>
                                                <input type="text" class="rib-input" name="rib_23" maxlength="1">
                                                <input type="text" class="rib-input" name="rib_24" maxlength="1">
                                            </div>
                                            <span class="text-center"><i id="ibanMsgError" class="text-danger"></i></span>
                                            <span class="text-center"><i id="ibanMsgSuccess" class="text-success"></i></span>
                                        </div>
                                        <input type="hidden" class="form-control" name="IBAN" id="IBAN"
                                                    >
                                            
                                        <input type="hidden" name="TelOtp" value="" id="TelOtp">
                                    </div>
                                    {{-- <div class="col-12">
                                                
                                        <input type="hidden" class="form-control" name="ConfirmIBAN"
                                            id="ConfirmIBAN"
                                            placeholder="Veuillez resaisir l'IBAN sur lequel vous souhaitez recevoir le paiement">
                                            <small><i id="ibanConfirmMsgError" class="text-danger"></i></small>
                                            <small><i id="ibanConfirmMsgSuccess" class="text-success"></i></small>
                                    </div> --}}
                                    <small class="text-center"><span class="form-label star"><i>Veuillez saisir le RIB de votre compte
                                                courant </i></span></small>
                                </div>
                                <div class="row g-3 mb-3" id="TelephonePaiement">
                                    <div class="col-12 col-lg-6">
                                        <label for="TelPaiement" class="form-label">N° de téléphone sur lequel vous
                                            souhaitez recevoir le paiement <span class="star">*</span></label>
                                        <input type="number" class="form-control no-copy no-cut no-paste" name="TelPaiement"
                                            id="TelPaiement"
                                            placeholder="Veuillez saisir le N° de téléphone sur lequel vous souhaitez recevoir le paiement">
                                            <small><i id="telMsgError" class="text-danger"></i></small>
                                            <small><i id="telMsgSuccess" class="text-success"></i></small>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="ConfirmTelPaiement" class="form-label">Confirmer le N° de
                                            téléphone <span class="star">*</span></label>
                                        <input type="number" class="form-control no-copy no-cut no-paste" name="ConfirmTelPaiement"
                                            id="ConfirmTelPaiement"
                                            placeholder="Veuillez resaisir le N° de téléphone sur lequel vous souhaitez recevoir le paiement">
                                            <small><i id="telConfirmMsgError" class="text-danger"></i></small>
                                            <small><i id="telConfirmMsgSuccess" class="text-success"></i></small>
                                    </div>
                                    <small><span class="form-label star"><i>N° de Telephone sans l'indicatif (ex:
                                                <strong>0100128271</strong>) </i></span></small>
                                </div>
                                <div class="row">
                                    <div class="col-6 d-flex justify-content-start gap-3">
                                        <button class="btn2 border-btn2 px-4" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne"><i
                                                class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour </button>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end gap-3">
                                        <button class="btn-prime" type="button" id="btnIbanPaiementSuivant" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">Suivant <i
                                                class='bx bx-right-arrow-alt fs-4'></i></button>

                                        <button class="btn-prime" type="button" id="btnTelPaiementSuivant" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">Suivant <i
                                                class='bx bx-right-arrow-alt fs-4'></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button">
                                <h4>Documents requis</h4>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @include('users.espace_client.components.prestations.docPrest')

                                <div class="row g-3 mb-3">
                                    <div class="col-12">
                                        <label for="AutresInfos" class="form-label">Avez-vous d'autres informations
                                            suplementaires a fournir pour votre demande ? (<span class="star">max 400
                                                caractères </span>)</label>
                                        <textarea class="form-control" name="msgClient" id="AutresInfos" rows="5"
                                            placeholder="Veuillez saisir d'autres informations suplementaires a fournir pour pour votre demande"></textarea>
                                        <div style="float: left;">
                                            <span id="totalChar" class="fs-6 text-muted"> 400 caractères autorisés
                                                :</span>
                                            <small><i id="counterror" class="text-danger"></i></small>
                                            <small><i id="countesucces" class="text-success"></i></small>
                                        </div>
                                        <div style="float: right;">
                                            <span id="totalMot" class="text-muted">0 mots saisis</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                <div class="col-6 d-flex justify-content-start gap-3">
                                    <button class="btn2 border-btn2 px-4" type="button" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour </button>
                                </div>
                                <div class="col-6 d-flex justify-content-end gap-3">
                                    <button class="btn-prime next-btn" type="button" data-next="etapePrest2">Suivant <i
                                        class='bx bx-right-arrow-alt fs-4'></i></button>
                                </div>
                            </div> --}}
                                <div class="row">
                                    <div class="col-6 d-flex justify-content-start gap-3">
                                        <button class="btn2 border-btn2 px-4" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo"><i
                                                class='bx bx-left-arrow-alt me-2 fs-4'></i>Retour </button>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end gap-3">
                                        {{-- vers etape 3 --}}
                                        {{-- <button class="btn-prime px-4 next-step-btn1" id="next-stepper4"
                                            type="button">
                                            Suivant<i class='bx bx-right-arrow-alt ms-2 fs-4'></i>
                                        </button> --}}

                                        {{-- vers confirmation otp --}}
                                        <button class="btn-prime next-btn" type="button" id="next-stepper3"
                                            data-next="etapePrest5">
                                            Suivant <i class='bx bx-right-arrow-alt fs-4'></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="etapePrest d-none" id="etapePrest2">
                
            </div>
            <div class="etapePrest d-none" id="etapePrest3">
                
            </div>
            <div class="etapePrest d-none" id="etapePrest4">

                
            </div>

            <div class="etapePrest d-none" id="etapePrest5">
                <div class="row g-3 mb-3 text-center" id="OTP">
                    <span class="form-label">Un code de confirmation a été envoyé pas SMS, veuillez le
                        rentrer ci-dessous</span>
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <div class="otp-container">
                            <input type="text" class="otp-input" name="otp_1" maxlength="1">
                            <input type="text" class="otp-input" name="otp_2" maxlength="1">
                            <input type="text" class="otp-input" name="otp_3" maxlength="1">
                            <input type="text" class="otp-input" name="otp_4" maxlength="1">
                            <input type="text" class="otp-input" name="otp_5" maxlength="1">
                            <input type="text" class="otp-input" name="otp_6" maxlength="1">
                        </div>
                    </div>


                    <div class="otp-timer" id="otp-timer">
                        {{-- afficher le deconte ici  --}}
                    </div>
                    <a href="#" class="d-none resend-otp-link">Renvoyer l'OTP</a>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end gap-3">
                        <div id="btn-otp">
                            {{-- <button class="btn2 border-btn2 prev-btn" type="button" data-prev="etapePrest4">
                                      <i class='bx bx-left-arrow-alt fs-4'></i>
                                  </button> --}}
                            <button class="btn-prime px-4 next-step-btn2" type="button">étape 3<i
                                    class='bx bx-right-arrow-alt ms-2 fs-4'></i></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

