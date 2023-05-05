<?php

require(__DIR__. "/../../partials/nav.php");

if(!is_logged_in()) {
    flash("Please log in to continue!", "warning");
    die(header("Location: $BASE_PATH/login.php"));
}

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
        case "update":
            $des_quan = (int)se($_POST, "desired_quantity", 0, false);
            if($des_quan < 0) {
                flash("Quantity can not be set to negative values", "warning");
                die(header("Location: $BASE_PATH/cart.php"));
            }
            if($des_quan == 0){
                $query = "DELETE FROM Cart WHERE id = :cid AND user_id = :uid";
                $stmt = $db->prepare($query);
                $stmt->bindValue(":cid", se($_POST, "cart_id", 0, false), PDO::PARAM_INT);
                $stmt->bindValue(":uid", get_user_id(), PDO::PARAM_INT);
            }
            else {
                $query = "UPDATE Cart SET desired_quantity = :dq WHERE id = :cid AND user_id = :uid";
                $stmt = $db->prepare($query);
                $des_quan = (int)se($_POST, "desired_quantity", 0, false);
                $stmt->bindValue(":dq", se($_POST, "desired_quantity", 0, false), PDO::PARAM_INT);
                $stmt->bindValue(":cid", se($_POST, "cart_id", 0, false), PDO::PARAM_INT);
                $stmt->bindValue(":uid", get_user_id(), PDO::PARAM_INT);
            }
            try{
                $stmt->execute();
                flash("Cart updated successfully", "success");
            } catch(PDOException $e) {
                error_log(var_export($e, true));
                flash("Error updating the cart", "danger");
            }
            break;
        case "delete":
            $query = "DELETE FROM Cart WHERE id = :cid AND user_id = :uid";
            $stmt = $db->prepare($query);
            $stmt->bindValue(":cid", se($_POST, "cart_id", 0, false), PDO::PARAM_INT);
            $stmt->bindValue(":uid", get_user_id(), PDO::PARAM_INT);
            try{
                $stmt->execute();
                flash("Item successfully removed from cart", "success");
            } catch(PDOException $e) {
                error_log(var_export($e, true));
                flash("Error removing item from cart", "danger");
            }
            break;
        case "clear":
            $query = "DELETE FROM Cart WHERE user_id = :uid";
            $stmt = $db->prepare($query);
            $stmt->bindValue(":uid", get_user_id(), PDO::PARAM_INT);
            try{
                $stmt->execute();
                flash("All items removed from cart successfully", "success");
            } catch(PDOException $e) {
                error_log(var_export($e, true));
                flash("Error removing item from cart", "danger");
            }
            break;
    }
}

$query = "SELECT cart.id, product.name, product.stock, cart.unit_price, cart.product_id, (cart.unit_price * cart.desired_quantity) as subtotal, cart.desired_quantity
          FROM Products as product JOIN Cart as cart on cart.product_id = product.id
          WHERE cart.user_id = :uid";

$db = getDB();
$stmt = $db->prepare($query);
$cart = [];
try {
    $stmt->bindValue(":uid", get_user_id(), PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $cart = $results;
    }
} catch (PDOException $e) {
    error_log(var_export($e, true));
    flash("Error fetching cart", "danger");
}
?>

<div class="container-fluid">
    <h1>Cart</h1>
    <table class="table table-striped">
        <?php $total = 0; 
              $total_items = 0;?>
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($cart as $c) : 
            $sub_total = 0;    
        ?>
            <tr>
                <td><a href="product_details.php?id=<?php se($c, "product_id") ?>" ><?php se($c, "name"); ?></a></td>
                <?php 
                    $price = (int)se($c, "unit_price", 0, false);
                    $price = cost_to_float($price);
                ?>
                <td>$<?php se($price, null, 0); ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="cart_id" value="<?php se($c, "id"); ?>" />
                        <input type="hidden" name="action" value="update" />
                        <input type="number" name="desired_quantity" value="<?php se($c, "desired_quantity"); ?>" min="0" max="<?php se($c, "stock"); ?>" />
                        <input type="submit" class="btn btn-primary" value="Update Quantity" />
                    </form>
                </td>
                <?php $sub_total += (int)se($c, "subtotal", 0, false);
                      $total += (int)se($c, "subtotal", 0, false); 
                      $total_items += (int)se($c, "desired_quantity", 0, false); 
                      $total_cost = cost_to_float($total);
                      $sub_total = cost_to_float($sub_total); ?>
                <td>$<?php se($sub_total, null, 0); ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="cart_id" value="<?php se($c, "id"); ?>" />
                        <input type="hidden" name="action" value="delete" />
                        <input type="submit" class="btn btn-danger" value="x" />
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (count($cart) == 0) : ?>
            <tr>
                <td colspan="100%">No items in cart</td>
            </tr>
        <?php endif; ?>
        <?php if (count($cart) != 0) : ?>
        <tr>
            <td colspan="100%">Total: $<?php se($total_cost, null, 0); ?></td>
        </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <form method="POST">
            <input type="hidden" name="action" value="clear" />
            <input type="submit" class="btn btn-danger" value="Clear Cart" />
            <a class="btn btn-warning" href="checkout.php" >Proceed to Checkout(<?php se($total_items, null, 0); ?> Items)</a>
        </form>
    </div>
</div>
<?php
require(__DIR__ . "/../../partials/footer.php");
?>