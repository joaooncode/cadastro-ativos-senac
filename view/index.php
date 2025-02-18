<?php
session_start();
if (isset($_GET['error']) && $_GET['error'] === 'access_denied') {
  echo "<script> 
      alert('Usuário não autenticado')
  </script>";
}

if (isset($_GET['error_auten']) && $_GET['error_auten'] == 'yes') {
  echo "
  <script>
    alert('Senha e/ou email inválidos') 
  </script>";
}

include('headView.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<title>Cadastro de Ativos</title>


<body class="min-vw-100 min-vh-100">

  <main class="vw-100 vh-100 d-flex align-items-center justify-content-center flex-column">
    <div class="container mb-5">
      <h1 class="text-primary text-center">Login usuário</h1>
    </div>
    <!--Login form-->
    <form class="container d-flex flex-column align-items-center justify-content-center"
      action="../controllers/loginUserController.php" method="POST">
      <div class="container d-flex flex-column align-items-center justify-content-center">
        <div class="form-floating mb-3 w-75">
          <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
            required />
          <label for="floatingInput">Endereço de e-mail</label>
          <div id="email-feedback" class="invalid-feedback">Por favor, insira um e-mail válido.</div>
        </div>
        <div class="form-floating w-75 mt-4">
          <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password"
            required />
          <label for="floatingPassword">Senha</label>
        </div>
      </div>
      <button type="submit" class="btn btn-outline-primary btn-md mt-5 px-4 py-4 w-25">
        Entrar
      </button>
      <p class="mt-5 fs-5">
        <a class="link-offset-2 link-underline link-underline-opacity-0" href="registerUserView.php">Cadastrar
          novo
          usuário?</a>
      </p>
    </form>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!--Validação visual-->
  <script src="../js/emailValidation.js"></script>
</body>
</html>