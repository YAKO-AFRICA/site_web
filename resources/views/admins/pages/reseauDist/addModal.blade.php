<div class="modal fade" id="verticallyCentered" tabindex="-1" aria-labelledby="verticallyCenteredModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verticallyCenteredModalLabel">Ajout réseau</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('products.reseau_dist.store') }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div id="previewContainer" class="dz-preview d-flex flex-wrap border border-translucent bg-body-emphasis rounded-3 d-flex flex-center position-relative me-2 mb-2" style="height:140px;width:140px;">
                            <!-- L'image sera ajoutée ici -->
                        </div><br>
                        <label for="my-awesome-dropzone" class="form-label">Image</label>
                        <div class="dropzone dropzone-multiple p-0 mb-5" id="my-awesome-dropzone">
                            <div class="fallback">
                                <input name="file" class="form-control" type="file" id="fileInput" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputLibelle" class="form-label">Libellé</label>
                        <input type="text" name="label" class="form-control" id="inputLibelle" placeholder="Libellé du reseau" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <div class="row mb-3">
                            <div class="col-md-12 text-end">
                                <button type="button" id="addRow" class="btn-prime btn-prime-two">Ajouter un produit</button>
                            </div>
                        </div>
                
                        <div id="productRows">
                            <div class="row mb-3">
                                <div class="input-group">
                                    {{-- <label for="product_name">Nom du Produit</label><br> --}}
                                    <select name="product_uuid[]" class="form-control" id="product_name" required>
                                        <option selected>Choisir un produit associé</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->uuid }}">{{ $product->label }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button type="button" class="btn-prime  removeRow">X</button>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control tinymce-editor" name="description" id="productDescription" rows="3" placeholder="Ecrire la description du reseau ici !" autocomplete="off"></textarea>
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