<!doctype html>
<html lang="en">

    <?php include_once "components/head.php"; ?>

    <body>
        <?php include_once "components/navbar.php"; ?>

        <div class="container my-5">

            <div class="page-title">BBK Privatkonto</div>
            <div class="page-description">CH61 0023 3233 2442 5840 R</div>
            <hr class="page-divider">

            <a href="./payment?action=new" class="link">Neue Zahlung</a>
            <a href="./card?id=4" class="link">Transaktionen</a>
            <a href="./payment?action=exchange" class="link">Kontoübertrag</a>

            <div class="card-details-title" style="margin-top: 2rem;">Kontosaldo: &nbsp;<u>CHF 322,80</u></div>
            <div class="profile-title">Transaktionen</div>

            <div class="card bg-darker mt-4">
                <div class="card-body text-gray">
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

                    gesendet. <a href="./tx/10c023b75403403d82cb8" class="transaction-link">Transaktionsdetails anzeigen.</a><br>
                    <i class="far fa-clock" style="width: 1.5%"></i>&nbsp; Transaktion wurde ausgeführt am 29. September 2021 (T-65276556)<br>
                    <i class="far fa-credit-card" style="width: 1.5%"></i>&nbsp; BBK Privatkonto <b>S. </b> CHF 322,80
                </div>
            </div>

            <div class="card bg-darker mt-4">
                <div class="card-body text-gray">
                    <span class="transaction-sender">
                        <i class="fas fa-minus text-danger"  style="width: 1.5%"></i>&nbsp; Sie
                    </span>

                    haben

                    <span class="transaction-amount text-danger">
                        CHF 74,00
                    </span>

                    an 

                    <span class="transaction-receiver">
                        Max Mustermann
                    </span>

                    gesendet. <a href="./tx/10c023b75403403d82cb8" class="transaction-link">Transaktionsdetails anzeigen.</a><br>
                    <i class="far fa-clock" style="width: 1.5%"></i>&nbsp; Transaktion wurde ausgeführt am 29. September 2021 (T-65276556)<br>
                    <i class="far fa-credit-card" style="width: 1.5%"></i>&nbsp; BBK Privatkonto <b>S. </b> CHF 347,80
                </div>
            </div>


        </div>

        <?php include_once "components/scripts.php"; ?>
    </body>

</html>
