<div class="modal fade" id="update{{$user->uuid}}" tabindex="-1" aria-labelledby="updateModalLabel{{$user->uuid}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel{{$user->uuid}}">Mise à jour Utilisateur</h5>
                <button class="btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('setting.users.update', $user->uuid) }}" method="POST" class="submitForm"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">

                            <div class="col-md-12">
                                <label for="nom" class="form-label">Nom et prénoms</label>
                                <input name="name" class="form-control" type="text" id="nom"
                                    autocomplete="off" required value="{{ $user->name }}" />
                            </div>

                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" class="form-control" type="email" id="email"
                                    autocomplete="off" required value="{{ $user->email }}" />
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <select name="role_id" class="form-control" id="role" required>
                                    
                                    @foreach ($roles as $role)
                                        @if ($role->id == $user->role_id)
                                            <option selected value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif
                                        <option selected value="">Choisissez un role</option>
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-prime" type="button" data-bs-dismiss="modal">Retour</button>
                    <button class="btn-prime btn-prime-two" type="submit">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>