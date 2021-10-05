<?php

$path = substr($_SERVER['SCRIPT_NAME'], 1);
$filename = basename($path, ".php");

?>

<nav class="navbar navbar-expand-lg navbar-dark mt-2">
    <div class="container">

        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link <?php if ($filename === 'index') echo "active"; ?>" href="./">Übersicht</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php if ($filename === 'cards' || $filename === 'payment' || $filename === 'card') echo "active"; ?>" href="./cards">Karten</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php if ($filename === 'transactions') echo "active"; ?>" href="./transactions">Transaktionen</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php if ($filename === 'status') echo "active"; ?>" href="./status">Status</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php if ($filename === 'help') echo "active"; ?>" href="./help">Kontakt</a>
                </li>

            </ul>

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link"><i class="far fa-bell"></i></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link <?php if ($filename === 'profile' || $filename === 'new-card') echo "active"; ?>" href="" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle fs-5"></i>&nbsp; Berfan K.
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="./profile"><i class="fas fa-user fs-6 me-1"></i>&nbsp; Profil</a></li>
                        <li><a class="dropdown-item" href="./new-card"><i class="fas fa-plus fs-6 me-1"></i></i>&nbsp; Karte eröffnen</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="./logout"><i class="fas fa-power-off fs-6 me-1"></i>&nbsp; Abmelden</a></li>
                    </ul>
                </li>
            </ul>


        </div>

    </div>
</nav>