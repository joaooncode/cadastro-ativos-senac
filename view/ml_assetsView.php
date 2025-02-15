<?php

include_once('../controllers/sessionController.php');
include_once('../controllers/functionsController.php');
include_once('dropdownView.php');


$query = "select 
quantidadeAtivo, 
quantidadeMinimaAtivo, 
descricaoAtivo,
(select descricaoMarca from marca m where m.idMarca = a.idMarca ) as descricaoMarca
(select quantidadeUso from movimentacao u where u.idAtivo = a.idAtivo and u.statusMovimentacao = 'S')
 as uso from ativo a;";


$result = mysqli_query($conn, $query);
$assets = $result->fetch_all(MYSQLI_ASSOC);
$getResult = '';



foreach ($assets as $asset) {
    $available = $asset['quantidadeAtivo'] - $asset['uso'];
    if ($available < $asset['quantidadeMinimaAtivo']) {

        $queryTerm = $asset['descricaoAtivo'] . $asset['descricaoMarca'];
        $getResult .= searchProducts($queryTerm);
    }
}
;