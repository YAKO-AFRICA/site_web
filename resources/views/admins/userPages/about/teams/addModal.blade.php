<div class="modal fade" id="addTeam" tabindex="-1" aria-labelledby="addTeamModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTeamModalLabel">Ajout team Yako</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('admin.about.AddTeam') }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" id="form-container">
                    <div class="form-group mb-4" id="team-form-template">
                        <!-- Image -->
                        <div class="mb-3">
                            <div id="previewContainer" class="dz-preview d-flex flex-wrap border border-translucent bg-body-emphasis rounded-3 d-flex flex-center position-relative me-2 mb-2" style="height:140px;width:140px;">
                                <!-- L'image sera ajoutée ici -->
                            </div><br>
                            <label for="my-awesome-dropzone" class="form-label">Image</label>
                            <div class="dropzone dropzone-multiple p-0 mb-5" id="my-awesome-dropzone">
                                <div class="fallback">
                                    <input name="file[]" class="form-control" type="file" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <!-- Nom et Prénoms -->
                        <div class="mb-3">
                            <label for="inputTeam_name" class="form-label">Nom et Prénoms</label>
                            <input type="text" name="team_name[]" class="form-control" required autocomplete="off">
                        </div>
                        <!-- Fonction -->
                        <div class="mb-3">
                            <label for="inputTeam_fonction" class="form-label">Fonction</label>
                            <select name="team_fonction[]" class="form-control" required autocomplete="off">
                                <option value="">Choisissez une fonction</option>
                                <option value="Président du conseil d'administration">PCA</option>
                                <option value="Directeur générale">DG</option>
                                <option value="Directeur Général Adjoint">DGA</option>
                                <option value="Directeur Financier et Comptable">DFC</option>
                                <option value="Directeur Technique et Actuariat">DTA</option>
                                <option value="Directeur du Développement Commercial">DDC</option>
                                <option value="Directeur Adjoint du Développement Commercial">DDCA</option>
                                <option value="Directeur du Système d'Information">DSI</option>
                            </select>
                        </div>
                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control tinymce-editor" name="team_description[]" rows="3" autocomplete="off"></textarea>
                        </div>
                        <button type="button" class="btn-prime remove-form">X</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-prime" id="add-more">Ajouter un membre</button>
                    <button class="btn-prime btn-prime-two" type="submit">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>