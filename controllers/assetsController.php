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
$img = $_FILES['imagem_ativo'];


var_dump($img);
exit;

if ($action == 'insert') {

    $query = "
INSERT INTO ativo(
    idMarca,
    idTipo,
    descricaoAtivo,
    statusAtivo,
    quantidadeAtivo,
    obsAtivo,
    dataHoraCadastroAtivo
    imagem_url 
) values(
    '" . $brand . "',
    '" . $type . "',
    '" . $description . "',
    '" . $status . "',
    '" . $quantity . "',
    '" . $obs . "',
    '" . $img . "'
    NOW()
)
";
    $image = '';

    $target_dir = "../temp/";
    $target_file = $target_dir . basename($_FILES["imagem_ativo"]["name"]);
    move_uploaded_file($_FILES["imagem_ativo"]["tmp_name"], $target_file);
    $image = $target_file; // Agora a variável $image tem o caminho da imagem


    $result = mysqli_query($conn, $query) or die(false);

    if ($result) {
        # code...
        echo "Cadastro realizado com sucesso!";
    }
}
;

if ($action == 'changeStatus') {
    $sql = "
        UPDATE ativo SET statusAtivo = '$statusAsset' WHERE idAtivo = '$idAsset'
    ";
    echo "$sql";
    $result = mysqli_query($conn, $sql) or die(false);

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

    $result = mysqli_query($conn, $sql) or die(false);

    //retorna todos os ativos

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
        idTipo = $type

        where idAtivo = $idAsset
";

    $result = mysqli_query($conn, $sql) or die(false);

    if ($result) {
        echo "Informações alteradas";
    }



}