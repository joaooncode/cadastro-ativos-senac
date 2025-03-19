<?php
include('dropdownView.php');
include_once('../models/connect_db.php');
include_once('../controllers/functionsController.php');



$options_data = fetchData($conn, 'opcoes_menu');


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


<!DOCTYPE html>
<html lang="pt-BR">
<header>
    <title>Listar Opções</title>
</header>

<body class="min-vh-100 w-vw-100 bg-light overflow-hidden d-flex">
    <button class="btn btn-primary al">Nova Opção</button>
    <h1 class="text-center text-primary">Controle de Opções</h1>
    <div class="container d-flex mt-10">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Nivel</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody class="">
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>