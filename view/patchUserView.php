<?php

include('../models/connect_db.php');
include('../controllers/functionsController.php');
include_once('headView.php');
include_once('dropdownView.php');

// id do usuário a ser alterado
$id = $_GET['idUsuario'];


$query_db = fetchData($conn, 'usuario', 'idUsuario', $id);

foreach ($query_db as $key => $value) {
    # code...
    $nome = $value['nomeUsuario'];
    $turma = $value['turmaUsuario'];
    $idUsuario = $value['idUsuario'];
}


//$sql = "UPDATE usuario SET nomeUsuario='$updateName' SET turmaUsuario='$$updateClass' WHERE id=$id";

?>

<body class="min-vw-100 min-vh-100 overflow-hidden overflow-hidden">
    <main class="vw-100 vh-100 d-flex align-items-center justify-content-center flex-column mt-5 pt-5">
        <h1 class="text-center text-primary mb-3">Alterar usuário</h1>
        <hr class="border border-primary border-3 opacity-25 w-100 mb-4">

        <!-- Formulário -->
        <div class="container w-100 h-100 mt-5">

            <form action="../controllers/patchUserController.php" method="POST"
                  class="w-100 d-flex flex-column justify-content-center align-items-center">
                <input type="hidden" name="idUsuario" value="<?php echo $idUsuario ?>">
                <div class="mb-3">
                    <label for="nomeUsuario" class="form-label">Nome</label>
                    <input type="text" value="<?php echo $nome ?>" class="form-control w-100" id="nomeUsuario"
                        name="nomeUsuario" required />
                </div>
                <div class="mb-3">
                    <label for="turmaUsuario" class="form-label">Turma</label>
                    <input type="text" value="<?php echo $turma ?>" class=" form-control w-100" id="turmaUsuario"
                        name="turmaUsuario" required />
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary py-2 px-4 w-100">Alterar</button>
                </div>
            </form>
        </div>
    </main>

    <footer class="mt-5 py-3 text-center">
        <!-- Add footer content here if needed -->
    </footer>

</body>

</html>