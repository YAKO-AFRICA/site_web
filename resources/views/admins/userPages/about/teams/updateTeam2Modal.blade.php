<div class="modal fade" id="updateTeam2{{$team2->uuid}}" tabindex="-1" aria-labelledby="updateModalLabel{{$team2->uuid}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel{{$team2->uuid}}">Mise à jour</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.about.updateTeam', $team2->uuid) }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div id="previewContainer" class="dz-preview d-flex flex-wrap border border-translucent bg-body-emphasis rounded-3 d-flex flex-center position-relative me-2 mb-2" style="height:140px;width:140px;">
                            <!-- L'image sera ajoutée ici -->
                            @if($team2->team_image)
                                <img src="{{ asset('images/Teams/' . $team2->team_image) }}" alt="Image" style="max-width: 100%; max-height: 100%;">
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
                        <label for="inputTeam_name" class="form-label">Nom et Prénoms</label>
                        <input type="text" name="team_name" value="{{$team2->team_name}}" class="form-control" required autocomplete="off">
                    </div>
                    <!-- Fonction -->
                    <div class="mb-3">
                        <label for="inputTeam_fonction" class="form-label">Fonction</label>
                        <select name="team_fonction" class="form-control" required autocomplete="off">
                            <option selected value="{{$team2->team_fonction}}">{{$team2->team_fonction}}</option>
                            <option value="Président du conseil d'administration">PCA</option>
                            <option value="Directeur Général Adjoint">DGA</option>
                            <option value="Directeur Financier et Comptable">DFC</option>
                            <option value="Directeur Technique et Actuariat">DTA</option>
                            <option value="Directeur du Développement Commercial">DDC</option>
                            <option value="Directeur Adjoint du Développement Commercial">DDCA</option>
                            <option value="Directeur du Système d'Information">DSI</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control tinymce-editor" name="team_description" rows="3" autocomplete="off">
                            {{$team2->team_description}}
                        </textarea>
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