<?php

require(__DIR__. "/../../partials/nav.php");

if(!is_logged_in()) {
    flash("Please log in to continue!", "warning");
    die(header("Location: $BASE_PATH/login.php"));
}

$query = "SELECT Orders.id as orderid, total_price, address, payment_method, money_recieved, first_name, last_name, item.product_id, item.quantity, item.unit_price, Products.name AS product_name
          FROM Orders JOIN OrderItems as item on item.order_id = Orders.id 
          JOIN Products ON Products.id = item.product_id
          WHERE Orders.user_id = :uid
          ORDER BY Orders.id DESC";

$db = getDB();
$stmt = $db->prepare($query);
$orders = [];
try {
    $stmt->bindValue(":uid", get_user_id(), PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $orderId = $results[0]['orderid'];
        $order = [];
        $order['orderid'] = $orderId;
        $items = [];
        foreach ($results as $r) {
            if ($r['orderid'] == $orderId) {
                $item = [
                    "name" => $r["product_name"],
                    "quantity" => $r["quantity"],
                    "price" => $r["unit_price"],
                    "subtotal" => $r["quantity"] * $r["unit_price"]
                ];
                $items[] = $item;
                $order['address'] = $r['address'];
                $order['payment_method'] = $r['payment_method'];
                $order['money_recieved'] = $r['money_recieved'];
                $order['first_name'] = $r['first_name'];
                $order['last_name'] = $r['last_name'];
                $order['total_price'] = $r['total_price'];
            }
        }
        $order['items'] = $items;
        $orders[] = $order;
    }
} catch (PDOException $e) {
    error_log(var_export($e, true));
    flash("Error fetching results", "danger");
}
?>

<div class="container-fluid">
    <h1>Order Confirmation</h1>
    <?php if (count($orders) > 0): ?>
        <?php foreach ($orders as $order): ?>
            <div class="card my-3">
                <div class="card-header">
                    <h3>Order #<?php echo $order['orderid']; ?></h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h5>Shipping Address</h5>
                            <p><?php echo $order['address']; ?></p>
                        </div>
                        <div class="col-6">
                            <h5>Payment Method</h5>
                            <p><?php echo $order['payment_method']; ?></p>
                            <h5>Payment Received</h5>
                            <p>$<?php echo cost_to_float($order['money_recieved']); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5>Order Summary</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($order['items'] as $item): ?>
                                        <tr>
                                            <td><?php echo $item['name']; ?></td>
                                            <td><?php echo $item['quantity']; ?></td>
                                            <td>$<?php echo cost_to_float((int)$item['price']); ?></td>
                                            <td>$<?php echo cost_to_float((int)$item['subtotal']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                        <td>$<?php echo cost_to_float((int)$order['total_price']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info">No orders found.</div>
    <?php endif; ?>
</div>
<div class="container text-center">
  <img src="<?php echo $BASE_PATH; ?>/imgs/thankyou.gif" alt="Thank You" class="img-fluid">
</div>



<?php
require(__DIR__ . "/../../partials/footer.php");
?>