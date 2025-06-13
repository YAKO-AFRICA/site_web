@forelse($preSouscriptions as $preSouscription)
<div class="px-lg-1 p-3 rounded my-2 border-bottom pre-souscription-item">
    <a class="text-body-emphasis fw-bold inbox-link fs-9" href="javascript:void(0)" 
    onclick="showPreSouscriptionDetails('{{ $preSouscription->uuid }}', this)">
        <div class="row align-items-sm-center gx-2">
            <div class="col-auto">
                <div class="avatar avatar-s  rounded-circle">
                    <img class="rounded-circle " src="{{ asset('assets/img/images/user-default1.jpg')}}" alt="" />
                </div>
            </div>
            <div class="col-auto">
                {{$preSouscription->customer_lastname}} {{$preSouscription->customer_firstname}}
            </div>
            <div class="col-auto ms-auto">
                <span class="fs-10 fw-bold">{{ $preSouscription->created_at->diffForHumans() ?? 'N/A' }}</span>
            </div>
        </div>
        <div class="ms-4 mt-3 mt-sm-0 ms-sm-11">
            <span class="fs-9 line-clamp-1 text-body-emphasis">{!! nl2br(e(Str::limit($preSouscription->object, 25, "...") ?? "N/A")) !!}</span>
            <p class="fs-9 ps-0 text-body-tertiary mb-0 line-clamp-2">{!! nl2br(e(Str::limit($preSouscription->content, 100, "...") ?? "N/A")) !!}</p>
        </div>
    </a>
</div>
@empty
<div class="border-top border-translucent py-3">
    <div class="row align-items-sm-center gx-2">
        <div class="col-auto"><span class="fas fa-exclamation-triangle fs-12 text-warning"></span></div>
        <div class="col-auto ms-auto">
            <p class="fs-9 text-body-tertiary">Aucun enregistrement trouvé.</p>
        </div>
    </div>
</div>
@endforelse