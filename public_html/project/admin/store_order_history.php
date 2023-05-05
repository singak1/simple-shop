<?php
require(__DIR__ . "/../../../partials/nav.php");

if(!is_logged_in()) {
    flash("Please log in to continue!", "warning");
    die(header("Location: $BASE_PATH/login.php"));
}
if(!has_role("Admin") && !has_role("Shop Owner")) {
    //Redirect non admin or shop owner
    flash("You don't have permission to view this page", "warning");
    die(header("Location: $BASE_PATH/home.php"));
}

$query = "SELECT Orders.id as orderid, total_price, address, payment_method, money_recieved, first_name, last_name, item.product_id, item.quantity, item.unit_price, Products.name AS product_name, Users.username as username
          FROM Orders 
          JOIN OrderItems as item on item.order_id = Orders.id 
          JOIN Products ON Products.id = item.product_id
          JOIN Users ON Users.id = Orders.user_id
          ORDER BY Orders.id DESC";

$db = getDB();
$orders = [];

try {
    $stmt = $db->prepare($query);
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
            'items' => [],
            'username' => null
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
                $order['username'] = $r['username'];
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
    <h1>Shop Purchase History</h1>
    <?php if (count($orders) > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order #</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Payment Received</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Order Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['orderid']; ?></td>
                        <td><?php echo $order['payment_method']; ?></td>
                        <td>$<?php echo cost_to_float($order['money_recieved']); ?></td>
                        <td><?php echo $order['first_name'] . ' ' . $order['last_name']; ?></td>
                        <td><?php echo $order['username']; ?></td>
                        <td>$<?php echo $order['total_price']; ?></td>
                        <td>
                            <a href="<?php echo $BASE_PATH ?>/order_details.php?orderid=<?php echo $order['orderid']; ?>" class="btn btn-primary">Order Details</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No orders found.</div>
    <?php endif; ?>
</div>

<?php 
    //note we need to go up 1 more directory
    require_once(__DIR__ . "/../../../partials/footer.php");
 ?>