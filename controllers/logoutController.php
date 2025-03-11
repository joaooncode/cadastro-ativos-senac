<?php

session_start();

if ($_SESSION['login_ok'] == true && $_SESSION['login_controle'] == true) {
    session_unset();
    session_destroy();
    echo "<script>
    alert('Você saiu da sessão')
    window.location.href='../view/index.php';
  </script>";
    /*  header('location:../view/index.php'); */

    exit();
}