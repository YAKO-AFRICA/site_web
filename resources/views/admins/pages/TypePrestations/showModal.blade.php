<div class="modal fade" id="show{{$typePrestation->id}}" tabindex="-1" aria-labelledby="showModalLabel{{$typePrestation->id}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{$typePrestation->id}}">Details Type Prestation</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    {{-- {{$typePrestation->description ?? 'N/A'}} --}}
                    {!! ($typePrestation->description) ?? "N/A" !!}
                </div>
                <div class="modal-footer">
                    <button class="btn-prime" type="button" data-bs-dismiss="modal">Fermer</button>
                </div>
        </div>
    </div>
</div>