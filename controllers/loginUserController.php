<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /view/index.php");
    exit();
}

// Include database connection
include('../models/connect_db.php');
include('../view/headView.php');

session_start();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    // Check if fields are filled
    if (empty($email) || empty($password)) {
        echo "<script>
                // Incluir SweetAlert2 (adicione isso no head do seu HTML também)
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Atenção!',
                        text: 'Por favor, preencha todos os campos!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        window.location.href='../view/login.php';
                    });
                });
              </script>";
        exit();
    }

    // Query database to check if email exists
    $query = "SELECT idUsuario, senhaUsuario, isAdmin FROM usuario WHERE emailUsuario = ?";
    $stmt = $conn->prepare($query);
    
    if ($stmt === false) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Erro ao preparar a consulta',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        window.location.href='../view/login.php';
                    });
                });
              </script>";
        exit();
    }

    // Bind parameter
    $stmt->bind_param("s", $email);
    
    // Execute query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        // Get user data
        $user = $result->fetch_assoc();

        // Verify password - use password_verify if you're storing hashed passwords (recommended)
        // For bcrypt: if (password_verify($password, $user['senhaUsuario'])) {
        
        // If you're using base64 encoding (not recommended for production):
        if (base64_encode($password) === $user['senhaUsuario']) {
            // Start session and store user ID
            $_SESSION['user_id'] = $user['idUsuario'];
            $_SESSION['login_ok'] = true;
            $_SESSION['login_controle'] = true;

            // Check if user is admin
            if ($user['isAdmin'] == 'S') {
                $_SESSION['is_admin'] = 'S'; // Set session variable for admin
                // Redirect to admin page
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Sucesso!',
                                text: 'Login bem-sucedido! Você é um administrador.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                window.location.href='../view/registerAssetsView.php';
                            });
                        });
                      </script>";
            } else {
                // Redirect to default page
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Sucesso!',
                                text: 'Login bem-sucedido!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                window.location.href='../view/registerAssetsView.php';
                            });
                        });
                      </script>";
            }
        } else {
            $_SESSION['login_ok'] = false;
            unset($_SESSION['login_controle']);
            echo "<script>
                    window.location.href='/view/index.php?error_auten=yes';
                  </script>";
        }
    } else {
        $_SESSION['login_ok'] = false;
        unset($_SESSION['login_controle']);
        echo "<script>
                window.location.href='/view/index.php?error_auten=yes';
              </script>";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>