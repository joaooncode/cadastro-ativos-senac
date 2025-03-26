<?php
// include('dropdownView.php');
include('headView.php');
?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>Cadastrar Usuário</title>
</head>
<body class="bg-light">
    <div class="container min-vh-100 d-flex flex-column justify-content-center">
        <h1 class="text-primary text-center mb-4">Cadastrar novo usuário</h1>
        
        <main class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <form method="POST" action='../controllers/registerUserController.php' class="bg-white p-4 rounded-3 shadow">
                    <!-- Nome do usuário -->
                    <div class="form-floating mb-3">
                        <input name="nameUser" type="text" class="form-control" 
                               id="floatingInput" placeholder="Informe seu nome completo" required>
                        <label for="floatingInput">Nome completo</label>
                    </div>

                    <!-- Email do usuário -->
                    <div class="form-floating mb-3">
                        <input name="emailUser" type="email" class="form-control" 
                               id="floatingEmail" placeholder="Informe seu endereço de email" required>
                        <label for="floatingEmail">Endereço de e-mail</label>
                    </div>

                    <!-- Senha e Confirmação -->
                    <div class="row g-2 mb-3">
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input name="passwordUser" type="password" class="form-control" 
                                       id="floatingPassword" placeholder="Insira uma senha" required minlength="8">
                                <label for="floatingPassword">Senha</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input name="confirmPasswordUser" type="password" class="form-control" 
                                       id="floatingPasswordConfirm" placeholder="A senhas devem coincidir" required minlength="8">
                                <label for="floatingPasswordConfirm">Confirmar senha</label>
                            </div>
                        </div>
                    </div>

                    <!-- Turma Usuário -->
                    <div class="form-floating mb-4">
                        <input name="classUser" type="text" class="form-control" 
                               id="floatingClass" placeholder="Informe sua turma" required>
                        <label for="floatingClass">Turma</label>
                    </div>

                    <!-- Botões -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="javascript:history.back()" class="btn btn-outline-secondary">Voltar</a>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="../js/emailValidation.js"></script>
    <script src="../js/password.js"></script>
</body>

</html>