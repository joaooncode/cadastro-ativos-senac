<?php

include('../models/connect_db.php');
include('../controllers/functionsController.php');
include_once('headView.php');
include_once('dropdownView.php');

// id do usuário a ser alterado
$id = $_GET['idUsuario'];


$query_db = fetchData($conn, 'usuario', 'idUsuario', $id);
$cargos = fetchData($conn, 'cargo');

foreach ($query_db as $key => $value) {
    # code...
    $nome = $value['nomeUsuario'];
    $turma = $value['turmaUsuario'];
    $idUsuario = $value['idUsuario'];
    $idCargo = $value['id_cargo'];
}


//$sql = "UPDATE usuario SET nomeUsuario='$updateName' SET turmaUsuario='$$updateClass' WHERE id=$id";

?>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-grow-1 d-flex align-items-center">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-lg">
                        <div class="card-body p-4 p-md-5">
                            <h1 class="text-center text-primary mb-4">Alterar usuário</h1>

                            <!-- Formulário -->
                            <form action="../controllers/patchUserController.php" method="POST">
                                <input type="hidden" name="idUsuario" value="<?php echo $idUsuario ?>">
                                
                                <div class="mb-4">
                                    <label for="nomeUsuario" class="form-label">Nome</label>
                                    <input type="text" value="<?php echo $nome ?>" 
                                           class="form-control" 
                                           id="nomeUsuario"
                                           name="nomeUsuario" 
                                           required>
                                </div>

                                <div class="mb-4">
                                    <label for="turmaUsuario" class="form-label">Turma</label>
                                    <input type="text" value="<?php echo $turma ?>" 
                                           class="form-control" 
                                           id="turmaUsuario"
                                           name="turmaUsuario" 
                                           required>
                                </div>

                                <div class="mb-4">
                                    <label for="cargo_usuario" class="form-label">Cargo</label>
                                    <select name="cargo" id="cargo_usuario" class="form-select">
                                        <option value="" disabled selected>Selecione o cargo</option>
                                        <?php
                                        foreach ($cargos as $value) {
                                            $selected = ($value['id_cargo'] == $idCargo) ? 'selected' : '';
                                            echo '<option value="'.$value['id_cargo'].'" '.$selected.'>'
                                                .htmlspecialchars($value['descricao_cargo'])
                                                .'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="d-grid mt-5">
                                    <button type="submit" class="btn btn-primary btn-lg py-2">Alterar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<?php

include('../models/connect_db.php');
include('../controllers/functionsController.php');
include_once('headView.php');
include_once('dropdownView.php');

// id do usuário a ser alterado
$id = $_GET['idUsuario'];


$query_db = fetchData($conn, 'usuario', 'idUsuario', $id);
$cargos = fetchData($conn, 'cargo');

foreach ($query_db as $key => $value) {
    # code...
    $nome = $value['nomeUsuario'];
    $turma = $value['turmaUsuario'];
    $idUsuario = $value['idUsuario'];
    $idCargo = $value['id_cargo'];
}


//$sql = "UPDATE usuario SET nomeUsuario='$updateName' SET turmaUsuario='$$updateClass' WHERE id=$id";

?>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-grow-1 d-flex align-items-center">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-lg">
                        <div class="card-body p-4 p-md-5">
                            <h1 class="text-center text-primary mb-4">Alterar usuário</h1>

                            <!-- Formulário -->
                            <form action="../controllers/patchUserController.php" method="POST">
                                <input type="hidden" name="idUsuario" value="<?php echo $idUsuario ?>">
                                
                                <div class="mb-4">
                                    <label for="nomeUsuario" class="form-label">Nome</label>
                                    <input type="text" value="<?php echo $nome ?>" 
                                           class="form-control" 
                                           id="nomeUsuario"
                                           name="nomeUsuario" 
                                           required>
                                </div>

                                <div class="mb-4">
                                    <label for="turmaUsuario" class="form-label">Turma</label>
                                    <input type="text" value="<?php echo $turma ?>" 
                                           class="form-control" 
                                           id="turmaUsuario"
                                           name="turmaUsuario" 
                                           required>
                                </div>

                                <div class="mb-4">
                                    <label for="cargo_usuario" class="form-label">Cargo</label>
                                    <select name="cargo" id="cargo_usuario" class="form-select">
                                        <option value="" disabled selected>Selecione o cargo</option>
                                        <?php
                                        foreach ($cargos as $value) {
                                            $selected = ($value['id_cargo'] == $idCargo) ? 'selected' : '';
                                            echo '<option value="'.$value['id_cargo'].'" '.$selected.'>'
                                                .htmlspecialchars($value['descricao_cargo'])
                                                .'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="d-grid mt-5">
                                    <button type="submit" class="btn btn-primary btn-lg py-2">Alterar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>