@extends('admins.layouts.main')
@section('content-admin')
<nav class="mb-3" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="#!">Page 1</a></li>
      <li class="breadcrumb-item"><a href="#!">Page 2</a></li>
      <li class="breadcrumb-item active">Default</li>
    </ol>
</nav>
  <div class="mb-9">
    <div class="row g-3 mb-4">
      <div class="col-auto">
        <h2 class="mb-0">Agents</h2>
      </div>
    </div>
    <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>Total Agents </span><span class="text-body-tertiary fw-semibold">({{count($agents)}})</span></a></li>
    </ul>
    
    <div >
      <div class="mb-4">
        <div class="d-flex flex-wrap gap-3">
            @include("admins.pages.agents.addModal")
          <div class="ms-xxl-auto">
            <button class="btn-prime btn-prime-two" id="addBtn" data-bs-toggle="modal" data-bs-target="#addAgent">
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
                <th class="text-center">Nom</th>
                <th class="text-center">Prenoms</th>
                <th class="text-center">Telephone</th>
                <th class="text-center">Ville</th>
                <th class="text-center">Email</th>
                <th class="text-center">Code agent partenaire</th>
                <th class="text-center">Code zone</th>
                {{-- <th class="text-center">Code manager</th> --}}
                {{-- <th class="text-center">Nom manager</th> --}}
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody class="list" id="products-table-body">
              @foreach($agents as $agent)
              <tr class="position-static"> 
                <td class="product align-middle ps-4 text-center"><a class="fw-semibold line-clamp-3 mb-0" data-bs-toggle="modal" data-bs-target="#show{{$agent->idmembre}}" href="#">{{ $agent->nom ?? 'N/A' }}</a></td>
                <td class="product align-middle ps-4 text-center"><a class="fw-semibold line-clamp-3 mb-0" data-bs-toggle="modal" data-bs-target="#show{{$agent->idmembre}}" href="#">{{ $agent->prenom ?? 'N/A' }}</a></td>
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> {{ $agent->cel ?? 'N/A' }}</td>
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> {{ $agent->ville ?? 'N/A' }}</td>
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;">
                  {{ $agent->email ?? 'N/A' }}
                </td>
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> {{ $agent->codeagent ?? 'N/A' }}</td>

                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;">
                  {{ $agent->codezone ?? 'N/A' }}
                </td>
                
                {{-- <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> {{ $agent->codemanager ?? 'N/A' }}</td> --}}
                {{-- <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> {{ $agent->nommanager ?? 'N/A' }}</td> --}}
                <td class="align-middle white-space-nowrap text-end pe-0 ps-4 btn-reveal-trigger text-center">
                  <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#show{{$agent->idmembre}}" href="#">
                    <span class="badge badge-tag me-2 mb-2 far fa-eye"></span>
                </a>
                <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#update{{$agent->idmembre}}" href="#">
                      <span class="badge badge-tag me-2 mb-2 far fa-edit"></span>
                </a>
                <a class="ms-3 deleteConfirmation" data-uuid="{{$agent->idmembre}}"
                    data-type="confirmation_redirect" data-placement="top"
                    data-token="{{ csrf_token() }}"
                    data-url="{{route('admin.prod_formul.destroy', $agent->idmembre)}}"
                    data-title="Vous êtes sur le point de supprimer {{$agent->nom}} "
                    data-id="{{$agent->idmembre}}" data-param="0"
                    data-route="{{route('admin.prod_formul.destroy', $agent->idmembre)}}">
                    <span class="badge badge-tag me-2 mb-2 fa-solid fa-trash"></span>
                </a>
              </td>
            </tr>
            {{-- @include('admins.pages.agents.showModal',["idmembre" => $agent->idmembre])
            @include('admins.pages.agents.updateModal',["idmembre" => $agent->idmembre]) --}}
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection