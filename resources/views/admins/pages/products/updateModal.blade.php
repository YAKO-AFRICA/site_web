<div class="modal fade" id="update{{$product->uuid}}" tabindex="-1" aria-labelledby="updateModalLabel{{$product->uuid}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel{{$product->uuid}}">Mise à jour produit</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.product.update', $product->uuid) }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div id="previewContainer" class="dz-preview d-flex flex-wrap border border-translucent bg-body-emphasis rounded-3 d-flex flex-center position-relative me-2 mb-2" style="height:140px;width:140px;">
                            <!-- L'image sera ajoutée ici -->
                            @if($product->product_image)
                                <img src="{{ asset('images/Products/' . $product->product_image) }}" alt="Image" style="max-width: 100%; max-height: 100%;">
                            @endif
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
                        <input type="text" name="label" class="form-control" id="inputLibelle" value="{{ $product->label }}" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control tinymce-editor" name="description" id="productDescription" rows="3" autocomplete="off">{{ $product->description }}</textarea>
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