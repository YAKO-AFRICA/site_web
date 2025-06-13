<div class="modal fade" id="addProductFormule" tabindex="-1" aria-labelledby="addProductFormuleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductFormuleModalLabel">Ajout formule produit</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.prod_formul.store') }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div id="previewContainer" class="dz-preview d-flex flex-wrap border border-translucent bg-body-emphasis rounded-3 d-flex flex-center position-relative me-2 mb-2" style="height:140px;width:140px;">
                            <!-- L'image sera ajoutée ici -->
                        </div><br>
                        <div class="row">
                            <div class="dropzone dropzone-multiple p-0 mb-5 col-md-6" id="my-awesome-dropzone">
                                <label for="my-awesome-dropzone" class="form-label">Image</label>
                                <div class="fallback">
                                    <input name="file" class="form-control" type="file" id="fileInput" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="video" class="form-label">Lien de la video</label>
                                <input name="video_url" class="form-control" type="text" id="video" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 ">
                        <label for="brochure" class="form-label">Brochure</label>
                        <input type="file" name="brochure" class="form-control" id="brochure" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="inputLibelle" class="form-label">Libellé</label>
                        <input type="text" name="label" class="form-control" id="inputLibelle" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="reseau" class="form-label">Reseau</label>
                        <select name="reseau_uuid" id="reseau" class="form-control" required>
                            <option selected>Choisissez un Reseau</option>
                            @foreach($reseaux as $reseau)
                            <option value="{{$reseau->uuid}}">{{$reseau->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="produit" class="form-label">Produit</label>
                        <select name="product_uuid" id="produit" class="form-control" required>
                            <option selected>Choisissez un produit</option>
                            @foreach($products as $product)
                            <option value="{{$product->uuid}}">{{$product->label}}</option>
                            @endforeach
                        </select>
                    </div> 
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control tinymce-editor" name="description" id="productDescription" rows="3" autocomplete="off"></textarea>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div class="editor-container" id="editor-container-1" style="height: 300px;"></div>
                        <input type="hidden" name="description" id="hidden-description-1">
                    </div> --}}
                
                </div>
                <div class="modal-footer">
                    <button class="btn-prime" type="button" data-bs-dismiss="modal">Retour</button>
                    <button class="btn-prime btn-prime-two" type="submit">Valider</button>
                </div>
        </form>
        </div>
    </div>
</div>