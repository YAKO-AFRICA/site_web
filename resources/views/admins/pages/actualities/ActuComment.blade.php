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
        <h2 class="mb-0">Commentaires</h2>
      </div>
    </div>
    <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>Total Commentaires </span><span class="text-body-tertiary fw-semibold">({{count($comments)}})</span></a></li>
    </ul>
    
    <div>
      {{-- <div class="mb-4">
        <div class="d-flex flex-wrap gap-3">
          <div class="ms-xxl-auto">
            <button class="btn-prime btn-prime-two" id="addBtn" data-bs-toggle="modal" data-bs-target="#addActualities">
                <span class="fas fa-plus me-2"></span>Ajouter
            </button>
        </div>
        </div>
      </div> --}}
      <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
        <div class="table-responsive scrollbar mx-n1 px-1">
          <table class="table fs-9 mb-0 table-striped table-hover display" id="example" style="width:100%">
            <thead>
              <tr>
                <th class="text-center">User</th>
                <th class="text-center">Email</th>
                <th class="text-center">Telephone</th>
                <th class="text-center">Site Web</th>
                <th class="text-center">Commentaire</th>
                <th class="text-center">Actualités</th>
                <th class="text-center">Etat</th>
                <th class="text-center">Status</th>
                <th class="text-center">Date de Création</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody class="list" id="products-table-body">
              @foreach($comments as $comment)
              <tr class="position-static">
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> {{ $comment->customer_name}}</td>
                {{-- <td class="product align-middle ps-4 text-center"><a class="fw-semibold line-clamp-3 mb-0" data-bs-toggle="modal" data-bs-target="#show{{$actuality->uuid}}" href="#">{{ $actuality->code ?? 'N/A' }}</a></td> --}}
                <td class="product align-middle ps-4 text-center"><a class="fw-semibold line-clamp-3 mb-0" data-bs-toggle="modal" data-bs-target="#show{{$comment->uuid}}" href="#">{{$comment->customer_email}}</a></td>
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> {{ $comment->customer_phone }}</td>
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> {{ $comment->customer_website ?? 'aucun Site Web' }}</td>
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;">
                  {!! nl2br(e(Str::limit($comment->comment, 100, "...") ?? "N/A")) !!}
                </td>
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> {{ $comment->actuality->title }}</td>
                <td class="align-middle review fs-8 text-center ps-4 text-center"> 
                    <span class="badge badge-tag me-2 mb-2 p-2 bg-success text-white">{{ $comment->etat ?? 'N/A' }}</span>               
                </td>
                <td class="align-middle review fs-8 text-center ps-4 text-center"> 
                    @if($comment->status == 'Draft')
                      <span class="badge badge-tag me-2 mb-2 p-2 bg-danger text-white">{{ $comment->status ?? 'N/A' }}</span>
                    @else
                      <span class="badge badge-tag me-2 mb-2 p-2 bg-success text-white">{{ $comment->status ?? 'N/A' }}</span>               
                    @endif
                  </td>
                  
                <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;">
                  {{ $comment->created_at->format('d/m/Y H:i:s') ?? 'N/A' }}
                </td>
                <td class="align-middle white-space-nowrap text-end pe-0 ps-4 btn-reveal-trigger text-center">
                  <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#show{{$comment->uuid}}" href="#">
                    <span class="badge badge-tag me-2 mb-2 far fa-eye"></span>
                </a>
                {{-- <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#update{{$comment->uuid}}" href="#">
                      <span class="badge badge-tag me-2 mb-2 far fa-edit"></span>
                </a> --}}
                <a class="ms-3 deleteConfirmation" data-uuid="{{$comment->uuid}}"
                    data-type="confirmation_redirect" data-placement="top"
                    data-token="{{ csrf_token() }}"
                    data-url="{{route('admin.actuality.comment_destroy', $comment->uuid)}}"
                    data-title="Vous êtes sur le point de supprimer le commentaire de {{$comment->customer_name}}"
                    data-id="{{$comment->uuid}}" data-param="0"
                    data-route="{{route('admin.actuality.comment_destroy', $comment->uuid)}}">
                    <span class="badge badge-tag me-2 mb-2 fa-solid fa-trash"></span>
                </a>
              </td>
            </tr>
            <div class="modal fade" id="show{{$comment->uuid}}" tabindex="-1" aria-labelledby="showModalLabel{{$comment->uuid}}" aria-hidden="true" style="display: none;">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="showModalLabel{{$comment->uuid}}">Details Commentaire</h5>
                          <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('admin.actuality.comment_approved', $comment->uuid) }}" method="POST" class="submitForm" enctype="multipart/form-data">
                        @csrf
                          <div class="modal-body">
                            {{$comment->customer_name}} <br>
                              {{$comment->uuid}}


                          <input type="hidden" name="status" value="Approved">
                          </div>
                          <div class="modal-footer">
                            <button class="btn-prime" type="button" data-bs-dismiss="modal">Fermer</button>
                            <button class="btn-prime btn-prime-two" type="submit">Approuver</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
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