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

$arr = [];
foreach ($opcoes as $row) {
    $arr[$row['id_opcao']]['descricao_opcao'] = $row['descricao_opcao'];
    $arr[$row['id_opcao']]['nivel_opcao'] = $row['nivel_opcao'];
    $arr[$row['id_opcao']]['url_opcao'] = $row['url_opcao'];
    $arr[$row['id_opcao']]['status_opcao'] = $row['status_opcao'];
    $arr[$row['id_opcao']]['descricao_nivel'] = $row['descricao_nivel'];
    $sub_query = "SELECT
        id_opcao,
        descricao_opcao,
        nivel_opcao,
        url_opcao,
        status_opcao,
        (SELECT descricao_nivel FROM nivel_acesso ac WHERE ac.id_nivel = a.nivel_opcao) AS descricao_nivel
       
      FROM opcoes_menu a
      WHERE  id_menu_superior = " . $row['id_opcao'];
    $sub_query_result = mysqli_query($conn, $sub_query) or die(false);
    $sub_query_options = $sub_query_result->fetch_all(mode: MYSQLI_ASSOC);

    foreach ($sub_query_options as $sub) {
        $arr[$sub['id_opcao']]['descricao_opcao'] = $sub['descricao_opcao'];
        $arr[$sub['id_opcao']]['nivel_opcao'] = $sub['nivel_opcao'];
        $arr[$sub['id_opcao']]['url_opcao'] = $sub['url_opcao'];
        $arr[$sub['id_opcao']]['status_opcao'] = $sub['status_opcao'];
        $arr[$sub['id_opcao']]['descricao_nivel'] = $sub['descricao_nivel'];

        $sql = "SELECT
        id_opcao,
        descricao_opcao,
        nivel_opcao,
        url_opcao,
        status_opcao,
        (SELECT descricao_nivel FROM nivel_acesso ac WHERE ac.id_nivel = a.nivel_opcao) AS descricao_nivel
       
      FROM opcoes_menu a
      WHERE  id_menu_superior = " . $sub['id_opcao'];
        $result_query_opcao = mysqli_query($conn, query: $sql) or die(false);
        $opcoesData = $result_query_opcao->fetch_all(mode: MYSQLI_ASSOC);

        foreach ($opcoesData as $opcao) {
            $arr[$opcao['id_opcao']]['descricao_opcao'] = $opcao['descricao_opcao'];
            $arr[$opcao['id_opcao']]['nivel_opcao'] = $opcao['nivel_opcao'];
            $arr[$opcao['id_opcao']]['url_opcao'] = $opcao['url_opcao'];
            $arr[$opcao['id_opcao']]['status_opcao'] = $opcao['status_opcao'];
            $arr[$opcao['id_opcao']]['descricao_nivel'] = $opcao['descricao_nivel'];
        }
    }
}


?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="cargo" class="form-label">Cargo</label>
                    <select name="cargo" id="cargo" class="form-select">
                        <option value="" disabled selected>Selecione o cargo</option>
                        <?php
                        foreach ($cargos as $value) {
                            if ($value['id_cargo'] == $id_cargo) {
                                echo '<option value="' . $value['id_cargo'] . '" selected>' . $value['descricao_cargo'] . '</option>';
                            } else {
                                echo '<option value="' . $value['id_cargo'] . '">' . $value['descricao_cargo'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            foreach ($arr as $id_opcao => $opcao) {
                ?>
            <div class="col-md-4"><?php echo $opcao['descricao_opcao']; ?></div>
            <?php
            }
            ?>
        </div>
    </div>
</body>