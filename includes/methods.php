<?php

/**
 * @author Berfan Korkmaz
 * @version 1.0.0
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "plugins/PHPMailer/src/Exception.php";
require "plugins/PHPMailer/src/PHPMailer.php";
require "plugins/PHPMailer/src/SMTP.php";

/**
 * @param message Prints an success Bootstrap alert
 */
function print_success($message) {
    echo
    '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class="far fa-check-circle"></i></strong> '. $message . '
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
}

/**
 * @param message Prints an success Bootstrap alert
 */
function print_success_raw($message) {
    echo
    '
    <div class="text-center text-success mt-3" >
        <strong><i class="far fa-check-circle"></i></strong> '. $message . '
    </div>
    ';
}

/**
 * @param message Prints an danger Bootstrap alert
 */
function print_danger($message) {
    echo
    '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class="far fa-times-circle"></i></strong> '. $message . '
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
}

/**
 * @param message Prints an danger Bootstrap alert
 */
function print_danger_raw($message) {
    echo
    '
    <div class="text-center text-danger mt-3" >
        <strong><i class="far fa-times-circle"></i></strong> '. $message . '
    </div>
    ';
}

/**
 * This function logs a user in.
 * @param contractNr The contract number (bigint).
 * @param password The password (string)
 */
function login($contractNr, $password) {
    global $conn;

    $statement = $conn->prepare("SELECT k.Vertragsnummer, k.Passwort, k.FirstTime, k.Id AS KundeId, k.Vorname, k.Nachname, k.Adresse, k.Postleitzahl, k.Ort, k.Email, k.Telefonnummer, k.Geburtsdatum, k.Geschlecht FROM kunde AS k WHERE k.Vertragsnummer = ? ORDER BY k.Id");
    $statement->bind_param("s", $contractNr);
    $statement->execute();

    $result = $statement->get_result();
    $row = $result->fetch_assoc();

    $dbPassword = $row["Passwort"];

    if (password_verify($password, $dbPassword)) { // Password correct!

        $_SESSION["logged_in"] = true;
        $_SESSION["customer_id"] = $row["KundeId"];
        $_SESSION["contract_number"] = $contractNr;
        $_SESSION["first_time"] = $row["FirstTime"];
        $_SESSION["firstname"] = $row["Vorname"];
        $_SESSION["lastname"] = $row["Nachname"];
        $_SESSION["birthdate"] = $row["Geburtsdatum"];
        $_SESSION["phone"] = $row["Telefonnummer"];
        $_SESSION["email"] = $row["Email"];
        $_SESSION["gender"] = $row["Geschlecht"];
        $_SESSION["adress"] = $row["Adresse"];
        $_SESSION["zip"] = $row["Postleitzahl"];
        $_SESSION["location"] = $row["Ort"];

        print_success_raw("Sie werden in <span id='counter' class='fw-bold'>3</span> Sekunde(n) weitergeleitet!");

        echo
        '
        <script>
            var x, secs = 2;
            x = setInterval(myFunc, 1000);

            function myFunc() {
                document.getElementById(\'counter\').innerHTML =  secs;
                secs --;
                if(secs == -1){
                    document.getElementById(\'counter\').innerHTML = "0";
                    clearInterval(x);
                    window.location.href = "./";
                }
            }
        </script>
        ';

    } else { // Password incorrect!

        print_danger_raw("Die Vertragsnummer oder das Passwort ist falsch.");

    }
}

/**
 * This function creates a new user.
 * @param firstname The users firstname
 * @param lastname The users lastname
 * @param adress The users adress 
 * @param house The users house number
 * @param zip The users zip code
 * @param location The users location
 * @param email The users email
 * @param phone The users phone number
 * @param birthdate The users birthdate
 * @param gender The users gender
 */
function register($firstname, $lastname, $adress, $house, $zip, $location, $email, $phone, $birthdate, $gender) {
    global $conn;

    if (email_exists($email)) {
        print_danger_raw("Die Email-Adresse existiert bereits.");
        return;
    }

    if (strlen($firstname) > 35) {
        print_danger_raw("Der Vorname darf maximal 35 Zeichen enthalten!");
        return;
    }

    if (strlen($lastname) > 35) {
        print_danger_raw("Der Nachname darf maximal 35 Zeichen enthalten!");
        return;
    }

    if (strlen($adress . " " . $house) > 75) {
        print_danger_raw("Die Adresse darf maximal 75 Zeichen enthalten!");
        return;
    }

    if (strlen($location) > 25) {
        print_danger_raw("Der Ort darf maximal 25 Zeichen enthalten!");
        return;
    }

    if (strlen($email) > 100) {
        print_danger_raw("Die Email darf maximal 100 Zeichen enthalten!");
        return;
    }

    if ($phone != null && !is_phone($phone)) {
        print_danger_raw("Die Telefonnummer ist ungültig!");
        return;
    }
    
    $age = get_age($birthdate);

    if ($age < 16) {
        print_danger_raw("Sie sind zu jung um ein BBK-Konto zu erstellen.");
        return;
    }

    if ($age > 122) {
        print_danger_raw("Bitte geben Sie ein gültiges Geburtsdatum an.");
        return;
    }

    $adress = $adress . " " . $house;

    $randomPassword = random_string(15);
    $randomPasswordHashed = password_hash($randomPassword, PASSWORD_DEFAULT);
    $randomContract = random_contract(10);

    $statement = $conn->prepare("INSERT INTO kunde(Vertragsnummer, Vorname, Nachname, Adresse, Postleitzahl, Ort, Email, Telefonnummer, Geburtsdatum, Geschlecht, Passwort) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $statement->bind_param("sssssssssss", $randomContract, $firstname, $lastname, $adress, $zip, $location, $email, $phone, $birthdate, $gender, $randomPasswordHashed);
    
    
    if ($statement->execute()) {
        send_mail($email, "$firstname $lastname", $randomContract, $randomPassword);
        print_success_raw("Konto erstellt! Bitte überprüfen Sie Ihre Mail.");
    } else {
        print_danger_raw("Ihr Konto konnte nicht erstellt werden.");
    }
    

}

/**
 * This function updates the personal info.
 * @param kundeId The id of the user
 * @param firstname The users firstname
 * @param lastname The users lastname
 * @param adress The users adress 
 * @param house The users house number
 * @param zip The users zip code
 * @param location The users location
 * @param email The users email
 * @param phone The users phone number
 * @param birthdate The users birthdate
 * @param gender The users gender
 */
function update_data($kundeId, $firstname, $lastname, $adress, $house, $zip, $location, $email, $phone, $birthdate, $gender) {
    global $conn;

    if ($email != $_SESSION["email"] && email_exists($email)) {
        print_danger_raw("Die Email-Adresse existiert bereits.");
        return;
    }

    if (strlen($firstname) > 35) {
        print_danger_raw("Der Vorname darf maximal 35 Zeichen enthalten!");
        return;
    }

    if (strlen($lastname) > 35) {
        print_danger_raw("Der Nachname darf maximal 35 Zeichen enthalten!");
        return;
    }

    if (strlen($adress . " " . $house) > 75) {
        print_danger_raw("Die Adresse darf maximal 75 Zeichen enthalten!");
        return;
    }

    if (strlen($location) > 25) {
        print_danger_raw("Der Ort darf maximal 25 Zeichen enthalten!");
        return;
    }

    if (strlen($email) > 100) {
        print_danger_raw("Die Email darf maximal 100 Zeichen enthalten!");
        return;
    }

    if ($phone != null && !is_phone($phone)) {
        print_danger_raw("Die Telefonnummer ist ungültig!");
        return;
    }
    
    $age = get_age($birthdate);

    if ($age < 16 || $age > 122) {
        print_danger_raw("Bitte geben Sie ein gültiges Geburtsdatum an.");
        return;
    }

    $adress = $adress . " " . $house;
    $statement = $conn->prepare("UPDATE kunde SET Vorname = ?, Nachname = ?, Adresse = ?, Postleitzahl = ?, Ort = ?, Email = ?, Telefonnummer = ?, Geburtsdatum = ?, Geschlecht = ? WHERE Id = ?");
    $statement->bind_param("sssssssssi", $firstname, $lastname, $adress, $zip, $location, $email, $phone, $birthdate, $gender, $kundeId);
    
    $_SESSION["firstname"] = $firstname;
    $_SESSION["lastname"] = $lastname;
    $_SESSION["birthdate"] = $birthdate;
    $_SESSION["phone"] = $phone;
    $_SESSION["email"] = $email;
    $_SESSION["gender"] = $gender;
    $_SESSION["adress"] = $adress;
    $_SESSION["zip"] = $zip;
    $_SESSION["location"] = $location;
    
    if ($statement->execute()) {
        print_success("Ihre persönlichen Daten wurden aktualisiert!");
    } else {
        print_danger("Ihre persönlichen Daten konnten nicht aktualisiert werden.");
    }
    

}


/**
 * Change the password of an account.
 * @param contractNr The contract of the account
 * @param password The new password
 */
function change_password($contractNr, $password) {
    global $conn;

    if (strlen($password) < 8) {
        print_danger_raw("Ihr Passwort muss mind. 8 Zeichen enthalten.");
        return;
    }

    $pwHashed = password_hash($password, PASSWORD_DEFAULT);

    $statement = $conn->prepare("UPDATE kunde SET Passwort = ?, FirstTime = 0 WHERE Vertragsnummer = ?");
    $statement->bind_param("ss", $pwHashed, $contractNr);
    
    if ($statement->execute()) {
        $_SESSION["first_time"] = 0;
        print_success_raw("Password wurde geändert!<br>Sie werden in <span id='counter' class='fw-bold'>3</span> Sekunde(n) weitergeleitet!");

        echo
        '
        <script>
            var x, secs = 2;
            x = setInterval(myFunc, 1000);

            function myFunc() {
                document.getElementById(\'counter\').innerHTML =  secs;
                secs --;
                if(secs == -1){
                    document.getElementById(\'counter\').innerHTML = "0";
                    clearInterval(x);
                    window.location.href = "./";
                }
            }
        </script>
        ';
    } else {
        print_danger_raw("Ihr Passwort konnte nicht geändert werden.");
    }

}

/**
 * Checks wheter a string is a phone number.
 * @param myString The string that should be checked.
 */
function is_phone($myString) {

    // Allow +, - and . in phone number
    $filtered_phone_number = filter_var($myString, FILTER_SANITIZE_NUMBER_INT);

    // Remove "-" from number
    $phone_to_check = str_replace("-", "", $filtered_phone_number);

    // Check the lenght of number
    // This can be customized if you want phone number from a specific country
    return !(strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14);
}

/**
 * This function calculates the age from date.
 * @param date The birthdate
 */
function get_age($birthDate) {
    
    $tz  = new DateTimeZone('Europe/Brussels');
    $age = DateTime::createFromFormat('Y-m-d', $birthDate, $tz)
        ->diff(new DateTime('now', $tz))
        ->y;

    return $age;
}

/**
 * Checks whether the email exists.
 * @param email The email adress.
 */
function email_exists($email) {
    global $conn;

    $statement = $conn->prepare("SELECT Email FROM kunde WHERE Email = ?");
    $statement->bind_param("s", $email);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows == 0) return false;
    else return true;
}

/**
 * This function generates a random string.
 * @param length The amount of characters.
 */
function random_string($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * This function generates a contract number.
 * @param length The amount of characters.
 */
function random_contract($length = 12) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * This function generates a number.
 * @param length The amount of characters.
 */
function random_numbers($length = 12) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * This function generates letters.
 * @param length The amount of characters.
 */
function random_letters_capital($length = 12) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * This function generates letters.
 * @param length The amount of characters.
 */
function random_letters_lower($length = 12) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * This function sends a mail.
 * @param address The email address
 * @param name The name 
 * @param contract The contract number
 * @param password The password
 */
function send_mail($address, $name, $contract, $password) {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
  
    $mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "bbk.kundenservice@gmail.com";
    $mail->Password   = "KZt9EqCqQt4A7Vv";
  
    $mail->IsHTML(true);
    $mail->AddAddress($address, $name);
    $mail->SetFrom("bbk.kundenservice@gmail.com", "BBK Kundenservice");
    $mail->Subject = "Ihre Anmeldedaten";
    $content = 
    '
    <html>
  
    <head>
    
        <!-- Meta -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    
        <style>
    
          .card{
              position:relative;
              display:flex;
              flex-direction:column;
              min-width:0;
              word-wrap:break-word;
              background-color:#fff;
              background-clip:border-box;
              border:1px solid rgba(0,0,0,.125);
              border-radius:.25rem
          }
          .card>hr{
              margin-right:0;
              margin-left:0
          }
          .card>.list-group{
              border-top:inherit;
              border-bottom:inherit
          }
          .card>.list-group:first-child{
              border-top-width:0;
              border-top-left-radius:calc(.25rem - 1px);
              border-top-right-radius:calc(.25rem - 1px)
          }
          .card>.list-group:last-child{
              border-bottom-width:0;
              border-bottom-right-radius:calc(.25rem - 1px);
              border-bottom-left-radius:calc(.25rem - 1px)
          }
          .card>.card-header+.list-group,.card>.list-group+.card-footer{
              border-top:0
          }
          .card-body{
              flex:1 1 auto;
              padding:1rem 1rem
          }
          .card-title{
              margin-bottom:.5rem
          }
          .card-subtitle{
              margin-top:-.25rem;
              margin-bottom:0
          }
          .card-text:last-child{
              margin-bottom:0
          }
          .card-link:hover{
              text-decoration:none
          }
          .card-link+.card-link{
              margin-left:1rem
          }
          .card-header{
              padding:.5rem 1rem;
              margin-bottom:0;
              background-color:rgba(0,0,0,.03);
              border-bottom:1px solid rgba(0,0,0,.125)
          }
          .card-header:first-child{
              border-radius:calc(.25rem - 1px) calc(.25rem - 1px) 0 0
          }
          .card-footer{
              padding:.5rem 1rem;
              background-color:rgba(0,0,0,.03);
              border-top:1px solid rgba(0,0,0,.125)
          }
          .card-footer:last-child{
              border-radius:0 0 calc(.25rem - 1px) calc(.25rem - 1px)
          }
          .card-header-tabs{
              margin-right:-.5rem;
              margin-bottom:-.5rem;
              margin-left:-.5rem;
              border-bottom:0
          }
          .card-header-pills{
              margin-right:-.5rem;
              margin-left:-.5rem
          }
          .card-img-overlay{
              position:absolute;
              top:0;
              right:0;
              bottom:0;
              left:0;
              padding:1rem;
              border-radius:calc(.25rem - 1px)
          }
          .card-img,.card-img-bottom,.card-img-top{
              width:100%
          }
          .card-img,.card-img-top{
              border-top-left-radius:calc(.25rem - 1px);
              border-top-right-radius:calc(.25rem - 1px)
          }
          .card-img,.card-img-bottom{
              border-bottom-right-radius:calc(.25rem - 1px);
              border-bottom-left-radius:calc(.25rem - 1px)
          }
          .card-group>.card{
              margin-bottom:.75rem
          }
          @media (min-width:576px){
              .card-group{
                  display:flex;
                  flex-flow:row wrap
              }
              .card-group>.card{
                  flex:1 0 0%;
                  margin-bottom:0
              }
              .card-group>.card+.card{
                  margin-left:0;
                  border-left:0
              }
              .card-group>.card:not(:last-child){
                  border-top-right-radius:0;
                  border-bottom-right-radius:0
              }
              .card-group>.card:not(:last-child) .card-header,.card-group>.card:not(:last-child) .card-img-top{
                  border-top-right-radius:0
              }
              .card-group>.card:not(:last-child) .card-footer,.card-group>.card:not(:last-child) .card-img-bottom{
                  border-bottom-right-radius:0
              }
              .card-group>.card:not(:first-child){
                  border-top-left-radius:0;
                  border-bottom-left-radius:0
              }
              .card-group>.card:not(:first-child) .card-header,.card-group>.card:not(:first-child) .card-img-top{
                  border-top-left-radius:0
              }
              .card-group>.card:not(:first-child) .card-footer,.card-group>.card:not(:first-child) .card-img-bottom{
                  border-bottom-left-radius:0
              }
          }

          .row{--bs-gutter-x:1.5rem;--bs-gutter-y:0;display:flex;flex-wrap:wrap;margin-top:calc(-1 * var(--bs-gutter-y));margin-right:calc(-.5 * var(--bs-gutter-x));margin-left:calc(-.5 * var(--bs-gutter-x))}
          .col-sm{flex:1 0 0%}.row-cols-sm-auto>*{flex:0 0 auto;width:auto}.row-cols-sm-1>*{flex:0 0 auto;width:100%}.row-cols-sm-2>*{flex:0 0 auto;width:50%}.row-cols-sm-3>*{flex:0 0 auto;width:33.3333333333%}.row-cols-sm-4>*{flex:0 0 auto;width:25%}.row-cols-sm-5>*{flex:0 0 auto;width:20%}.row-cols-sm-6>*{flex:0 0 auto;width:16.6666666667%}.col-sm-auto{flex:0 0 auto;width:auto}.col-sm-1{flex:0 0 auto;width:8.33333333%}.col-sm-2{flex:0 0 auto;width:16.66666667%}.col-sm-3{flex:0 0 auto;width:25%}.col-sm-4{flex:0 0 auto;width:33.33333333%}.col-sm-5{flex:0 0 auto;width:41.66666667%}.col-sm-6{flex:0 0 auto;width:50%}.col-sm-7{flex:0 0 auto;width:58.33333333%}.col-sm-8{flex:0 0 auto;width:66.66666667%}.col-sm-9{flex:0 0 auto;width:75%}.col-sm-10{flex:0 0 auto;width:83.33333333%}.col-sm-11{flex:0 0 auto;width:91.66666667%}.col-sm-12{flex:0 0 auto;width:100%}.offset-sm-0{margin-left:0}
          .col-md{flex:1 0 0%}.row-cols-md-auto>*{flex:0 0 auto;width:auto}.row-cols-md-1>*{flex:0 0 auto;width:100%}.row-cols-md-2>*{flex:0 0 auto;width:50%}.row-cols-md-3>*{flex:0 0 auto;width:33.3333333333%}.row-cols-md-4>*{flex:0 0 auto;width:25%}.row-cols-md-5>*{flex:0 0 auto;width:20%}.row-cols-md-6>*{flex:0 0 auto;width:16.6666666667%}.col-md-auto{flex:0 0 auto;width:auto}.col-md-1{flex:0 0 auto;width:8.33333333%}.col-md-2{flex:0 0 auto;width:16.66666667%}.col-md-3{flex:0 0 auto;width:25%}.col-md-4{flex:0 0 auto;width:33.33333333%}.col-md-5{flex:0 0 auto;width:41.66666667%}.col-md-6{flex:0 0 auto;width:50%}.col-md-7{flex:0 0 auto;width:58.33333333%}.col-md-8{flex:0 0 auto;width:66.66666667%}.col-md-9{flex:0 0 auto;width:75%}.col-md-10{flex:0 0 auto;width:83.33333333%}.col-md-11{flex:0 0 auto;width:91.66666667%}.col-md-12{flex:0 0 auto;width:100%}
          .col-lg{flex:1 0 0%}.row-cols-lg-auto>*{flex:0 0 auto;width:auto}.row-cols-lg-1>*{flex:0 0 auto;width:100%}.row-cols-lg-2>*{flex:0 0 auto;width:50%}.row-cols-lg-3>*{flex:0 0 auto;width:33.3333333333%}.row-cols-lg-4>*{flex:0 0 auto;width:25%}.row-cols-lg-5>*{flex:0 0 auto;width:20%}.row-cols-lg-6>*{flex:0 0 auto;width:16.6666666667%}.col-lg-auto{flex:0 0 auto;width:auto}.col-lg-1{flex:0 0 auto;width:8.33333333%}.col-lg-2{flex:0 0 auto;width:16.66666667%}.col-lg-3{flex:0 0 auto;width:25%}.col-lg-4{flex:0 0 auto;width:33.33333333%}.col-lg-5{flex:0 0 auto;width:41.66666667%}.col-lg-6{flex:0 0 auto;width:50%}.col-lg-7{flex:0 0 auto;width:58.33333333%}.col-lg-8{flex:0 0 auto;width:66.66666667%}.col-lg-9{flex:0 0 auto;width:75%}.col-lg-10{flex:0 0 auto;width:83.33333333%}.col-lg-11{flex:0 0 auto;width:91.66666667%}.col-lg-12{flex:0 0 auto;width:100%}
          .col-xl-auto{flex:0 0 auto;width:auto}.col-xl-1{flex:0 0 auto;width:8.33333333%}.col-xl-2{flex:0 0 auto;width:16.66666667%}.col-xl-3{flex:0 0 auto;width:25%}.col-xl-4{flex:0 0 auto;width:33.33333333%}.col-xl-5{flex:0 0 auto;width:41.66666667%}.col-xl-6{flex:0 0 auto;width:50%}.col-xl-7{flex:0 0 auto;width:58.33333333%}.col-xl-8{flex:0 0 auto;width:66.66666667%}.col-xl-9{flex:0 0 auto;width:75%}.col-xl-10{flex:0 0 auto;width:83.33333333%}.col-xl-11{flex:0 0 auto;width:91.66666667%}.col-xl-12{flex:0 0 auto;width:100%}
          .col-xxl{flex:1 0 0%}.row-cols-xxl-auto>*{flex:0 0 auto;width:auto}.row-cols-xxl-1>*{flex:0 0 auto;width:100%}.row-cols-xxl-2>*{flex:0 0 auto;width:50%}.row-cols-xxl-3>*{flex:0 0 auto;width:33.3333333333%}.row-cols-xxl-4>*{flex:0 0 auto;width:25%}.row-cols-xxl-5>*{flex:0 0 auto;width:20%}.row-cols-xxl-6>*{flex:0 0 auto;width:16.6666666667%}.col-xxl-auto{flex:0 0 auto;width:auto}.col-xxl-1{flex:0 0 auto;width:8.33333333%}.col-xxl-2{flex:0 0 auto;width:16.66666667%}.col-xxl-3{flex:0 0 auto;width:25%}.col-xxl-4{flex:0 0 auto;width:33.33333333%}.col-xxl-5{flex:0 0 auto;width:41.66666667%}.col-xxl-6{flex:0 0 auto;width:50%}.col-xxl-7{flex:0 0 auto;width:58.33333333%}.col-xxl-8{flex:0 0 auto;width:66.66666667%}.col-xxl-9{flex:0 0 auto;width:75%}.col-xxl-10{flex:0 0 auto;width:83.33333333%}.col-xxl-11{flex:0 0 auto;width:91.66666667%}.col-xxl-12{flex:0 0 auto;width:100%}

          .container,.container-fluid,.container-lg,.container-md,.container-sm,.container-xl,.container-xxl{
              width:100%;
              padding-right:var(--bs-gutter-x,.75rem);
              padding-left:var(--bs-gutter-x,.75rem);
              margin-right:auto;
              margin-left:auto
          }
          @media (min-width:576px){
              .container,.container-sm{
                  max-width:540px
              }
          }
          @media (min-width:768px){
              .container,.container-md,.container-sm{
                  max-width:720px
              }
          }
          @media (min-width:992px){
              .container,.container-lg,.container-md,.container-sm{
                  max-width:960px
              }
          }
          @media (min-width:1200px){
              .container,.container-lg,.container-md,.container-sm,.container-xl{
                  max-width:1140px
              }
          }
          @media (min-width:1400px){
              .container,.container-lg,.container-md,.container-sm,.container-xl,.container-xxl{
                  max-width:1320px
              }
          }
    
          .w-35{
            width: 35% !important
          }
    
          .justify-content-between{
              justify-content:space-between!important
          }
    
          .p-0{
              padding:0!important
          }
          .p-1{
              padding:.25rem!important
          }
          .p-2{
              padding:.5rem!important
          }
          .p-3{
              padding:1rem!important
          }
          .p-4{
              padding:1.5rem!important
          }
          .p-5{
              padding:3rem!important
          }
    
          .m-0{
              margin:0!important
          }
          .m-1{
              margin:.25rem!important
          }
          .m-2{
              margin:.5rem!important
          }
          .m-3{
              margin:1rem!important
          }
          .m-4{
              margin:1.5rem!important
          }
          .m-5{
              margin:3rem!important
          }
          .m-auto{
              margin:auto!important
          }
    
          .mail-title {
            font-family: "Lato", Arial, Helvetica, sans-serif;
            font-size: 25px;
            text-align: center;
            color: black;
          }
          
          .mail-address {
            font-family: "Lato", Arial, Helvetica, sans-serif;
            font-size: 15px;
            text-align: center;
            color: black;
            text-decoration: none;
          }
          
          .mail-divider {
            margin: 2rem 0 2rem 0;
            color: black;
          }
          
          .mail-text {
            font-family: "Lato", Arial, Helvetica, sans-serif;
            font-size: 13px;
            color: black;
          }
          
          .mail-field {
            display: inline-block;
            font-family: "Lato", Arial, Helvetica, sans-serif;
            font-weight: 600;
            font-size: 15px;
            width: 50%;
            color: black;
          }
          
          .mail-value {
            font-family: "Lato", Arial, Helvetica, sans-serif;
            font-size: 15px;
            color: black;
          }
          
          .mail-footer {
            font-family: "Lato", Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #686868;
            text-align: center;
          }
        </style>
    
    </head>
    
    <body style="background-color: white;">
    
      <div class="container justify-content-between">
    
        <div class="row">

        <div class="col-xxl-3"></div>

        <div class="col-xxl-6 w-100">

            <div class="card p-4 m-2" style="border: 1px solid #827f7f;">
                <div class="card-body">

                    <div class="mail-title">Ihre Anmeldedaten</div>
                    <div class="mail-address">'. $address .'</div>
                    <hr class="mail-divider">

                    <div class="mail-text" style="margin-bottom: 2rem;">
                    Es freut uns, dass Sie sich für uns entschieden haben. Ihr Konto wurde erfolgreich erstellt und 
                    steht zur Aktivierung bereit. Nutzen Sie die folgenden Daten fürs Anmelden, anschliessend werden 
                    Sie darum gebeten, Ihr Passwort zu ändern.
                    </div>

                    <span class="mail-field">Vertragsnummer:</span><span class="mail-value">'. $contract .'</span><br>
                    <span class="mail-field">Passwort:</span><span class="mail-value">'. $password .'</span>

                    <div class="mail-text" style="margin-top: 2rem;">
                    Sollten Fragen auftreten, antworten Sie einfach auf diese Mail.<br><br>
                    Beste Grüsse,<br>
                    BBK-Team
                    </div>

                </div>
            </div>

            <div class="mail-footer">© 2021 BBK Alle Rechte vorbehalten.</div>

        </div>

        <div class="col-xxl-3"></div>

        </div>
    
      </div>
      
    
    </body>
    
    </html>
    ';
  
    $mail->MsgHTML($content); 
    $mail->Send();
  }
  

?>