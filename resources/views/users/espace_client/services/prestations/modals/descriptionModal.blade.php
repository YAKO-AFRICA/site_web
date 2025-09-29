<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Basic modal</button> --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $typePrestation->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @php
        $produitsEpargneValides = ["CADENCE", "DOIHOO", "CAD_EDUCPLUS", "PFA_IND"];
        $produitsObsequeValides1 = ["YKE_2008","YKE_2018"];
        $produitsObsequeValides2 = ["YKS_2008","YKS_2018"];
        // $dureeCotisation = $NbrencConfirmer/12;
        switch ($contratDetails['periodicite']) {
            case "M":
                $dureeCotisation = $NbrencConfirmer/12;
                break;
            case "T":
                $dureeCotisation = $NbrencConfirmer / 3; // Trimestriel = tous les 3 mois
                break;
            case "S":
                $dureeCotisation = $NbrencConfirmer / 6; // Semestriel = tous les 6 mois
                break;
            case "A":
                $dureeCotisation = $NbrencConfirmer; // 1 encaissement = 1 an
                break;
            case "U":
                $dureeCotisation = 1; // Unique = une seule cotisation
                break;
            default:
                $dureeCotisation = 0; // Gérer les cas non définis
                break;
        }
        // dd($dureeCotisation, $NbrencConfirmer);
        
    @endphp
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card radius-10">
                    <div class="card-body bg-light-success rounded">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 col-sm-12 text-center">
                                <img src="{{ asset('cust_assets/images/avatars/yvon.png')}}" class="rounded-circle p-1 border img-fluid">
                            </div>
                            <div class="col-md-9 col-lg-9 col-sm-12">
                                <h5 class="mt-0">Qu'est ce qu'un(e) {{$typePrestation->libelle ?? ''}}</h5>
                                <p class="mb-0">{!! ($typePrestation->description) ?? 'Pas de description' !!}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex-grow-1 ms-3">
                        <p class="text-danger text-center">
                            @if ($typePrestation->impact == 0)
                                @if (in_array($contratDetails['codeProduit'], $produitsEpargneValides))
                                    @if ($typePrestation->id != 5 && $NbrencConfirmer <= 24)
                                    Vous ne pouvez pas demander cette prestation !
                                    {{-- "Pour pouvoir demander cette prestation : <strong>{{$typePrestation->libelle ?? ''}}</strong> sur le contrat <strong>{{$contratDetails['IdProposition'] ?? ''}}</strong>, vous devez avoir effectué une cotisation d'au moins 24 mois." --}}
                                    @endif
                                @endif
                                @if (in_array($contratDetails['codeProduit'], $produitsObsequeValides1))
                                        @if ( ($typePrestation->id == 4 && $NbrencConfirmer <= 13))
                                            {{-- Pour pouvoir demander ce type de prestation <strong>{{$typePrestation->libelle ?? ''}}</strong> sur le contrat <strong>{{$contratDetails['IdProposition'] ?? ''}}</strong>, vous devez effetuer une cotisation au moins 13 mois
                                             --}}
                                             Vous ne pouvez pas demander cette prestation !
                                             {{-- "Pour pouvoir demander cette prestation : <strong>{{$typePrestation->libelle ?? ''}}</strong> sur le contrat <strong>{{$contratDetails['IdProposition'] ?? ''}}</strong>, vous devez avoir effectué une cotisation d'au moins 13 mois." --}}
                                        
                                        @elseif($typePrestation->id == 2 && (float) $contratDetails['DureeCotisationAns'] >= $dureeCotisation)
                                        {{-- "Pour pouvoir demander cette prestation : <strong>{{$typePrestation->libelle ?? ''}}</strong> sur le contrat <strong>{{$contratDetails['IdProposition'] ?? ''}}</strong>, vous devez avoir cotisé pendant au moins <strong>{{$contratDetails['DureeCotisationAns'] ?? ''}}</strong> ans." --}}
                                        Vous ne pouvez pas demander cette prestation !
                                        @endif 
                                @endif
                            @elseif($typePrestation->impact == 1)
                                @if (in_array($contratDetails['codeProduit'], $produitsEpargneValides))
                                    @if ($TotalEncaissement <= $contisationPourcentage && $typePrestation->id == 3)
                                        {{-- "Désolé, le cumul actuel de vos cotisations ne vous permet pas de demander la prestation <strong>{{$typePrestation->libelle ?? ''}}</strong> sur le contrat <strong>{{$contratDetails['IdProposition'] ?? ''}}</strong>." --}}
                                        Vous ne pouvez pas demander cette prestation !
                                    @endif
                                @endif
                            @endif
                        </p>

                    </div>
                </div>
            </div>
            
            @if($typePrestation->impact == 0)
                <div class="modal-footer">
                    <button type="button" class="btn-prime" data-bs-dismiss="modal">Fermer</button>
                    @if(in_array($contratDetails['codeProduit'], $produitsEpargneValides))
                        @if($typePrestation->id == 5 || $NbrencConfirmer >= 24) 
                            <a href="{{ route('customer.prestation.create', $typePrestation->id) }}" class="btn-prime btn-prime-two">
                                Ok, Je Continue
                            </a>
                        @endif
                    @endif
                    @if(in_array($contratDetails['codeProduit'], $produitsObsequeValides1))
                        @if(($typePrestation->id == 4 && $NbrencConfirmer >= 13) || ($typePrestation->id == 2 && (float) $contratDetails['DureeCotisationAns'] <= $dureeCotisation) || ($typePrestation->id == 5)) 
                            <a href="{{ route('customer.prestation.create', $typePrestation->id) }}" class="btn-prime btn-prime-two">
                                Ok, Je Continue
                            </a>
                        @endif 
                    @endif
                    @if(in_array($contratDetails['codeProduit'], $produitsObsequeValides2))
                        <a href="{{ route('customer.prestation.create', $typePrestation->id) }}" class="btn-prime btn-prime-two">
                            Ok, Je Continue
                        </a>
                    @endif
                </div>
            @elseif($typePrestation->impact == 1)
                <div class="modal-footer">
                    <button type="button" class="btn-prime" data-bs-dismiss="modal">Fermer</button>
                    @if(in_array($contratDetails['codeProduit'], $produitsEpargneValides))
                        @if($TotalEncaissement >= $contisationPourcentage || $typePrestation->id != 3)
                            <a href="{{ route('customer.rdv.create', $typePrestation->id) }}" type="button" class="btn-prime btn-prime-two">Ok, Je Continue</a>
                        @endif
                    @endif
                    @if(in_array($contratDetails['codeProduit'], $produitsObsequeValides1) || in_array($contratDetails['codeProduit'], $produitsObsequeValides2))
                        <a href="{{ route('customer.rdv.create', $typePrestation->id) }}" type="button" class="btn-prime btn-prime-two">Ok, Je Continue</a>
                    @endif
                    {{-- @if(in_array($contratDetails['codeProduit'], $produitsObsequeValides2))
                        <a href="{{ route('customer.rdv.create', $typePrestation->id) }}" class="btn-prime btn-prime-two">
                            Ok, Je Continue
                        </a>
                    @endif --}}
                </div>
            @elseif($typePrestation->impact == 'Autre')
                <div class="modal-footer">
                    <button type="button" class="btn-prime" data-bs-dismiss="modal">Fermer</button>
                    <a href="{{ route('customer.prestation.autre', $typePrestation->id) }}" type="button" class="btn-prime btn-prime-two">Ok, Je Continue</a>
                </div>
            @endif
        </div>
    </div>
</div>