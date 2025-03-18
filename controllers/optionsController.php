<?php

include_once("./sessionController.php");
include_once("../models/connect_db.php");
include_once("./options.php");
$acao = $_POST['acao'];

$options = new Option();

if($acao == 'inserir')
{
    $result = $options->insert($conn, $level, $description, $url, $user_id);
} 
if ($acao == 'update') 
{
    $result = $options->update($conn, $level, $description, $url)
} 
if ($acao == 'delete') 
{
    $result = $options->delete($conn, $idOption)
} 
if ($acao == 'get_info') 
{
    $result = $options->get_info($conn, $idOption)
} 
if ($acao == 'change_status') 
{
    $result = $options->change_status($conn, $idOption, $staus)
}

echo $result

