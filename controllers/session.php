<?php

session_start();

if ($_SESSION['login_controle'] === false || $_SESSION['login_ok'] === false) {
    header('location:../view/index.php?error=access_denied');
}
