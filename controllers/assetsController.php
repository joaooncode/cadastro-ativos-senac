<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);

include_once('../models/connect_db.php');
include_once('sessionController.php');

$description = $_POST['description'];
$quantity = $_POST['quantity'];
$obs = $_POST['obs'];
$status = $_POST['status'];
$brand = $_POST['brand'];
$type = $_POST['type'];
$user = $_SESSION['user_id'];
$action = $_POST['action'];
$idAsset = $_POST['idAtivo'];
$statusAsset = $_POST['status'];
// $img = $_FILES['imagem_ativo']; // Não usaremos o array completo, apenas os dados processados

if ($action == 'insert') {

    // --- Upload da Imagem ---
    $target_dir = "../temp/";
    // Verifica se o diretório existe, senão tenta criá-lo
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Define o caminho do arquivo (você pode adicionar lógica para renomear arquivos, se necessário)
    $target_file = $target_dir . basename($_FILES["imagem_ativo"]["name"]);

    // Move o arquivo da pasta temporária para o diretório desejado
    if (move_uploaded_file($_FILES["imagem_ativo"]["tmp_name"], $target_file)) {
        // $image conterá o caminho da imagem que será salvo no banco
        $image = $target_file;
    } else {
        // Em caso de erro no upload, pode definir $image como nulo ou tratar o erro conforme necessário
        $image = null;
    }

    // --- Inserção no Banco ---
    // Atenção: Corrigimos a query para incluir vírgulas entre os campos e usar NOW() corretamente.
    $query = "
        INSERT INTO ativo(
            idMarca,
            idTipo,
            descricaoAtivo,
            statusAtivo,
            quantidadeAtivo,
            obsAtivo,
            dataHoraCadastroAtivo,
            url_imagem
        ) VALUES (
            '$brand',
            '$type',
            '$description',
            '$status',
            '$quantity',
            '$obs',
            NOW(),
            '$image'
        )
    ";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if ($result) {
        echo "Cadastro realizado com sucesso!";
    }
}

if ($action == 'changeStatus') {
    $sql = "
        UPDATE ativo 
        SET statusAtivo = '$statusAsset' 
        WHERE idAtivo = '$idAsset'
    ";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($result) {
        echo "Status Alterado";
    }
}

if ($action == 'getInfo') {
    $sql = "
        SELECT   
            idMarca,
            idTipo,
            descricaoAtivo,
            quantidadeAtivo,
            obsAtivo
        FROM 
            ativo
        WHERE 
            idAtivo = $idAsset
    ";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Retorna os dados do ativo em formato JSON
    $asset = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($asset);
    exit();
}

if ($action == 'update') {
    $sql = "
        UPDATE ativo SET 
            descricaoAtivo = '$description',
            quantidadeAtivo = '$quantity',
            obsAtivo = '$obs',
            idMarca = '$brand',
            idTipo = '$type'
        WHERE idAtivo = $idAsset
    ";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($result) {
        echo "Informações alteradas";
    }
}


if ($action == 'delete') {
    // Recupera o ID do ativo a ser deletado
    $idAsset = $_POST['idAtivo'];

    // Query para deletar o ativo
    $sql = "DELETE FROM ativo WHERE idAtivo = '$idAsset'";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($result) {
        echo "Ativo deletado com sucesso!";
    } else {
        echo "Erro ao deletar o ativo.";
    }
    exit();
}
?>