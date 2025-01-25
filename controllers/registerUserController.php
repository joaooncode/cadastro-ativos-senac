<?php
include('../models/connect_db.php');

// form inputs
$name = $_POST['nameUser'];
$email = $_POST['emailUser'];
$passwd = $_POST['passwordUser'];
$passwdConfirm = $_POST['confirmPasswordUser'];
$class = $_POST['classUser'];

// checks password confirm
if ($passwd !== $passwdConfirm) {
    echo "<script>
            alert('Senhas precisam ser iguais')
            window.location.href='../view/registerUserController.php'
    </script>";
    exit();
}



$passwd_hash = password_hash($passwd, PASSWORD_BCRYPT);


$query = "
    INSERT INTO usuario (
        nomeUsuario,
        emailUsuario,
        senhaUsuario,
        turmaUsuario,
        dataCriacaoUsuario
      )values(
        '" . $name . "',
        '" . $email . "',
        '" . $passwd_hash . "',
        '" . $class . "',
        NOW()
      )
";


$result = mysqli_query($conn, $query) or die(false);

// redirects user
if ($result) {
    echo "<script>
    alert('Usuário cadastrado!');
    window.location.href='../view/listUsersView.php'
    </script>";

} else {
    echo "<script>
    alert('Falha no cadastro');
    window.location.href='../view/register_users.php'
    </script>";
}