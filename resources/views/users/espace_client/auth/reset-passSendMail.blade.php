<div class="modal fade" id="resetSendMailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Réinitialisation de mot de passe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--wrapper-->
                <div class="wrapper">
                    <div class="section-authentication-cover">
                        <div class="">
                            <div class="row g-0">
                                <div class="col-12 align-items-center justify-content-center">
                                    <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                                        <div class="card-body p-sm-5">
                                            <div class="">
                                                <div class="mb-4 text-center">
                                                    <img src="{{ asset('cust_assets/images/logo-icon.png')}}" width="150" alt="" />
                                                </div>
                                                <div class="text-center mb-4">
                                                    <h5 class="">Espace Client</h5>
                                                    <p class="mb-0 text-danger">S'il vous plaît, entrez votre adresse email utilisée lors de la création de votre compte et nous vous enverrons un lien de reinitialisation.</p>
                                                </div>
                                                
                                                <div class="form-body">
                                                    <form id="" action="{{ route('customer.resetPassSendMail')}}" method="POST">
                                                        {{-- @if (Session::get('fail'))
                                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                {{ Session::get('fail') }}
                                                            </div>
                                                        @endif
                                                        @if (Session::get('success'))
                                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                {{ Session::get('success') }}
                                                            </div>
                                                        @endif --}}
                                                        @csrf
                                                        <div class="mb-3 mt-4">
                                                            <label for="email" class="form-label">Votre adresse email</label>
                                                            <div class="">
                                                                <input type="email" class="form-control" id="email" name="email" placeholder="Votre adresse email" required>
                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    {{-- <span class="text-danger">Veuillez entrer votre adresse email</span>  --}}
                                                                @enderror
                                                            </div> 
                                                        </div>
                                                         
                                                        <div class="row my-3">
                                                            <div class="col-md-12  text-center">
                                                                <button class="btn-prime btn-prime-two d-block w-100" type="submit">Envoyer le lien de réinitialisation du mot de passe</button>
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
    