<div class="modal fade" id="update{{$formule->uuid}}" tabindex="-1" aria-labelledby="updateModalLabel{{$formule->uuid}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel{{$formule->uuid}}">Mise à jour Formule Produit</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.prod_formul.update', $formule->uuid) }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div id="previewContainer" class="dz-preview d-flex flex-wrap border border-translucent bg-body-emphasis rounded-3 d-flex flex-center position-relative me-2 mb-2" style="height:140px;width:140px;">
                            <!-- L'image sera ajoutée ici -->
                            @if($formule->formul_image)
                                <img src="{{ asset('images/FormuleProducts/' . $formule->formul_image) }}" alt="Image" style="max-width: 100%; max-height: 100%;">
                            @endif
                        </div><br>
                        <div class="row">
                            <div class="dropzone dropzone-multiple col-md-6 p-0 mb-5" id="my-awesome-dropzone">
                                <label for="my-awesome-dropzone" class="form-label">Image</label>
                                <div class="fallback">
                                    <input name="file" class="form-control" type="file" id="fileInput" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="video" class="form-label">Lien de la video</label>
                                <input name="video_url" class="form-control" type="text" id="video" value="{{ $formule->video_url }}" autocomplete="off"/>
                            </div>
                        </div>
                        
                    </div>
                    <div class="mb-3 ">
                        <label for="brochure" class="form-label">Brochure</label>
                        <input type="file" name="brochure" class="form-control" id="brochure" value="{{ $formule->brochure }}" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="inputLibelle" class="form-label">Libellé</label>
                        <input type="text" name="label" class="form-control" id="inputLibelle" value="{{ $formule->label }}" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="reseau" class="form-label">Reseau</label>
                        <select name="reseau_uuid" id="reseau" class="form-control">
                            <option selected value="{{$formule->reseau_uuid}}">{{$formule->reseau->label}}</option>
                            @foreach($reseaux as $reseau)
                            @if($formule->reseau_uuid !== $reseau->uuid)
                                
                            <option value="{{$reseau->uuid}}">{{$reseau->label}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="produit" class="form-label">Produit</label>
                        <select name="product_uuid" id="produit" class="form-control">
                            <option selected value="{{$formule->product_uuid}}">{{$formule->product->label}}</option>
                            @foreach($products as $product)
                            @if($formule->product_uuid !== $product->uuid)

                            <option value="{{$product->uuid}}">{{$product->label}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control tinymce-editor" name="description" id="productDescription" rows="3" autocomplete="off">{{ $formule->description }}</textarea>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="description2" class="form-label">Description 1</label>
                        <div class="editor-container" id="editor-container-2" style="height: 300px;">
                            {{ $formule->description }}
                        </div>
                        <input type="hidden" name="description" id="hidden-description-2">
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button class="btn-prime" type="button" data-bs-dismiss="modal">Fermer</button>
                    <button class="btn-prime btn-prime-two" type="submit">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>