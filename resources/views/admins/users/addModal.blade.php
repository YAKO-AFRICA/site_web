<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Ajout Utilisateur</h5>
                <button class="btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('setting.users.store') }}" method="POST" class="submitForm"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">

                            <div class="col-md-12">
                                <label for="nom" class="form-label">Nom et prénoms</label>
                                <input name="name" class="form-control" type="text" id="nom"
                                    autocomplete="off" required />
                            </div>

                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" class="form-control" type="email" id="email"
                                    autocomplete="off" required />
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <select name="role_id" class="form-control" id="role" required>
                                    <option selected value="">Choisissez un role</option>
                                    @if(Auth::user()->name != 'Super admin')
                                        @foreach ($roles->where('name', '!=', 'Super admin') as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    @else
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input name="password" class="form-control" type="password" id="password"
                                    autocomplete="off" required />
                            </div>
                            <div class="col-md-6">
                                <label for="confirm_password" class="form-label">Confirmer le Mot de passe</label>
                                <input name="confirm_password" class="form-control" type="password"
                                    id="confirm_password" autocomplete="off" required />
                            </div>
                        </div>
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
