<?php
// Incluir a conexão com o banco de dados
include('../models/connect_db.php');

session_start();

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obter dados do formulário
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $crip = base64_encode($password);
    // Verificar se os campos foram preenchidos
    if (empty($email) || empty($password)) {
        echo "<script>
                alert('Por favor, preencha todos os campos!');
                window.location.href='../view/login.php';
              </script>";
        exit();
    }

    // Consultar o banco de dados para verificar se o email existe
    $query = "SELECT COUNT('*') as quantidade, idUsuario, senhaUsuario, isAdmin FROM usuario WHERE emailUsuario = ? AND senhaUsuario =?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        echo "<script>
                alert('Erro ao preparar a consulta');
                window.location.href='../view/login.php';
              </script>";
        exit();
    }

    // Vincular o parâmetro
    $stmt->bind_param("ss", $email, $crip);

    // Executar a consulta
    $stmt->execute();
    $result = $stmt->get_result();



    // Verificar se o usuário existe
    if ($result->num_rows > 0) {
        // Obter os dados do usuário
        $user = $result->fetch_assoc();


        // Verificar se a senha fornecida corresponde ao hash bcrypt armazenado
        if ($user['quantidade'] > 0) {
            // Iniciar a sessão e armazenar o ID do usuário
            $_SESSION['user_id'] = $user['idUsuario'];
            $_SESSION['login_ok'] = true;
            $_SESSION['login_controle'] = true;

            // Verificar se o usuário é um admin
            if ($user['isAdmin'] == 'S') {
                $_SESSION['is_admin'] = 'S'; // Definir uma variável de sessão para o admin
                // Redirecionar para a página de administração
                echo "<script>
                        alert('Login bem-sucedido! Você é um administrador.');
                        window.location.href='../view/registerAssetsView.php';
                      </script>";
            } else {
                // Redirecionar para a página padrão
                echo "<script>
                        alert('Login bem-sucedido!');
                        window.location.href='../view/listUsersView.php';
                      </script>";
            }
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