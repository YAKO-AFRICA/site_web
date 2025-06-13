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
        <h2 class="mb-0">Actualités</h2>
      </div>
    </div>
    <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>Total Actualités </span><span class="text-body-tertiary fw-semibold">({{count($actualities)}})</span></a></li>
    </ul>
    
    <div>
      <div class="mb-4">
        <div class="d-flex flex-wrap gap-3">
            @include("admins.pages.actualities.addModal")
          <div class="ms-xxl-auto">
            <button class="btn-prime btn-prime-two" id="addBtn" data-bs-toggle="modal" data-bs-target="#addActualities">
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
                <th class="text-center">user</th>
                <th class="text-center">Titre</th>
                <th class="text-center">Contenue</th>
                <th class="text-center">Produit</th>
                <th class="text-center">Citation</th>
                <th class="text-center">Etat</th>
                <th class="text-center">Date de Création</th>
                <th class="text-center">Action</th>
                {{-- <th class="text-center"></th> --}}
            </tr>
            </thead>
            <tbody class="list" id="products-table-body">
              @foreach($actualities as $actuality)
                <tr class="position-static">
                    <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> 
                        {{ $actuality->user->name ?? 'aucun user' }}
                    </td>

                    <td class="product align-middle ps-4 text-center">
                        <a class="fw-semibold line-clamp-3 mb-0" data-bs-toggle="modal" data-bs-target="#show{{$actuality->uuid}}" href="#">{{ $actuality->title ?? 'N/A' }}</a>
                    </td>

                    <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;">
                        {!! Str::words($actuality->comment, 30, "...") ?? "N/A" !!}
                    </td>
                    
                    <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> 
                        @if($actuality->product) {{ $actuality->product->label ?? ' ' }} @else {{ $actuality->product_uuid ?? ' ' }} @endif
                    </td>

                    <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;"> 
                        {{(Str::limit($actuality->citation, 90, "...") ?? 'aucune citation') }}
                    </td>

                    <td class="align-middle review fs-8 text-center ps-4 text-center"> 
                        <span class="badge badge-tag me-2 mb-2 p-2 bg-success text-white">{{ $actuality->etat ?? 'N/A' }}</span>               
                    </td>

                    <td class="tags align-middle review pb-2 ps-3 text-center" style="min-width:225px;">
                        {{ $actuality->created_at->format('d/m/Y H:i:s') ?? 'N/A' }}
                    </td>
                    
                    <td class="align-middle white-space-nowrap text-end pe-0 ps-4 btn-reveal-trigger text-center">
                        <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#show{{$actuality->uuid}}" href="#">
                            <span class="badge badge-tag me-2 mb-2 far fa-eye"></span>
                        </a>
                        <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#update{{$actuality->uuid}}" href="#">
                            <span class="badge badge-tag me-2 mb-2 far fa-edit"></span>
                        </a>
                        <a class="ms-3 deleteConfirmation" data-uuid="{{$actuality->uuid}}"
                            data-type="confirmation_redirect" data-placement="top"
                            data-token="{{ csrf_token() }}"
                            data-url="{{route('admin.actuality.destroy', $actuality->uuid)}}"
                            data-title="Vous êtes sur le point de supprimer {{$actuality->title}} "
                            data-id="{{$actuality->uuid}}" data-param="0"
                            data-route="{{route('admin.actuality.destroy', $actuality->uuid)}}">
                            <span class="badge badge-tag me-2 mb-2 fa-solid fa-trash"></span>
                        </a>
                        @include('admins.pages.actualities.showModal',["uuid" => $actuality->uuid])
                        @include('admins.pages.actualities.updateModal',["uuid" => $actuality->uuid])
                    </td> 
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
<script>
    // Tableau pour stocker les fichiers sélectionnés
    let allSelectedFiles = [];

    // Écoutez les changements sur le champ de fichier
    document.getElementById('fileInput').addEventListener('change', function(event) {
        var files = event.target.files;
        var previewContainer = document.getElementById('previewContainer');

        // Ajoutez les nouveaux fichiers sélectionnés à la liste globale
        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                allSelectedFiles.push(file);
            }
        });

        // Réinitialiser la zone de prévisualisation
        previewContainer.innerHTML = '';

        // Afficher toutes les images sélectionnées
        allSelectedFiles.forEach((file, index) => {
            var imgElement = document.createElement('div');
            imgElement.classList.add('dz-image', 'position-relative', 'm-1');
            imgElement.style.width = '150px';
            imgElement.style.height = '140px';
            imgElement.style.objectFit = 'cover';
            imgElement.style.display = 'inline-block';

            // Créez une URL pour l'image chargée
            var imageUrl = URL.createObjectURL(file);
            imgElement.innerHTML = `
                <img src="${imageUrl}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;" />
                <a class="position-absolute top-0 end-0 text-center" style="border-radius: 10%; width: 15%; height: 15%; background-color: #fff" onclick="removeImage(${index})">X</a>
            `;

            // Ajoutez l'image à la div de prévisualisation
            previewContainer.appendChild(imgElement);
        });
    });

    // Fonction pour supprimer une image
    function removeImage(index) {
        allSelectedFiles.splice(index, 1); // Supprimez le fichier du tableau
        document.getElementById('fileInput').files = new DataTransfer().files; // Réinitialiser le champ de fichier

        // Recréer l'objet FileList
        var dt = new DataTransfer();
        allSelectedFiles.forEach(file => {
            dt.items.add(file);
        });
        document.getElementById('fileInput').files = dt.files; // Mettre à jour le champ de fichier

        // Mettre à jour la prévisualisation
        var previewContainer = document.getElementById('previewContainer');
        previewContainer.innerHTML = ''; // Réinitialiser la zone de prévisualisation
        allSelectedFiles.forEach((file, index) => {
            var imgElement = document.createElement('div');
            imgElement.classList.add('dz-image', 'position-relative', 'm-1');
            imgElement.style.width = '150px';
            imgElement.style.height = '140px';
            imgElement.style.objectFit = 'cover';
            imgElement.style.display = 'inline-block';

            var imageUrl = URL.createObjectURL(file);
            imgElement.innerHTML = `
                <img src="${imageUrl}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;" />
                <a class="position-absolute top-0 end-0 text-center" style="border-radius: 10%; width: 15%; height: 15%; background-color: #fff" onclick="removeImage(${index})">X</a>
            `;

            previewContainer.appendChild(imgElement);
        });
    }
