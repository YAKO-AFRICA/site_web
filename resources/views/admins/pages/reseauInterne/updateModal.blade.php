<div class="modal fade" id="update{{$reseauInterne->uuid}}" tabindex="-1" aria-labelledby="updateModalLabel{{$reseauInterne->uuid}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel{{$reseauInterne->uuid}}">Mise à jour</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.reseau_interne.update', $reseauInterne->uuid) }}" method="POST" class="submitForm" id="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- Sélection du type de réseau -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="type" class="form-label">Type de réseau</label>
                            <select name="type" class="form-control" id="type" required disabled autocomplete="off">
                                <option selected value="{{$reseauInterne->type}}">{{$reseauInterne->type}}</option>
                                <option value="Siege">Siège</option>
                                <option value="EspaceClient">Espace Client</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div id="previewContainer" class="dz-preview d-flex flex-wrap border border-translucent bg-body-emphasis rounded-3 d-flex flex-center position-relative me-2 mb-2" style="height:140px;width:140px;">
                            <!-- L'image sera ajoutée ici -->
                            @if($reseauInterne->image)
                                <img src="{{ asset('images/ReseauInterne/' . $reseauInterne->image) }}" alt="Image" style="max-width: 100%; max-height: 100%;">
                            @endif
                        </div><br>
                        <label for="my-awesome-dropzone" class="form-label">Image</label>
                        <div class="dropzone dropzone-multiple p-0 mb-5" id="my-awesome-dropzone">
                            <div class="fallback">
                                <input name="file" class="form-control" type="file" id="fileInput" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <!-- Champs communs pour tous les types -->
                    <div class="mb-3">
                        <label for="inputLibelle" class="form-label">Libellé</label>
                        <input type="text" name="label" class="form-control" value="{{$reseauInterne->label}}" id="inputLibelle" placeholder="Libellé du réseau" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="ville" class="form-label">Ville</label>
                        <div class="input-group">
                            <select name="ville" class="form-control" id="ville" autocomplete="off" required>
                                <option selected value="{{$reseauInterne->ville}}">{{$reseauInterne->ville}}</option> 
                                <option value="Abidjan">Abidjan</option> 
                                <option value="Yamoussoukro">Yamoussoukro</option> 
                                <option value="Abengourou">Abengourou</option> 
                                <option value="Daloa">Daloa</option> 
                                <option value="San Pédro">San Pédro</option> 
                                <option value="Aboisso">Aboisso</option> 
                                <option value="Gagnoa">Gagnoa</option> 
                                <option value="Bouaké">Bouaké</option> 
                                <option value="Korhogo">Korhogo</option> 
                                <option value="Adzopé">Adzopé</option> 
                                <option value="Dimbokro">Dimbokro</option> 
                                <option value="Daoukro">Daoukro</option> 
                                <option value="Bondoukou">Bondoukou</option> 
                                <option value="Man">Man</option> 
                            </select>
                        </div>
                    </div>
                        @if($reseauInterne->type === 'Siege')
                            <!-- Section pour le type "Siège" -->
                            <div>
                                <div class="mb-3">
                                    <label for="siège_telephone1" class="form-label">Téléphone 1 (Siège)</label>
                                    <input type="text" name="telephone1" value="{{$reseauInterne->telephone1}}" class="form-control" id="siège_telephone1" placeholder="Téléphone 1 du siège" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="siège_telephone2" class="form-label">Téléphone 2 (Siège)</label>
                                    <input type="text" name="telephone2" value="{{$reseauInterne->telephone2}}"  class="form-control" id="siège_telephone2" placeholder="Téléphone 2 du siège" autocomplete="off">
                                </div>
                            </div>
                        @elseif($reseauInterne->type === 'EspaceClient')
                            <!-- Section pour le type "Espace Client" -->
                            <div>
                                <div class="mb-3">
                                    <label for="emailEspaceClient" class="form-label">Email (Espace Client)</label>
                                    <input type="email" name="email" value="{{$reseauInterne->email}}" class="form-control" id="emailEspaceClient" placeholder="Email de l'espace client" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="telephone1EspaceClient" class="form-label">Téléphone 1 (Espace Client)</label>
                                    <input type="text" name="telephone1" value="{{$reseauInterne->telephone1}}" class="form-control" id="telephone1EspaceClient" placeholder="Téléphone 1 de l'espace client" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="telephone2EspaceClient" class="form-label">Téléphone 2 (Espace Client)</label>
                                    <input type="text" name="telephone2" value="{{$reseauInterne->telephone2}}" class="form-control" id="telephone2EspaceClient" placeholder="Téléphone 2 de l'espace client" autocomplete="off">
                                </div>
                            </div>
                        @else
                            <!-- Section pour le type "Autre" -->
                            <div>
                                <div class="mb-3">
                                    <label for="emailAutre" class="form-label">Email (Autre)</label>
                                    <input type="email" name="email" value="{{$reseauInterne->email}}" class="form-control" id="emailAutre" placeholder="Email (Autre)" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="telephone1Autre" class="form-label">Téléphone 1 (Autre)</label>
                                    <input type="text" name="telephone1" value="{{$reseauInterne->telephone1}}" class="form-control" id="telephone1Autre" placeholder="Téléphone 1 (Autre)" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="telephone2Autre" class="form-label">Téléphone 2 (Autre)</label>
                                    <input type="text" name="telephone2" value="{{$reseauInterne->telephone2}}" class="form-control" id="telephone2Autre" placeholder="Téléphone 2 (Autre)" autocomplete="off">
                                </div>
                            </div>
                        @endif 

                    <!-- Géolocalisation -->
                    <span>Géolocalisation du site</span>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="number" name="longitude" value="{{$reseauInterne->longitude}}" class="form-control" id="longitude" placeholder="longitude" step="0.000000000000001" required autocomplete="off">
                        </div>
                        <div class="col-md-6">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="number" name="latitude" value="{{$reseauInterne->latitude}}"class="form-control" id="latitude" placeholder="latitude" step="0.000000000000001" required autocomplete="off">
                        </div>
                    </div>
            
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Écrire la description du réseau ici !" required autocomplete="off">{{ $reseauInterne->description }}</textarea>
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