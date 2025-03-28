<?php
include('../models/connect_db.php');


$nome = $_POST['nomeUsuario'];
$turma = $_POST['turmaUsuario'];

$id = $_POST['idUsuario'];
$cargo = $_POST['id_cargo'];

$sql_query = "
    UPDATE usuario 
    SET 
        nomeUsuario='$nome', 
        turmaUsuario='$turma',
        id_cargo='$cargo'
    WHERE 
        idUsuario='$id' 
";


$result = mysqli_query($conn, $sql_query) or die(false);


if ($result) {
    echo "<script>
    alert('Usuário alterado!');
    window.location.href='../view/listUsersView.php'
    </script>";

} else {
    echo "<script>
    alert('Falha ao alterar usuário');
    window.location.href='../view/register_users.php?idUsuario=$id'
    </script>";
}
