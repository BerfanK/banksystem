<!doctype html>
<html lang="en">

    <?php include_once "components/head.php"; ?>

    <body>
        <?php include_once "components/navbar.php"; ?>

        <div class="container my-5">

            <div class="page-title">Ihre Karten</div>
            <div class="page-description">Hier können Sie Ihre Karten verwalten.</div>
            <hr class="page-divider">

            <?php 

            $totalAmount = get_amount($_SESSION["customer_id"], "Giro") + get_amount($_SESSION["customer_id"], "Spar") + get_amount($_SESSION["customer_id"], "Prepaid");
            if ($totalAmount == 0) {
                echo  
                '
                <div class="page-title text-warning fw-bold fs-5">
                    <i class="far fa-minus-square text-danger"></i>&nbsp; Es scheint als hätten Sie noch keine Bankkarten.
                </div>
                ';
            }

            ?>
            

            <div class="row mt-5">

                

            </div>
          

        </div>

        <?php include_once "components/scripts.php"; ?>
    </body>

</html>
