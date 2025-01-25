<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);

include('../models/connect_db.php');
include('sessionController.php');
$tipo = $_POST['tipo'];
$user = $_SESSION['user_id'];
$acao = $_POST['acao'];
$idTipo = $_POST['idTipo'];
//$statusAtivo = $_POST['status'];

if ($acao == 'inserir') {
  $query = "
        insert into tipo (
                              descricaoTipo,
                               
                              dataCadastroTipo,
                              idUsuario
                            )values(
                              '" . $tipo . "',
                              NOW(),
                              '" . $user . "'
                            )

        ";
  $result = mysqli_query($conn, $query) or die(false);
  if ($result) {
    echo "cadastro realizado";
  }
}
if ($acao == 'alterar_status') {
  $sql = "
    Update ativo set statusTipo ='$statusTipo' where idTipo=$idTipo
  ";
  $result = mysqli_query($conn, $sql) or die(false);
  if ($result) {
    echo "Status Alterado";
  }
}

if ($acao == 'get_info') {
  $sql = "
    Select
      descricaoTipo,
      idTipo
    from
      tipo
    where
      idTipo = $idTipo
  ";
  $result = mysqli_query($conn, $sql) or die(false);
  $ativo = $result->fetch_all(MYSQLI_ASSOC);
  echo json_encode($ativo);
  exit();

}

if ($acao == 'update') {
  $sql = "
    update tipo set
      descricaoTipo='$tipo'
     
    where idTipo = $idTipo
  ";
  // echo $sql;
  $result = mysqli_query($conn, $sql) or die(false);
  if ($result) {
    echo "Informações Alteradas";
  }
}




?>