<!doctype html>
<html lang="en">

    <?php include_once "components/head.php"; ?>

    <body>
        <?php include_once "components/navbar.php"; ?>

        <div class="container my-5">

            <div class="page-title">Berfan Korkmaz</div>
            <div class="page-description">Einstellungen, Bankkarten etc. finden Sie hier.</div>
            <hr class="page-divider">

            <div class="profile-title">Persönliche Daten</div>

            <form action="" autocomplete="off" class="my-3" method="post">

                <div class="row">

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <label for="vorname" class="form-label profile-label">Vorname</label>
                        <input type="text" name="vorname" class="form-control profile-input shadow-none" value="" placeholder="Maximilian">
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <label for="nachname" class="form-label profile-label">Nachname</label>
                        <input type="text" name="nachname" class="form-control profile-input shadow-none" value="" placeholder="Mustermann">
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4"></div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <label for="strasse" class="form-label profile-label">Strasse</label>
                        <input type="text" name="strasse" class="form-control profile-input shadow-none" value="" placeholder="Beispielstrasse">
                    </div>

                    <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-2 col-sm-12 col-xs-12 mb-3">
                        <label for="hausnummer" class="form-label profile-label">Hausnr.</label>
                        <input type="number" name="hausnummer" class="form-control profile-input shadow-none" value="" placeholder="5">
                    </div>

                    <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-2 col-sm-12 col-xs-12 mb-3">
                        <label for="plz" class="form-label profile-label">PLZ</label>
                        <input type="text" name="plz" class="form-control profile-input shadow-none" value="" placeholder="4055">
                    </div>

                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 mb-3">
                        <label for="ort" class="form-label profile-label">Ort</label>
                        <input type="text" name="ort" class="form-control profile-input shadow-none" value="" placeholder="Basel">
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4"></div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <label for="email" class="form-label profile-label">Email-Adresse</label>
                        <input type="email" name="email" class="form-control profile-input shadow-none" value="" placeholder="max@domain.ch">
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <label for="telefonnummer" class="form-label profile-label">Telefonnummer</label>
                        <input type="text" name="telefonnummer" class="form-control profile-input shadow-none" value="" placeholder="078 123 45 67">
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4"></div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                        <label for="geburtsdatum" class="form-label profile-label">Geburtsdatum</label>
                        <input type="date" name="geburtsdatum" class="form-control profile-input shadow-none" value="" placeholder="max@domain.ch">
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
                        <label for="geschlecht" class="form-label profile-label">Geschlecht</label>
                        <select name="geschlecht" class="form-control profile-input">
                            <option value="0" selected>Bitte auswählen</option>
                            <option value="1">Männlich</option>
                            <option value="2">Weiblich</option>
                            <option value="3">Anderes</option>
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
