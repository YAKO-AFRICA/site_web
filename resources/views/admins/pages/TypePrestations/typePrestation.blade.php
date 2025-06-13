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
        <h2 class="mb-0">Type de Prestation</h2>
      </div>
    </div>
    <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>Total</span><span class="text-body-tertiary fw-semibold">({{count($typePrestations)}})</span></a></li>
    </ul>
    
    <div >
      <div class="mb-4">
        <div class="d-flex flex-wrap gap-3">
            @include("admins.pages.TypePrestations.addModal")
          <div class="ms-xxl-auto">
            <button class="btn-prime btn-prime-two" id="addBtn" data-bs-toggle="modal" data-bs-target="#addtypePrestation">
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
                <th class="text-center">Libellé</th>
                <th class="text-center">Impact</th>
                <th class="text-center">Description</th>
                <th class="text-center">Etat</th>
                <th class="text-center">Date de Création</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody class="list" id="products-table-body">
              @foreach($typePrestations as $typePrestation)
              <tr class="position-static">
                <td class="product align-middle ps-4 text-center"><a class="fw-semibold line-clamp-3 mb-0" data-bs-toggle="modal" data-bs-target="#show{{$typePrestation->id}}" href="#">{{ $typePrestation->libelle ?? 'N/A' }}</a></td>
                @if($typePrestation->impact == 0)
                  <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> 
                      <span class="badge badge-tag me-2 mb-2 p-2 bg-success text-white">Pas de sortie de portefeuille</span>
                  </td>
                @elseif($typePrestation->impact == 1)
                  <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> 
                      <span class="badge badge-tag me-2 mb-2 p-2 bg-warning text-white">Sortie de portefeuille</span>
                  </td>
                @elseif($typePrestation->impact == 'Autre')
                  <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> 
                      <span class="badge badge-tag me-2 mb-2 p-2 bg-secondary text-white">Autre</span>
                  </td>
                @endif
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;">
                  {!! Str::words($typePrestation->description, 20, "...") ?? "N/A" !!}
                  {{-- {{ $typePrestation->description ?? 'N/A' }} --}}
                </td>
                <td class="align-middle review fs-8 text-center ps-4 text-center"> 
                    <span class="badge badge-tag me-2 mb-2 p-2 bg-success text-white">{{ $typePrestation->etat ?? 'N/A' }}</span>               
                </td>
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;">
                  {{ $typePrestation->created_at->format('d/m/Y H:i:s') ?? 'N/A' }}
                </td>
                <td class="align-middle white-space-nowrap text-end pe-0 ps-4 btn-reveal-trigger text-center">
                  <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#show{{$typePrestation->id}}" href="#">
                    <span class="badge badge-tag me-2 mb-2 far fa-eye"></span>
                </a>
                <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#update{{$typePrestation->id}}" href="#">
                      <span class="badge badge-tag me-2 mb-2 far fa-edit"></span>
                </a>
                <a class="ms-3 deleteConfirmation" data-uuid="{{$typePrestation->id}}"
                    data-type="confirmation_redirect" data-placement="top"
                    data-token="{{ csrf_token() }}"
                    data-url="{{route('customer.typePrestation.destroy', $typePrestation->id)}}"
                    data-title="Vous êtes sur le point de supprimer {{$typePrestation->libelle}} "
                    data-id="{{$typePrestation->id}}" data-param="0"
                    data-route="{{route('customer.typePrestation.destroy', $typePrestation->id)}}">
                    <span class="badge badge-tag me-2 mb-2 fa-solid fa-trash"></span>
                </a>
              </td>
            </tr>
            @include('admins.pages.TypePrestations.showModal',["id" => $typePrestation->id])
            @include('admins.pages.TypePrestations.updateModal',["id" => $typePrestation->id])
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    document.getElementById('fileInput').addEventListener('change', function(event) {
    var files = event.target.files;
    var previewContainer = document.getElementById('previewContainer');
    previewContainer.innerHTML = ''; // Effacer les anciennes prévisualisations

    for (var i = 0; i < files.length; i++) {
        var file = files[i];

        // Assurez-vous que le fichier est bien une image
        if (file.type.startsWith('image/')) {
            var imgElement = document.createElement('img');
            imgElement.classList.add('dz-image');
            imgElement.style.width = '140px';
            imgElement.style.height = '140px';
            imgElement.style.objectFit = 'cover';
            imgElement.style.marginRight = '10px';
            imgElement.style.borderRadius = '5px';

            // Créez une URL pour l'image chargée
            var imageUrl = URL.createObjectURL(file);
            imgElement.src = imageUrl;

            // Ajoutez l'image à la div de prévisualisation
            previewContainer.appendChild(imgElement);
        }
    }
});

</script>
@endsection