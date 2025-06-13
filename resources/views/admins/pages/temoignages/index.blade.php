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
        <h2 class="mb-0">Temoignages</h2>
      </div>
    </div>
    <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>Total Temoignages </span><span class="text-body-tertiary fw-semibold">({{count($temoignages)}})</span></a></li>
    </ul>
    
    <div>
      <div class="mb-4">
        <div class="d-flex flex-wrap gap-3">
            @include("admins.pages.temoignages.addModal")
          <div class="ms-xxl-auto">
            <button class="btn-prime btn-prime-two" id="addBtn" data-bs-toggle="modal" data-bs-target="#addtemoignage">
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
                    <th class="text-center">Nom du temoin</th>
                    <th class="text-center">Fonction du temoin</th>
                    <th class="text-center">Temoignage</th>
                    <th class="text-center">Etat</th>
                    <th class="text-center">Date de création</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody class="list" id="products-table-body">
              @foreach($temoignages as $temoignage)
              <tr class="position-static">
                <td class="product align-middle ps-4 text-center"><a class="fw-semibold line-clamp-3 mb-0" data-bs-toggle="modal" data-bs-target="#show{{$temoignage->uuid}}" href="#">{{$temoignage->nom ?? "N/A"}}</a></td>
                <td class="product align-middle ps-4 text-center"><a class="fw-semibold line-clamp-3 mb-0" data-bs-toggle="modal" data-bs-target="#show{{$temoignage->uuid}}" href="#">{{$temoignage->fonction ?? "N/A"}}</a></td>
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;">
                  {!! Str::words($temoignage->contenu, 70, '...') ?? "N/A" !!}
                </td>
                <td class="align-middle review fs-8 text-center ps-4 text-center"> 
                    <span class="badge badge-tag p-2 me-2 mb-2 bg-success text-dark">{{$temoignage->etat ?? "N/A"}}</span>               
                </td>
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;">
                  {{$temoignage->created_at->format('d/m/Y H:i:s') ?? "N/A"}}
                </td>
                <td class="align-middle white-space-nowrap text-end pe-0 ps-4 btn-reveal-trigger text-center">
                  <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#show{{$temoignage->uuid}}" href="#">
                    <span class="badge badge-tag me-2 mb-2 far fa-eye"></span>
                </a>
                <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#update{{$temoignage->uuid}}" href="#">
                      <span class="badge badge-tag me-2 mb-2 far fa-edit"></span>
                </a>
                <a class="ms-3 deleteConfirmation" data-uuid="{{$temoignage->uuid}}"
                    data-type="confirmation_redirect" data-placement="top"
                    data-token="{{ csrf_token() }}"
                    data-url="{{route('admin.temoignage.destroy', $temoignage->uuid)}}"
                    data-title="Vous êtes sur le point de supprimer le temoignage {{$temoignage->nom}} "
                    data-id="{{$temoignage->uuid}}" data-param="0"
                    data-route="{{route('admin.temoignage.destroy', $temoignage->uuid)}}">
                    <span class="badge badge-tag me-2 mb-2 fa-solid fa-trash"></span>
                </a>
                    @include('admins.pages.temoignages.showModal',["uuid" => $temoignage->uuid])
                    @include('admins.pages.temoignages.updateModal',["uuid" => $temoignage->uuid])
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection