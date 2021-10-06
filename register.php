<!doctype html>
<html lang="en">

    <?php include_once "components/head.php"; ?>

    <body>

    <div class="container justify-between" style="margin-top: 10rem;">

        <div class="row">

            <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12"></div>
            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-12 col-sm-12 col-xs-12 mx-auto">

                <!-- Login -->
                <div class="my-5 ms-5">

                    <div class="profile-title">Guten Tag.</div>
                    <div class="page-description">Bitte füllen Sie das Formular aus.</div>

                    <hr class="my-3">

                    <form action="" autocomplete="off" class="my-3 needs-validation" method="post" novalidate>

                        <div class="row">

                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="vorname" class="form-label profile-label">Vorname <span class="text-danger"><b>*</b></span></label>
                                <input type="text" name="vorname" class="form-control profile-input shadow-none" value="" placeholder="Maximilian" required>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="nachname" class="form-label profile-label">Nachname <span class="text-danger"><b>*</b></span></label>
                                <input type="text" name="nachname" class="form-control profile-input shadow-none" value="" placeholder="Mustermann" required>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-4"></div>

                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="strasse" class="form-label profile-label">Strasse <span class="text-danger"><b>*</b></span></label>
                                <input type="text" name="strasse" class="form-control profile-input shadow-none" value="" placeholder="Beispielstrasse" required>
                            </div>

                            <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-2 col-sm-12 col-xs-12 mb-3">
                                <label for="hausnummer" class="form-label profile-label">Nr. <span class="text-danger"><b>*</b></span></label>
                                <input type="number" name="hausnummer" class="form-control profile-input shadow-none" value="" placeholder="5" required>
                            </div>

                            <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-2 col-sm-12 col-xs-12 mb-3">
                                <label for="plz" class="form-label profile-label">PLZ <span class="text-danger"><b>*</b></span></label>
                                <input type="text" name="plz" class="form-control profile-input shadow-none" value="" placeholder="4055" required>
                            </div>

                            <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 mb-3">
                                <label for="ort" class="form-label profile-label">Ort <span class="text-danger"><b>*</b></span></label>
                                <input type="text" name="ort" class="form-control profile-input shadow-none" value="" placeholder="Basel" required>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-4"></div>

                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="email" class="form-label profile-label">Email-Adresse <span class="text-danger"><b>*</b></span></label>
                                <input type="email" name="email" class="form-control profile-input shadow-none" value="" placeholder="max@domain.ch" required>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="telefonnummer" class="form-label profile-label">Telefonnummer</label>
                                <input type="text" name="telefonnummer" class="form-control profile-input shadow-none" value="" placeholder="078 123 45 67">
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-4"></div>

                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                                <label for="geburtsdatum" class="form-label profile-label">Geburtsdatum <span class="text-danger"><b>*</b></span></label>
                                <input type="date" name="geburtsdatum" class="form-control profile-input shadow-none" value="" placeholder="max@domain.ch" required>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
                                <label for="geschlecht" class="form-label profile-label">Geschlecht</label>
                                <select name="geschlecht" class="form-control profile-input">
                                    <option value="0" selected>Bitte auswählen</option>
                                    <option value="M">Männlich</option>
                                    <option value="W">Weiblich</option>
                                    <option value="X">Anderes</option>
                                </select>
                            </div>

                            <div class="col-xxl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 mb-3">
                                <?php

                                if (isset($_POST["submit"]) && !empty($_POST["vorname"]) && !empty($_POST["nachname"]) && !empty($_POST["strasse"]) && !empty($_POST["hausnummer"]) && !empty($_POST["plz"]) && !empty($_POST["ort"]) && !empty($_POST["email"]) && !empty($_POST["geburtsdatum"])) {
                                    
                                    $vorname = $_POST["vorname"];
                                    $nachname = $_POST["nachname"];
                                    $strasse = $_POST["strasse"];
                                    $hausnummer = $_POST["hausnummer"];
                                    $plz = $_POST["plz"];
                                    $ort = $_POST["ort"];
                                    $email = $_POST["email"];
                                    
                                    $telefonnummer = (empty($_POST["telefonnummer"])) ? null : $_POST["telefonnummer"];
                                    $geburtsdatum = $_POST["geburtsdatum"];
                                    $geschlecht = (empty($_POST["geschlecht"]) || $_POST["geschlecht"] == '0') ? null : $_POST["geschlecht"];

                                    register($vorname, $nachname, $strasse, $hausnummer, $plz, $ort, $email, $telefonnummer, $geburtsdatum, $geschlecht);

                                }

                                ?>
                                <button type="submit" name="submit" class="btn btn-success w-100 opacity-75 me-3 my-3">Konto erstellen</button>
                                <span class="login-info">Haben Sie bereits ein Konto? <a href="./login">Melden Sie sich an.</a></span>
                            </div>

                        </div>

                    </form>

                </div>
                <!-- End Login -->

            </div>

        </div>

        </div>
        <?php include_once "components/scripts.php"; ?>
    </body>

</html>
