<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);

include_once('../models/connect_db.php');
include_once('sessionController.php');

// Recupera e trata os valores enviados
$description = trim($_POST['description'] ?? '');
$quantity = trim($_POST['quantity'] ?? '');
$obs = trim($_POST['obs'] ?? '');
$status = trim($_POST['status'] ?? '');
$brand = trim($_POST['brand'] ?? '');
$type = trim($_POST['type'] ?? '');
$user = $_SESSION['user_id'] ?? '';
$action = $_POST['action'] ?? '';
$idAsset = trim($_POST['idAtivo'] ?? '');
// Para a ação changeStatus usamos o mesmo campo "status" (mas poderia ser distinto)
$statusAsset = trim($_POST['status'] ?? '');

// Processa a ação solicitada
if ($action == 'insert') {

    // --- Upload da Imagem ---
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/cadastro-ativos-senac/temp/';
    // Cria o diretório caso não exista
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $image = null;
    if (isset($_FILES["imagem_ativo"]) && $_FILES["imagem_ativo"]["error"] == UPLOAD_ERR_OK) {
        // Define o caminho do arquivo (você pode adicionar lógica para renomear o arquivo, se necessário)
        $target_file = $target_dir . basename($_FILES["imagem_ativo"]["name"]);
        // Move o arquivo da pasta temporária para o diretório de destino
        if (move_uploaded_file($_FILES["imagem_ativo"]["tmp_name"], $target_file)) {
            $image = 'cadastro-ativos-senac/temp/' . basename($_FILES["imagem_ativo"]["name"]);
        }
    }

    // --- Insere os dados no Banco de Dados ---
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

} elseif ($action == 'changeStatus') {

    $sql = "UPDATE ativo SET statusAtivo = '$statusAsset' WHERE idAtivo = '$idAsset'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if ($result) {
        echo "Status Alterado";
    }

} elseif ($action == 'getInfo') {

    $sql = "
        SELECT   
            idMarca,
            idTipo,
            descricaoAtivo,
            quantidadeAtivo,
            obsAtivo,
            url_imagem
        FROM 
            ativo
        WHERE 
            idAtivo = '$idAsset'
    ";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    // Retorna os dados do ativo em formato JSON
    $asset = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($asset);
    exit();

} elseif ($action == 'update') {

    // --- Verifica se uma nova imagem foi enviada para atualização ---
    $image_sql = "";
    if (isset($_FILES["imagem_ativo"]) && $_FILES["imagem_ativo"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/cadastro-ativos-senac/temp/';
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES["imagem_ativo"]["name"]);
        if (move_uploaded_file($_FILES["imagem_ativo"]["tmp_name"], $target_file)) {
            $image = 'cadastro-ativos-senac/temp/' . basename($_FILES["imagem_ativo"]["name"]);
            // Prepara a parte do SQL para atualizar a imagem
            $image_sql = ", url_imagem = '$image'";
        }
    }

    // --- Atualiza os dados do ativo ---
    $sql = "
        UPDATE ativo SET 
            descricaoAtivo = '$description',
            quantidadeAtivo = '$quantity',
            obsAtivo = '$obs',
            idMarca = '$brand',
            idTipo = '$type'
            $image_sql
        WHERE idAtivo = '$idAsset'
    ";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if ($result) {
        echo "Informações alteradas";
    }

} elseif ($action == 'delete') {

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