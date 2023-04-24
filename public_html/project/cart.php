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
        case "update":
            $des_quan = (int)se($_POST, "desired_quantity", 0, false);
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
    }
}

$query = "SELECT cart.id, product.name, product.stock, cart.unit_price, (cart.unit_price * cart.desired_quantity) as subtotal, cart.desired_quantity
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
        <?php $total = 0; ?>
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
        <?php foreach ($cart as $c) : ?>
            <tr>
                <td><?php se($c, "name"); ?></td>
                <td><?php se($c, "unit_price"); ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="cart_id" value="<?php se($c, "id"); ?>" />
                        <input type="hidden" name="action" value="update" />
                        <input type="number" name="desired_quantity" value="<?php se($c, "desired_quantity"); ?>" min="0" max="<?php se($c, "stock"); ?>" />
                        <input type="submit" class="btn btn-primary" value="Update Quantity" />
                    </form>
                </td>
                <?php $total += (int)se($c, "subtotal", 0, false); ?>
                <td><?php se($c, "subtotal"); ?></td>
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
        <tr>
            <td colspan="100%">Total: <?php se($total, null, 0); ?></td>
        </tr>
        </tbody>
    </table>
</div>
<?php
require(__DIR__ . "/../../partials/footer.php");
?>