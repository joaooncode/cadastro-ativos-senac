<?php


$json_data = file_get_contents('php://input');

$data = json_decode($json_data, true);

$user = $_SESSION['id_user'];

$sql = "SELECT
        id_cargo,
        id_opcao,
        id_acesso,
        status_acesso
    FROM acesso WHERE id_cargo = '$cargo'";




$arr_selecionados = [];

foreach ($data['acessos'] as $getAcesso) {
    $arr_selecionados[$getAcesso['id__opcao']] = $getAcesso;
}

$sql = '';

if (!empty($acessos)) {
    foreach ($acessos as $acesso_bd) {
        if (array_key_exists($acesso_bd['id_opcao'], $arr_selecionados)) {
            $sql .= "UPDATE acesso SET status_acesso='" . $arr_selecionados[$acesso_bd['id_opcao']] . "' WHERE id_acesso='" . $acesso_bd['id_acesso'] . "';";
        } else {
            $sql .= "UPDATE acesso set status_acesso='N' WHERE id_acesso = '" . $acesso_bd['id_acesso'] . "'; ";
        }
        unset($arr_selecionados[$acesso['id_opcao']]);
        ;
    }
}

foreach ($arr_selecionados as $id_opcao => $value) {
    $sql .= "INSERT INTO acesso (id_cargo, id_opcao, status_acesso, data_cadastro, idUsuario)
     VALUES (
     '" . $cargo . "',
     '" . $id_opcao . "', 
     '" . $value . "', 
     NOW(),
     '" . $user . "'
     );";
}


$sql = substr($sql, 0, -2);

$resul = mysqli_multi_query($conn, $sql) or die(false);

if ($result) {
    echo json_encode('Cadastro realizado');
    exit;
}

if ($acao == '') {
    $sql = "SELECT id_cargo, id_opcao, id_acesso, status_acesso FROM acesso WHERE id_cargo = '$cargo'";
    $result = mysqli_query($conn, $sql) or die(false);

    $acessos = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($acessos);

    exit();
}