<div class="modal fade" id="addAgent" tabindex="-1" aria-labelledby="addAgentModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAgentModalLabel">Ajout Agent</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.agent.store') }}" method="POST" class="submitForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3"> 
                        <div class="row">
                            
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom agent</label>
                                <input name="nom" class="form-control" type="text" id="nom" autocomplete="off"/>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prenoms agent</label>
                                <input name="prenom" class="form-control" type="text" id="prenom" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3"> 
                        <div class="row">
                            
                            <div class="col-md-6">
                                <label for="cel" class="form-label">Teléphone agent</label>
                                <input name="cel" class="form-control" type="text" id="cel" autocomplete="off"/>
                            </div>
                            <div class="col-md-6">
                                <label for="ville" class="form-label">Ville agent</label>
                                <input name="ville" class="form-control" type="text" id="ville" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3"> 
                        <div class="row">
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email agent</label>
                                <input name="email" class="form-control" type="email" id="email" autocomplete="off"/>
                            </div>
                            <div class="col-md-6">
                                <label for="codeagent" class="form-label">Code agent</label>
                                <input name="codeagent" class="form-control" type="text" id="codeagent" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 ">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="codezone" class="form-label">Code zone</label>
                                <input name="codezone" class="form-control" type="text" id="codezone" autocomplete="off"/>
                            </div>
                            <div class="col-md-3">
                                <label for="codemanager" class="form-label">Code manager</label>
                                <input name="codemanager" class="form-control" type="text" id="codemanager" autocomplete="off"/>
                            </div>
                            <div class="col-md-6">
                                <label for="nommanager" class="form-label">Nom manager</label>
                                <input name="nommanager" class="form-control" type="text" id="nommanager" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="mb-3">
                        <div class="row"> 
                            <div class="col-md-12">
                                <label for="codezone" class="form-label">Code zone</label>
                                <input name="codezone" class="form-control" type="text" id="codezone" autocomplete="off"/>
                            </div>
                        </div>
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