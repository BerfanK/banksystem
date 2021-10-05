<!doctype html>
<html lang="en">

    <?php include_once "components/head.php"; ?>

    <body>

    <div class="container justify-between" style="margin-top: 10rem;">

        <div class="row">

            <div class="col-lg-4 col-lg-4 col-md-12 col-sm-12 mx-auto">

                <!-- Login -->
                <div class="my-5">

                        <div class="profile-title">Bitte anmelden.</div>
                        <div class="page-description">Willkommen zurück, bitte melden Sie sich an.</div>

                        <hr class="my-3">

                        <form autocomplete="off" class="needs-validation" method="post" novalidate>
                        
                            <div class="form-group mb-1">
                                <label for="contractNumber" class="new-card-label">Vertragsnummer &nbsp;</b><span class="text-danger">*</span></b></label>
                                <input type="number" class="form-control profile-input shadow-none rounded-0" name="contractNumber" placeholder="Ihre Vertragsnummer ..." required>
                                <div class="invalid-feedback">
                                    Bitte füllen Sie dieses Feld aus!
                                </div>
                            </div>

                            <span class="login-info"><a href="./recover">Vertragsnummer vergessen?</a></span>

                            <div class="form-group mt-4 mb-1">
                                <label for="password" class="new-card-label">Passwort &nbsp;</b><span class="text-danger">*</span></b></label>
                                <input type="password" class="form-control profile-input shadow-none rounded-0" name="password" placeholder="Ihr Passwort ..." required>
                                <div class="invalid-feedback">
                                    Bitte füllen Sie dieses Feld aus!
                                </div>
                            </div>

                            <?php
                            

                            ?>

                            <span class="login-info"><a href="./recover">Passwort vergessen?</a></span>

                            <?php

                            if (isset($_POST["submit"]) && !empty($_POST["contractNumber"]) && !empty($_POST["password"])) {
                                login($_POST["contractNumber"], $_POST["password"]);
                            }

                            ?>

                            <div class="form-group mb-2 mt-4">
                                <button type="submit" class="w-100 btn btn-success opacity-75 shadow-none rounded-0" name="submit">Anmelden</button>
                            </div>

                            <div class="login-info text-center">Noch kein Konto? <a href="./register">Jetzt registrieren.</a></div>

                        </form>

                </div>
                <!-- End Login -->

            </div>

        </div>

        </div>
        <?php include_once "components/scripts.php"; ?>
    </body>

</html>
