<?php

// connects database
$conn = mysqli_connect('localhost', 'root', '', 'senac_ativos');

if (!$conn) {
    echo "Connection failed!";
    exit();
}