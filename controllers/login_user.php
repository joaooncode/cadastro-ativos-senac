<?php
// Incluir a conexão com o banco de dados
include('../models/connect_db.php');

session_start();


// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obter dados do formulário
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Verificar se os campos foram preenchidos
    if (empty($email) || empty($password)) {
        echo "<script>
                alert('Por favor, preencha todos os campos!');
                window.location.href='../view/login.php';
              </script>";
        exit();
    }

    // Consultar o banco de dados para verificar se o email existe
    $query = "SELECT idUsuario, senhaUsuario FROM usuario WHERE emailUsuario = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        echo "<script>
                alert('Erro ao preparar a consulta');
                window.location.href='../view/login.php';
              </script>";
        exit();
    }

    // Vincular o parâmetro
    $stmt->bind_param("s", $email);

    // Executar a consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se o usuário existe
    if ($result->num_rows > 0) {
        // Obter os dados do usuário
        $user = $result->fetch_assoc();

        // Verificar se a senha fornecida corresponde ao hash bcrypt armazenado
        if (password_verify($password, $user['senhaUsuario'])) {
            // Iniciar a sessão e armazenar o ID do usuário
            $_SESSION['user_id'] = $user['idUsuario'];
            $_SESSION['login_ok'] = true;
            $_SESSION['login_controle'] = true;


            // Redirecionar para a área restrita
            echo "<script>
                    alert('Login bem-sucedido!');
                    window.location.href='../view/list_users.php';
                  </script>";
        } else {
            $_SESSION['login_ok'] = false;
            unset($_SESSION['login_controle']);
            echo "<script>
                    window.location.href='../view/index.php?error_auten=yes';
                  </script>";

        }
    } else {
        $_SESSION['login_ok'] = false;
        unset($_SESSION['login_controle']);
        echo "<script>
                window.location.href='../view/index.php?error_auten=yes';
              </script>";

    }

    // Fechar a declaração
    $stmt->close();
}

// Fechar a conexão
$conn->close();
?>