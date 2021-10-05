<form action="" autocomplete="off" class="my-5 needs-validation" method="post" novalidate>

    <div class="row">

        <!-- Col -->
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">

            <label for="konto" class="new-card-label">Mit welchem Konto möchten Sie bezahlen? <b><span class="text-danger">*</span></b></label>
            <select name="konto" id="konto" class="form-control custom-select payment-input shadow-none" required>
                <option value="">Bitte auswählen</option>
                <option value="0">BBK Privatkonto (CH61 0023 3233 2442 5840 R) &bull; CHF 322,80</option>
                <option value="1">BBK Prepaidkonto (3952 9492 0964 7955) &bull; CHF -122,25</option>
            </select>
            <div class="invalid-feedback">
                Bitte wählen Sie ein Konto aus.
            </div>

        </div>
        <!-- End Col -->

        <!-- Col -->
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">

            <label for="date" class="new-card-label">Ausführungsdatum <b><span class="text-danger">*</span></b></label>
            <input type="date" name="date" class="form-control payment-input shadow-none" value="" required>
            <div class="invalid-feedback">
                Bitte wählen Sie ein Datum.
            </div>
        </div>
        <!-- End Col -->

        <!-- Col -->
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">

            <label for="nameAdress" class="new-card-label">Name und Adresse des Empfängers <b><span class="text-danger">*</span></b></label>
            <input type="text" name="nameAdress" class="form-control payment-input shadow-none" value="" placeholder="Max Mustermann Beispielstrasse 5" required>
            <div class="invalid-feedback">
                Bitte füllen Sie das Feld aus.
            </div>
        </div>
        <!-- End Col -->

        <!-- Col -->
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">

            <label for="zweck" class="new-card-label">Verwendungszweck</label>
            <input type="text" name="zweck" class="form-control payment-input shadow-none" value="" placeholder="Rechnung #1234">
        </div>
        <!-- End Col -->

        <!-- Col -->
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">

            <label for="land" class="new-card-label">Land <b><span class="text-danger">*</span></b></label>
            <select name="land" id="land" class="form-control custom-select payment-input shadow-none" required>
                <option value="">Bitte auswählen</option>
                <option value="CH">Schweiz</option>
                <option value="DE">Deutschland</option>
                <option value="AT">Österreich</option>
                <option value="US">Vereinigte Staaten</option>
            </select>
            <div class="invalid-feedback">
                Bitte wählen Sie ein Konto aus.
            </div>
        </div>
        <!-- End Col -->

        <!-- Col -->
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">

            <label for="notiz" class="new-card-label">Eigene Notiz</label>
            <input type="text" name="notiz" class="form-control payment-input shadow-none" value="" placeholder="T-Shirt Rechnung">
        </div>
        <!-- End Col -->

        <!-- Col -->
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">

            <label for="iban" class="new-card-label">IBAN oder Kontonummer <b><span class="text-danger">*</span></b></label>
            <input type="text" name="iban" class="form-control payment-input shadow-none" value="" placeholder="CH12 3456 7891 2345 B" required>
            <div class="invalid-feedback">
                Bitte füllen Sie das Feld aus.
            </div>
        </div>
        <!-- End Col -->

        <!-- Col -->
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">

            <label for="betrag" class="new-card-label">Betrag <b><span class="text-danger">*</span></b></label>
            <input type="number" name="betrag" class="form-control payment-input shadow-none" value="" placeholder="15000" required>
            <div class="invalid-feedback">
                Bitte geben Sie einen Geldbetrag ein.
            </div>
        </div>
        <!-- End Col -->

        <!-- Col -->
        <div class="col-12 mb-4">

            <div class="form-check text-light">
                <input class="form-check-input shadow-none" type="checkbox" value="" name="dauerauftrag" id="invalidCheck">
                <label class="form-check-label" for="invalidCheck">
                    Diese Zahlung sollte ein Dauerauftrag sein.
                </label>
            </div>

        </div>
        <!-- End Col -->

        <!-- Col -->
        <div class="col-12 mb-5">

            <button class="btn btn-success opacity-100 shadow-none">Auftrag einreichen</button>

        </div>
        <!-- End Col -->

    </div>

</form>