@extends('admins.layouts.main')
@section('content-admin')
<style>

</style>
<div class="email-container">
    <div class="row g-lg-6 mb-8">
      <div class="col-lg">
        <div class="px-lg-1">
          <div class="d-flex align-items-center flex-wrap position-stick pb-2 bg-body z-2 email-toolbar inbox-toolbar">
            <div class="d-flex align-items-center flex-1 me-2">
                <a class="p-0 me-2" type="button" onclick="location.reload()">
                    <span class="text-primary fas fa-redo fs-10"></span>
                </a>
              <p class="fw-semibold fs-10 text-body-tertiary text-opacity-85 mb-0 lh-sm text-nowrap">Last refreshed 1m ago</p>
            </div>
            
          </div><br><br>
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-souscription-tab" data-bs-toggle="pill" data-bs-target="#pills-souscription" type="button" role="tab" aria-controls="pills-souscription" aria-selected="true">Pré-souscription</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-souscription" role="tabpanel" aria-labelledby="pills-souscription-tab" tabindex="0">
              <div class="border-top border-translucent hover-actions-trigger py-3">
                <div class="row">
                  <div class="col-2 mb-3">
                    <select name="filterByPre" id="filterByPre" class="form-control" autocomplete="off">
                      <option value="" {{ $statusPre == '' ? 'selected' : '' }} selected>Tous</option>
                      <option value="En attente" {{ $statusPre == 'En attente' ? 'selected' : '' }}>En attente</option>
                      <option value="Approuver" {{ $statusPre == 'Approuver' ? 'selected' : '' }}>Approuver</option>
                      <option value="Rejeter" {{ $statusPre == 'Rejeter' ? 'selected' : '' }}>Rejeter</option>
                  </select>
                  </div>
                </div>
                
                <div class="row g-lg-6">
                  <div class="col-lg-3  d-xxl-block">
                    <div class="email-content mb-3 scrollbar" id="preSouscription-list">
                      @include('admins.pages.mail.partials.pre-souscriptions', ['preSouscriptions' => $preSouscriptions])
                    </div>
                      
                  </div>

                    <div class="col">
                      <div class="card email-content">
                        <div class="card-body overflow-hidden">
                          <div class="d-flex flex-between-center pb-3 border-bottom border-translucent mb-4">
                            <a class="btn-link p-0 text-body-secondary me-3" href="{{ route('admin.subscription') }}">
                              <span class="fa-solid fa-angle-left fw-bolder fs-8"></span>
                            </a>
                            <h3 class="flex-1 mb-0 lh-sm line-clamp-1" id="preSouscription-title">Sélectionnez un message pour en savoir plus</h3>

                            <span class="d-inline-flex text-white align-items-center border border-translucent rounded-pill px-3 py-1 me-2 mt-2 inbox-link" id="preSouscription-status-container" href="#!">
                              <span class="ms-2 fw-bold fs-10 text-bod" id="preSouscription-status"></span>
                          </span>
                    
                          </div>
                          <div class="overflow-x-hidden scrollbar email-detail-content" id="preSouscription-content">
                            <p class="fs-9 text-body-tertiary text-center">Aucun détail disponible.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
              <div class="border-top border-translucent hover-actions-trigger py-3">
                <div class="row">
                  <div class="col-2 mb-3">
                    <select name="filterByContact" id="filterByContact" class="form-control" autocomplete="off">
                      <option value="" {{ $statusCon == '' ? 'selected' : '' }}>Tous</option>
                      <option value="En attente" {{ $statusCon == 'En attente' ? 'selected' : '' }}>En attente</option>
                      <option value="Approuver" {{ $statusCon == 'Approuver' ? 'selected' : '' }}>Approuver</option>
                      <option value="Rejeter" {{ $statusCon == 'Rejeter' ? 'selected' : '' }}>Rejeter</option>
                  </select>
                  </div>
                </div>
                <div class="row g-lg-6">
                  <div class="col-lg-3  d-xxl-block">
                    <div class="email-content mb-3 scrollbar" id="contact-list">
                      @include('admins.pages.mail.partials.contacts', ['contacts' => $contacts])
                      </div>
                  </div>
                  <div class="col">
                    <div class="card email-content">
                      <div class="card-body overflow-hidden">
                        <div class="d-flex flex-between-center pb-3 border-bottom border-translucent mb-4">
                          <a class="btn-link p-0 text-body-secondary me-3" href="{{ route('admin.subscription') }}">
                            <span class="fa-solid fa-angle-left fw-bolder fs-8"></span>
                          </a>
                          <h3 class="flex-1 mb-0 lh-sm line-clamp-1" id="Contact-title">Sélectionnez un message pour en savoir plus</h3>
                          <span class="d-inline-flex text-white align-items-center border border-translucent rounded-pill px-3 py-1 me-2 mt-2 inbox-link" id="Contact-status-container" href="#!">
                            <span class="ms-2 fw-bold fs-10 text-bod" id="Contact-status"></span>
                        </span>
                        </div>
                        <div class="overflow-x-hidden scrollbar email-detail-content" id="Contact-content">
                          <p class="fs-9 text-body-tertiary text-center">Aucun détail disponible.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              
            </div>
              
            </div>
          </div>
          
          
        </div>
      </div>
    </div>
