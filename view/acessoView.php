<?php
include('../models/connect_db.php');
include('../controllers/functionsController.php');
include('dropdownView.php');





$options_data = fetchData($conn, 'opcoes_menu');
$levels = fetchData($conn, 'nivel_acesso');
include_once('./modal/options_modal.php');
$query = 'SELECT 
            id_opcao,
            descricao_opcao,
            nivel_opcao,
            url_opcao,
            status_opcao,
            idUsuario,
            data_cadastro
        FROM opcoes_menu';

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$data = $result->fetch_all(MYSQLI_ASSOC);
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
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
            </div>
        </div>
        <div class="row">
            <?php 
                foreach ($array as $idOpcao => $opcao) {
                    # code...
                    
                    ?>
            <div class="col-md-4"><?php echo $opcao['descricao_opcao']; ?></div>
            <?php
                }
            ?>
        </div>
    </div>
</body>