<div class="modal fade" id="addFile" tabindex="-1" aria-labelledby="addFileModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFileModalLabel"></h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.assistance.addCourrier')}}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="my-awesome-dropzone" class="form-label"> charger le fichier en format PDF</label>
                        <div class="dropzone dropzone-multiple p-0 mb-5" id="my-awesome-dropzone">
                            <div class="fallback">
                                <input name="file" class="form-control" type="file" id="fileInput" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="label" class="form-label">Libellé du fichier</label>
                        <input type="text" name="label" class="form-control" id="label">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-prime" type="button" data-bs-dismiss="modal">Fermer</button>
                    <button class="btn-prime btn-prime-two" type="submit">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>