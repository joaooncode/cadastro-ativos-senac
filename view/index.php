<?php
include('navbar.php');
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
    <div class="container d-flex flex-column align-items-center justify-content-center">
      <div class="form-floating mb-3 w-75">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required />
        <label for="floatingInput">Endereço de e-mail</label>
      </div>
      <div class="form-floating w-75 mt-4">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required />
        <label for="floatingPassword">Senha</label>
      </div>
    </div>
    <button type="submit" class="btn btn-outline-primary btn-lg mt-5 px-4 py-4 w-25">
      Entrar
    </button>
    <p class="mt-5 fs-5">
      <a class="link-offset-2 link-underline link-underline-opacity-0" href="./register_user.php">Cadastrar novo
        usuário?</a>
    </p>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
</body>

</html>