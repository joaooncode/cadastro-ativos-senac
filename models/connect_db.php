<?php

// connects database
$conn = mysqli_connect('82.25.77.221', 'joao', 'mqfinCZGcE46X*h', 'ativos', 3306);

if (!$conn) {
    echo "Connection failed!";
    exit();
}