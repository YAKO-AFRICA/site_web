@extends('users.espace_client.layouts.main')

@section('content')
    <div class="container">
        <p class="text-center m-5">
            <img src="data:image/svg+xml;base64,{{ $qrcode }}" alt="QR Code">
        </p>
    </div>


    const etape_prestation = array(
    "1" => array("lib_statut" => "Déclaration", "libelle" => "saisie du courrier", "statut_traitement" => "1",
    "color_statut" => self::color_NOUVEAU, "color" => "gray"),
    "2" => array("lib_statut" => "Traitement", "libelle" => "traitement par les gestionnaires", "statut_traitement" => "2",
    "color_statut" => self::color_SUCCESS, "color" => "#033f1f"),
    "3" => array("lib_statut" => "Soumission", "libelle" => "soumission par responsable", "statut_traitement" => "3",
    "color_statut" => self::color_REJETE, "color" => "#F9B233"),
    "4" => array("lib_statut" => "Règlement", "libelle" => "mise en place ordre de paiement", "statut_traitement" => "4",
    "color_statut" => self::color_REJETE, "color" => "blue"),
    "5" => array("lib_statut" => "Remise", "libelle" => "paiement effectif", "statut_traitement" => "5", "color_statut" =>
    self::color_REJETE, "color" => "#033f1f"),
    "6" => array("lib_statut" => "Archivage", "libelle" => "archivage du dossier de prestation", "statut_traitement" => "6",
    "color_statut" => self::color_REJETE, "color" => "black"),
    );

    <div class="card-body">

        <h4 class="text-center p-2" style="color:#033f1f ; font-weight:bold;"> Détails prestation du contrat n°
            <?= $detailsClient->IdProposition ?> </h4>
        <hr>
        <table class="table hover data-table-export nowrap" id="example" style="font-size: small;">

            <thead style="background-color:gray;color:white">
                <tr>
                    <th id="pID" class="">#</th>
                    <th>Libelle</th>
                    <th>Detail Reception</th>
                    <th>Detail courrier</th>
                    <th class="table-plus datatable-nosort">Etat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                                    for ($c = 0; $c <= count($retourCourrierPrestation) - 1; $c++) {
                                                        $detailCourrier = $retourCourrierPrestation[$c];
                                                        $tabloEtat = Config::etape_prestation[$detailCourrier->Etat];
                                                    ?>

                <tr>
                    <td scope="row" id="col-<?= $c ?>"><?php echo $c + 1; ?></td>
                    <td>
                        <p class="mb-0 text-dark" style="font-size: 0.7em;">
                            <span style="font-weight:bold;"><?php echo $detailCourrier->MonLibelle; ?></span>
                        </p>
                        <p class="mb-0 text-dark" style="font-size: 0.7em;">
                            Expediteur :<span style="font-weight:bold;"><?php echo $detailCourrier->Expediteur; ?></span>
                        </p>
                    </td>

                    <td>
                        <p class="mb-0 text-dark" style="font-size: 0.7em;">
                            Date Reception :<span style="font-weight:bold;"><?php echo $detailCourrier->DateReception; ?></span>
                        </p>

                        <p class="mb-0 text-dark" style="font-size: 0.7em;">
                            Saisie Le :<span style="font-weight:bold;"><?php echo $detailCourrier->SaisieLe; ?></span>
                        </p>
                        <p class="mb-0 text-dark" style="font-size: 0.7em;">
                            Saisie Par :<span style="font-weight:bold;"><?php echo $detailCourrier->SaisiePar; ?></span>
                        </p>

                    </td>
                    <td>

                        <p class="mb-0 text-dark" style="font-size: 0.7em;">
                            Id contrat :<span style="font-weight:bold;"><?php echo $detailCourrier->IdProposition; ?></span>
                        </p>
                        <p class="mb-0 text-dark" style="font-size: 0.7em;">
                            Code Courrier :<span style="font-weight:bold;"><?php echo $detailCourrier->CodeCourrier; ?></span>
                        </p>
                        <p class="mb-0 text-dark" style="font-size: 0.7em;">
                            Traite Le :<span style="font-weight:bold;"><?php echo $detailCourrier->ModifieLe; ?></span>
                        </p>
                        <p class="mb-0 text-dark" style="font-size: 0.7em;">
                            Traite Par :<span style="font-weight:bold;"><?php echo $detailCourrier->ModifiePar; ?></span>
                        </p>
                        <p class="mb-0 text-dark" style="font-size: 0.7em;">Observation
                            :<span style="font-weight:bold;"><?php echo $detailCourrier->Observation; ?></span>
                        </p>

                    </td>
                    <td style="font-size:13px;font-weight:bold"><span class="badge rounded-pill w-100"
                            style="background-color:<?= $tabloEtat['color'] ?>; color:white ; font-size:8px;"><?= $tabloEtat['lib_statut'] ?></span>
                    </td>

                </tr>
                <?php
                                                    }
                                                    ?>
            </tbody>
        </table>
    </div>
@endsection
