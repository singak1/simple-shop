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
    $orders = [];

    $orderIds = array_unique(array_column($results, 'orderid'));
    $orderIds = array_slice($orderIds, 0, 10);

    foreach ($orderIds as $orderId) {
        $order = [
            'orderid' => $orderId,
            'address' => null,
            'payment_method' => null,
            'money_recieved' => null,
            'first_name' => null,
            'last_name' => null,
            'total_price' => null,
            'items' => []
        ];
        foreach ($results as $r) {
            if ($r['orderid'] == $orderId) {
                $item = [
                    'name' => $r['product_name'],
                    'quantity' => $r['quantity'],
                    'price' => $r['unit_price'],
                    'subtotal' => $r['quantity'] * $r['unit_price']
                ];
                $order['address'] = $r['address'];
                $order['payment_method'] = $r['payment_method'];
                $order['money_recieved'] = $r['money_recieved'];
                $order['first_name'] = $r['first_name'];
                $order['last_name'] = $r['last_name'];
                $order['total_price'] = $r['total_price'];
                $order['items'][] = $item;
            }
        }
        $orders[] = $order;
    }

} catch (PDOException $e) {
    error_log(var_export($e, true));
    flash('Error fetching results', 'danger');
}
?>

<div class="container-fluid">
    <h1>Purchase History</h1>
    <?php if (count($orders) > 0): ?>
        <div class="row row-cols-1 row-cols-md-2">
            <?php foreach ($orders as $order): ?>
                <div class="col mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3>Order #<?php echo $order['orderid']; ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <h5>Payment Method</h5>
                                    <p><?php echo $order['payment_method']; ?></p>
                                </div>
                                <div class="col-6">
                                    <h5>Payment Received</h5>
                                    <p>$<?php echo cost_to_float($order['money_recieved']); ?></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5>Name and Shipping Address</h5>
                                    <p><?php echo $order['first_name'] . ' ' . $order['last_name'] . '<br>' . $order['address']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="<?php echo $BASE_PATH ?>/order_details.php?orderid=<?php echo $order['orderid']; ?>" class="btn btn-primary">Order Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No orders found.</div>
    <?php endif; ?>
</div>



<?php require(__DIR__ . "/../../partials/footer.php"); ?>