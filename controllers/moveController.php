<?php


session_status();

date_default_timezone_set('America/Sao_Paulo');
include('../models/connect_db.php');


ini_set('display_errors', 0);


$ativo = $_POST['ativo'];
$tipo = $_POST['tipoMovimentacao'];
$quantidade = $_POST['quantidade'];
$origem = $_POST['localOrigem'];
$destino = $_POST['localDestino'];
$descricao = $_POST['descricaoMovimentacao'];
$usuario = $_POST['user_id'];