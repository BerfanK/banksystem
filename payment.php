<?php

if (!isset($_GET["action"])) {
    header("Location: ./cards");
    die();
}

$action = $_GET["action"];

$titleHtml = "Neue Zahlung";
$descriptionHtml = "Erteilen Sie eine neue Zahlung.";

if ($action === 'exchange') {
    $titleHtml = "Kontoübertrag";
    $descriptionHtml = "Senden Sie Geld an ein anderes Konto.";
}

$cardId = $_GET["id"];

?>

<!doctype html>
<html lang="en">

    <?php include_once "components/head.php"; ?>

    <body>
        <?php include_once "components/navbar.php"; ?>

        <div class="container my-5">

            <div class="page-title"><?=$titleHtml?></div>
            <div class="page-description"><?=$descriptionHtml?></div>
            <hr class="page-divider">

            <a href="./payment?action=new" class="link">Neue Zahlung</a>
            <a href="./card?id=4" class="link">Transaktionen</a>
            <a href="./payment?action=exchange" class="link">Kontoübertrag</a>

            <div class="profile-title" style="margin-top: 2rem;">Formular ausfüllen</div>

            <?php if ($action === 'new') include_once "components/new-payment.php"; ?>
            <?php if ($action === 'exchange') include_once "components/exchange-payment.php"; ?>


        </div>

        <?php include_once "components/scripts.php"; ?>
    </body>

</html>
