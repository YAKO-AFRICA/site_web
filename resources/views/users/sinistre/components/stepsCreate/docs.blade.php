<div class="card">
    <div class="card-header text-center">
        <h5 class="mb-1">Documents requis (en PDF, PNG ou JPEG)</h5>
        <p class="mb-4">Vueillez joindre les documents demander ci-dessous pour finaliser votre pré-déclaration </p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Libelle</th>
                        <th>Document en possession</th>
                        <th>Joindre document</th>
                    </tr>
                </thead>
                <tbody id="docsListTable">
                    {{-- Afficher dynamiquement les documents requis ici selon certaines conditions --}}
                    <tr>
                        <td colspan="3" class="text-center">Aucun document requis</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
