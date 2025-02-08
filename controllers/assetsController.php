<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);

include_once('../models/connect_db.php');
include_once('sessionController.php');

// Retrieve and trim input values
$description = trim($_POST['description'] ?? '');
$quantity = trim($_POST['quantity'] ?? '');
$obs = trim($_POST['obs'] ?? '');
$status = trim($_POST['status'] ?? '');
$brand = trim($_POST['brand'] ?? '');
$type = trim($_POST['type'] ?? '');
$user = $_SESSION['user_id'] ?? '';
$action = $_POST['action'] ?? '';
$idAsset = trim($_POST['idAtivo'] ?? '');
$statusAsset = trim($_POST['status'] ?? '');

// Validate required fields based on action
switch ($action) {
    case "insert":
        if (empty($description) || empty($quantity) || empty($status) || empty($brand) || empty($type)) {
            echo "Por favor, preencha todos os campos obrigatórios para inserir.";
            exit();
        }
        break;
    case "update":
        if (empty($idAsset) || empty($description) || empty($quantity) || empty($status) || empty($brand) || empty($type)) {
            echo "Por favor, preencha todos os campos obrigatórios para atualizar.";
            exit();
        }
        break;
    case "changeStatus":
        if (empty($idAsset) || empty($statusAsset)) {
            echo "ID do ativo e status são obrigatórios para alterar o status.";
            exit();
        }
        break;
    case "getInfo":
        if (empty($idAsset)) {
            echo "ID do ativo é obrigatório para buscar informações.";
            exit();
        }
        break;
    case "delete":
        if (empty($idAsset)) {
            echo "ID do ativo é obrigatório para deletar.";
            exit();
        }
        break;
    default:
        echo "Ação inválida.";
        exit();
}

// Process actions based on the value of $action

if ($action == 'insert') {

    // --- Upload da Imagem ---
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . 'cadastro-ativos-senac/temp/';

    // Create the directory if it doesn't exist
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Define the file path (you can add renaming logic if needed)
    $target_file = $target_dir . basename($_FILES["imagem_ativo"]["name"]);

    // Move the file from temporary directory to the target directory
    if (move_uploaded_file($_FILES["imagem_ativo"]["tmp_name"], $target_file)) {
        $image = 'cadastro-ativos-senac/temp/' . basename($_FILES["imagem_ativo"]["name"]);
    } else {
        $image = null;
    }

    // --- Insert into Database ---
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
    $sql = "UPDATE ativo SET statusAtivo = '$statusAsset' WHERE idAtivo = '$idAsset'";
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
            obsAtivo,
            url_imagem
        FROM 
            ativo
        WHERE 
            idAtivo = $idAsset
    ";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Return the asset data as JSON
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
            idTipo = '$type',
        WHERE idAtivo = $idAsset
    ";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($result) {
        echo "Informações alteradas";
    }
}

if ($action == 'delete') {
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