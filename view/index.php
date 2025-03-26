<?php
session_start();

if (isset($_GET['error']) && $_GET['error'] === 'access_denied') {
  echo "<script>alert('Usuário não autenticado');</script>";
}

if (isset($_GET['error_auten']) && $_GET['error_auten'] == 'yes') {
  echo "<script>alert('Senha e/ou email inválidos');</script>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Ativos</title>
  <!-- Inclua aqui os seus links de CSS, meta tags, etc. -->
  <?php include('headView.php'); ?>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
  <main class="flex-grow-1 d-flex align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="text-center mb-5">
            <h1 class="text-primary display-5 mb-4">Login usuário</h1>
          </div>
          
          <!-- Login Form -->
          <form class="bg-white p-4 rounded-4 shadow" 
                action="/controllers/loginUserController.php" 
                method="POST">
            <div class="mb-4">
              <div class="form-floating">
                <input name="email" type="email" 
                       class="form-control form-control-lg" 
                       id="floatingInput" 
                       placeholder="name@example.com" 
                       required>
                <label for="floatingInput">Endereço de e-mail</label>
                <div id="email-feedback" class="invalid-feedback">
                  Por favor, insira um e-mail válido.
                </div>
              </div>
            </div>

            <div class="mb-4">
              <div class="form-floating">
                <input name="password" type="password" 
                       class="form-control form-control-lg" 
                       id="floatingPassword" 
                       placeholder="Password" 
                       required>
                <label for="floatingPassword">Senha</label>
              </div>
            </div>

            <div class="d-grid gap-3">
              <button type="submit" 
                      class="btn btn-primary btn-lg py-3">
                Entrar
              </button>
              
              <div class="text-center mt-3">
                <a href="/view/registerUserView.php" 
                   class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                  Cadastrar novo usuário?
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <script src="../js/emailValidation.js"></script>
</body>
</html>
