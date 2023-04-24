<?php

require(__DIR__. "/../../partials/nav.php");

is_logged_in(true);

$action = strtolower(trim(se($_POST, "action", "", false)));
if(!empty($action)) {
    $db = getDB();
    switch ($action) {
        case "add":
            $query = "INSERT INTO Cart (product_id, desired_quantity, unit_price, user_id) 
                      VALUES (:pid, :dq, (SELECT unit_price FROM Products WHERE id = :pid), :uid) ON DUPLICATE KEY UPDATE
                      desired_quantity = desired_quantity + :dq";
            $stmt = $db->prepare($query);
            $stmt->bindValue(":pid", se($_POST, "product_id", 0, false), PDO::PARAM_INT);
            $stmt->bindValue(":dq", se($_POST, "desired_quantity", 0, false), PDO::PARAM_INT);
            $stmt->bindValue(":uid", get_user_id(), PDO::PARAM_INT);
            try {
                $stmt->execute();
                flash("Added item to cart", "success");
            } catch (PDOException $e) {
                error_log(var_export($e, true));
                flash("Error adding item to cart", "danger");
            }
            break;
    }
}
?>