</div>

<script>
  function showPreSouscriptionDetails(preSouscriptionUUID, element) {
    // Supprimer la couleur de fond des éléments précédents
    document.querySelectorAll('.pre-souscription-item').forEach(item => {
        item.style.backgroundColor = ''; // Réinitialiser la couleur de fond
        item.style.borderLeft = '';     // Réinitialiser la bordure gauche
    });

    // Appliquer la couleur de fond et la bordure gauche à l'élément sélectionné
    const parentElement = element.parentElement;
    parentElement.style.backgroundColor = '#a0d2e5'; // Couleur de fond
    parentElement.style.borderLeft = '5px solid #007bff'; // Bordure gauche

    // Envoyer une requête AJAX pour obtenir les détails de la pré-souscription
    fetch(`/admin/mail/presous/show/${preSouscriptionUUID}`)
    .then(response => response.json())
    .then(data => {
        // Mettre à jour le titre
        document.getElementById('preSouscription-title').textContent = data.object;
        // Mettre à jour le statut
        const statusElement = document.getElementById('preSouscription-status');
        const statusContainer = document.getElementById('preSouscription-status-container');

        statusElement.textContent = data.status;

        // Vérifier le statut et appliquer la classe de couleur correspondante
        if (data.status === 'En attente') {
          statusContainer.classList.remove('bg-success');
          statusContainer.classList.add('bg-danger');
          statusContainer.classList.add('bg-info');
        } else if (data.status === 'Approuver') {
          statusContainer.classList.remove('bg-danger');
          statusContainer.classList.remove('bg-info');
          statusContainer.classList.add('bg-success');
        } else if (data.status === 'Rejeter') {
          statusContainer.classList.remove('bg-info');
          statusContainer.classList.remove('bg-success');
          statusContainer.classList.add('bg-danger');
        }

        // Mettre à jour le contenu des détails
        const contentElement = document.getElementById('preSouscription-content');
        contentElement.innerHTML = `
            <div class="row align-items-center gy-3 gx-0 mb-4">
              
              <div class="col-auto flex-1">
                <div class="d-flex mb-1">
                  <h5 class="mb-0 text-body-highlight bg-light me-2 d-inline-flex align-items-center border border-translucent rounded px-3 py-1 me-2 mt-2">${data.formul_product.label}</h5>   
                </div>
              </div>
            </div>
            <div class="row gap-3">
              <div class="col-md-4  border rounded">
                <h3 class="mb-3 lh-sm line-clamp-1 text-center border-bottom py-3">Infos Client</h3>
                <div class="col-auto text-center mb-3">
                    <p>
                      <img class="me-2 rounded-circle" src="{{ asset('assets/img/images/user-default1.jpg')}}" alt="..." width="65px" height="65px" />
                      <h5 class="mb-0 text-body-highlight me-2">${data.customer_lastname} ${data.customer_firstname}</h5>
                    </p>
                    <p class="mb-0 lh-sm text-body-tertiary fs-9 d-none d-md-block text-nowrap">
                      &#60; ${data.customer_email} &#62;
                    </p>
                    <p class="mb-0 lh-sm text-body-tertiary fs-9 d-none d-md-block text-nowrap">
                      Tel: ${data.customer_phone}
                    </p>
                    <p class="mb-0 lh-sm text-body-tertiary fs-9 d-none d-md-block text-nowrap">
                      WhatsApp: ${data.customer_whatsapp}
                    </p>
                </div>
                <dl class="text-center">
                  <dt>Civilité</dt>
                  <dd>${data.customer_civility}</dd>

                  <dt>Lieu de residence</dt>
                  <dd>${data.customer_residence}</dd>

                  <dt>Fonction</dt>
                  <dd>${data.customer_job}</dd>

                  <dt>Date de naissance</dt>
                  <dd>${data.customer_birthday}</dd>

                  <dt>Personne à assurer</dt>
                  <dd>${data.customer_assure}</dd>

                  <dt>Date de naissance assuré</dt>
                  <dd>${data.assure_birthday}</dd>
                </dl>     
              </div>
              <div class="col-md-7 border rounded">
                <div class="row align-items-center gy-3 gx-0 mb-4 border-bottom py-2 mb-3">
                  <div class="col-auto flex-1"> 
                    <h3 class="mb-0 lh-sm line-clamp-1">Message</h3>
                    <p class="mb-0 fs-9">
                      <span class="fw-bold text-body-secondary">Envoyé le </span>
                      <span class="text-body-highlight fw-semibold fs-10">${new Date(data.created_at).toLocaleString('fr-FR')}</span>
                    </p>
                  </div> 
                  <div class="col-12 col-sm-auto d-flex order-sm-1">
                    <a href="javascript:void(0);" class="p-0 me-4 me-lg-3 me-xl-4 reply-messge" data-bs-toggle="tooltip" data-bs-placement="top" title="Repondre">
                        <span class="fa-solid fa-reply text-body-quaternary"></span>
                    </a>
                    <a href="javascript:void(0);" class="p-0 me-4 me-lg-3 me-xl-4 delete-messge" data-uuid="${data.uuid}" onclick="deleteMessage(this);" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer">
                        <span class="fa-solid fa-trash-can text-body-quaternary"></span>
                    </a>
                    <a href="javascript:void(0);" class="p-0 me-4 me-lg-3 me-xl-4 Approuved-messge" data-uuid="${data.uuid}" onclick="approuvedMessage(this);" data-bs-toggle="tooltip" data-bs-placement="top" title="Approuver">
                        <span class="fa fa-thumbs-up text-body-quaternary"></span>
                    </a>
                    <a href="javascript:void(0);" class="p-0 dismiss-messge" data-uuid="${data.uuid}" onclick="dismissMessage(this);" data-bs-toggle="tooltip" data-bs-placement="top" title="Réjeter">
                        <span class="fa fa-thumbs-down text-body-quaternary"></span>
                    </a>     
                  </div>
                </div>
                <div class="text-body-highlight fs-9 w-100 w-md-75 mb-8">
                  <p>${data.content.replace(/\n/g, "<br>")}</p>
                </div>
              </div>
            </div>
              
            
            
        `;
    })
    .catch(error => console.error('Erreur:', error));
}
</script>

