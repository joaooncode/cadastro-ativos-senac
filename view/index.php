<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Cadastro de Usuário</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <!--Link css-->
  <link rel="stylesheet" href="../css/style.css">

</head>

<body class="min-vw-100 min-vh-100">
  <header>
    <!-- place navbar here -->
    <div class="container">
      <nav class="navbar navbar-expand-lg bg-body-tertiary fs-5 shadow p-3 mb-5 bg-body-tertiary rounded fixed-top"
        data-bs-theme="light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="https://api.senacrs.com.br/bff/site-senac/v1/file/078f143692e591ec20623efea089cdf3d19a24.png"
              alt="logo-senac" height="45" />
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active link-primary" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link link-primary" href="#">Listar Ativos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link link-primary" href="./list_users.php">Listar Usuário</a>
              </li>
              <li class="nav-item">
                <a class="nav-link link-primary" href="#">Cadastrar Ativo</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <main class="vw-100 vh-100 d-flex align-items-center justify-content-center flex-column">
    <div class="container mb-5">
      <h1 class="text-primary text-center">Login usuário</h1>
    </div>
    <!--Login form-->
    <div class="container d-flex flex-column align-items-center justify-content-center">
      <div class="form-floating mb-3 w-75">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required />
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating w-75 mt-4">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required />
        <label for="floatingPassword">Password</label>
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