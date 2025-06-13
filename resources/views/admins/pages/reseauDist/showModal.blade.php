<div class="modal fade" id="show{{$reseau->uuid}}" tabindex="-1" aria-labelledby="showModalLabel{{$reseau->uuid}}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{$reseau->uuid}}">Details du réseau {{$reseau->label}}</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div>
                        <img src="{{ asset('images/ReseauDist/'.$reseau->image)}}" class="img-fluid" alt=""/>
                    </div>

                    <div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Produits associés</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($reseau->products as $product)
                                    @php
                                        $producByReseau = App\Models\ProductByReseau::where(['reseau_uuid'=> $reseau->uuid, 'product_uuid' => $product->uuid])->first();
                                    @endphp
                                
                                <tr>

                                    <th scope="row">{{$loop->iteration }}</th>
                                    <td>
                                        <span class="badge bg-primary text-white badge-tag p-2">{{ $product->label }}</span>
                                    </td>
                                    <td>
                                        <a class="ms-3 deleteConfirmation" data-uuid="{{$producByReseau->uuid}}"
                                            data-type="confirmation_redirect" data-placement="top"
                                            data-token="{{ csrf_token() }}"
                                            data-url="{{ route('products.removeProdInReseau', $producByReseau->uuid)}}"
                                            data-title='Vous êtes sur le point de supprimer le produit "{{$product->label}}" du reseau "{{$reseau->label}}" '
                                            data-id="{{$producByReseau->uuid}}" data-param="0"
                                            data-route="{{ route('products.removeProdInReseau', $producByReseau->uuid)}}">
                                            <span class="badge bg-danger text-white badge-tag me-2 mb-2 fa-solid fa-times"></span>
                                        </a>
                                        {{-- <a class="ms-3 deleteConfirmation" data-uuid="{{$product->uuid}}"
                                            data-type="confirmation_redirect" data-placement="top"
                                            data-token="{{ csrf_token() }}"
                                            data-url="{{ route('products.removeProdInReseau', $product->uuid)}}"
                                            data-title='Vous êtes sur le point de supprimer le produit "{{$product->label}}" du reseau "{{$reseau->label}}" '
                                            data-id="{{$product->uuid}}" data-param="0"
                                            data-route="{{ route('products.removeProdInReseau', $product->uuid)}}">
                                            <span class="badge bg-danger text-white badge-tag me-2 mb-2 fa-solid fa-times"></span>
                                        </a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button class="btn-prime" type="button" data-bs-dismiss="modal">Fermer</button>
                </div>
        </div>
    </div>
</div>