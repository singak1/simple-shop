<?php

require(__DIR__. "/../../partials/nav.php");

if(!is_logged_in()) {
    flash("Please log in to continue!", "warning");
    die(header("Location: $BASE_PATH/login.php"));
}

$db = getDB();
$query = "SELECT cart.id, product.name, product.stock, cart.unit_price, cart.product_id, product.unit_price as product_price, (cart.unit_price * cart.desired_quantity) as subtotal, cart.desired_quantity
          FROM Products as product JOIN Cart as cart on cart.product_id = product.id
          WHERE cart.user_id = :uid";
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
    <h1>Checkout</h1>
    <table class="table table-striped">
        <?php $total = 0; 
              $total_items = 0;?>
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
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
                    <?php se($c, "desired_quantity"); ?>
                </td>
                <?php $sub_total += (int)se($c, "subtotal", 0, false);
                      $total += (int)se($c, "subtotal", 0, false); 
                      $total_items += (int)se($c, "desired_quantity", 0, false); 
                      $total_cost = cost_to_float($total);
                      $sub_total = cost_to_float($sub_total); 
                     
                      $unit_price = (int)(se($c, "unit_price", 0, false));
                      $product_price = ((int)(se($c, "product_price", 0, false)));
                      echo '<script>console.log(' . $product_price . ')</script>';
                      if ($product_price != 0) {
                        $price_diff = ($unit_price - $product_price) / $product_price * 100;
                      } else {
                        $price_diff = 0;
                      }
                ?>
                <td>$<?php se($sub_total, null, 0); ?>
                    <?php if ($price_diff != 0) {
                        echo("(");
                        se(round($price_diff, 2));
                        echo("%)");
                        } 
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (count($cart) == 0) : ?>
            <tr>
                <td colspan="100%">No items in cart</td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="100%">Total: $<?php se($total_cost, null, 0); ?></td>
        </tr>
        </tbody>
    </table>
</div>
<?php
require(__DIR__ . "/../../partials/footer.php");
?>