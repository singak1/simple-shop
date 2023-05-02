<?php

require(__DIR__. "/../../partials/nav.php");

if(!is_logged_in()) {
    flash("Please log in to continue!", "warning");
    die(header("Location: $BASE_PATH/login.php"));
}

$db = getDB();
$query = "SELECT cart.id, product.name as name, product.stock as product_stock, cart.unit_price, cart.product_id, product.unit_price as product_price, (cart.unit_price * cart.desired_quantity) as subtotal, cart.desired_quantity as quantity
          FROM Products as product JOIN Cart as cart on cart.product_id = product.id
          WHERE cart.user_id = :uid";
$stmt = $db->prepare($query);
try{
    $stmt->bindValue(":uid", get_user_id(), PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $balance = (int)$_POST['payment_amount'] * 100;
    $total_cost = 0;
    $total_product_cost = 0;
    foreach($results as $row) {
        $stock_diff = (int)se($row, "product_stock", 0, false) - (int)se($row, "quantity", 0, false);
        $total_cost += (int)se($row, "subtotal", 0, false);
        $total_product_cost += (int)se($row, "product_price", 0, false);
        $unit_price = (int)(se($row, "unit_price", 0, false));
        $product_price = ((int)(se($row, "product_price", 0, false)));
        $price_diff = ($unit_price - $product_price);
        if($stock_diff < 0) {
            flash("There are only " .se($row, "product_stock", 0, false) ." ". se($row, "name", 0, false)." available, please update your cart!", "warning");
            die(header("Location: $BASE_PATH/cart.php"));
        }
        else if($price_diff != 0) {
            flash("Cart needs to be updated to reflect new prices for item, " . se($row, "name", 0, false), "warning");
            die(header("Location: $BASE_PATH/cart.php"));
        }
    }
    if ($balance >= $total_cost) {
        //check out of date price and user can purchase the items
        $db->beginTransaction();
        $stmt = $db->prepare("SELECT max(id) as orderId FROM Orders");
        $next_order_id = 0;
        try {
            $stmt->execute();
            $r = $stmt->fetch(PDO::FETCH_ASSOC);
            $next_order_id = (int)se($r, "orderId", 0, false);
            $next_order_id++;
        } catch (PDOException $e) {
            error_log("Error fetching order_id: " . var_export($e));
            flash("Error fetching order_id", "warning");
            $db->rollback();
        }
    if ($next_order_id > 0) {
        $stmt = $db->prepare("UPDATE Products 
        set stock = stock - (select IFNULL(desired_quantity, 0) FROM Cart WHERE product_id = Products.id and user_id = :uid) 
        WHERE id in (SELECT product_id from Cart where user_id = :uid)");
        try {
            $stmt->bindValue(":uid", get_user_id(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Update stock error: " . var_export($e, true));
            $db->rollback();
            $next_order_id = 0; //using as a controller
        }
    }
    $user_id = (int)get_user_id();
    if($next_order_id > 0) {
        $address = $_POST['shipping_address'] . ', ' .
           $_POST['shipping_apt_suite_fl'] . ', ' .
           $_POST['shipping_city'] . ', ' .
           $_POST['shipping_state_province'] . ', ' .
           $_POST['shipping_country'] . ', ' .
           $_POST['shipping_zip_postal_code'];
        // prepare and execute the query
        $query = "INSERT INTO Orders (user_id, total_price, address, payment_method, money_recieved, first_name, last_name)
                  VALUES (:uid, :total_cost, :address, :payment_method, :money_recieved, :first_name, :last_name)";
        $stmt = $db->prepare($query);
        try {
            $stmt->execute([
                ":uid" => $user_id,
                ":total_cost" => $total_cost,
                ":payment_method" => $_POST['payment_method'],
                ":money_recieved" => $balance,
                ":first_name" => $_POST['shipping_first_name'],
                ":last_name" => $_POST['shipping_last_name'],
                ":address" => $address
            ]);
            $next_order_id = $db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Update Orders error: " . var_export($e, true));
            flash("Error", "danger");
            $db->rollback();
            $next_order_id = 0; //using as a controller
        }
    }

    if ($next_order_id > 0) {
        $stmt = $db->prepare("INSERT INTO OrderItems (order_id, product_id, quantity, unit_price)
        SELECT :order_id, product_id, desired_quantity, unit_price
        FROM Cart
        WHERE user_id = :user_id");
        try {
            $stmt->execute([":user_id" => $user_id, ":order_id" => $next_order_id]);
        } catch (PDOException $e) {
            error_log("Error mapping cart data to order history: " . var_export($e, true));
            flash("Error Updating Order Items", "danger");
            $db->rollback();
            $next_order_id = 0; //using as a controller
        }
    }
    if ($next_order_id > 0) {
        $stmt =  $db->prepare("DELETE from Cart where user_id = :uid");
        try {
            $stmt->execute([":uid" => $user_id]);
        } catch (PDOException $e) {
            error_log("Error deleting cart: " . var_export($e, true));
            $db->rollback();
            $next_order_id = 0; // using as a controller
        }
    }
    if ($next_order_id) {
        $db->commit();
    }
}
} catch (PDOException $e) {
    error_log(var_export($e, true));
    flash("Error fetching cart", "danger");
}

require(__DIR__ . "/../../partials/footer.php");
