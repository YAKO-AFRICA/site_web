@extends('admins.layouts.main')
@section('content-admin')
    {{-- formater la date du jour en jour mois, année  --}}
    @php
        $date = date('d M, Y');
    @endphp
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#!">Admin</a></li>
            <li class="breadcrumb-item active">Tableau de bord</li>
        </ol>
    </nav>
    <div class="pb-6">
        <div class="row align-items-center justify-content-between g-3 mb-6">
            <div class="col-12 col-md-auto">
                <h2 class="mb-0">Analytics</h2>
            </div>
            <div class="col-12 col-md-auto">
                <div class="flatpickr-input-container">
                    <input class="form-control ps-6 datetimepicker" id="todaydatepicker" type="text" /><span
                        class="uil uil-calendar-alt flatpickr-icon text-body-tertiary"></span>
                </div>
                {{-- <input class="form-control ps-6 datetimepicker" id="datepicker" type="text" data-options='{"dateFormat":"M j, Y","disableMobile":true,"defaultDate":"Mar 1, 2022"}' /><span class="uil uil-calendar-alt flatpickr-icon text-body-tertiary"></span></div> --}}
            </div>
        </div>
        <div class="px-3 mb-6">
            <div class="row border-top row border-end justify-content-between">
                <div
                    class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end border-bottom pb-4 pb-xxl-0 ">
                    <span class="uil fs-5 lh-1 uil-envelope text-primary"></span>
                    <h1 class="fs-5 pt-3">{{ $totalVisitors }}</h1>
                    <p class="fs-9 mb-0">Visiteurs au total</p>
                </div>
                <div
                    class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end border-bottom pb-4 pb-xxl-0 ">
                    <span class="uil fs-5 lh-1 uil-envelope text-primary"></span>
                    <h1 class="fs-5 pt-3">{{ $today }}</h1>
                    <p class="fs-9 mb-0">Visiteurs aujourdhui</p>
                </div>
                <div
                    class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end-md border-bottom pb-4 pb-xxl-0">
                    <span class="uil fs-5 lh-1 uil-envelope-upload text-info"></span>
                    <h1 class="fs-5 pt-3"> {{ $thisMonth }} </h1>
                    <p class="fs-9 mb-0">Visiteurs ce mois</p>
                </div>
            </div>
            <div class="row border-top row border-end mt-3 justify-content-between">
                <div
                    class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-bottom-xxl-0 border-bottom border-end border-end-md-0 pb-4 pb-xxl-0 pt-4 pt-md-0">
                    <span class="uil fs-5 lh-1 uil-envelopes text-primary"></span>
                    <h1 class="fs-5 pt-3">{{ $newPreSouscription }}</h1>
                    <p class="fs-9 mb-0">Demande(s) de cotation en attente</p>
                </div>
                <div
                    class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-bottom-xxl-0 border-bottom border-end border-end-md-0 pb-4 pb-xxl-0 pt-4 pt-md-0">
                    <span class="uil fs-5 lh-1 uil-envelopes text-primary"></span>
                    <h1 class="fs-5 pt-3">{{ $approuvePreSouscription }}</h1>
                    <p class="fs-9 mb-0">Demande(s) de cotation approuvé</p>
                </div>
                <div
                    class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-bottom-xxl-0 border-bottom border-end border-end-md-0 pb-4 pb-xxl-0 pt-4 pt-md-0">
                    <span class="uil fs-5 lh-1 uil-envelopes text-primary"></span>
                    <h1 class="fs-5 pt-3"> {{ $rejetePreSouscription }} </h1>
                    <p class="fs-9 mb-0">Demande(s) de cotation rejétée</p>
                </div>
            </div>
            <div class="row border-top row border-end mt-3 justify-content-between">
                <div
                    class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-bottom-xxl-0 border-bottom border-end border-end-md-0 pb-4 pb-xxl-0 pt-4 pt-md-0">
                    <span class="uil fs-5 lh-1 uil-envelopes text-primary"></span>
                    <h1 class="fs-5 pt-3"> {{ $newContact }} </h1>
                    <p class="fs-9 mb-0">Message(s) non lu</p>
                </div>
                <div
                    class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-bottom-xxl-0 border-bottom border-end border-end-md-0 pb-4 pb-xxl-0 pt-4 pt-md-0">
                    <span class="uil fs-5 lh-1 uil-envelopes text-primary"></span>
                    <h1 class="fs-5 pt-3">{{ $approuveContact }}</h1>
                    <p class="fs-9 mb-0">Message(s) lu</p>
                </div>
                <div
                    class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-bottom-xxl-0 border-bottom border-end border-end-md-0 pb-4 pb-xxl-0 pt-4 pt-md-0">
                    <span class="uil fs-5 lh-1 uil-envelopes text-primary"></span>
                    <h1 class="fs-5 pt-3"> {{ $rejeteContact }} </h1>
                    <p class="fs-9 mb-0">Message(s) rejété</p>
                </div>
            </div>
        </div>
        {{-- <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-6 pb-3 border-y">
      <div class="row gx-6">
        <div class="col-12 col-md-6 col-lg-12 col-xl-6 mb-5 mb-md-3 mb-lg-5 mb-xl-2 mb-xxl-3">
          <div class="scrollbar">
            <h3>Email Campaign Reports</h3>
            <p class="text-body-tertiary">Paid and Verified for each piece of content</p>
            <div class="echart-email-campaign-report echart-contacts-width"></div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-12 col-xl-6 mb-1 mb-sm-0">
          <div class="row align-itms-center mb-5 mb-sm-2 mb-md-4">
            <div class="col-sm-8 col-md-12 col-lg-8 col-xl-12 col-xxl-8 mb-xl-2 mb-xxl-0">
              <h3> Marketing Campaign Report</h3>
              <p class="text-body-tertiary mb-lg-0">According to the sales data.</p>
            </div>
            <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12 col-xxl-4"><select class="form-select form-select">
                <option>Ally Aagaard</option>
                <option>Alec Haag</option>
                <option>Aagaard</option>
              </select></div>
          </div>
          <div class="row g-3 align-items-center">
            <div class="col-sm-8 col-md-12 col-lg-8 col-xl-12 col-xxl-8">
              <div class="echart-social-marketing-radar" style="min-height:320px; width:100%"></div>
            </div>
            <div class="col-sm-4 col-md-12 col-lg-4 col-xl-12 col-xxl-4 d-flex justify-content-end-xxl mt-0">
              <div class="d-flex flex-1 justify-content-center d-sm-block d-md-flex d-lg-block d-xl-flex d-xxl-block">
                <div class="mb-4 me-6 me-sm-0 me-md-6 me-lg-0 me-xl-6 me-xxl-0">
                  <div class="d-flex align-items-center mb-2">
                    <h4 class="mb-0">15,000</h4><span class="badge badge-phoenix badge-phoenix-primary ms-2">+30.63%</span>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="fa-solid fa-circle text-warning-light me-2"></div>
                    <h6 class="mb-0">Online Campaign</h6>
                  </div>
                </div>
                <div>
                  <div class="d-flex align-items-center mb-2">
                    <h4 class="mb-0">5,000</h4><span class="badge badge-phoenix badge-phoenix-danger ms-2">+13.52%</span>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="fa-solid fa-circle text-primary-light me-2"></div>
                    <h6 class="mb-0">Offline Campaign</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    </div>
    <div class="row">
        <div class="col-12 mb-6">
            <h3 class="mb-3">Evolution des visites journalières des trois dernières semaines</h3>
            {{-- <canvas id="visitesChart" style="height:45vh; width:100%"></canvas> --}}
            <div class="echart-visites-chart" style="min-height:420px; width:100%"></div>
        </div>
    </div>
    <div class="row mb-6">
        <div class="col-12 col-xxl-12 mb-3 mb-sm-0">
            <div class="row">
                <div class="col-sm-7 col-md-8 col-xxl-8 mb-md-3 mb-lg-0">
                    <h3>Nombre de visites par page</h3>
                    {{-- <p class="text-body-tertiary">Payment received across all channels</p> --}}
                    <div class="row g-0"> 
                        <!-- Les cartes seront générées ici -->
                    </div>
                </div>
                <div class="col-sm-5 col-md-4 col-xxl-4 my-3 my-sm-0">
                    <div
                        class="position-relative d-flex flex-center mb-sm-4 mb-xl-0 echart-page-visited-container mt-sm-7 mt-lg-4 mt-xl-0">
                        <div class="echart-page-visited" style="min-height:245px;width:100%"
                            data-chart='@json($chartData)'></div>
                        <div class="position-absolute rounded-circle bg-primary-subtle top-50 start-50 translate-middle d-flex flex-center"
                            style="height:100px; width:100px;">
                            <h3 class="mb-0 text-primary-dark fw-bolder" data-label></h3>
                            <!-- L'élément avec data-label -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-6">
            <h3 class="mb-3">Nombre de consultation des réseaux de distribution du {{ $date }}</h3>
            {{-- <p class="text-body-tertiary mb-1">Nombre de consultation des réseaux de distribution par jour</p> --}}
            {{-- <div class="echart-contacts-created" style="min-height:280px; width:100%"></div> --}}
            <div class="echart-reseaux-consultation" style="min-height:280px; width:100%"></div>
        </div>
        <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-6">

            <h3 class="mb-3">TOP 5 des produits les plus consultés du {{ $date }}</h3>
            {{-- <p class="text-body-tertiary mb-1">Nombre de consultation des réseaux de distribution par jour</p> --}}
            <div class="echart-produits-created" style="min-height:280px; width:100%"></div>
            {{-- <div class="echart-reseaux-consultation" style="min-height:270px; width:100%"></div> --}}
        </div>
    </div>

    <div class="row">
      <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-6">

        <h3 class="mb-3">TOP 5 des formules de produits les plus consultés du {{ $date }}</h3>
        <div class="echart-formules-consultation" style="min-height:280px; width:100%"></div>
      </div>
        <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-6">
            <h3 class="mb-3">Top 5 des actualités les plus consultées du {{ $date }}</h3>
            <div class="echart-actualites-consultation" style="min-height:280px; width:100%"></div>
        </div>
        
    </div>



    <script>
        // Convertir les données pour ECharts
        const datesReseaux = {!! json_encode($visiteReseauxParJour->keys()->toArray()) !!};
        const reseauxData = {!! json_encode($visiteReseauxParJour->toArray()) !!};
        const reseaux = {!! json_encode($reseaux) !!};

        const datesProduits = {!! json_encode($visiteProduitsParJour->keys()->toArray()) !!};
        const produitsData = {!! json_encode($visiteProduitsParJour->toArray()) !!};
        const produits = {!! json_encode($products) !!};

        const datesFormulesProduits = {!! json_encode($visiteFormulesProduitsParJour->keys()->toArray()) !!};
        const formulesProduitsData = {!! json_encode($visiteFormulesProduitsParJour->toArray()) !!};
        const formulesProduits = {!! json_encode($prodFormules) !!};

        const datesActualites = {!! json_encode($visiteActualitesParJour->keys()->toArray()) !!};
        const actualitesData = {!! json_encode($visiteActualitesParJour->toArray()) !!};
        const actualites = {!! json_encode($actualities) !!};

        const labels = {!! json_encode($labels) !!};
        const data = {!! json_encode($data) !!};


        // const chartData = {!! json_encode($chartData) !!};
        // alert(chartData);
        // alert(labels);



        // Palette de couleurs prédéfinie
        const colorPalette = [
            '#3cb371', '#ffa500', '#9370db', '#6a5acd',
            '#ff6347', '#20b2aa', '#778899', '#ff69b4',
            '#dc143c', '#00bfff', '#ff4500', '#32cd32',
            '#adff2f', '#ff1493', '#f0e68c', '#8a2be2',
            '#00fa9a', '#ff6347', '#4682b4', '#d2691e'
        ];
    </script>
    {{-- <style>
  .echart-reseaux-consultation {
    height: 300px;
    width: 100%;
    color: #ffa500;
  }
</style> --}}

    <script>
        // Les données PHP sont passées à JavaScript
        const chartData = @json($chartData);

        // Fonction pour générer dynamiquement les éléments HTML
        function generatePageVisitCards(data) {
            const container = document.querySelector('.row.g-0'); // Cible l'élément contenant les cartes

            data.forEach((item, index) => {
                const cardHTML = `
              <div class="col-6 col-xl-4">
                  <div class="d-flex flex-column flex-center align-items-sm-start flex-md-row justify-content-md-between flex-xxl-column p-3 ps-sm-3 ps-md-4 p-md-3 h-100 border-1 border-bottom border-end border-translucent">
                      <div class="d-flex align-items-center mb-1">
                          <span class="fa-solid fa-square fs-11 me-2 ${getColorClass(index)}" data-fa-transform="up-2"></span>
                          <span class="mb-0 fs-9 text-body">${item.name}</span>
                      </div>
                      <h3 class="fw-semibold ms-xl-3 ms-xxl-0 pe-md-2 pe-xxl-0 mb-0 mb-sm-3">${item.value}</h3>
                  </div>
              </div>
          `;
                container.innerHTML += cardHTML;
            });
        }

        // Fonction pour retourner une couleur en fonction de l'index
        function getColorClass(index) {
            const colorClasses = ['text-primary', 'text-success', 'text-info', 'text-warning', 'text-danger',
                'text-info-light'
            ];
            return colorClasses[index % colorClasses.length]; // Assure une répartition des couleurs
        }

        // Appeler la fonction pour générer les cartes
        generatePageVisitCards(chartData);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('visitesChart').getContext('2d');

            var visitesChart = new Chart(ctx, {
                type: 'line', // Graphique en ligne
                data: {
                    labels: {!! json_encode($labels) !!}, // Jours
                    datasets: [{
                        label: 'Nombre de Visites',
                        data: {!! json_encode($data) !!}, // Visites
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        pointRadius: 4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Jours'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Visites'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        });
        //   document.addEventListener("DOMContentLoaded", function() {
        //     var ctx = document.getElementById('visitesChart').getContext('2d');

        //     var visitesChart = new Chart(ctx, {
        //         type: 'line',
        //         data: {
        //             labels: {!! json_encode($labels) !!}, // Jours
        //             datasets: [{
        //                 label: 'Nombre de Visites',
        //                 data: {!! json_encode($data) !!}, // Visites
        //                 borderColor: 'rgba(75, 192, 192, 1)',
        //                 backgroundColor: 'rgba(75, 192, 192, 0.2)',
        //                 borderWidth: 2,
        //                 fill: true,
        //                 pointRadius: (ctx) => ctx.dataIndex % 7 === 0 ? 4 : 0 // Affiche les points tous les 7 jours
        //             }]
        //         },
        //         options: {
        //             responsive: true,
        //             maintainAspectRatio: false,
        //             scales: {
        //                 x: {
        //                     title: { display: true, text: 'Jours' },
        //                     ticks: {
        //                         callback: function(value, index) {
        //                             return index % 7 === 0 ? this.getLabelForValue(value) : ''; // Affiche une date par semaine
        //                         }
        //                     }
        //                 },
        //                 y: {
        //                     title: { display: true, text: 'Visites' },
        //                     beginAtZero: true
        //                 }
        //             }
        //         }
        //     });
        // });
    </script>
@endsection
