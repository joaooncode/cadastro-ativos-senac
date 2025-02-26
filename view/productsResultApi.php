<?php

include_once '../models/connect_db.php';
include_once '../controllers/sessionController.php';
include_once '../controllers/functionsController.php';
include_once '../view/dropdownView.php';

$inputSearch = $_POST['search'];

$url = 'https://api.mercadolibre.com/sites/MLB/search?q=' . urlencode($inputSearch) . '&limit=50&sort=relevance&condition=new';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

http_response_code(200);

$output = curl_exec($ch);

curl_close($ch);

$data = json_decode($output, true);

?>

<body>
    <div class="container mt-5">
        <?php if (isset($data['results']) && is_array($data['results'])): ?>
            <div class="d-flex flex-wrap justify-content-center">
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
                    <div class="card m-2" style="width: 14rem;">
                        <?php if (isset($item['thumbnail'])): ?>
                            <?php
                            // Check for high-quality image URLs
                            $imageUrl = $item['thumbnail'];
                            if (isset($item['pictures']) && is_array($item['pictures'])) {
                                foreach ($item['pictures'] as $picture) {
                                    if (isset($picture['url']) && $picture['size'] === 'full') {
                                        $imageUrl = $picture['url'];
                                        break;
                                    }
                                }
                            }
                            ?>
                            <img src="<?php echo htmlspecialchars($imageUrl); ?>" class="card-img-top img-fluid" alt="Thumbnail" style="object-fit: cover; height: 150px;">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['title']); ?></h5>
                            <p class="card-text">
                                <?php
                                if (isset($item['price']) && isset($item['currency_id'])) {
                                    $price = $item['price'];
                                    $currency = $item['currency_id'];
                                    $rate = isset($conversionRates[$currency]) ? $conversionRates[$currency] : 1;
                                    $priceBRL = $price * $rate;
                                    echo 'R$ ' . number_format($priceBRL, 2, ',', '.');
                                }
                                ?>
                            </p>
                            <?php if (isset($item['permalink'])): ?>
                                <a href="<?php echo htmlspecialchars($item['permalink']); ?>" class="btn btn-primary mt-auto" target="_blank">Ver</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Nenhum resultado encontrado.</div>
        <?php endif; ?>
    </div>
</body>