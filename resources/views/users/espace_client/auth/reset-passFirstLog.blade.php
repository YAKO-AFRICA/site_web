<div class="modal fade" id="ModifierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title">Modal title</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--wrapper-->
                <div class="wrapper">
                    <div class="section-authentication-c">
                        <div class="">
                            <div class="row g-0">
                                <div class="col-12 align-items-center justify-content-center">
                                    <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                                        <div class="card-body p-sm-5">
                                            <div class="">
                                                <div class="mb-4 text-center">
                                                    <img src="{{ asset('cust_assets/images/logo-icon.png')}}" width="150" alt="" />
                                                </div>
                                                <div class="text-start mb-4">
                                                    <h5 class="text-center">Espace Client</h5>
                                                    <p class="mb-0 text-center">S'il vous plaît, entrez un nouveau mot de passe.</p>
                                                </div>
                                                
                                                <div class="form-body">
                                                    <form id="resetFirstLogForm" action="{{ route('customer.resetPassFirstLogin')}}" method="POST" class="submitForm">
                                                         
                                                        @csrf
                                                        <div class="mb-3 mt-4">
                                                            <label for="inputChoosePasswor" class="form-label">Nouveau mot de passe</label>
                                                            <div class="input-group" id="show_hide_password">
                                                                <input type="password" name="password" class="form-control border-end-0" id="inputChoosePasswor" placeholder="Entrer nouveau nouveau mot de passe" />
                                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                                @error('password')
                                                                    <span class="text-danger">Veuillez entrer votre nouveau mot de passe</span> 
                                                                @enderror
                                                            </div>
                                                            <span class="text-danger" id="resetFirstLogMsgerror"></span>
                                                        </div>
                                                        <input type="hidden" id="modifier-login" name="login"> 
                                                        <div class="mb-4">
                                                            <label for="inputChoosePasswor" class="form-label">Confirmer le mot de passe</label>
                                                            <div class="input-group" id="show_hide_password">
                                                                <input type="password" name="confirmPassword" class="form-control border-end-0" id="inputChoosePasswor" placeholder="cofirmer le nouveau mot de passe" required />
                                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                        
                                                            </div>
                                                            <div id="password-message" class="text-danger mb-3" style="display: none;"></div> <!-- Message de conformité -->
                                                        </div> 
                                                        <div class="row my-3">
                                                            <div class="col-md-12  text-center">
                                                                <button class="btn-prime btn-prime-two d-block w-100" id="submitButton" type="submit" disabled>Modifier</button>
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
    