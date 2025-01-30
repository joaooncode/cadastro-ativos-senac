<?php


session_status();

date_default_timezone_set('America/Sao_Paulo');
include('../models/connect_db.php');
include_once('sessionController.php');


ini_set('display_errors', 1);


$ativo = $_POST['ativo'];
$tipo = $_POST['tipo'];
$quantidadeMov = $_POST['quantidade'];
$origem = $_POST['origem'];
$destino = $_POST['destino'];
$descricao = $_POST['descricao'];
$usuario = $_SESSION['user_id'];


$totalQuery = "SELECT quantidadeAtivo FROM ativo WHERE idAtivo=$ativo";

$resultadoQueryTotal = mysqli_query($conn, $totalQuery) or die(false);

$total = $resultadoQueryTotal->fetch_assoc();

$qtdTotalAtivo = $total['quantidadeAtivo'];

// Realiza busca no banco de dados
$qtdUsoQuery = "SELECT COALESCE(quantidadeUso, 0) as quantidadeUso FROM movimentacao WHERE idAtivo=$ativo and statusMovimentacao='S'";

$qtdUsoQueryResult = mysqli_query($conn, $qtdUsoQuery) or die(false);

$ativoUso = $qtdUsoQueryResult->fetch_assoc();
$qtdUso = isset($ativoUso['quantidadeUso']) ? $ativoUso['quantidadeUso'] : 0;


if ($tipo == 'entrada') {
    $total = $qtdUso + $quantidadeMov;
    if ($total > $qtdTotalAtivo) {
        echo "Erro! Quantidade de ativos em uso + quantidade selecionada ultrpassa o total de ativos";
        exit();
    }
} elseif ($tipo == 'remover') {
    if ($qtdUso - $quantidadeMov < 0) {
        echo "Não permitido! Quantidade de ativos";
        exit();
    }
    $total = $qtdUso - $quantidadeMov;

} else {
    if ($qtdUso - $quantidadeMov < 0) {
        echo "Não permitido";
        exit();
    }
    $total = $qtdUso;
}



$queryUpdate = "UPDATE movimentacao SET statusMovimentacao='N' WHERE idAtivo=$ativo";
$resultQueryUpdate = mysqli_query($conn, $queryUpdate) or die(false);

$queryInsert = "INSERT into movimentacao (
    idUsuario,
    idAtivo,
    localOrigem,
    localDestino,
    dataHoraMovimentacao,
    descricaoMovimentacao,
    quantidadeUso,
    statusMovimentacao,
    tipoMovimentacao,
    quantidadeMovimentacao
)values(
    '" . $usuario . "',
    '" . $ativo . "',
    '" . $origem . "',
    '" . $destino . "',
    now(),
    '" . $descricao . "',
    '" . $total . "',
    'S',
    '" . $tipo . "',
    '" . $quantidadeMov . "'
) ";


$result = mysqli_query($conn, $queryInsert) or die(false);
if ($result) {
    echo "Sucesso";
} else {
    echo "Erro";
}


exit();