<script>
  function deleteMessage(element) {
    const messageUUID = element.getAttribute('data-uuid');
    const parentElement = element.closest('.row'); // Sélectionne l'élément parent à supprimer du DOM

    // Confirmez avant la suppression
    if (confirm("Êtes-vous sûr de vouloir supprimer ce message ?")) {
          fetch(`{{ route('admin.subscription.destroy', '') }}/${messageUUID}`, {
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Content-Type': 'application/json'
          }
      })
      .then(response => response.text())  // Changez ici pour voir la réponse brute
      .then(text => {
          console.log(text);  // Affichez la réponse brute pour déboguer
          const data = JSON.parse(text);  // Ensuite parsez-la si tout semble correct
          if (data.success) {
              parentElement.remove(); // Supprimer du DOM
              alert('Message supprimé avec succès.');
          } else {
              alert('Erreur lors de la suppression du message.');
          }
      })
      .catch(error => console.error('Erreur:', error));
    }
}

function approuvedMessage(element) {
    const messageUUID = element.getAttribute('data-uuid');

    // Confirmez avant l'approbation
    if (confirm("Êtes-vous sûr de vouloir approuver ce message ?")) {
        fetch(`{{ route('admin.subscription.approuvedMessage', '') }}/${messageUUID}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.text())  // Voir la réponse brute pour déboguer
        .then(text => {
            try {
                const data = JSON.parse(text);  // Tenter de parser le JSON
                if (data.success) {
                    alert('Message approuvé avec succès.');
                } else {
                    alert('Erreur lors de l\'approbation du message.');
                }
            } catch (error) {
                console.error('Erreur de parsing JSON:', error);
                console.log('Réponse brute:', text);  // Afficher la réponse brute si JSON incorrect
                alert('Erreur lors de l\'approbation du message.');
            }
        })
        .catch(error => console.error('Erreur:', error));
    }
}



function dismissMessage(element) {
  const messageUUID = element.getAttribute('data-uuid');
  // Confirmez avant la suppression
  if (confirm("Êtes-vous sûr de vouloir réjeter ce message?")) {
        fetch(`{{ route('admin.subscription.dismissMessage', '') }}/${messageUUID}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.text())  // Changez ici pour voir la réponse brute
    .then(text => {
        const data = JSON.parse(text);  // Ensuite parsez-la si tout semble correct
        if (data.success) {
            alert('Message réjeté avec succès.');
        } else {
            alert('Erreur lors du réjet du message.');
        }

        })
    .catch(error => console.error('Erreur:', error));
      }
}
</script>


