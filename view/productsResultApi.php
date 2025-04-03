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

$token_info = json_decode(file_get_contents('/var/www/scripts/mercadolivre/ml_token_info.json'), true);

$access_token = $token_info['access_token'];

// Construir a URL da API
$url = 'https://api.mercadolibre.com/sites/MLB/search?q=' . urlencode($inputSearch) . '&limit=50&sort=relevance&condition=new';

// Inicializar cURL
$ch = curl_init();

// Configurar opções do cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $access_token, 'Accept: application/json']);

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

// echo "<pre>";
// echo "Termo de busca: " . htmlspecialchars($inputSearch) . "\n";
// echo "URL: " . $url . "\n";
// echo "HTTP Code: " . $httpCode . "\n";
// echo "Response: ";
// print_r($data);
// echo "</pre>";

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

<body class="bg-light">
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="h3 text-primary mb-3">Resultados para: "<?= htmlspecialchars($inputSearch) ?>"</h2>

                <?php if (isset($data['results']) && is_array($data['results']) && count($data['results']) > 0): ?>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    <?php foreach ($data['results'] as $item): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 hover-shadow transition-all">
                            <?php if (isset($item['thumbnail'])): ?>
                            <?php
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
                            <div class="ratio ratio-1x1 bg-light">
                                <img src="<?= htmlspecialchars($imageUrl) ?>" class="card-img-top object-fit-cover"
                                    alt="<?= htmlspecialchars($item['title']) ?>">
                            </div>
                            <?php else: ?>
                            <div class="ratio ratio-1x1 bg-light d-flex align-items-center justify-content-center">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>
                            <?php endif; ?>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-2 text-truncate"><?= htmlspecialchars($item['title']) ?></h5>

                                <div class="d-flex align-items-center mb-3">
                                    <span class="badge bg-primary fs-6 py-2">
                                        <?php
                                                if (isset($item['price']) && isset($item['currency_id'])) {
                                                    $price = $item['price'];
                                                    $currency = $item['currency_id'];
                                                    $rate = $conversionRates[$currency] ?? 1;
                                                    $priceBRL = $price * $rate;
                                                    echo 'R$ ' . number_format($priceBRL, 2, ',', '.');
                                                } else {
                                                    echo 'Preço indisponível';
                                                }
                                                ?>
                                    </span>
                                    <?php if (isset($item['currency_id']) && $item['currency_id'] !== 'BRL'): ?>
                                    <small class="ms-2 text-muted">(convertido de <?= $item['currency_id'] ?>)</small>
                                    <?php endif; ?>
                                </div>

                                <?php if (isset($item['permalink'])): ?>
                                <a href="<?= htmlspecialchars($item['permalink']) ?>"
                                    class="btn btn-outline-primary w-100 mt-auto d-flex align-items-center justify-content-center"
                                    target="_blank">
                                    <i class="bi bi-eye me-2"></i>
                                    Ver produto
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle me-3 fs-4"></i>
                    <div>
                        Nenhum resultado encontrado para "<?= htmlspecialchars($inputSearch) ?>"
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>