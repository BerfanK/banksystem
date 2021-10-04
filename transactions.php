<!doctype html>
<html lang="en">

    <?php include_once "components/head.php"; ?>

    <body>
        <?php include_once "components/navbar.php"; ?>

        <div class="container my-5">

            <div class="page-title">Ihre Transaktionen</div>
            <div class="page-description">Hier haben Sie einen Einblick auf Bewegungen.</div>
            <hr class="page-divider">

            <div class="embed-info">
                <div class="embed-text">💡&nbsp; Klicken Sie auf eine Transaktion für <u>mehr</u> Details!</div>
            </div>


            <div class="transaction-header">1. September - 30. September 2021</div>

            <div class="card mb-5">
                <div class="card-body">
                    <span class="transaction-sender">
                        <i class="fas fa-minus text-danger"  style="width: 1.5%"></i>&nbsp; Sie
                    </span>

                    haben

                    <span class="transaction-amount text-danger">
                        CHF 25,00
                    </span>

                    an 

                    <span class="transaction-receiver">
                        Max Mustermann
                    </span>

                    gesendet. <a href="./tx/10c023b75403403d82cb8" class="transaction-link">Transaktionsdetails anzeigen.</a>
                </div>
                <div class="card-footer border-0" style="background-color: inherit">
                    <i class="far fa-clock" style="width: 1.5%"></i>&nbsp; Transaktion wurde ausgeführt am 29. September 2021 (T-65276556)
                </div>
            </div>

            <div class="card mb-5">
                <div class="card-body">
                    <span class="transaction-sender">
                        <i class="fas fa-plus text-success"  style="width: 1.5%"></i>&nbsp; Sie
                    </span>

                    haben 

                    <span class="transaction-amount text-success">
                        CHF 50,00
                    </span>

                    von 

                    <span class="transaction-receiver">
                        Max Mustermann
                    </span>

                    erhalten. <a href="" class="transaction-link">Transaktionsdetails anzeigen.</a>
                </div>
                <div class="card-footer border-0" style="background-color: inherit">
                    <i class="far fa-clock" style="width: 1.5%"></i>&nbsp; Transaktion wurde ausgeführt am 25. September 2021 (T-55276556)
                </div>
            </div>


        </div>

        <?php include_once "components/scripts.php"; ?>
    </body>

</html>