<script>
function showContactDetails(contactUUID, element) {
  // Supprimer la couleur de fond des éléments précédents
  document.querySelectorAll('.Contact-item').forEach(item => {
        item.style.backgroundColor = ''; // Réinitialiser la couleur de fond
        item.style.borderLeft = '';     // Réinitialiser la bordure gauche
    });

    // Appliquer la couleur de fond et la bordure gauche à l'élément sélectionné
    const parentElement = element.parentElement;
    parentElement.style.backgroundColor = '#a0d2e5'; // Couleur de fond
    parentElement.style.borderLeft = '5px solid #007bff'; // Bordure gauche
    // Envoyer une requête AJAX pour obtenir les détails de la pré-souscription
    fetch(`/admin/mail/showContact/show/${contactUUID}`)
        .then(response => response.json())
        .then(data => {
            // Mettre à jour le titre
            document.getElementById('Contact-title').textContent = data.object;
            // Mettre à jour le statut
        const statusElement = document.getElementById('Contact-status');
        const statusContainer = document.getElementById('Contact-status-container');

        statusElement.textContent = data.status;

        // Vérifier le statut et appliquer la classe de couleur correspondante
        if (data.status === 'En attente') {
            statusContainer.classList.remove('bg-success');
            statusContainer.classList.add('bg-danger');
            statusContainer.classList.add('bg-info');
        } else if (data.status === 'Approuver') {
            statusContainer.classList.remove('bg-danger');
            statusContainer.classList.remove('bg-info');
            statusContainer.classList.add('bg-success');
        } else if (data.status === 'Rejeter') {
          statusContainer.classList.remove('bg-info');
          statusContainer.classList.remove('bg-success');
            statusContainer.classList.add('bg-danger');
        }


            // Mettre à jour le contenu des détails
            const contentElement = document.getElementById('Contact-content');
            contentElement.innerHTML = `
                <div class="row align-items-center gy-3 gx-0 mb-10">
                    <div class="col-12 col-sm-auto d-flex order-sm-1">
                        <a href="#" class="p-0 me-4 me-lg-3 me-xl-4" data-bs-toggle="tooltip" data-bs-placement="top" title="Repondre">
                        <span class="fa-solid fa-reply text-body-quaternary"></span>
                    </a>
                    <a href="#" class="p-0 me-4 me-lg-3 me-xl-4" data-uuid="${data.uuid}" onclick="deleteMessage(this);"  data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer">
                        <span class="fa-solid fa-trash-can text-body-quaternary"></span>
                    </a>
                    <a href="#" class="p-0 me-4 me-lg-3 me-xl-4" data-uuid="${data.uuid}" onclick="approuvedMessage(this);" data-bs-toggle="tooltip" data-bs-placement="top" title="Approuver">
                        <span class="fa fa-thumbs-up text-body-quaternary"></span>
                    </a>
                    <a href="#" class="p-0" data-uuid="${data.uuid}" onclick="dismissMessage(this);" data-bs-toggle="tooltip" data-bs-placement="top" title="Réjeter">
                        <span class="fa fa-thumbs-down text-body-quaternary"></span>
                    </a>
                    </div>
                    <div class="col-auto">
                        <img class="me-2 rounded-circle" src="{{ asset('assets/img/images/user-default1.jpg')}}" alt="..." width="48" height="48" />
                    </div>
                    <div class="col-auto flex-1">
                        <div class="d-flex mb-1">
                            <h5 class="mb-0 text-body-highlight me-2">${data.customer_firstname}</h5>
                            <p class="mb-0 lh-sm text-body-tertiary fs-9 d-none d-md-block text-nowrap">
                                &#60; ${data.customer_email} | Tel: ${data.customer_phone} &#62;
                            </p>
                        </div>
                        <p class="mb-0 fs-9">
                            <span class="text-body-tertiary">à</span>
                            <span class="fw-bold text-body-secondary"> Moi </span>
                            <span class="text-body-highlight fw-semibold fs-10">${new Date(data.created_at).toLocaleString('fr-FR')}</span>
                        </p>
                    </div>
                </div>
                <div class="text-body-highlight fs-9 w-100 w-md-75 mb-8">
                    <p>${data.content.replace(/\n/g, "<br>")}</p>
                </div>
            `;
        })
        .catch(error => console.error('Erreur:', error));
}

document.addEventListener('DOMContentLoaded', function() {
    function updateList() {
        var filterByPre = document.getElementById('filterByPre').value;
        var filterByContact = document.getElementById('filterByContact').value;

        fetch("{{ route('admin.subscription') }}?filterByPre=" + filterByPre + "&filterByContact=" + filterByContact, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            document.querySelector('#preSouscription-list').innerHTML = data.preSouscriptions;
            document.querySelector('#contact-list').innerHTML = data.contacts;
        });
    }

    // Attacher les gestionnaires d'événements
    document.getElementById('filterByPre').addEventListener('change', updateList);
    document.getElementById('filterByContact').addEventListener('change', updateList);

    // Appeler updateList pour charger les listes au premier chargement
    updateList();
});
</script>


@endsection