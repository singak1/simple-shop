<?php
require(__DIR__. "/../../partials/nav.php");

if(!is_logged_in()) {
    flash("Please log in to continue!", "warning");
    die(header("Location: $BASE_PATH/login.php"));
}

$orderId = $_GET["orderid"];

$query = "SELECT Orders.id as orderid, total_price, address, payment_method, money_recieved, first_name, last_name, item.product_id, item.quantity, item.unit_price, Products.name AS product_name
          FROM Orders JOIN OrderItems as item on item.order_id = Orders.id 
          JOIN Products ON Products.id = item.product_id
          WHERE Orders.id = :oid";

$db = getDB();

try {
    if (!has_role("Admin") && !has_role("Shop Owner")) {
        $query .= " AND Orders.user_id = :uid";
    }
    $stmt = $db->prepare($query);
    $stmt->bindValue(":oid", $orderId, PDO::PARAM_INT);
    if (!has_role("Admin") && !has_role("Shop Owner")) {
        $stmt->bindValue(":uid", get_user_id(), PDO::PARAM_INT);
    }
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $order = [];
        $order['orderid'] = $results[0]['orderid'];
        $order['address'] = $results[0]['address'];
        $order['payment_method'] = $results[0]['payment_method'];
        $order['money_recieved'] = $results[0]['money_recieved'];
        $order['first_name'] = $results[0]['first_name'];
        $order['last_name'] = $results[0]['last_name'];
        $order['total_price'] = $results[0]['total_price'];
        $items = [];
        foreach ($results as $r) {
            $item = [
                "name" => $r["product_name"],
                "quantity" => $r["quantity"],
                "price" => $r["unit_price"],
                "subtotal" => $r["quantity"] * $r["unit_price"]
            ];
            $items[] = $item;
        }
        $order['items'] = $items;
    }
    if (empty($results)) {
        flash("Cannot view order details for this order", "warning");
        header("Location: $BASE_PATH/shop.php");
        exit;
    }
} catch (PDOException $e) {
    error_log(var_export($e, true));
    flash("Cannot view order details for this order", "warning");
    header("Location: $BASE_PATH/shop.php");
    exit;
}
?>

<div class="container-fluid">
    <h1>Order Details</h1>
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
            <div class="row mb-3">
                <div class="col-6">
                    <h5>First Name</h5>
                    <p><?php echo $order['first_name']; ?></p>
                </div>
                <div class="col-6">
                    <h5>Last Name</h5>
                    <p><?php echo $order['last_name']; ?></p>
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
</div>

<?php require(__DIR__ . "/../../partials/footer.php"); ?>