<div class="modal fade" id="getContractModal" tabindex="-1" aria-labelledby="getContractModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('customer.fetch.contract.Details') }}" method="post" class="submitForm">
                @csrf
                <div class="modal-body">
                    <div class="card radius-10">
                        <div class="card-body bg-light-succes rounded">
                            <div class="">
                                <label for="single-select" class="form-label">Pour quel Contrat
                                    demandez-vous la prestation ? <span class="star">*</span></label>
                                <select class="form-select" name="idcontrat" id="single-select"
                                    data-placeholder="" required>
                                    <option selected value="">Veuillez sélectionner l'ID du contrat</option>
                                    @foreach (Auth::guard('customer')->user()->membre->membreContrat as $contrat)
                                        <option value="{{ $contrat->idcontrat }}">
                                            {{ $contrat->idcontrat }}
                                        </option> 
                                    @endforeach
                                </select>
                                <input type="hidden" value="Prestation" name="type">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-prime" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn-prime btn-prime-two">Continuer</button>
                </div>
            </form>
            
        </div>
    </div>
</div>