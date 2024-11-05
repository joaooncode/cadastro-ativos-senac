<!doctype html>
<html lang="pt-br">

<head>
    <title>Cadastrar Usuário</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!--Link CSS-->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class='min-vh-100 min-vw-100 overflow-hidden  bg-light'>
    <header>
        <!-- place navbar here -->
    </header>
    <h1 class='text-center h-100 my-5'>Cadastar novo usuário</h1>
    <main class='mx-4 my-4 min-vw-100 min-vh-100 flex-grow-1'>
        <form action='' class="d-flex align-items-center justify-content-center w-100 h-100 my-5">
            <!--Nome do usuário-->
            <div class="form-floating mb-3 w-75">
                <input type="text" class="form-control mb-4" id="floatingInput" placeholder="Informe seu nome completo"
                    required>
                <label for="floatingInput">Nome completo</label>
                <!--Email do usuário-->
                <div class="form-floating">
                    <input type="email" class="form-control mb-4" id="floatingEmail"
                        placeholder="Informe seu endereço de email" required>
                    <label for="floatingEmail">Endereço de email</label>
                </div>
                <!--Senha Usuário-->
                <div class="form-floating">
                    <input type="password" class="form-control mb-4" id="floatingPassword"
                        placeholder="Insira uma senha" required minlength="8">
                    <label for="floatingPassword">Senha</label>
                </div>
                <!--Confirmar Senha Usuário-->
                <div class="form-floating">
                    <input type="password" class="form-control mb-4" id="floatingPasswordConfirm"
                        placeholder="A senhas devem coincidir" required minlength="8">
                    <label for="floatingPasswordConfirm">Confirmar senha</label>
                </div>
                <!--Turma Usuário-->
                <div class="form-floating">
                    <input type="text" class="form-control mb-4" id="floatingClass" placeholder="Informe sua turma"
                        required>
                    <label for="floatingClass">Turma</label>
                </div>
        </form>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </main>
    <!--Footer-->
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>