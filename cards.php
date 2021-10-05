<!doctype html>
<html lang="en">

    <?php include_once "components/head.php"; ?>

    <body>
        <?php include_once "components/navbar.php"; ?>

        <div class="container my-5">

            <div class="page-title">Ihre Karten</div>
            <div class="page-description">Hier können Sie Ihre Karten verwalten.</div>
            <hr class="page-divider">


            <!--
            <div class="page-title text-warning fw-bold fs-5">
                <i class="far fa-minus-square text-danger"></i>&nbsp; Es scheint als hätten Sie noch keine Bankkarten.
            </div>
            -->
            

            <div class="row mt-5">

                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-4">

                    <div class="card text-light bg-darker">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-1 text-start">
                                    <br>
                                    <span class="card-icon"><i class="fas fa-piggy-bank fs-2"></i></span>
                                    <br>
                                </div>

                                <div class="col-5 text-start">
                                    <div class="card-description">Berfan Korkmaz</div>
                                    <div class="card-name">BBK Sparkonto</div>
                                    <div class="card-description">CH81 0023 3233 2442 58M1 Z</div>
                                </div>

                                <div class="col-5 text-end">
                                    <br>
                                    <span class="card-balance">CHF 2 583,55</span>
                                </div>

                                <div class="col-1 text-end">
                                    <br>
                                    <div class="dropdown">
                                        <a href="" class="card-icon" style="color: inherit;" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v fs-2"></i></a>
                                        <div class="dropdown-menu card-dropdown">
                                            <a href="./card?id=4" class="dropdown-item">Transaktionen</a>
                                            <a href="./payment?action=exchange" class="dropdown-item">Kontoübertrag</a>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-4">

                    <div class="card text-light bg-darker">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-1 text-start">
                                    <br>
                                    <span class="card-icon"><i class="fas fa-coins fs-2"></i></span>
                                    <br>
                                </div>

                                <div class="col-5 text-start">
                                    <div class="card-description">Berfan Korkmaz</div>
                                    <div class="card-name">BBK Privatkonto</div>
                                    <div class="card-description">CH61 0023 3233 2442 5840 R</div>
                                </div>

                                <div class="col-5 text-end">
                                    <br>
                                    <span class="card-balance">CHF 322,80</span>
                                </div>

                                <div class="col-1 text-end">
                                    <br>
                                    <div class="dropdown">
                                        <a href="" class="card-icon" style="color: inherit;" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v fs-2"></i></a>
                                        <div class="dropdown-menu card-dropdown">
                                            <a href="./payment?action=new" class="dropdown-item">Neue Zahlung</a>
                                            <a href="./card?id=4" class="dropdown-item">Transaktionen</a>
                                            <a href="./payment?action=exchange" class="dropdown-item">Kontoübertrag</a>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-4">

                    <div class="card text-light bg-darker">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-1 text-start">
                                    <br>
                                    <span class="card-icon"><i class="fab fa-cc-visa fs-2"></i></span>
                                    <br>
                                </div>

                                <div class="col-5 text-start">
                                    <div class="card-description">Berfan Korkmaz</div>
                                    <div class="card-name">BBK Prepaidkonto</div>
                                    <div class="card-description">3952 9492 0964 7955</div>
                                </div>

                                <div class="col-5 text-end">
                                    <br>
                                    <span class="card-balance text-danger">CHF -122,25</span>
                                </div>

                                <div class="col-1 text-end">
                                    <br>
                                    <div class="dropdown">
                                        <a href="" class="card-icon" style="color: inherit;" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v fs-2"></i></a>
                                        <div class="dropdown-menu card-dropdown">
                                            <a href="./payment?action=new" class="dropdown-item">Neue Zahlung</a>
                                            <a href="./card?id=4" class="dropdown-item">Transaktionen</a>
                                            <a href="./payment?action=exchange" class="dropdown-item">Kontoübertrag</a>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
          

        </div>

        <?php include_once "components/scripts.php"; ?>
    </body>

</html>
