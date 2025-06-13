<div class="modal fade" id="update{{$typePrestation->id}}" tabindex="-1" aria-labelledby="updateModalLabel{{$typePrestation->id}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel{{$typePrestation->id}}">Mise à jour Formule Produit</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('customer.typePrestation.update', $typePrestation->id) }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="inputLibelle" class="form-label">Libellé</label>
                        <input type="text" name="libelle" class="form-control" id="inputLibelle" value="{{ $typePrestation->libelle }}" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="impact" class="form-label">impact sur portefeuille YAKO</label>
                        <select name="impact" id="impact" class="form-control" required>
                            <option selected value="{{ $typePrestation->impact }}"> {{ $typePrestation->impact == 0 ? 'Pas de sortir' : 'Sortir de du portefeuille' }}</option>
                            @if($typePrestation->impact == 1)
                                <option  value="0">Pas de sortir</option>
                            @else
                                <option value="1">Sortir de du portefeuille</option>
                            @endif
                        </select>

                    </div> 
                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea class="form-control tinymce-editor" name="description" id="Description" rows="3" autocomplete="off">{{ $typePrestation->description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-prime" type="button" data-bs-dismiss="modal">Fermer</button>
                    <button class="btn-prime btn-prime-two" type="submit">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>