@extends('admins.layouts.main')
@section('content-admin')
<style>
  .remove-row {
      cursor: pointer;
      color: red;
      margin-left: 10px;
  }
</style>
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
        <h2 class="mb-0">Liste des reseaux interne</h2>
      </div>
    </div>
    <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
      <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>Total </span><span class="text-body-tertiary fw-semibold">({{count($reseauInternes)}})</span></a></li>
    </ul>
    
    <div>
      <div class="mb-4">
        <div class="d-flex flex-wrap gap-3">
          @include("admins.pages.reseauInterne.addModal")
          
          <div class="ms-xxl-auto">
            <button class="btn-prime btn-prime-two" id="addBtn" data-bs-toggle="modal" data-bs-target="#verticallyCentered">
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
                    <th class="text-center">Image</th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Libellé</th>
                    <th class="text-center">Ville</th>
                    <th class="text-center">Longitude</th>
                    <th class="text-center">Latitude</th>
                    <th class="text-center">État</th>
                    <th class="text-center">Date de création</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach($reseauInternes as $reseauInterne)
                    
                <tr class="position-staic">
                    <td class="align-middle white-space-nowrap py-0 text-center">
                        <a class="d-block border border-translucent rounded-2" data-bs-toggle="modal" data-bs-target="#show{{$reseauInterne->uuid}}" href="#">
                            <img src="{{ asset('images/ReseauInterne/'.$reseauInterne->image)}}" class="img-fluid" alt="" width="70" />
                        </a>
                    </td>
                    <td class="product align-middle ps-4 text-center">
                        <a class="fw-semibold line-clamp-3 mb-0" data-bs-toggle="modal" data-bs-target="#show{{$reseauInterne->uuid}}" href="#">
                            {{$reseauInterne->code ?? "N/A"}}
                        </a>
                    </td>
                    <td class="product align-middle ps-4 text-center">{{$reseauInterne->label ?? "N/A"}}</td>
                    <td class="align-middle review fs-8 text-center ps-4">
                        {{$reseauInterne->ville ?? "N/A"}}
                    </td>
                    <td class="align-middle review fs-8 text-center ps-4">
                        {{$reseauInterne->longitude ?? "N/A"}}
                    </td>
                    <td class="align-middle review fs-8 text-center ps-4">
                        {{$reseauInterne->latitude ?? "N/A"}}
                    </td>
                    
                    <td class="align-middle review fs-8 text-center ps-4"> 
                        <span class="badge badge-tag p-2 text-white me-2 mb-2 bg-success text-dark">
                            {{$reseauInterne->etat ?? "N/A"}}
                        </span>               
                    </td>
                    <td class="product align-middle ps-4 text-center">
                        {{$reseauInterne->created_at->format('d/m/Y H:i:s') ?? "N/A"}}
                    </td>
                    <td class="align-middle white-space-nowrap text-end pe-0 ps-4 btn-reveal-trigger text-center">
                        <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#show{{$reseauInterne->uuid}}" href="#">
                            <span class="badge badge-tag me-2 mb-2 far fa-eye"></span>
                        </a>
                        <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#update{{$reseauInterne->uuid}}" href="#">
                            <span class="badge badge-tag me-2 mb-2 far fa-edit"></span>
                        </a>
                        <a class="ms-3 deleteConfirmation" data-uuid="{{$reseauInterne->uuid}}"
                            data-type="confirmation_redirect" data-placement="top"
                            data-token="{{ csrf_token() }}"
                            data-url="{{route('admin.reseau_interne.destroy', $reseauInterne->uuid)}}"
                            data-title="Vous êtes sur le point de supprimer {{$reseauInterne->label}} "
                            data-id="{{$reseauInterne->uuid}}" data-param="0"
                            data-route="{{route('admin.reseau_interne.destroy', $reseauInterne->uuid)}}">
                            <span class="badge badge-tag me-2 mb-2 fa-solid fa-trash"></span>
                        </a>
                        @include('admins.pages.reseauInterne.showModal',["uuid" => $reseauInterne->uuid])
                        @include('admins.pages.reseauInterne.updateModal',["uuid" => $reseauInterne->uuid])
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


