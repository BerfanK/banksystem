<!doctype html>
<html lang="en">

    <?php include_once "components/head.php"; ?>

    <body>
        <?php include_once "components/navbar.php"; ?>

        <div class="container my-5">

            <div class="page-title">Konto eröffnen</div>
            <div class="page-description">Hier können Sie ein Konto eröffnen.</div>
            <hr class="page-divider">

            <?php

            if (isset($_POST["submit"]) && isset($_POST["konto"])) {
                create_card($_SESSION["customer_id"], $_POST["konto"]);
            }


            ?>

            <div class="profile-title">Formular ausfüllen</div>

            <form action="" autocomplete="off" class="my-5 needs-validation" method="post" novalidate>

                <div class="row">

                    <!-- Col -->
                    <div class="col-12 w-50 mb-4">

                        <label for="konto" class="new-card-label">Welche Art von Konto möchten Sie eröffnen? <b><span class="text-danger">*</span></b></label>
                        <select name="konto" id="konto" class="form-control custom-select profile-input shadow-none" required>
                            <option value="">Bitte auswählen</option>
                            <option value="Giro">Girokonto</option>
                            <option value="Spar">Sparkonto</option>
                            <option value="Prepaid">Prepaidkonto</option>
                        </select>
                        <div class="invalid-feedback">
                            Bitte wählen Sie ein Konto aus.
                        </div>

                    </div>
                    <!-- End Col -->

                    <!-- Col -->
                    <div class="col-12 mb-4">

                        <div class="form-check text-light">
                            <input class="form-check-input shadow-none" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                                Ich bestätige, mich über dieses Konto informiert zu haben.
                            </label>
                            <div class="invalid-feedback">
                                Sie müssen das Feld ankreuzen.
                            </div>
                        </div>

                    </div>
                    <!-- End Col -->

                    <!-- Col -->
                    <div class="col-12 mb-5">

                        <button type="submit" name="submit" class="btn btn-success shadow-none">Eröffnen</button>

                    </div>
                    <!-- End Col -->

                </div>

            </form>

        </div>

        <?php include_once "components/scripts.php"; ?>
    </body>

</html>
