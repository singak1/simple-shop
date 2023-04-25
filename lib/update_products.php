<?php

function update_products($table, $id, $product_data, $ignore = ["id", "submit"])
{
    $columns = array_keys($product_data);
    foreach($columns as $index => $value) {
        if(in_array($value, $ignore)) {
            unset($columns[$index]);
        }
    }
$query = "UPDATE $table SET ";
$cols = [];
foreach ($columns as $index => $col) {
    array_push($cols, "$col = :$col");
}
$query .= join(",", $cols);
$query .= " WHERE id = :id";

$params = [":id" => $id];
foreach($columns as $col) {
    $params[":$col"] = se($product_data, $col, "", false);
}
$db = getDB();
$stmt = $db->prepare($query);
try {
    $stmt->execute($params);
    return true;
} catch (PDOException $e)
{
    error_log(var_export($e->errorInfo, true));
    flash("Error updating the product", "danger");
    return false;
    }
}