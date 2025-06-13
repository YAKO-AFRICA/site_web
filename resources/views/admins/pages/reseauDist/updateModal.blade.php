<div class="modal fade" id="update{{$reseau->uuid}}" tabindex="-1" aria-labelledby="updateModalLabel{{$reseau->uuid}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel{{$reseau->uuid}}">Ajout réseau</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('products.reseau_dist.update', $reseau->uuid) }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div id="previewContainer" class="dz-preview d-flex flex-wrap border border-translucent bg-body-emphasis rounded-3 d-flex flex-center position-relative me-2 mb-2" style="height:140px;width:140px;">
                            <!-- L'image sera ajoutée ici -->
                            @if($reseau->image)
                                <img src="{{ asset('images/ReseauDist/' . $reseau->image) }}" alt="Image" style="max-width: 100%; max-height: 100%;">
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
                        <input type="text" name="label" class="form-control" id="inputLibelle" value="{{ $reseau->label }}" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="products" class="form-label">Produits associés</label>
                        <textarea class="form-control" name="" id="products" rows="2" disabled>@if(!$reseau->products)N/A @else @foreach($reseau->products as $product){{ $product->label }},&nbsp; @endforeach @endif</textarea>
                    </div>
                    <div class="mb-3">
                        <div class="row mb-3">
                            <div class="col-md-12 text-end">
                                <button type="button" id="updateRow{{$reseau->uuid}}" class="btn-prime btn-prime-two">Ajouter nouveau produit</button>
                            </div>
                        </div>
                
                        <div id="productupdateRows{{$reseau->uuid}}">
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
                                        <button type="button" class="btn-prime  removeupdateRow{{$reseau->uuid}}">X</button>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control tinymce-editor" name="description" id="productDescription" rows="3" autocomplete="off">{{ $reseau->description }}</textarea>
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