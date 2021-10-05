<!doctype html>
<html lang="en">

    <?php include_once "components/head.php"; ?>

    <body>
        <?php include_once "components/navbar.php"; ?>

        <div class="container my-5">

            <div class="page-title">Hilfe anfordern</div>
            <div class="page-description">Hier können Sie uns kontaktieren.</div>
            <hr class="page-divider">

            <div class="row">

                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="help-title mb-4">Kontaktformular ausfüllen</div>

                    <form autocomplete="off" class="needs-validation" method="post" novalidate>

                        <div class="form-group mb-4">
                            <label for="name" class="mb-1 new-card-label">Bitte geben Sie Ihren Namen ein <b><span class="text-danger">*</span></b></label>
                            <input type="text" id="name" name="name" class="form-control profile-input shadow-none p-2" placeholder="z.B. Max Mustermann" required>
                            <div class="invalid-feedback">
                                Bitte füllen Sie dieses Feld aus.
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" class="mb-1 new-card-label">Bitte geben Sie Ihre Email-Adresse ein <b><span class="text-danger">*</span></b></label>
                            <input type="text" id="email" name="email" class="form-control profile-input shadow-none p-2" placeholder="z.B. max.mustermann@gmail.com" required>
                            <div class="invalid-feedback">
                                Bitte füllen Sie dieses Feld aus.
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="message" class="mb-1 new-card-label">Bitte geben Sie eine Nachricht ein <b><span class="text-danger">*</span></b></label>
                            <textarea spellcheck="false" id="message" name="message" class="form-control profile-input shadow-none p-2" style="resize: none;" placeholder="Hier Ihre Nachricht eingeben..." col="30" rows="4" required></textarea>
                            <div class="invalid-feedback">
                                Bitte füllen Sie dieses Feld aus.
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <button type="submit" name="submitForm" style="width: 100%" class="shadow-none p-2 btn btn-light">Absenden</button>
                        </div>

                    </form>
                </div>

                <div class="col-2"></div>

                <div class="col-xxl-4col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="help-title mb-4">Wir sind für Sie da.</div>
                    
                    <span class="help-description">Mo – Fr</span><span class="help-time">8:00 - 19:00</span><br>
                    <span class="help-description">Sa</span><span class="help-time">8:30 - 13:00</span><br>
                    <hr class="text-light">

                    <span class="help-description">Mail</span><span class="help-time">support@bbk.ch</span><br>
                    <span class="help-description">Telefon</span><span class="help-time">(+41) 61 835 99 24</span><br>
                </div>

            </div>

        </div>

        <?php include_once "components/scripts.php"; ?>
    </body>

</html>
