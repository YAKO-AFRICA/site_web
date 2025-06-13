<div class="modal fade" id="show{{$actuality->uuid}}" tabindex="-1" aria-labelledby="showModalLabel{{$actuality->uuid}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{$actuality->uuid}}">Details Actualités</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div>
                        <img src="{{ asset('images/Actualities/'.$actuality->image_url)}}" class="img-fluid" alt=""/>
                    </div>
                    {{$actuality->uuid}}
                
                </div>
                <div class="modal-footer">
                    <button class="btn-prime" type="button" data-bs-dismiss="modal">Fermer</button>
                </div>
        </div>
    </div>
</div>