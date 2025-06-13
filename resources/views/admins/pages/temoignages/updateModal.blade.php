<div class="modal fade" id="update{{$temoignage->uuid}}" tabindex="-1" aria-labelledby="updateModalLabel{{$temoignage->uuid}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel{{$temoignage->uuid}}">Mise à jour temoignage</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.temoignage.update', $temoignage->uuid) }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="inputNom" class="form-label">Nom complet du temoin</label>
                            <input type="text" name="nom" class="form-control" id="inputNom" value="{{ $temoignage->nom }}" required autocomplete="off">
                        </div>
                        
                        <div class="mb-3">
                            <label for="fonction" class="form-label">fonction du temoin</label>
                            <input type="text" name="fonction" class="form-control" id="fonction" value="{{ $temoignage->fonction }}" required autocomplete="off">
                        </div>
    
                        <div class="mb-3">
                            <label for="Temoignage" class="form-label">Temoignage</label>
                            <textarea class="form-control tinymce-editor" name="contenu" id="Temoignage" rows="3" autocomplete="off">{{ $temoignage->contenu }}</textarea>
                        </div>
                    
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