@extends('admins.layouts.main')
@section('content-admin')
  <div class="email-container">
      <div class="row g-lg-6 mb-8">
        
        {{-- <div class="col-3 d-none d-xxl-block">
          <div class="email-content scrollbar">
            <div class="px-lg-1">
              <div class="d-flex align-items-center flex-wrap position-sticky pb-2 bg-body z-2 email-toolbar">
                <div class="d-flex align-items-center flex-1 me-2"><button class="btn btn-sm p-0 me-2" type="button" onclick="location.reload()"><span class="text-primary fas fa-redo fs-10"></span></button>
                  <p class="fw-semibold fs-10 text-body-tertiary text-opacity-85 mb-0 lh-sm text-nowrap">Last refreshed 1m ago</p>
                </div>
                <div class="d-flex">
                  <p class="text-body-tertiary text-opacity-85 fs-9 fw-semibold mb-0 me-3"> <span class="text-body">1-7 </span>of <span class="text-body">205</span></p><button class="btn p-0 me-3" type="button"><span class="text-body-quaternary fa-solid fa-angle-left fs-10"></span></button><button class="btn p-0" type="button"><span class="text-primary fa-solid fa-angle-right fs-10"></span></button>
                </div>
              </div>
              <div class="border-top border-translucent py-2 d-flex justify-content-between">
                <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row="data-bulk-select-row" /></div>
                <div><button class="btn p-0 me-2 text-body-quaternary hover text-body-tertiary text-opacity-85" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Archive"><span class="fas fa-archive fs-10"></span></button><button class="btn p-0 me-2 text-body-quaternary hover text-body-tertiary text-opacity-85" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><span class="fas fa-trash fs-10"></span></button><button class="btn p-0 me-2 text-body-quaternary hover text-body-tertiary text-opacity-85" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Star"><span class="fas fa-star fs-10"></span></button><button class="btn p-0 text-body-quaternary hover text-body-tertiary text-opacity-85" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tags"><span class="fas fa-tag fs-10"></span></button></div>
              </div>
              <div class="border-top border-translucent hover-actions-trigger py-3">
                <div class="row align-items-sm-center gx-2">
                  <div class="col-auto">
                    <div class="d-flex flex-column flex-sm-row"><input class="form-check-input mb-2 m-sm-0 me-sm-2" type="checkbox" id="checkbox-1" data-bulk-select-row="data-bulk-select-row" /><button class="btn p-0"><span class="fas text-warning fa-star"></span></button></div>
                  </div>
                  <div class="col-auto">
                    <div class="avatar avatar-s  rounded-circle">
                      <img class="rounded-circle " src="../../assets/img/team/60.webp" alt="" />
                    </div>
                  </div>
                  <div class="col-auto"><a class="text-body-emphasis fw-bold inbox-link fs-9" href="email-detail.html">Jessica Ball</a></div>
                  <div class="col-auto ms-auto">
                    <div class="hover-actions end-0"><button class="btn btn-phoenix-secondary btn-icon dropdown-toggle dropdown-caret-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-ellipsis"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Mark Unread</a><a class="dropdown-item" href="#!">Mark Important</a><a class="dropdown-item" href="#!">Archive</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Print</a><a class="dropdown-item" href="#!">Report Spam</a><a class="dropdown-item" href="#!">Report Phishing</a><a class="dropdown-item" href="#!">Mute Jessica Ball</a><a class="dropdown-item" href="#!">Block Jessica Ball</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                    </div><span class="fs-10 fw-bold">1 M</span>
                  </div>
                </div>
                <div class="ms-4 mt-n3 mt-sm-0 ms-sm-11"><a class="d-block inbox-link" href="email-detail.html"><span class="fs-9 line-clamp-1 text-body-emphasis">Query about purchased soccer socks</span>
                    <p class="fs-9 ps-0 text-body-tertiary mb-0 line-clamp-2">Greetings. I have purchased some socks under the bundle offer you availed this week. According to the offer I was thrilled to get a 25% off of any product I bought. Regardless, I had to pay the exact full price for them...</p>
                  </a></div>
              </div>
              <div class="border-top border-translucent hover-actions-trigger py-3">
                <div class="row align-items-sm-center gx-2">
                  <div class="col-auto">
                    <div class="d-flex flex-column flex-sm-row"><input class="form-check-input mb-2 m-sm-0 me-sm-2" type="checkbox" id="checkbox-2" data-bulk-select-row="data-bulk-select-row" /><button class="btn p-0"><span class="far text-body-quaternary fa-star"></span></button></div>
                  </div>
                  <div class="col-auto">
                    <div class="avatar avatar-s  rounded-circle">
                      <img class="rounded-circle " src="../../assets/img/team/58.webp" alt="" />
                    </div>
                  </div>
                  <div class="col-auto"><a class="text-body-emphasis fw-bold inbox-link fs-9" href="email-detail.html">Danny Reid</a></div>
                  <div class="col-auto ms-auto">
                    <div class="hover-actions end-0"><button class="btn btn-phoenix-secondary btn-icon dropdown-toggle dropdown-caret-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-ellipsis"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Mark Unread</a><a class="dropdown-item" href="#!">Mark Important</a><a class="dropdown-item" href="#!">Archive</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Print</a><a class="dropdown-item" href="#!">Report Spam</a><a class="dropdown-item" href="#!">Report Phishing</a><a class="dropdown-item" href="#!">Mute Jessica Ball</a><a class="dropdown-item" href="#!">Block Jessica Ball</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                    </div><span class="fs-10 fw-bold">3 M</span>
                  </div>
                </div>
                <div class="ms-4 mt-n3 mt-sm-0 ms-sm-11"><a class="d-block inbox-link" href="email-detail.html"><span class="fs-9 line-clamp-1 text-body-emphasis">How to take the headache out of Order</span>
                    <p class="fs-9 ps-0 text-body-tertiary mb-0 line-clamp-2">Hello! As I've mentioned before, we have this huge order deals to ship within this month. Also, the financial report is attached to this email. Hopefully, you'll find it useful for the company.</p>
                  </a><a class="d-inline-flex align-items-center border border-translucent rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="#!"><span class="fas fa-file-pdf text-warning fs-9"></span><span class="ms-2 fw-bold fs-10 text-body">Financial_Reports.pdf</span></a><a class="d-inline-flex align-items-center border border-translucent rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="#!"><span class="fas fa-file-zipper text-warning fs-9"></span><span class="ms-2 fw-bold fs-10 text-body">Frame20.zip</span></a></div>
              </div>
              <div class="border-top border-translucent hover-actions-trigger py-3">
                <div class="row align-items-sm-center gx-2">
                  <div class="col-auto">
                    <div class="d-flex flex-column flex-sm-row"><input class="form-check-input mb-2 m-sm-0 me-sm-2" type="checkbox" id="checkbox-3" data-bulk-select-row="data-bulk-select-row" /><button class="btn p-0"><span class="fas text-warning fa-star"></span></button></div>
                  </div>
                  <div class="col-auto">
                    <div class="avatar avatar-s  rounded-circle">
                      <img class="rounded-circle " src="../../assets/img/team/57.webp" alt="" />
                    </div>
                  </div>
                  <div class="col-auto"><a class="text-body fw-semibold inbox-link fs-9" href="email-detail.html">Harley Brown</a></div>
                  <div class="col-auto ms-auto">
                    <div class="hover-actions end-0"><button class="btn btn-phoenix-secondary btn-icon dropdown-toggle dropdown-caret-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-ellipsis"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Mark Unread</a><a class="dropdown-item" href="#!">Mark Important</a><a class="dropdown-item" href="#!">Archive</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Print</a><a class="dropdown-item" href="#!">Report Spam</a><a class="dropdown-item" href="#!">Report Phishing</a><a class="dropdown-item" href="#!">Mute Jessica Ball</a><a class="dropdown-item" href="#!">Block Jessica Ball</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                    </div><span class="fs-10">5 M</span>
                  </div>
                </div>
                <div class="ms-4 mt-n3 mt-sm-0 ms-sm-11"><a class="d-block inbox-link" href="email-detail.html"><span class="fs-9 line-clamp-1 text-body-highlight">The Arnold Schwarzenegger of Order</span>
                    <p class="fs-9 ps-0 text-body-tertiary mb-0 line-clamp-2">I’ve come across your posts and found some favorable deals on your page. I’ve added a load of products to the cart and I don’t know the payment options you avail. Also, can you enlighten me about any discount or...</p>
                  </a></div>
              </div>
              <div class="border-top border-translucent hover-actions-trigger py-3">
                <div class="row align-items-sm-center gx-2">
                  <div class="col-auto">
                    <div class="d-flex flex-column flex-sm-row"><input class="form-check-input mb-2 m-sm-0 me-sm-2" type="checkbox" id="checkbox-4" data-bulk-select-row="data-bulk-select-row" /><button class="btn p-0"><span class="far text-body-quaternary fa-star"></span></button></div>
                  </div>
                  <div class="col-auto">
                    <div class="avatar avatar-s  rounded-circle">
                      <img class="rounded-circle " src="../../assets/img/team/59.webp" alt="" />
                    </div>
                  </div>
                  <div class="col-auto"><a class="text-body-emphasis fw-bold inbox-link fs-9" href="email-detail.html">Hollie Stephens</a></div>
                  <div class="col-auto ms-auto">
                    <div class="hover-actions end-0"><button class="btn btn-phoenix-secondary btn-icon dropdown-toggle dropdown-caret-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-ellipsis"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Mark Unread</a><a class="dropdown-item" href="#!">Mark Important</a><a class="dropdown-item" href="#!">Archive</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Print</a><a class="dropdown-item" href="#!">Report Spam</a><a class="dropdown-item" href="#!">Report Phishing</a><a class="dropdown-item" href="#!">Mute Jessica Ball</a><a class="dropdown-item" href="#!">Block Jessica Ball</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                    </div><span class="fs-10 fw-bold">8 M</span>
                  </div>
                </div>
                <div class="ms-4 mt-n3 mt-sm-0 ms-sm-11"><a class="d-block inbox-link" href="email-detail.html"><span class="fs-9 line-clamp-1 text-body-emphasis">My order is not being taken</span>
                    <p class="fs-9 ps-0 text-body-tertiary mb-0 line-clamp-2">Hello. I’m knocking to let you know that I am trying to place some orders on your site. But my orders are not being taken, maybe it’s technical issues. Can you help me with it as I really need the products I am trying to...</p>
                  </a></div>
              </div>
              <div class="border-top border-translucent hover-actions-trigger py-3">
                <div class="row align-items-sm-center gx-2">
                  <div class="col-auto">
                    <div class="d-flex flex-column flex-sm-row"><input class="form-check-input mb-2 m-sm-0 me-sm-2" type="checkbox" id="checkbox-5" data-bulk-select-row="data-bulk-select-row" /><button class="btn p-0"><span class="fas text-warning fa-star"></span></button></div>
                  </div>
                  <div class="col-auto">
                    <div class="avatar avatar-s  rounded-circle">
                      <img class="rounded-circle avatar-placeholder" src="../../assets/img/team/avatar.webp" alt="" />
                    </div>
                  </div>
                  <div class="col-auto"><a class="text-body fw-semibold inbox-link fs-9" href="email-detail.html">Natasha West</a></div>
                  <div class="col-auto ms-auto">
                    <div class="hover-actions end-0"><button class="btn btn-phoenix-secondary btn-icon dropdown-toggle dropdown-caret-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-ellipsis"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Mark Unread</a><a class="dropdown-item" href="#!">Mark Important</a><a class="dropdown-item" href="#!">Archive</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Print</a><a class="dropdown-item" href="#!">Report Spam</a><a class="dropdown-item" href="#!">Report Phishing</a><a class="dropdown-item" href="#!">Mute Jessica Ball</a><a class="dropdown-item" href="#!">Block Jessica Ball</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                    </div><span class="fs-10">20 M</span>
                  </div>
                </div>
                <div class="ms-4 mt-n3 mt-sm-0 ms-sm-11"><a class="d-block inbox-link" href="email-detail.html"><span class="fs-9 line-clamp-1 text-body-highlight">Shipment is missing</span>
                    <p class="fs-9 ps-0 text-body-tertiary mb-0 line-clamp-2">Greetings! I’ve got an email saying I was to get the products yesterday. But got a call instead saying the shipment was misplaced. Can you put some light on it? Really need the products.</p>
                  </a></div>
              </div>
              <div class="border-top border-translucent hover-actions-trigger py-3">
                <div class="row align-items-sm-center gx-2">
                  <div class="col-auto">
                    <div class="d-flex flex-column flex-sm-row"><input class="form-check-input mb-2 m-sm-0 me-sm-2" type="checkbox" id="checkbox-6" data-bulk-select-row="data-bulk-select-row" /><button class="btn p-0"><span class="fas text-warning fa-star"></span></button></div>
                  </div>
                  <div class="col-auto">
                    <div class="avatar avatar-s ">
                      <div class="avatar-name rounded-circle"><span>R</span></div>
                    </div>
                  </div>
                  <div class="col-auto"><a class="text-body fw-semibold inbox-link fs-9" href="email-detail.html">Max Williamson</a></div>
                  <div class="col-auto ms-auto">
                    <div class="hover-actions end-0"><button class="btn btn-phoenix-secondary btn-icon dropdown-toggle dropdown-caret-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-ellipsis"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Mark Unread</a><a class="dropdown-item" href="#!">Mark Important</a><a class="dropdown-item" href="#!">Archive</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Print</a><a class="dropdown-item" href="#!">Report Spam</a><a class="dropdown-item" href="#!">Report Phishing</a><a class="dropdown-item" href="#!">Mute Jessica Ball</a><a class="dropdown-item" href="#!">Block Jessica Ball</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                    </div><span class="fs-10">30 M</span>
                  </div>
                </div>
                <div class="ms-4 mt-n3 mt-sm-0 ms-sm-11"><a class="d-block inbox-link" href="email-detail.html"><span class="fs-9 line-clamp-1 text-body-highlight">How can I order something urgently?</span>
                    <p class="fs-9 ps-0 text-body-tertiary mb-0 line-clamp-2">I saw your promotion on 25% sales. Do you avail emergency orders and urgent shipments? If you do, I need to place some orders. Please reply, thanks.</p>
                  </a><a class="d-inline-flex align-items-center border border-translucent rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="#!"><span class="fa-solid fa-music text-primary fs-9"></span><span class="ms-2 fw-bold fs-10 text-body">syllabus</span></a></div>
              </div>
              <div class="border-top border-translucent hover-actions-trigger pt-3">
                <div class="row align-items-sm-center gx-2">
                  <div class="col-auto">
                    <div class="d-flex flex-column flex-sm-row"><input class="form-check-input mb-2 m-sm-0 me-sm-2" type="checkbox" id="checkbox-7" data-bulk-select-row="data-bulk-select-row" /><button class="btn p-0"><span class="far text-body-quaternary fa-star"></span></button></div>
                  </div>
                  <div class="col-auto">
                    <div class="avatar avatar-s  rounded-circle">
                      <img class="rounded-circle " src="../../assets/img/team/30.webp" alt="" />
                    </div>
                  </div>
                  <div class="col-auto"><a class="text-body fw-semibold inbox-link fs-9" href="email-detail.html">Ethan Hawkins</a></div>
                  <div class="col-auto ms-auto">
                    <div class="hover-actions end-0"><button class="btn btn-phoenix-secondary btn-icon dropdown-toggle dropdown-caret-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-ellipsis"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Mark Unread</a><a class="dropdown-item" href="#!">Mark Important</a><a class="dropdown-item" href="#!">Archive</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Print</a><a class="dropdown-item" href="#!">Report Spam</a><a class="dropdown-item" href="#!">Report Phishing</a><a class="dropdown-item" href="#!">Mute Jessica Ball</a><a class="dropdown-item" href="#!">Block Jessica Ball</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                    </div><span class="fs-10">32 M</span>
                  </div>
                </div>
                <div class="ms-4 mt-n3 mt-sm-0 ms-sm-11"><a class="d-block inbox-link" href="email-detail.html"><span class="fs-9 line-clamp-1 text-body-highlight">How the delicacy of the products will be handled??</span>
                    <p class="fs-9 ps-0 text-body-tertiary mb-0 line-clamp-2">Hello! I need to purchase some delicate products. Can you tell me how you handle the delicacy of the products to be shipped? I don’t want to get my hands on broken things, so. Thank you! </p>
                  </a></div>
              </div>
            </div>
          </div>
        </div> --}}
        <div class="col">
          <div class="card email-content">
            <div class="card-body overflow-hidden">
              <div class="d-flex flex-between-center pb-3 border-bottom border-translucent mb-4"><a class=" btn-link p-0 text-body-secondary me-3" href="{{ route('admin.subscription') }}"><span class="fa-solid fa-angle-left fw-bolder fs-8"></span></a>
                <h3 class="flex-1 mb-0 lh-sm line-clamp-1">{{$souscription->object}}</h3>
                <div class="btn-reveal-trigger">
                  @if($souscription->type == 'Pré-souscription')
                      <a class="d-inline-flex align-items-center border border-translucent rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="#!">
                          {{-- <span class="fas fa-file-pdf text-warning fs-9"></span> --}}
                          <span class="ms-2 fw-bold fs-10 text-body">{{$souscription->formul_product->label ?? 'N/A'}}</span>
                      </a>
                  @endif

                  {{-- <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none d-flex btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>
                  <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Report abuse</a></div> --}}
                </div>
              </div>
              <div class="overflow-x-hidden scrollbar email-detail-content">
                <div class="row align-items-center gy-3 gx-0 mb-10">
                  <div class="col-12 col-sm-auto d-flex order-sm-1">
                      <a class="p-0 me-4 me-lg-3 me-xl-4" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Reply">
                          <span class="fa-solid fa-reply text-body-quaternary"></span>
                      </a>
                      <a class="p-0 me-4 me-lg-3 me-xl-4" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Remove">
                          <span class="fa-solid fa-trash-can text-body-quaternary"></span>
                      </a>
                      <a class="p-0 me-4 me-lg-3 me-xl-4" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Archive">
                          <span class="fa-solid fa-archive text-body-quaternary"></span>
                      </a><a class="p-0 me-4 me-lg-3 me-xl-4" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Print">
                          <span class="fa-solid fa-print text-body-quaternary"></span>
                      </a>
                      <a class="p-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Star">
                          <span class="fa-regular fa-star text-body-quaternary"></span>
                      </a>
                  </div>
                  <div class="col-auto">
                      <img class="me-2 rounded-circle" src="../../assets/img/team/60.webp" alt="..." width="48" height="48" />
                  </div>
                  <div class="col-auto flex-1">
                    <div class="d-flex mb-1">
                      <h5 class="mb-0 text-body-highlight me-2">{{$souscription->customer_lastname}} {{$souscription->customer_firstname}}</h5>
                      <p class="mb-0 lh-sm text-body-tertiary fs-9 d-none d-md-block text-nowrap">&#60; {{$souscription->customer_email}} | Tel: {{$souscription->customer_phone}} | WhatsApp: {{$souscription->customer_whatsapp}} &#62;</p>
                    </div>
                    <p class="mb-0 fs-9">
                      <span class="text-body-tertiary">à</span>
                      <span class="fw-bold text-body-secondary"> Moi </span>
                      <span class="text-body-highlight fw-semibold fs-10">{{ $souscription->created_at->format('d/m/Y H:i:s') ?? 'N/A' }} </span>
                  </p>
                  </div>
                </div>
                <div class="text-body-highlight fs-9 w-100 w-md-75 mb-8">
                  <p>{!! nl2br(e($souscription->content ?? "N/A")) !!}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection