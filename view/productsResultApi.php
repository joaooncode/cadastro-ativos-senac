<?php

include_once '../models/connect_db.php';
include_once './sessionController.php';
include_once '../controllers/functionsController.php';

$inputSearch = $_POST['search'];

$url = 'https://api.mercadolibre.com/sites/MLB/search?q=' . "$inputSearch";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

http_response_code(200);

$output = curl_exec($ch);

curl_close($ch);


$data = json_decode($output, true);

;

?>



<body>
    <div class="container mt-5">
        <?php if (isset($data['results']) && is_array($data['results'])): ?>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Imagem</th>
                        <th>Título</th>
                        <th>Preço (BRL)</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Array com taxas de conversão para BRL (valores de exemplo)
                    $conversionRates = [
                        'ARS' => 0.025,  // Exemplo: 1 ARS = 0.025 BRL
                        'USD' => 5.10,   // Exemplo: 1 USD = 5.10 BRL
                        'BRL' => 1,
                        // Adicione outras moedas, se necessário
                    ];
                    ?>
                    <?php foreach ($data['results'] as $item): ?>
                        <tr>
                            <td>
                                <?php if (isset($item['thumbnail'])): ?>
                                    <img src="<?php echo htmlspecialchars($item['thumbnail']); ?>" width="50" alt="Thumbnail">
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($item['title']); ?></td>
                            <td>
                                <?php
                                if (isset($item['price']) && isset($item['currency_id'])) {
                                    $price = $item['price'];
                                    $currency = $item['currency_id'];
                                    $rate = isset($conversionRates[$currency]) ? $conversionRates[$currency] : 1;
                                    $priceBRL = $price * $rate;
                                    echo 'R$ ' . number_format($priceBRL, 2, ',', '.');
                                }
                                ?>
                            </td>
                            <td>
                                <?php if (isset($item['permalink'])): ?>
                                    <a href="<?php echo htmlspecialchars($item['permalink']); ?>" target="_blank">Ver</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">Nenhum resultado encontrado.</div>
        <?php endif; ?>
    </div>