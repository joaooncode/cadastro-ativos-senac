<?php


function fetchData($conn, $table, $col_where = false, $value_where = false)
{
    $query = "select * from " . $table;
    if ($col_where != false) {
        $query .= " where $col_where='" . $value_where . "'";
    }
    $result = mysqli_query($conn, $query) or die(false);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    return $rows;
}



function searchProducts($queryTerm)
{

    $inputSearch = $_POST['search'];

    $url = 'https://api.mercadolibre.com/sites/MLB/search?q=' . "$inputSearch";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    http_response_code(200);

    $output = curl_exec($ch);

    curl_close($ch);


    $data = json_decode($output, true);
}