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


