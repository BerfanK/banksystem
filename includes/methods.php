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

    $statement = $conn->prepare("SELECT * FROM account WHERE Vertragsnummer = ?");
    $statement->bind_param("s", $contractNr);
    $statement->execute();

    $result = $statement->get_result();
    $row = $result->fetch_assoc();

    $dbPassword = $row["Passwort"];
    echo $contractNr;

    if (password_verify($password, $dbPassword)) { // Password correct!

        $_SESSION["logged_in"] = true;
        $_SESSION["account_id"] = $row["Id"];
        $_SESSION["customer_id"] = $row["KundeId"];
        $_SESSION["contract_number"] = $contractNr;

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
    $statement = $conn->prepare("INSERT INTO kunde(Vorname, Nachname, Adresse, Postleitzahl, Ort, Email, Telefonnummer, Geburtsdatum, Geschlecht) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $statement->bind_param("sssssssss", $firstname, $lastname, $adress, $zip, $location, $email, $phone, $birthdate, $gender);
    
    
    if ($statement->execute()) {

        $kundeId = $conn->insert_id;
        $randomPassword = random_string(15);
        $randomPasswordHashed = password_hash($randomPassword, PASSWORD_DEFAULT);
        $randomContract = random_contract(10);

        
        $stmt = $conn->prepare("INSERT INTO account (KundeId, Vertragsnummer, Passwort) VALUES(?, ?, ?)");
        $stmt->bind_param("iss", $kundeId, $randomContract, $randomPasswordHashed);
        $stmt->execute();
        
        send_mail($email, "$firstname $lastname", $randomContract, $randomPassword);

        print_success_raw("Konto erstellt! Bitte überprüfen Sie Ihre Mail.");
    } else {
        print_danger_raw("Ihr Konto konnte nicht erstellt werden.");
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
    
      <div class="container justify-content-between w-35">
    
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
      
    
    </body>
    
    </html>
    ';
  
    $mail->MsgHTML($content); 
    $mail->Send();
  }
  

?>