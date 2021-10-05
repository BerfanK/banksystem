<!doctype html>
<html lang="en">

    <?php include_once "components/head.php"; ?>

    <body>
        <?php include_once "components/navbar.php"; ?>

        <div class="container my-5">

            <div class="page-title">Konto eröffnen</div>
            <div class="page-description">Hier können Sie ein Konto eröffnen.</div>
            <hr class="page-divider">

            <div class="profile-title">Formular ausfüllen</div>

            <form action="" autocomplete="off" class="my-5 needs-validation" method="post" novalidate>

                <div class="row">

                    <!-- Col -->
                    <div class="col-12 w-50 mb-4">

                        <label for="" class="new-card-label">Welche Art von Konto möchten Sie eröffnen? <b><span class="text-danger">*</span></b></label>
                        <select name="" id="" class="form-control custom-select profile-input shadow-none" required>
                            <option value="">Bitte auswählen</option>
                            <option value="1">Girokonto</option>
                            <option value="2">Sparkonto</option>
                            <option value="3">Prepaidkonto</option>
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

                        <button class="btn btn-success shadow-none">Eröffnen</button>

                    </div>
                    <!-- End Col -->

                </div>

            </form>

        </div>

        <?php include_once "components/scripts.php"; ?>
    </body>

</html>
