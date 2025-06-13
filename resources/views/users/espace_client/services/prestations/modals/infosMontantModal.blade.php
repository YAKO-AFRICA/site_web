<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Basic modal</button> --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Information importante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card radius-10">
                    <div class="card-body bg-light-success rounded">
                        <div class="align-items-center">
                            <center>
                                <img src="{{ asset('cust_assets/images/avatars/yvon.png')}}" class="rounded-circle p-1 border" width="90" height="90" alt="...">
                            </center>
                            <div class="flex-grow-1 ms-3 my-4" style="text-align: justify">
                                <h5 class="mt-0">Mobile Money</h5>
                                <p class="mb-0">Pour tout montant <strong>inférieur ou égal à 600 000 FCFA,</strong> vous pouvez être payé par <strong>Mobile Money</strong></p>
                            </div>
                            <div class="flex-grow-1 ms-3" style="text-align: justify">
                                <h5 class="mt-0">Virement Bancaire</h5>
                                <p class="mb-0">Pour tout montant même <strong>au delà de 600 000 FCFA,</strong> vous pouvez être payé par <strong>Virment Bancaire</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-prime btn-prime-two" data-bs-dismiss="modal">J'ai compris</button>
            </div>
        </div>
    </div>
</div>