<?php

include_once("./sessionController.php");
include_once("../models/connect_db.php");
include_once("./options.php");

// Get the action from POST
$acao = $_POST['acao'];

// Initialize the Options class
$options = new Option();

// Get other parameters from POST
$level = isset($_POST['level']) ? $_POST['level'] : null;
$description = isset($_POST['description']) ? $_POST['description'] : null;
$url = isset($_POST['url']) ? $_POST['url'] : null;
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
$idOption = isset($_POST['idOption']) ? $_POST['idOption'] : null;
$status = isset($_POST['status']) ? $_POST['status'] : null;

// Perform the requested action
if ($acao == 'inserir') {
    $result = $options->insert($conn, $level, $description, $url, $user_id);
} else if ($acao == 'update') {
    $result = $options->update($conn, $level, $description, $url);
} else if ($acao == 'delete') {
    $result = $options->delete($conn, $idOption);
} else if ($acao == 'get_info') {
    $result = $options->get_info($conn, $idOption);
} else if ($acao == 'change_status') {
    $result = $options->change_status($conn, $idOption, $status);
} else {
    $result = "Invalid action";
}

echo $result;
