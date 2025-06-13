<div class="modal fade" id="show{{$reseauInterne->uuid}}" tabindex="-1" aria-labelledby="showModalLabel{{$reseauInterne->uuid}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{$reseauInterne->uuid}}">Details réseau</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div>
                        <img src="{{ asset('images/ReseauInterne/'.$reseauInterne->image)}}" class="img-fluid" alt=""/>
                    </div>
                    {{$reseauInterne->uuid}}
                
                </div>
                <div class="modal-footer">
                    <button class="btn-prime" type="button" data-bs-dismiss="modal">Fermer</button>
                </div>
        </div>
    </div>
</div>