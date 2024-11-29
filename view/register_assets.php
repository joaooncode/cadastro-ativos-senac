<?php
include_once('head.php');
include_once('../controllers/session.php');
include_once('modal.php');
include_once('dropdown.php');
include_once('../models/connect_db.php');
include_once('../controllers/functions.php');


$assets = fetchData($conn, 'ativo');


$sql = "
    SELECT 
    idAtivo,
    descricaoAtivo,
    (SELECT descricaoMarca FROM marca m WHERE m.idMarca = a.idMarca) as marca
    , statusAtivo,
    dataHoraCadastroAtivo, 
    quantidadeAtivo,
    obsAtivo,
    (SELECT descricaotipo FROM tipo t WHERE t.idTipo = a.idTipo) as tipo
    FROM ativo a
";

$result = mysqli_query($conn, $sql) or die(false);

//retorna todos os ativos
$data = $result->fetch_all(MYSQLI_ASSOC);

?>

<body class="min-vw-100 min-vh-100 overflow-hidden">
    <div class="container min-vh-100 min-vw-100 d-flex align-content-center justify-content-center flex-column">
        <main class="vw-100 vh-100 d-flex align-items-center justify-content-center flex-column">
            <!--Tabela ativos cadastrados-->
            <div class="container mb-5 w-100">
                <h1 class="text-center text-primary">Lista de Ativos</h1>
                <table class="table table-bordered  border-primary mt-5">
                    <table class="table table-bordered  border-primary mt-5">
                        <thead>
                            <th scope="col">
                                Descrição
                            </th>
                            <th scope="col">
                                Quantidade
                            </th>
                            <th scope="col">
                                Marca
                            </th>
                            <th scope="col">
                                Status
                            </th>
                            <th scope="col">
                                Observação
                            </th>
                            <th scope="col">
                                Tipo
                            </th>
                            <th scope="col">
                                Data de Cadastro
                            </th>
                            <th scope="col">
                                Ações
                            </th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $assets => $value) {
                                ?>
                                <tr>

                                    <td>
                                        <p>
                                            <?php echo $value['descricaoAtivo'] ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            <?php echo $value['quantidadeAtivo'] ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            <?php echo $value['marca'] ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            <?php echo $value['statusAtivo'] ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            <?php echo $value['obsAtivo'] ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            <?php echo $value['tipo'] ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            <?php echo $value['dataHoraCadastroAtivo'] ?>
                                        </p>
                                    </td>
                                    <td>
                                        <button class="btn  btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
            </div>
            <button style="width: 15%;" type="button" class="btn btn-outline-primary mt-3 mb-3  p-3"
                data-bs-toggle="modal" data-bs-target="#exampleModal">Cadastrar Ativo</button>
        </main>
    </div>
</body>
<script src="../js/assets.js"></script>