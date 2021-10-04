<!doctype html>
<html lang="en">

    <?php include_once "components/head.php"; ?>

    <body>
        <?php include_once "components/navbar.php"; ?>

        <div class="container my-5">

            <div class="page-title">BBK Status</div>
            <div class="page-description">Ist ein Service down? Hier erfahren Sie es.</div>
            <hr class="page-divider">

            <div class="status text-success">Es gibt keine schwerwiegende Ausfälle.</div>

            <div class="row mb-5">

                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                    <div class="status-item"><i class="far fa-check-square text-success"></i>&nbsp; BBK Store</div>
                    <div class="status-item"><i class="far fa-check-square text-success"></i>&nbsp; BBK Login</div>
                    <div class="status-item"><i class="far fa-check-square text-success"></i>&nbsp; BBK Register</div>
                    <div class="status-item"><i class="far fa-check-square text-success"></i>&nbsp; BBK Development</div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                    <div class="status-item"><i class="far fa-check-square text-success"></i>&nbsp; BBK Mobile</div>
                    <div class="status-item"><i class="far fa-check-square text-success"></i>&nbsp; BBK KeyClub</div>
                    <div class="status-item"><i class="far fa-minus-square text-danger"></i>&nbsp; BBK Transaktionen</div>
                    <div class="status-item"><i class="far fa-minus-square text-danger"></i>&nbsp; BBK Zahlungsverkehr</div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                    <div class="status-item"><i class="far fa-check-square text-success"></i>&nbsp; BBK Support</div>
                    <div class="status-item"><i class="far fa-check-square text-success"></i>&nbsp; BBK Cards</div>
                    <div class="status-item"><i class="far fa-check-square text-success"></i>&nbsp; BBK Authentication</div>
                    <div class="status-item"><i class="far fa-check-square text-success"></i>&nbsp; BBK Notifications</div>
                </div>

            </div>

            <div class="status-title">Vergangene Fälle</div>
            
            <div class="mb-5">
                <div class="status-date">3 Oktober 2021</div>
                <hr style="color: white;">
                <div class="status-incident">Keine Meldungen an diesem Tag.</div>
            </div>

            <div class="mb-5">
                <div class="status-date">2 Oktober 2021</div>
                <hr style="color: white;">
                <div class="status-incident">Keine Meldungen an diesem Tag.</div>
            </div>

            <div class="mb-5">
                <div class="status-date">1 Oktober 2021</div>
                <hr style="color: white;">
                <div class="status-incident text-danger fs-5 fw-bold">Probleme mit dem Zahlungsverkehr</div>

                <div class="mt-4">
                    <div class="text-light"><b>Behoben</b> - Dieses Problem wurde behoben.</div>
                    <div class="status-incident-date">1 Okt. 19:42 Uhr</div>
                </div>

                <div class="mt-4">
                    <div class="text-light"><b>In Untersuchung</b> - Wir untersuchen dieses Problem.</div>
                    <div class="status-incident-date">1 Okt. 19:30 Uhr</div>
                </div>

            </div>


        </div>

        <?php include_once "components/scripts.php"; ?>
    </body>

</html>
