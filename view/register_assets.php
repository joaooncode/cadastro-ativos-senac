<?php
include_once('head.php');
include_once('../controllers/session.php');
include_once('dropdown.php');
include_once('../models/connect_db.php');
include_once('../controllers/functions.php');

$brands = fetchData($conn, 'marca');
$types = fetchData($conn, 'tipo');

include_once('modal.php');

$assets = fetchData($conn, 'ativo');

$sql = "
    SELECT 
    idAtivo,
    descricaoAtivo,
    (SELECT descricaoMarca FROM marca m WHERE m.idMarca = a.idMarca) as marca,
    statusAtivo,
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

<body class="min-vw-100 min-vh-100">
    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center flex-column">
        <main class="vw-100 vh-100 d-flex align-items-center justify-content-center flex-column">
            <!--Tabela ativos cadastrados-->
            <div class="container-fluid mb-5 w-100">
                <h1 class="text-center text-primary">Lista de Ativos</h1>

                <!-- Adicionando responsividade à tabela -->
                <div class="table-responsive">
                    <table class="table table-bordered border-primary mt-5">
                        <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Status</th>
                                <th scope="col">Observação</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Data de Cadastro</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $assets => $value) {
                                ?>
                                <tr>
                                    <td><?php echo $value['idAtivo'] ?></td>
                                    <td><?php echo $value['descricaoAtivo'] ?></td>
                                    <td><?php echo $value['quantidadeAtivo'] ?></td>
                                    <td><?php echo $value['marca'] ?></td>
                                    <td><?php echo $value['statusAtivo'] ?></td>
                                    <td><?php echo $value['obsAtivo'] ?></td>
                                    <td><?php echo $value['tipo'] ?></td>
                                    <td><?php echo $value['dataHoraCadastroAtivo'] ?></td>
                                    <td>
                                        <button class="btn btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div> <!-- Fim da table-responsive -->
            </div>

            <!-- Botão responsivo com largura ajustada para dispositivos móveis -->
            <button style="width: 100%; max-width: 200px;" type="button" class="btn btn-outline-primary mt-3 mb-5 p-3"
                data-bs-toggle="modal" data-bs-target="#exampleModal">Cadastrar Ativo</button>

        </main>
    </div>
</body>
<script src="../js/assets.js"></script>