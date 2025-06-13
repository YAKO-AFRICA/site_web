<div class="modal fade" id="updateAboutSectionHist{{$aboutHist->uuid}}" tabindex="-1" aria-labelledby="updateAboutSectionHistModalLabel{{$aboutHist->uuid}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateAboutSectionHistModalLabel{{$aboutHist->uuid}}">Mise à jour de la section</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.about.aboutUpdate', $aboutHist->uuid) }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div id="previewContainer" class="dz-preview d-flex flex-wrap border border-translucent bg-body-emphasis rounded-3 d-flex flex-center position-relative me-2 mb-2" style="height:140px;width:140px;">
                            <!-- L'image sera ajoutée ici -->
                            @if($aboutHist->image)
                                <img src="{{ asset('images/AboutPage/' . $aboutHist->image) }}" alt="Image" style="max-width: 100%; max-height: 100%;">
                            @endif
                        </div><br>
                        <label for="my-awesome-dropzone" class="form-label"> charger l'image de l'historique</label>
                        <div class="dropzone dropzone-multiple p-0 mb-5" id="my-awesome-dropzone">
                            <div class="fallback">
                                <input name="file" class="form-control" type="file" id="fileInput" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea class="form-control tinymce-editor" name="content" id="Description" rows="3" autocomplete="off">{{ $aboutHist->content }}</textarea>
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