</script>

<script>
  // Tableau pour stocker les fichiers sélectionnés et les images existantes supprimées
  let allSelectedFilesupdate = [];
  let deletedImages = [];

  // Écoutez les changements sur le champ de fichier
  document.getElementById('fileInputupdate').addEventListener('change', function(event) {
      var files = event.target.files;
      var previewContainerupdate = document.getElementById('previewContainerupdate');

      // Réinitialiser la zone de prévisualisation
      previewContainerupdate.innerHTML = '';

      // Ajoutez les nouveaux fichiers sélectionnés à la liste globale
      Array.from(files).forEach(file => {
          if (file.type.startsWith('image/')) {
              allSelectedFilesupdate.push(file);

              // Afficher l'image sélectionnée
              var imgElement = document.createElement('div');
              imgElement.classList.add('dz-image', 'position-relative', 'm-1');
              imgElement.style.width = '150px';
              imgElement.style.height = '140px';
              imgElement.style.objectFit = 'cover';
              imgElement.style.display = 'inline-block';

              // Créez une URL pour l'image chargée
              var imageUrl = URL.createObjectURL(file);
              imgElement.innerHTML = `
                  <img src="${imageUrl}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;" />
                  <a class="position-absolute top-0 end-0 text-center" style="border-radius: 10%; width: 15%; height: 15%; background-color: #fff" onclick="removeImages(${allSelectedFilesupdate.length - 1})">X</a>
              `;

              // Ajoutez l'image à la div de prévisualisation
              previewContainerupdate.appendChild(imgElement);
          }
      });
  });

  // Fonction pour supprimer une nouvelle image
  function removeImages(index) {
      allSelectedFilesupdate.splice(index, 1); // Supprimez le fichier du tableau

      // Recréer l'objet FileList en utilisant DataTransfer
      var dt = new DataTransfer();
      allSelectedFilesupdate.forEach(file => {
          dt.items.add(file);
      });

      // Mettre à jour le champ de fichier avec les nouvelles valeurs
      document.getElementById('fileInputupdate').files = dt.files; 

      // Mettre à jour la prévisualisation
      updatePreview();
  }


  // Fonction pour mettre à jour la prévisualisation
  function updatePreview() {
      var previewContainerupdate = document.getElementById('previewContainerupdate');
      previewContainerupdate.innerHTML = ''; // Réinitialiser la zone de prévisualisation

      // Afficher les images restantes
      allSelectedFilesupdate.forEach((file, index) => {
          var imgElement = document.createElement('div');
          imgElement.classList.add('dz-image', 'position-relative', 'm-1');
          imgElement.style.width = '150px';
          imgElement.style.height = '140px';
          imgElement.style.objectFit = 'cover';
          imgElement.style.display = 'inline-block';

          var imageUrl = URL.createObjectURL(file);
          imgElement.innerHTML = `
              <img src="${imageUrl}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;" />
              <a class="position-absolute top-0 end-0 text-center" style="border-radius: 10%; width: 15%; height: 15%; background-color: #fff" onclick="removeImages(${index})">X</a>
          `;
          previewContainerupdate.appendChild(imgElement);
      });
  }
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-image').forEach(function(element) {
        element.addEventListener('click', function() {
            const uuid = this.getAttribute('data-uuid');
            const confirmation = confirm("Êtes-vous sûr de vouloir supprimer cette image ?");
            
            if (confirmation) {
                fetch(`/admin/DeleteImgByActuality/${uuid}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Assurez-vous d'inclure le token CSRF
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        uuid: uuid // Vous pouvez ajouter d'autres données si nécessaire
                    })
                })
                .then(response => {
                    if (response.ok) {
                        // Supprimer le conteneur d'image de la page
                        this.closest('.dz-image').remove();
                    } else {
                        alert('Erreur lors de la suppression de l\'image. Veuillez réessayer.');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                });
            }
        });
    });
});

</script>


{{-- <script>
  // Tableau pour stocker les fichiers sélectionnés et les images existantes supprimées
    let allSelectedFilesupdate = [];
    let deletedImages = [];

    // Écoutez les changements sur le champ de fichier
    document.getElementById('fileInputupdate').addEventListener('change', function(event) {
        var files = event.target.files;
        var previewContainerupdate = document.getElementById('previewContainerupdate'); 

        // Ajouter les nouveaux fichiers sélectionnés à la liste globale
        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                allSelectedFilesupdate.push(file);  // Ajouter à la liste des fichiers
            }
        });

        // Mettre à jour la prévisualisation
        updatePreview();
    });

    // Fonction pour mettre à jour la prévisualisation des images (nouvelles et existantes)
    function updatePreview() {
        var previewContainerupdate = document.getElementById('previewContainerupdate');
        previewContainerupdate.innerHTML = ''; // Réinitialiser la zone de prévisualisation

        // Afficher les nouvelles images sélectionnées
        allSelectedFilesupdate.forEach((file, index) => {
            var imgElement = document.createElement('div');
            imgElement.classList.add('dz-image', 'position-relative', 'm-1');
            imgElement.style.width = '150px';
            imgElement.style.height = '140px';
            imgElement.style.objectFit = 'cover';
            imgElement.style.display = 'inline-block';

            var imageUrl = URL.createObjectURL(file);
            imgElement.innerHTML = `
                <img src="${imageUrl}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;" />
                <a class="position-absolute top-0 end-0 text-center" style="border-radius: 10%; width: 15%; height: 15%; background-color: #fff" onclick="removeImage(${index})">X</a>
            `;
            previewContainerupdate.appendChild(imgElement);
        });
    }

    // Fonction pour supprimer une nouvelle image
    function removeImage(index) {
        allSelectedFilesupdate.splice(index, 1); // Supprimer l'image du tableau

        // Recréer l'objet FileList avec DataTransfer
        var dt = new DataTransfer();
        allSelectedFilesupdate.forEach(file => {
            dt.items.add(file);
        });

        // Mettre à jour le champ de fichier avec les nouvelles images
        document.getElementById('fileInputupdate').files = dt.files; 

        // Mettre à jour la prévisualisation après la suppression
        updatePreview();
    }

    // Fonction pour supprimer une image existante
    function removeExistingImage(uuid) {
        var imageElement = document.querySelector(`div[data-uuid="${uuid}"]`);
        if (imageElement) {
            imageElement.remove(); // Supprimer visuellement l'image
            deletedImages.push(uuid); // Stocker l'UUID des images supprimées
        } else {
            console.error("L'élément avec l'UUID " + uuid + " n'a pas été trouvé.");
        }
    }

</script> --}}
@endsection