<div class="modal fade" id="addActualities" tabindex="-1" aria-labelledby="addActualitiesModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addActualitiesModalLabel">Ajout Actualités</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.actuality.store') }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="border border-translucent bg-body-emphasis rounded-3 me-2 mb-2" style="min-height:140px; min-width:140px;">
                            <div class="row d-flex flex-wrap dz-preview position-relative" id="previewContainer">
                                <!-- Les images seront ajoutées ici -->
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="dropzone dropzone-multiple p-0 mb-5 col-md-6" id="my-awesome-dropzone">
                                <label for="my-awesome-dropzone" class="form-label">Images</label>
                                <div class="fallback">
                                    <input name="file[]" class="form-control" type="file" id="fileInput" multiple autocomplete="off" accept=".jpg,.jpeg,.png"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="video" class="form-label">Lien de la video</label>
                                <input name="video_url" class="form-control" type="text" id="video" autocomplete="off"/>
                            </div>
                        </div>
                        
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" name="title" class="form-control" id="title" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="produit" class="form-label">Produit</label>
                        <select name="product_uuid" id="produit" class="form-control" required>
                            <option selected disabled>Choisissez un produit</option>
                            <option value="Institutionnelle">Institutionnelle</option>
                            <option value="RSE">RSE</option>
                            <option value="Bancassurance">Bancassurance</option>
                            <option value="Courtage">Courtage</option>
                            @foreach($products as $product)
                            <option value="{{$product->uuid}}">{{$product->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Contenu</label>
                        <textarea class="form-control tinymce-editor" name="comment" id="comment" rows="3" autocomplete="off"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="citation" class="form-label">Citation</label>
                        <textarea class="form-control" name="citation" id="citation" rows="2" autocomplete="off"></textarea>
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