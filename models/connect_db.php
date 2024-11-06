<?php

// connects database
$conn = mysqli_connect('localhost', 'root', '', 'bd_controle_ativo');

if (!$conn) {
    echo "Connection failed!";
    exit();
}