<div class="modal fade" id="addtemoignage" tabindex="-1" aria-labelledby="addtemoignageModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addtemoignageModalLabel">Ajout temoignage</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.temoignage.store') }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="inputNom" class="form-label">Nom complet du temoin</label>
                        <input type="text" name="nom" class="form-control" id="inputNom" required autocomplete="off">
                    </div>
                    
                    <div class="mb-3">
                        <label for="fonction" class="form-label">fonction du temoin</label>
                        <input type="text" name="fonction" class="form-control" id="fonction" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label for="Temoignage" class="form-label">Temoignage</label>
                        <textarea class="form-control tinymce-editor" name="contenu" id="Temoignage" rows="3" autocomplete="off"></textarea>
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