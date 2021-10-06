<!doctype html>
<html lang="en">

    <?php 
    include_once "components/head.php"; 
    
    $vorname = $_SESSION["firstname"];
    $nachname = $_SESSION["lastname"];
    
    $addresse = $_SESSION["adress"];
    $split = explode(' ', $addresse);
    $hausnummer = array_pop($split);
    $strasse = trim(str_replace($hausnummer, "", $addresse));

    $geburtsdatum = $_SESSION["birthdate"];
    $plz = $_SESSION["zip"];
    $ort = $_SESSION["location"];
    $email = $_SESSION["email"];
    $telefonnummer = $_SESSION["phone"];
    $geschlecht = $_SESSION["gender"];

    ?>

    <body>
        <?php include_once "components/navbar.php"; ?>

        <div class="container my-5">

            <div class="page-title">Berfan Korkmaz</div>
            <div class="page-description">Einstellungen, Bankkarten etc. finden Sie hier.</div>
            <hr class="page-divider">

            <?php

                if (isset($_POST["btnSubmitProfile"]) && !empty($_POST["vorname"]) && !empty($_POST["nachname"]) && !empty($_POST["strasse"]) && !empty($_POST["hausnummer"]) && !empty($_POST["plz"]) && !empty($_POST["ort"]) && !empty($_POST["email"]) && !empty($_POST["geburtsdatum"])) {
                    
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

                    update_data($_SESSION["customer_id"], $vorname, $nachname, $strasse, $hausnummer, $plz, $ort, $email, $telefonnummer, $geburtsdatum, $geschlecht);

                }

            ?>
            
            <div class="profile-title">Persönliche Daten</div>

            <form action="" autocomplete="off needs-validation" class="my-3" method="post" novalidate>

                <div class="row">

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <label for="vorname" class="form-label profile-label">Vorname <span class="text-danger"><b>*</b></label>
                        <input type="text" name="vorname" class="form-control profile-input shadow-none" value="<?=$vorname?>" placeholder="Maximilian" required>
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <label for="nachname" class="form-label profile-label">Nachname <span class="text-danger"><b>*</b></label>
                        <input type="text" name="nachname" class="form-control profile-input shadow-none" value="<?=$nachname?>" placeholder="Mustermann" required>
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4"></div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <label for="strasse" class="form-label profile-label">Strasse <span class="text-danger"><b>*</b></label>
                        <input type="text" name="strasse" class="form-control profile-input shadow-none" value="<?=$strasse?>" placeholder="Beispielstrasse" required>
                    </div>

                    <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-2 col-sm-12 col-xs-12 mb-3">
                        <label for="hausnummer" class="form-label profile-label">Nr. <span class="text-danger"><b>*</b></label>
                        <input type="number" name="hausnummer" class="form-control profile-input shadow-none" value="<?=$hausnummer?>" placeholder="5" required>
                    </div>

                    <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-2 col-sm-12 col-xs-12 mb-3">
                        <label for="plz" class="form-label profile-label">PLZ <span class="text-danger"><b>*</b></label>
                        <input type="text" name="plz" class="form-control profile-input shadow-none" value="<?=$plz?>" placeholder="4055" required>
                    </div>

                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 mb-3">
                        <label for="ort" class="form-label profile-label">Ort <span class="text-danger"><b>*</b></label>
                        <input type="text" name="ort" class="form-control profile-input shadow-none" value="<?=$ort?>" placeholder="Basel" required>
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4"></div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <label for="email" class="form-label profile-label">Email-Adresse <span class="text-danger"><b>*</b></label>
                        <input type="email" name="email" class="form-control profile-input shadow-none" value="<?=$email?>" placeholder="max@domain.ch" required>
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <label for="telefonnummer" class="form-label profile-label">Telefonnummer</label>
                        <input type="text" name="telefonnummer" class="form-control profile-input shadow-none" value="<?=$telefonnummer?>" placeholder="078 123 45 67">
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4"></div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <label for="geburtsdatum" class="form-label profile-label">Geburtsdatum <span class="text-danger"><b>*</b></label>
                        <input type="date" name="geburtsdatum" class="form-control profile-input shadow-none" value="<?=$geburtsdatum?>" placeholder="max@domain.ch" required>
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
                        <label for="geschlecht" class="form-label profile-label">Geschlecht</label>
                        <select name="geschlecht" class="form-control profile-input">
                            <option value="0" >Bitte auswählen</option>
                            <option value="M" <?php if ($geschlecht === 'M') echo "selected"; ?>>Männlich</option>
                            <option value="W" <?php if ($geschlecht === 'W') echo "selected"; ?>>Weiblich</option>
                            <option value="X" <?php if ($geschlecht === 'X') echo "selected"; ?>>Anderes</option>
                        </select>
                    </div>

                    <div class="col-xxl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 mb-3">

                        <button type="submit" name="btnSubmitProfile" class="btn btn-save opacity-75 me-3">Speichern</button>
                        <a href="./profile" name="btnResetProfile" class="btn btn-danger opacity-75">Zurücksetzen</a>
                    </div>

                </div>

            </form>

            <div class="profile-title">Einstellungen</div>

            <div class="row my-3">
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-7 col-sm-7 col-xs-12 my-3">
                    <div class="profile-setting-title">Account deaktivieren</div>
                    <div class="profile-setting-text">Schalten Sie Ihr Konto temporär ab.</div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-sm-5 col-xs-12 text-lg-end text-xl-end text-md-end text-sm-start my-3">
                    <div class="profile-setting-button"><button class="btn btn-github px-4">Konto deaktivieren</button></div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-7 col-sm-7 col-xs-12 my-3">
                    <div class="profile-setting-title">Account löschen</div>
                    <div class="profile-setting-text">Löschen Sie permanent ihr Konto.</div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-sm-5 col-xs-12 text-lg-end text-xl-end text-md-end text-sm-start my-3">
                    <div class="profile-setting-button"><button class="btn btn-github px-4">Konto löschen</button></div>
                </div>
            </div>
          

        </div>

        <?php include_once "components/scripts.php"; ?>
    </body>

</html>
