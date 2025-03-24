<?php
global $conn;
ini_set('display_errors', 0);

include_once('../models/connect_db.php');
include_once('sessionController.php');

// Recupera e trata os valores enviados
$description = isset($_POST['description']) ? mysqli_real_escape_string($conn, trim($_POST['description'])) : '';
$quantity = isset($_POST['quantity']) ? intval(trim($_POST['quantity'])) : 0;
$obs = isset($_POST['obs']) ? mysqli_real_escape_string($conn, trim($_POST['obs'])) : '';
$status = isset($_POST['status']) ? mysqli_real_escape_string($conn, substr(trim($_POST['status']), 0, 1)) : ''; // Limita a 1 caractere
$brand = isset($_POST['brand']) ? intval(trim($_POST['brand'])) : 0;
$type = isset($_POST['type']) ? intval(trim($_POST['type'])) : 0;
$user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';
$idAsset = isset($_POST['idAtivo']) ? intval(trim($_POST['idAtivo'])) : 0;
$statusAsset = isset($_POST['status']) ? mysqli_real_escape_string($conn, substr(trim($_POST['status']), 0, 1)) : ''; // Limita a 1 caractere
$quantityMin = isset($_POST['quantityMin']) ? intval(trim($_POST['quantityMin'])) : 0;
$reasonChange = isset($_POST['reasonChange']) ? mysqli_real_escape_string($conn, trim($_POST['reasonChange'])) : '';

// Verificar estrutura da tabela
if ($action == 'insert') {
    // Vamos verificar a estrutura da tabela para entender quais campos são realmente necessários
    $tableInfo = mysqli_query($conn, "DESCRIBE ativo");
    if (!$tableInfo) {
        die("Erro ao verificar estrutura da tabela: " . mysqli_error($conn));
    }
    
    // Listar todas as colunas e seus detalhes
    $columns = [];
    while ($col = mysqli_fetch_assoc($tableInfo)) {
        $columns[$col['Field']] = [
            'nullable' => $col['Null'] === 'YES',
            'default' => $col['Default'],
            'type' => $col['Type']
        ];
    }
    
    // --- Upload da Imagem ---
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/temp/';
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
            $image = '/temp/' . basename($_FILES["imagem_ativo"]["name"]);
        }
    }

    // --- Insere os dados no Banco de Dados usando inserção direta para diagnóstico ---
    // Em vez de usar prepared statement, vamos usar inserção direta para ver exatamente qual campo está causando o erro
    $query = "
        INSERT INTO ativo(
            idMarca,
            idTipo,
            descricaoAtivo,
            statusAtivo,
            quantidadeAtivo,
            obsAtivo,
            dataHoraCadastroAtivo,
            url_imagem,
            quantidadeMinimaAtivo,
            obsAlterarQtd
        ) VALUES (
            $brand,
            $type,
            '" . mysqli_real_escape_string($conn, $description) . "',
            '" . mysqli_real_escape_string($conn, $status) . "',
            $quantity,
            '" . mysqli_real_escape_string($conn, $obs) . "',
            NOW(),
            '" . mysqli_real_escape_string($conn, $image ? $image : '') . "',
            $quantityMin,
            '" . mysqli_real_escape_string($conn, $reasonChange) . "'
        )
    ";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conn);
        // Verificar se há triggers na tabela que podem estar causando o problema
        $triggers = mysqli_query($conn, "SHOW TRIGGERS WHERE `Table` = 'ativo'");
        if ($triggers& & mysqli_num_rows($triggers) > 0) {
            echo "<br>Triggers encontrados nesta tabela:";
            while ($trigger = mysqli_fetch_assoc($triggers)) {
                echo "<br>- " . $trigger['Trigger'] . " (" . $trigger['Timing'] . " " . $trigger['Event'] . ")";
            }
        }
    }
    
} elseif ($action == 'changeStatus') {

    $sql = "UPDATE ativo SET statusAtivo = '" . mysqli_real_escape_string($conn, $statusAsset) . "' WHERE idAtivo = $idAsset";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Status Alterado";
    } else {
        echo "Erro ao alterar status: " . mysqli_error($conn);
    }
    
} elseif ($action == 'getInfo') {

    $sql = "
        SELECT   
            idMarca,
            idTipo,
            descricaoAtivo,
            quantidadeAtivo,
            obsAtivo,
            url_imagem,
            quantidadeMinimaAtivo,
            obsAlterarQtd
        FROM 
            ativo
        WHERE 
            idAtivo = $idAsset
    ";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Erro ao buscar informações: " . mysqli_error($conn);
        exit();
    }
    
    // Retorna os dados do ativo em formato JSON
    $asset = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($asset);
    exit();
    
} elseif ($action == 'update') {

    // --- Verifica se uma nova imagem foi enviada para atualização ---
    $image = null;
    $has_new_image = false;
    
    if (isset($_FILES["imagem_ativo"]) && $_FILES["imagem_ativo"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/temp/';
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES["imagem_ativo"]["name"]);
        if (move_uploaded_file($_FILES["imagem_ativo"]["tmp_name"], $target_file)) {
            $image = '/temp/' . basename($_FILES["imagem_ativo"]["name"]);
            $has_new_image = true;
        }
    }

    // --- Atualiza os dados do ativo ---
    $sql = "
        UPDATE ativo SET 
            descricaoAtivo = '" . mysqli_real_escape_string($conn, $description) . "',
            quantidadeAtivo = $quantity,
            obsAtivo = '" . mysqli_real_escape_string($conn, $obs) . "',
            idMarca = $brand,
            idTipo = $type,
            quantidadeMinimaAtivo = $quantityMin
    ";
    
    if ($has_new_image) {
        $sql .= ", url_imagem = '" . mysqli_real_escape_string($conn, $image) . "'";
    }
    
    $sql .= " WHERE idAtivo = $idAsset";
    
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Informações alteradas";
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conn);
    }
    
} elseif ($action == 'delete') {

    $sql = "DELETE FROM ativo WHERE idAtivo = $idAsset";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Ativo deletado com sucesso!";
    } else {
        echo "Erro ao deletar o ativo: " . mysqli_error($conn);
    }
    exit();
}