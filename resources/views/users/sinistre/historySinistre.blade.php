@extends('users.sinistre.layouts.main')

@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Sinistre</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Mes Déclarations</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">

        <div class="card-header">
            <h4 class="card-title text-uppercase text-center">Consulter mes Déclarations de sinistre</h4>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <!-- Formulaire -->
            <form id="getSinistre"class="mb-3">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="" class="form-label">Consulter à partir de : <span
                                class="star">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" value="contrat" id="contrat"
                                checked>
                            <label class="form-check-label" for="contrat">
                                L'ID du contrat
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" value="code" id="code">
                            <label class="form-check-label" for="code">
                                Le code de la Déclaration
                            </label>
                        </div>
                    </div>
                </div>
                @if (Auth::guard('customer')->check())
                    <div class="row">
                        <div class="col-md-12" id="searchContrat">
                            <label for="contratIdInput" class="form-label">Sélectionnez le contrat <span
                                    class="star">*</span></label>
                            <select class="form-select" name="contratId" id="contratIdInput">
                                <option selected value="">Veuillez sélectionner l'ID du contrat</option>
                                @foreach (Auth::guard('customer')->user()->membre->membreContrat as $contrat)
                                    <option value="{{ $contrat->idcontrat }}">
                                        {{ $contrat->idcontrat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 d-none" id="searchCode">
                            <label for="codeInput" class="form-label">Veuillez entrer le code de la Déclaration du
                                sinistre <span class="star">*</span></label>
                            <input type="text" name="code" class="form-control"
                                placeholder="Veuillez entrer le code de la Déclaration du sinistre Ex: SIN-SHZZNS"
                                id="codeInput">
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-12" id="searchContrat">
                            <label for="contratIdInput" class="form-label">ID du contrat</label>
                            <input type="text" name="contratId" class="form-control"
                                placeholder="Veuillez entrer l'ID du contrat" id="contratIdInput">
                        </div>
                        <div class="col-12 d-none" id="searchCode">
                            <label for="codeInput" class="form-label">Veuillez entrer le code de la Déclaration
                                du sinistre
                                <span class="star">*</span></label>
                            <input type="text" name="code" class="form-control"
                                placeholder="Veuillez entrer le code de la Déclaration du sinistre Ex: SIN-SHZZNS"
                                id="codeInput">
                        </div>
                    </div>
                @endif

                <!-- Spinner -->
                <div id="spinner" class="text-center d-none mt-3">
                    <div class="spinner-border" style="color: #076633;" role="status"></div>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    <button type="submit"class="btn-prime btn-prime-two">Consulter</button>
                </div>
            </form>

            <!-- Tableau des assurés -->
            <div class="card-body container-fluid">
                <div class="table-responsive">
                    <table id="example3" class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Code</th>
                                <th>#ID du contrat</th>
                                <th>Assuré(e)</th>
                                <th>Nature du sinistre</th>
                                <th>Date Déclaration</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableSinistre">

                            {{-- Affichage des sinistres en fonction du contrat selectionner ici --}}

                            <tr>
                                <td colspan="7" class="text-center">Aucune sinistre trouvée</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>



        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const radioContrat = document.getElementById("contrat");
            const radioCode = document.getElementById("code");
            const contratIdInput = document.getElementById("contratIdInput");
            const codeInput = document.getElementById("codeInput");

            const searchContrat = document.getElementById("searchContrat");
            const searchCode = document.getElementById("searchCode");

            // Fonction pour mettre à jour l'affichage
            function toggleFields() {
                if (radioContrat.checked) {
                    searchContrat.classList.remove("d-none");
                    searchCode.classList.add("d-none");
                    contratIdInput.required = true;
                    codeInput.required = false;
                    codeInput.value = "";
                } else if (radioCode.checked) {
                    searchContrat.classList.add("d-none");
                    searchCode.classList.remove("d-none");
                    contratIdInput.required = false;
                    codeInput.required = true;
                    contratIdInput.value = "";
                }
            }

            // Écoute le changement des radios
            radioContrat.addEventListener("change", toggleFields);
            radioCode.addEventListener("change", toggleFields);

            // Initialisation au chargement
            toggleFields();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('getSinistre');
            const spinner = document.getElementById('spinner');
            const tableSinistre = document.getElementById('example3');
            const tableSinistreBody = document.getElementById('tableSinistre');
            let dataTableInstance = null;

            const formatDate = (dateString) => {
                if (!dateString) return '-';
                const date = new Date(dateString);
                return date.toLocaleDateString('fr-FR', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
            };

            const clearTable = () => {
                if (dataTableInstance) {
                    dataTableInstance.destroy();
                    dataTableInstance = null;
                }
                tableSinistreBody.innerHTML = '';
            };

            function getSinistre() {


                spinner.classList.remove('d-none');

                const formData = new FormData(form);
                const csrfToken = document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content');

                fetch("/api/get-sinistre", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erreur lors de la récupération des données');
                        }
                        return response.json();
                    })
                    .then(data => {
                        clearTable();
                        if (data.status === 'success') {
                            const sinistres = data.data;
                            if (sinistres.length > 0) {
                                tableSinistreBody.innerHTML = sinistres.map(sinistre => {
                                    const isEditable = sinistre.etape == 0 || sinistre.etape == 3;
                                    return `
                        <tr>
                            <td>${sinistre.code || '-'}</td>
                            <td>${sinistre.idcontrat || '-'}</td>
                            <td>${(sinistre.prenomAssuree || '') + ' ' + (sinistre.nomAssuree || '')}</td>
                            <td>${sinistre.natureSinistre || '-'}</td>
                            <td>${formatDate(sinistre.created_at) || '-'}</td>
                            <td>
                                ${sinistre.etape == '0' ? 
                                    '<div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>En attente de transmission</div>' :
                                sinistre.etape == '1' ? 
                                    '<div class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Transmise pour traitement</div>' :
                                sinistre.etape == '2' ? 
                                    '<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Acceptée et en cours de traitement</div>' :
                                sinistre.etape == '3' ? 
                                    '<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Pré-déclaration rejetée</div>' :
                                    '<div class="badge rounded-pill text-secondary bg-light-secondary p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Traitement Terminé</div>'
                                }
                            </td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="/sinistre/show/${sinistre.code}" class="ms-2 border"><i class='bx bxs-show'></i></a>
                                    <a href="/sinistre/edit/${sinistre.code}" class="ms-3 border ${isEditable ? '' : 'disabled-link'}" 
                                        title="${isEditable ? '' : 'Impossible de modifier la demande une fois transmise'}">
                                        <i class='bx bxs-edit'></i>
                                    </a>
                                    
                                    
                                    <a href="javascript:;" class="deleteConfirmation border ms-3 ${isEditable ? '' : 'disabled-link'}"
                                    data-type="confirmation_redirect" data-placement="top"
                                    data-token="${csrfToken}" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="${isEditable ? '' : 'Impossible de supprimer la demande une fois transmise'}"
                                    data-url="/sinistre/destroy/${sinistre.code}"
                                    data-title="Vous êtes sur le point de supprimer la pré-déclaration N° ${sinistre.code}"
                                    data-id="${sinistre.code}" data-param="0"
                                    data-route="/sinistre/destroy/${sinistre.code}" ><i
                                        class='bx bxs-trash' style="cursor: pointer"></i>
                                </a>
                                </div>
                            </td>
                        </tr>`;
                                }).join('');

                                // Initialiser DataTables après ajout des lignes
                                dataTableInstance = $(tableSinistre).DataTable({
                                    lengthChange: true,
                                    language: {
                                        search: "Recherche :",
                                        lengthMenu: "Afficher _MENU_ lignes",
                                        zeroRecords: "Aucun enregistrement trouvé",
                                        info: "Affichage de _START_ à _END_ sur _TOTAL_ enregistrements",
                                        infoEmpty: "Aucun enregistrement disponible",
                                        infoFiltered: "(filtré à partir de _MAX_ enregistrements)",
                                        paginate: {
                                            first: "Premier",
                                            last: "Dernier",
                                            next: "Suivant",
                                            previous: "Précédent",
                                        },
                                    },
                                });
                            } else {
                                tableSinistreBody.innerHTML = `
                        <tr>
                            <td colspan="7" class="text-center">Aucun sinistre trouvé.</td>
                        </tr>`;
                            }
                        } else {
                            tableSinistreBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center text-danger">Aucun sinistre trouvé</td>
                    </tr>`;
                        }
                        spinner.classList.add('d-none');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        clearTable();
                        spinner.classList.add('d-none');
                        tableSinistreBody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center text-danger">Erreur lors de la récupération des données</td>
                </tr>`;
                    });
            }

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                getSinistre();
            });
        });
    </script>
@endsection
