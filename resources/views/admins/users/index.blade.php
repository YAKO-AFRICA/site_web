@extends('admins.layouts.main')
@section('content-admin')
<nav class="mb-3" aria-label="breadcrumb">
  <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="#!">Admin</a></li>
      <li class="breadcrumb-item active">Users</li>
  </ol>
</nav>
  <div class="mb-9">
    <div class="row g-3 mb-4">
      <div class="col-auto">
        <h2 class="mb-0">Liste des utilisateurs</h2>
      </div>
    </div>
    <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>Total utilisateurs </span><span class="text-body-tertiary fw-semibold">({{count($users)}})</span></a></li>
    </ul>
    
    <div >
      <div class="mb-4">
        <div class="d-flex flex-wrap gap-3">
            @include("admins.users.addModal")
          <div class="ms-xxl-auto">
            <button class="btn-prime btn-prime-two" id="addBtn" data-bs-toggle="modal" data-bs-target="#addUser">
                <span class="fas fa-plus me-2"></span>Ajouter
            </button>
        </div>
        </div>
      </div>
      <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
        <div class="table-responsive scrollbar mx-n1 px-1">
          <table class="table fs-9 mb-0 table-striped table-hover display" id="example" style="width:100%">
            <thead>
              <tr>
                <th class="text-center">#ID</th>
                <th class="text-center">Noms</th>
                <th class="text-center">Login</th>
                <th class="text-center">Role</th>
                <th class="text-center">Date de Création</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody class="list" id="products-table-body">
              @foreach($users as $user)
              <tr class="position-static"> 
                <td class="product align-middle ps-4 text-center">{{ $user->id ?? '' }}</td>
                <td class="product align-middle ps-4 text-center"><a class="fw-semibold line-clamp-3 mb-0" href="javascript:void(0);" >{{ $user->name ?? '' }}</a></td>
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;">
                  {{ $user->email ?? '' }}
                </td>
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> {{ $user->role->name ?? '' }}</td>

                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;">
                  {{ $user->created_at->format('d/m/Y H:i') ?? 'N/A' }}
                </td>
                <td class="align-middle white-space-nowrap text-end pe-0 ps-4 btn-reveal-trigger text-center">
                <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#update{{$user->uuid}}" href="#">
                      <span class="badge badge-tag me-2 mb-2 far fa-edit"></span>
                </a>
                <a class="ms-3 deleteConfirmation" data-uuid="{{$user->uuid}}"
                    data-type="confirmation_redirect" data-placement="top"
                    data-token="{{ csrf_token() }}"
                    data-url="{{route('setting.users.destroy', $user->uuid)}}"
                    data-title="Vous êtes sur le point de supprimer l'utilisateur {{$user->name}} "
                    data-id="{{$user->uuid}}" data-param="0"
                    data-route="{{route('setting.users.destroy', $user->uuid)}}">
                    <span class="badge badge-tag me-2 mb-2 fa-solid fa-trash"></span>
                </a>
              </td>
            </tr>
              @include('admins.users.updateModal',["uuid" => $user->uuid])
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection