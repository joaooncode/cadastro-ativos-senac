<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);

include('../models/connect_db.php');
include('session.php');
$marca = $_POST['marca'];
$user = $_SESSION['user_id'];
$acao = $_POST['acao'];
$idMarca = $_POST['idMarca'];
//$statusAtivo = $_POST['status'];

if ($acao == 'inserir') {
  $query = "
        insert into marca (
                              descricaoMarca,
                               
                              dataCadastroMarca,
                              idUsuario
                            )values(
                              '" . $marca . "',
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
    Update ativo set statusAtivo ='$statusAtivo' where idAtivo=$idAtivo
  ";
  $result = mysqli_query($conn, $sql) or die(false);
  if ($result) {
    echo "Status Alterado";
  }
}

if ($acao == 'get_info') {
  $sql = "
    Select
      descricaoAtivo,
      quantidadeAtivo,
      observacaoAtivo,
      idMarca,
      idTipo
    from
      ativo
    where
      idAtivo = $idAtivo
  ";
  $result = mysqli_query($conn, $sql) or die(false);
  $ativo = $result->fetch_all(MYSQLI_ASSOC);
  echo json_encode($ativo);
  exit();

}

if ($acao == 'update') {
  $sql = "
    Update ativo set
      descricaoAtivo='$ativo',
      idMarca = '$marca',
      idTipo  ='$tipo',
      quantidadeAtivo = '$quantidade',
      observacaoAtivo = '$observacao'

    where idAtivo = $idAtivo
  ";
  // echo $sql;
  $result = mysqli_query($conn, $sql) or die(false);
  if ($result) {
    echo "Informações Alteradas";
  }
}




?>