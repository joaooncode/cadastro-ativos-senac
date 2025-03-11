<?php

include_once '../models/connect_db.php';
include_once '../controllers/sessionController.php';
include_once '../controllers/functionsController.php';
include_once '../view/dropdownView.php';

// Verificar se o parâmetro de busca existe (seja via POST ou GET)
if (isset($_POST['search'])) {
    $inputSearch = $_POST['search'];
} elseif (isset($_GET['search'])) {
    $inputSearch = $_GET['search'];
} else {
    // Valor padrão ou mensagem de erro
    echo '<div class="alert alert-warning">Nenhum termo de busca fornecido.</div>';
    exit;
}

// Verificar se o termo de busca não está vazio
if (empty($inputSearch)) {
    echo '<div class="alert alert-warning">Por favor, forneça um termo de busca válido.</div>';
    exit;
}

// Construir a URL da API
$url = 'https://api.mercadolibre.com/sites/MLB/search?q=' . urlencode($inputSearch) . '&limit=50&sort=relevance&condition=new';

// Inicializar cURL
$ch = curl_init();

// Configurar opções do cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; YourApp/1.0)');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

// Executar a requisição
$output = curl_exec($ch);

// Verificar erros de cURL
if ($output === false) {
    echo "Erro cURL: " . curl_error($ch);
    http_response_code(500);
    curl_close($ch);
    exit;
}

// Verificar código HTTP de resposta
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode != 200) {
    echo "Erro HTTP: " . $httpCode;
    http_response_code($httpCode);
    exit;
}

// Decodificar a resposta JSON
$data = json_decode($output, true);

// Verificar se o JSON foi decodificado corretamente
if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    echo "Erro ao decodificar JSON: " . json_last_error_msg();
    http_response_code(500);
    exit;
}

// Array com taxas de conversão para BRL
$conversionRates = [
    'ARS' => 0.025,  // Exemplo: 1 ARS = 0.025 BRL
    'USD' => 5.10,   // Exemplo: 1 USD = 5.10 BRL
    'BRL' => 1,
    // Adicione outras moedas, se necessário
];

// Para depuração - descomente se necessário
/*
echo "<pre>";
echo "Termo de busca: " . htmlspecialchars($inputSearch) . "\n";
echo "URL: " . $url . "\n";
echo "HTTP Code: " . $httpCode . "\n";
echo "Response: ";
print_r($data);
echo "</pre>";
*/
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Busca</title>
    <!-- Adicione seus arquivos CSS aqui, caso não estejam incluídos em outro lugar -->
    <!-- <link rel="stylesheet" href="path/to/bootstrap.min.css"> -->
</head>

<body>
    <div class="container mt-5">
        <h3>Resultados para: "<?php echo htmlspecialchars($inputSearch); ?>"</h3>

        <?php if (isset($data['results']) && is_array($data['results']) && count($data['results']) > 0): ?>
            <div class="d-flex flex-wrap justify-content-center">
                <?php foreach ($data['results'] as $item): ?>
                    <div class="card m-2" style="width: 14rem;">
                        <?php if (isset($item['thumbnail'])): ?>
                            <?php
                            // Check for high-quality image URLs
                            $imageUrl = $item['thumbnail'];
                            if (isset($item['pictures']) && is_array($item['pictures'])) {
                                foreach ($item['pictures'] as $picture) {
                                    if (isset($picture['url']) && isset($picture['size']) && $picture['size'] === 'full') {
                                        $imageUrl = $picture['url'];
                                        break;
                                    }
                                }
                            }
                            ?>
                            <img src="<?php echo htmlspecialchars($imageUrl); ?>" class="card-img-top img-fluid" alt="Thumbnail"
                                style="object-fit: cover; height: 150px;">
                        <?php else: ?>
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                style="height: 150px;">
                                <span class="text-muted">Sem imagem</span>
                            </div>
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title" style="font-size: 0.9rem;"><?php echo htmlspecialchars($item['title']); ?>
                            </h5>
                            <p class="card-text">
                                <?php
                                if (isset($item['price']) && isset($item['currency_id'])) {
                                    $price = $item['price'];
                                    $currency = $item['currency_id'];
                                    $rate = isset($conversionRates[$currency]) ? $conversionRates[$currency] : 1;
                                    $priceBRL = $price * $rate;
                                    echo 'R$ ' . number_format($priceBRL, 2, ',', '.');
                                } else {
                                    echo 'Preço não disponível';
                                }
                                ?>
                            </p>
                            <?php if (isset($item['permalink'])): ?>
                                <a href="<?php echo htmlspecialchars($item['permalink']); ?>" class="btn btn-primary mt-auto"
                                    target="_blank">Ver</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Nenhum resultado encontrado para "<?php echo htmlspecialchars($inputSearch); ?>".
            </div>
        <?php endif; ?>
    </div>

    <!-- Adicione seus arquivos JS aqui, caso não estejam incluídos em outro lugar -->
    <!-- <script src="path/to/bootstrap.min.js"></script> -->
</body>

</html>