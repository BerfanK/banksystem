<?php

/**
 * This page is a dynamic url.
 * Working with paths will be hard, that's 
 * why I don't use any includes. 
 */

 $txId = $_GET["id"];
 $exists = false;

 // TODO: Check if txId exists!

?>

<!doctype html>
<html lang="en">

    <head>

        <!-- Meta -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <meta property="og:title" content="BBK | Bank Berfan Korkmaz" />
        <meta property="og:description" content="Ihre Online-Bank. Ein Projekt von Berfan Korkmaz.">
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://www.google.com/">
        <meta name="msapplication-TitleColor" content="#0000FF">
        <meta name="theme-color" content="#0000FF">

        <!-- Apple -->
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/icons/apple-touch-icon-180x180.png">

        <!-- Browser -->
        <link rel="shortcut icon" type="image/x-icon" href="../assets/icons/favicon-32x32.ico">
        <link rel="icon" type="image/png" sizes="96x96" href="../assets/icons/favicon-96x96.png">

        <!-- Windows Metro -->
        <meta name="msapplication-square310x310logo" content="../assets/icons/mstile-310x310.png">
        <meta name="msapplication-TileColor" content="#0000FF">

        <!-- Links -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/style.css">

        <!-- Title -->
        <title>BBK | Deine Online-Bank! E-Banking war noch nie so einfach </title>


    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark mt-2">
            <div class="container">

                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">

                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="../">Übersicht</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../cards">Karten</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="../transactions">Transaktionen</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../status">Statusmeldungen</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../help">Support</a>
                        </li>

                    </ul>

                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <a class="nav-link"><i class="far fa-bell"></i></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle fs-5"></i>&nbsp; Berfan K.
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="../profile"><i class="fas fa-user fs-6 me-1"></i>&nbsp; Profil</a></li>
                                <li><a class="dropdown-item" href="../profile/create-card"><i class="fas fa-plus fs-6 me-1"></i></i>&nbsp; Karte erstellen</a></li>
                                <li><a class="dropdown-item" href="../profile/settings"><i class="fas fa-cog fs-6 me-1"></i>&nbsp; Einstellungen</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="../logout"><i class="fas fa-power-off fs-6 me-1"></i>&nbsp; Abmelden</a></li>
                            </ul>
                        </li>
                    </ul>


                </div>

            </div>
        </nav>

        <div class="container my-5">

            <div class="page-title">Transaktionszusammenfassung</div>
            <hr class="page-divider">

            <!--
            <div class="page-title text-warning fw-bold fs-5">
                <i class="far fa-minus-square text-danger"></i>&nbsp; Diese Transaktion scheint nicht zu existieren, oder Sie haben keine Rechte es zu sehen.
            </div>
            -->

            <div class="row">

                <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12 mb-5">
                    <img src="https://chart.googleapis.com/chart?chs=350x350&cht=qr&chl=http://localhost/in_progress/banksystem/tx/10c023b75403403d82cb831cdb5622e19f3a3f174638dd7bb95d2d173fa647e9" alt="Transaktion teilen" class="img-fluid">
                </div>

                <div class="col-lg-1 col-xl-1 col-md-12 col-sm-12"></div>

                <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12 text-light">
            
                        <!-- Item -->
                        <div class="row">
                            <div class="col-5">
                                <div class="tx-item">Transaktion</div>
                            </div>
                            <div class="col-7">
                                <div class="tx-value">10c023b75403403d82cb8</div>
                            </div>
                        </div>
                        <hr class="text-light">
                        <!-- End Item -->

                        
                        <!-- Item -->
                        <div class="row">
                            <div class="col-5">
                                <div class="tx-item">Ausführungsdatum</div>
                            </div>
                            <div class="col-7">
                                <div class="tx-value">29. Sept. 2021 • 15:43 UTC</div>
                            </div>
                        </div>
                        <hr class="text-light">
                        <!-- End Item -->

                        <!-- Item -->
                        <div class="row">
                            <div class="col-5">
                                <div class="tx-item">Betrag</div>
                            </div>
                            <div class="col-7">
                                <div class="tx-value text-success">CHF 10 450,50</div>
                            </div>
                        </div>
                        <hr class="text-light">
                        <!-- End Item -->

                        <!-- Item -->
                        <div class="row">
                            <div class="col-5">
                                <div class="tx-item">Absender</div>
                            </div>
                            <div class="col-7">
                                <div class="tx-value">Berfan Korkmaz (K-5735)</div>
                            </div>
                        </div>
                        <hr class="text-light">
                        <!-- End Item -->


                        <!-- Item -->
                        <div class="row">
                            <div class="col-5">
                                <div class="tx-item">Empfänger</div>
                            </div>
                            <div class="col-7">
                                <div class="tx-value">Zalando SE</div>
                            </div>
                        </div>
                        <hr class="text-light">
                        <!-- End Item -->

                        <!-- Item -->
                        <div class="row">
                            <div class="col-5">
                                <div class="tx-item">Verwendungszweck</div>
                            </div>
                            <div class="col-7">
                                <div class="tx-value">Rückzahlung Bestellung #55925</div>
                            </div>
                        </div>
                        <hr class="text-light">
                        <!-- End Item -->


            
                </div>

            </div>
          

        </div>

        <?php include_once "components/scripts.php"; ?>
    </body>

</html>
