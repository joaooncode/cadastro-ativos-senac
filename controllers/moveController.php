<?php


session_status();

date_default_timezone_set('America/Sao_Paulo');
include('../models/connect_db.php');


ini_set('display_errors', 1);


$ativo = $_POST['ativo'];
$tipo = $_POST['tipoMovimentacao'];
$quantidade = $_POST['quantidade'];
$origem = $_POST['localOrigem'];
$destino = $_POST['localDestino'];
$descricao = $_POST['descricaoMovimentacao'];
$usuario = $_POST['user_id'];

$quantidadeMov = $_POST['quantidadeMovimentacao'];

$totalQuery = "SELECT quantidadeAtivo FROM ativo WHERE idAtivo=$ativo";

$resultadoQueryTotal = mysqli_query($conn, $totalAtivo) or die(false);

$total = $resultadoQueryTotal->fetch_assoc();

$qtdTotalAtivo = $total['quantidadeAtivo'];

// Realiza busca no banco de dados
$qtdUsoQuery = "SELECT COALESCE(quantidadeUso, 0) as quantidadeUso FROM movimentacao WHERE idAtivo=$ativo and statusMovimentacao='S'";


$qtdUsoQueryResult = mysqli_query($conn, $qtdUsoQuery) or die(false);

$ativoUso = $qtdUsoQueryResult->fetch_assoc();
$qtdUso = $ativoUso['quantidadeUso'];

echo $qtdTotal;


if ($tipoMov == 'adicionar') {
    $total = $qtdUso + $quantidadeMov;
    if ($total < $qtdTotalAtivo) {
        echo "Erro! Quantidade de ativos em uso + quantidade selecionada ultrpassa o total de ativos";
    }
}


if ($tipoMov == 'remover') {
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


exit();