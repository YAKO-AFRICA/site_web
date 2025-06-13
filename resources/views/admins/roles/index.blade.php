@extends('admins.layouts.main')
@section('content-admin')
    <div class="page-content">
        <!--breadcrumb-->
        <nav class="mb-3" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#!">Admin</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </nav>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">

                    <div class="ms-auto">
                        <button type="button" class="btn-prime btn-prime-two radius-30 mt-2 mt-lg-0" data-bs-toggle="modal"
                            data-bs-target="#addRoleModal"><i class="bx bxs-plus-square"></i>Nouveau Role</button>
                    </div>

                    <!-- Button trigger modal -->

                </div>
                <div class="table-responsive">
                    <table class="table fs-9 mb-0 table-striped table-hover display" id="example" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>id</th>
                                <th>Libelle</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <input class="form-check-input me-3" type="checkbox" value=""
                                                    aria-label="...">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-0 font-14">#{{ $item->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->name }}</td>


                                    <td>
                                        <div class="d-flex order-actions">
                                            <a data-bs-toggle="modal" data-bs-target="#editRoleModal{{ $item->id }}"
                                                class="" style="cursor: pointer">
                                                {{-- <i class='bx bxs-edit'></i> --}}
                                                <span class="badge badge-tag me-2 mb-2 far fa-edit"></span>
                                            </a>

                                            {{-- <form action="{{ route('setting.role.destroy', $item->id) }}" method="post"
                                                class="submitForm">
                                                @csrf
                                                <button type="submit" class="mx-3 bg-light px-2 rounded"><i
                                                        class='bx bxs-trash'></i> </button>
                                            </form> --}}
                                            <a class="ms-3 deleteConfirmation mx-3 bg-light px-2" style="cursor: pointer" data-uuid="{{$item->id}}"
                                                data-type="confirmation_redirect" data-placement="top"
                                                data-token="{{ csrf_token() }}"
                                                data-url="{{ route('setting.role.destroy', $item->id) }}"
                                                data-title="Vous êtes sur le point de supprimer le role '{{ $item->name }}' "
                                                data-id="{{$item->id}}" data-param="0"
                                                data-route="{{ route('setting.role.destroy', $item->id) }}">
                                                <span class="badge badge-tag me-2 mb-2 fa-solid fa-trash"></span>
                                            </a>

                                            <a href="{{ route('setting.permission', $item->id) }}" class=""
                                                style="cursor: pointer">
                                                <span class="badge badge-tag me-2 mb-2 fa-solid fa-key"></span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Modal edit category --}}
                                <div class="modal fade" id="editRoleModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <form action="{{ route('setting.role.edit', $item->id) }}" method="post"
                                                class="submitForm">
                                                @csrf
                                                <div class="modal-body my-4">
                                                    <div class="row">
                                                        <div class="form-group col">
                                                            <label for="">Libelle <span><span
                                                                        class="text-danger">*</span></span></label>
                                                            <input class="form-control @error('name') is-invalid @enderror"
                                                                type="text" value="{{ old('name', $item->name) }}"
                                                                name="name" required>
                                                            @error('name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            @if ($errors->has('name') && $errors->first('name') == 'The name has already been taken.')
                                                                <div class="invalid-feedback">Le nom existe déjà dans la
                                                                    table des rôles.</div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer mt-2">
                                                        <button type="button" class="btn-prime"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            class="btn-prime btn-prime-two">Modifier</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <center>Aucun role</center>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        {{-- Modal add new category --}}

        <!-- Modal -->
        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nouveau Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('setting.role.store') }}" method="post" class="submitForm">
                        @csrf
                        <div class="modal-body my-4">
                            <div class="row">
                                <div class="form-group col">
                                    <label for="">Libelle <span><span class="text-danger">*</span></span></label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        name="name" autocomplete="off" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if ($errors->has('name') && $errors->first('name') == 'The name has already been taken.')
                                        <div class="invalid-feedback">Le nom existe déjà dans la table des rôles.</div>
                                    @endif
                                </div>
                            </div>

                            <div class="modal-footer mt-2">
                                <button type="button" class="btn-prime" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn-prime btn-prime-two">Ajouter</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>



    </div>
@endsection
