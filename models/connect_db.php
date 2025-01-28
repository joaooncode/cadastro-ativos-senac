<?php

// connects database
$conn = mysqli_connect('localhost', 'root', '', 'ativos');

if (!$conn) {
    echo "Connection failed!";
    exit();
}