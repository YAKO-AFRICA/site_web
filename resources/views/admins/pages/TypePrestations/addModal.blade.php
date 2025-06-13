<div class="modal fade" id="addtypePrestation" tabindex="-1" aria-labelledby="addtypePrestationModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addtypePrestationModalLabel">Ajout Type de Prestation</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('customer.typePrestation.add') }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="inputLibelle" class="form-label">Libellé</label>
                        <input type="text" name="libelle" class="form-control" id="inputLibelle" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="impact" class="form-label">impact sur portefeuille YAKO</label>
                        <select name="impact" id="impact" class="form-control" required>
                            <option selected value="Autre">Autre</option>
                            <option value="0">Pas de sortir</option>
                            <option value="1">Sortir de du portefeuille</option>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea class="form-control tinymce-editor" name="description" id="Description" rows="3" autocomplete="off"></textarea>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button class="btn-prime" type="button" data-bs-dismiss="modal">Retour</button>
                    <button class="btn-prime btn-prime-two" type="submit">Valider</button>
                </div>
        </form>
        </div>
    </div>
</div>