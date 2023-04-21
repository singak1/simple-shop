<?php

require(__DIR__. "/../../partials/nav.php");
$results = [];
$db = getDB();
$stmt = $db->prepare("SELECT id, name, description, category, stock, unit_price FROM Products WHERE visibility = 'true' LIMIT 10");
try {
    $stmt->execute();
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($r) {
        $results = $r;
    }
} catch(PDOException $e) {
    error_log(var_export($e, true));
    flash("Error fetching items", "danger");
}
?>
<script>
    //TODO ADD CART LOGIC HERE
</script>

<div class="container-fluid">
    <h1>Shop</h1>
    <div class="row row-cols-1 row-cols-md-5 g-4">
        <?php foreach ($results as $item) : ?>
            <div class="col">
                <div class="card bg-light">
                    <div class="card-header">
                        Product Placeholder
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Name: <?php se($item, "name"); ?></h5>
                        <p class="card-text">Description: <?php se($item, "description"); ?></p>
                    </div>
                    <div class="card-footer">
                        Cost: <?php se($item, "cost"); ?>
                        <button onclick="purchase('<?php se($item, 'id'); ?>')" class="btn btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>