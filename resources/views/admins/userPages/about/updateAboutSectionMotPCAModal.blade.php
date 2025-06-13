<div class="modal fade" id="updateAboutMotPCA{{$aboutMotPCA->uuid}}" tabindex="-1" aria-labelledby="updateAboutMotPCAModalLabel{{$aboutMotPCA->uuid}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateAboutMotPCAModalLabel{{$aboutMotPCA->uuid}}">Mise à jour de la section</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.about.aboutUpdate', $aboutMotPCA->uuid) }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div id="previewContainer" class="dz-preview d-flex flex-wrap border border-translucent bg-body-emphasis rounded-3 d-flex flex-center position-relative me-2 mb-2" style="height:140px;width:140px;">
                            <!-- L'image sera ajoutée ici -->
                            @if($aboutMotPCA->image)
                                <img src="{{ asset('images/AboutPage/' . $aboutMotPCA->image) }}" alt="Image" style="max-width: 100%; max-height: 100%;">
                            @endif
                        </div><br>
                        <label for="my-awesome-dropzone" class="form-label"> charger l'image du PCA ici</label>
                        <div class="dropzone dropzone-multiple p-0 mb-5" id="my-awesome-dropzone">
                            <div class="fallback">
                                <input name="file" class="form-control" type="file" id="fileInput" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputLibelle" class="form-label">Nom et Prenoms du PCA</label>
                        <input type="text" name="nomPCA" class="form-control" id="inputLibelle" value="{{ $aboutMotPCA->nomPCA }}" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="Description" class="form-label">Mot du PCA</label>
                        <textarea class="form-control tinymce-editor" name="content" id="Description" rows="3" autocomplete="off">{{ $aboutMotPCA->content }}</textarea>
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