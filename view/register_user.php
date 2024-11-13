<?php
include('navbar.php');
?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>Cadastrar Usuário</title>
</head>

<body class='min-vh-100 min-vw-100 bg-light overflow-hidden'>
    <h1 class='text-center text-primary h-100'>Cadastrar novo usuário</h1>
    <main class='mx-4 my-4 min-vw-100 min-vh-100 flex-grow-1'>
        <form method="POST" action='../controllers/register_user.php'
            class="d-flex align-items-center  justify-content-center min-vw-100 min-vh-100 my-5">
            <!--Nome do usuário-->
            <div class="form-floating mb-3 w-75">
                <input name="nameUser" type="text" class="form-control mb-4" id="floatingInput"
                    placeholder="Informe seu nome completo" required>
                <label for="floatingInput">Nome completo</label>
                <!--Email do usuário-->
                <div class="form-floating">
                    <input name="emailUser" type="email" class="form-control mb-4" id="floatingEmail"
                        placeholder="Informe seu endereço de email" required>
                    <label for="floatingEmail">Endereço de e-mail</label>
                </div>
                <!--Senha Usuário-->
                <div class="form-floating">
                    <input name="passwordUser" type="password" class="form-control mb-4" id="floatingPassword"
                        placeholder="Insira uma senha" required minlength="8">
                    <label for="floatingPassword">Senha</label>
                </div>
                <!--Confirmar Senha Usuário-->
                <div class="form-floating">
                    <input name="confirmPasswordUser" type="password" class="form-control mb-4"
                        id="floatingPasswordConfirm" placeholder="A senhas devem coincidir" required minlength="8">
                    <label for="floatingPasswordConfirm">Confirmar senha</label>
                </div>
                <!--Turma Usuário-->
                <div class="form-floating">
                    <input name="classUser" type="text" class="form-control mb-4" id="floatingClass"
                        placeholder="Informe sua turma" required>
                    <label for="floatingClass">Turma</label>
                </div>
        </form>
        <button type="submit" class="btn btn-lg btn-outline-primary">Cadastrar</button>
    </main>
    <script src="../js/emailValidation.js"></script>
</body>

</html>