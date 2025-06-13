<div class="modal fade" id="show{{$formule->uuid}}" tabindex="-1" aria-labelledby="showModalLabel{{$formule->uuid}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{$formule->uuid}}">Details Formule Produit</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div>
                        <img src="{{ asset('images/FormuleProducts/'.$formule->formul_image)}}" class="img-fluid" alt=""/>
                    </div>
                    {{$formule->uuid}}
                
                </div>
                <div class="modal-footer">
                    <button class="btn-prime" type="button" data-bs-dismiss="modal">Fermer</button>
                </div>
        </div>
    </div>
</div>