// document.addEventListener('DOMContentLoaded', function () {
//     document.getElementById('addRow').addEventListener('click', function () {
//         let productRows = document.getElementById('productRows');
//         let newRow = document.createElement('div');
//         newRow.className = 'row mb-3';

//         newRow.innerHTML = document.querySelector('#productRows .row.mb-3').innerHTML;

//         productRows.appendChild(newRow);

//         newRow.querySelector('.removeRow').addEventListener('click', function () {
//             this.closest('.row').remove();
//         });
//     });

//     document.querySelectorAll('.removeRow').forEach(function (button) {
//         button.addEventListener('click', function () {
//             this.closest('.row').remove();
//         });
//     });
// });

// document.addEventListener('DOMContentLoaded', function() {
//     const typeSelect = document.getElementById('type');
//     const typeSiegeFields = document.querySelectorAll('.type-siege');
//     const typeEspaceFields = document.querySelectorAll('.type-espace-client');
//     const typeAutreFields = document.querySelectorAll('.type-autre');

//     function toggleFields() {
//         const selectedType = typeSelect.value;

//         if (selectedType === 'Siège') {
//             typeSiegeFields.forEach(field => field.style.display = 'block');
//             typeAutreFields.forEach(field => field.style.display = 'none');
//             typeEspaceFields.forEach(field => field.style.display = 'none');
//         } else if (selectedType === 'Espace Client') {
//             typeSiegeFields.forEach(field => field.style.display = 'none');
//             typeAutreFields.forEach(field => field.style.display = 'none');
//             typeEspaceFields.forEach(field => field.style.display = 'block');
//         }  else {
//             typeSiegeFields.forEach(field => field.style.display = 'none');
//             typeEspaceFields.forEach(field => field.style.display = 'none');
//             typeAutreFields.forEach(field => field.style.display = 'block');

//         }
//     }

//     // Initial call to set the correct visibility
//     toggleFields();

//     // Event listener for change event on the type select
//     typeSelect.addEventListener('change', toggleFields);
// });

// document.addEventListener('DOMContentLoaded', function() {
//     const typeSelect = document.getElementById('type');
//     const typeSections = document.querySelectorAll('.type-section');

//     function updateTypeSections() {
//         const selectedType = typeSelect.value;

//         typeSections.forEach(section => {
//             if (section.getAttribute('data-type') === selectedType) {
//                 section.style.display = 'block';
//             } else {
//                 section.style.display = 'none';
//             }
//         });
//     }

//     // Initialiser l'affichage au chargement de la page
//     updateTypeSections();

//     // Mettre à jour l'affichage lorsque le type change
//     typeSelect.addEventListener('change', updateTypeSections);
// });

document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const typeSections = document.querySelectorAll('.type-section');
    const form = document.getElementById('submitForm'); // Remplacez 'yourFormId' par l'ID réel de votre formulaire

    function updateTypeSections() {
        const selectedType = typeSelect.value;

        typeSections.forEach(section => {
            if (section.getAttribute('data-type') === selectedType) {
                section.style.display = 'block';
            } else {
                section.style.display = 'none';
            }
        });
    }

    // Initialiser l'affichage au chargement de la page
    updateTypeSections();

    // Mettre à jour l'affichage lorsque le type change
    typeSelect.addEventListener('change', updateTypeSections);

    // Réactiver les champs masqués avant la soumission
    form.addEventListener('submit', function() {
        // Réactiver tous les champs masqués avant la soumission
        document.querySelectorAll('[disabled]').forEach(function(field) {
            field.disabled = false;
        });
    });
});


</script>
{{-- <script src="{{ asset('vendors/tinymce/tinymce.min.js')}}"></script> --}}
<script src="https://cdn.tiny.cloud/1/e4q046jo98cfguf7vaznxbg6xd76cu5k0jo48gj1lmgev6ns/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Initialiser TinyMCE sur tous les champs ayant l'attribut data-tinymce
    tinymce.init({
        selector: 'textarea[data-tinymce]',
        plugins: 'lists link image table',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        height: 300
    });
});
</script>
<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(setPosition);
        } else {
            alert("La géolocalisation n'est pas supportée par ce navigateur.");
        }
    }
    
    function setPosition(position) {
        document.getElementById('latitude').value = position.coords.latitude;
        document.getElementById('longitude').value = position.coords.longitude;
    }
    </script>
@endsection