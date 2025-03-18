<?php
include('dropdownView.php')
?>


<!DOCTYPE html>
<html lang="en">
<header>
    <title>Listar Opções</title>
</header>

<body class="min-vh-100 w-vw-100 bg-light overflow-hidden d-flex">
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
            <tbody>
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