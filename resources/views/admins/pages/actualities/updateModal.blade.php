<div class="modal fade" id="update{{$actuality->uuid}}" tabindex="-1" aria-labelledby="updateModalLabel{{$actuality->uuid}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel{{$actuality->uuid}}">Mise à jour actualité</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.actuality.update', $actuality->uuid) }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="border border-translucent bg-body-emphasis rounded-3 me-2 mb-2" style="min-height:140px; min-width:140px;">
                            <!-- Conteneur pour les nouvelles images sélectionnées -->
                            <div class="row d-flex flex-wrap dz-preview position-relative" id="previewContainerupdate">
                                <!-- Les nouvelles images ajoutées par l'utilisateur apparaîtront ici -->
                            </div>
                    
                            <!-- Conteneur pour les images existantes associées à l'actualité -->
                            <div class="row d-flex flex-wrap dz-preview position-relative" id="existingImageContainer">
                                @foreach($actuality->postImage as $image)
                                    <div class="dz-image position-relative m-1" style="width: 150px; height: 140px; object-fit: cover; display: inline-block;">
                                        <img src="{{ asset('images/Actualities/' . $image->image_url) }}" alt="Image" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;">
                                        <a href="javascript:void(0);" class="delete-image position-absolute top-0 end-0 text-center" data-uuid="{{ $image->uuid }}" style="border-radius: 10%; width: 15%; height: 15%; background-color: #fff">X</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="dropzone dropzone-multiple p-0 mb-5 col-md-6" id="my-awesome-dropzone">
                                <label for="my-awesome-dropzone" class="form-label">Images</label>
                                <div class="fallback">
                                    <input name="file[]" class="form-control" type="file" id="fileInputupdate" multiple autocomplete="off" accept=".jpg,.jpeg,.png"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="video" class="form-label">Lien de la video</label>
                                <input name="video_url" class="form-control" type="text" id="video" value="{{ $actuality->video_url }}" autocomplete="off"/>
                            </div>
                        </div>
                        
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ $actuality->title }}" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="produit" class="form-label">Produit</label>
                        <select name="product_uuid" id="produit" class="form-control">
                            @if($actuality->product)
                                <option selected value="{{ $actuality->product_uuid }}">{{ $actuality->product->label }}</option>
                            @else
                                <option selected value="{{ $actuality->product_uuid }}">{{ $actuality->product_uuid }}</option>
                            @endif
                            <option value="Institutionnelle">Institutionnelle</option>
                            <option value="RSE">RSE</option>
                            <option value="Bancassurance">Bancassurance</option>
                            <option value="Courtage">Courtage</option>
                            @foreach($products as $product)
                                @if($actuality->product_uuid !== $product->uuid)
                                    <option value="{{ $product->uuid }}">{{ $product->label }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Contenue</label>
                        <textarea class="form-control tinymce-editor" name="comment" id="comment" rows="3" autocomplete="off">{{ $actuality->comment }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="citation" class="form-label">Citation</label>
                        <textarea class="form-control" name="citation" id="citation" rows="3" autocomplete="off">{{ $actuality->citation }}</textarea>
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
